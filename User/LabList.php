<?php
include("../Assets/Connection/Connection.php");
include("Head.php");

$selUser = "SELECT * FROM tbl_user u 
            INNER JOIN tbl_place p ON u.place_id = p.place_id 
            WHERE user_id='" . $_SESSION['uid'] . "'";
$resUser = $Conn->query($selUser);
$dataUser = $resUser->fetch_assoc();
$user_place = $dataUser['place_id'];
$user_district = $dataUser['district_id'];

// Filter handling
$district = $_POST['sel_district'] ?? '';
$place = $_POST['sel_place'] ?? '';

// Base query
$selQry = "SELECT * FROM tbl_lab l
    INNER JOIN tbl_place p ON l.place_id = p.place_id
    INNER JOIN tbl_district d ON p.district_id = d.district_id
    WHERE lab_status = 1
";

// Apply filters dynamically
if (!empty($district)) {
    $selQry .= " AND d.district_id = '$district'";
}
if (!empty($place)) {
    $selQry .= " AND p.place_id = '$place'";
}

// Order by: user’s place first → user’s district next → then others
$selQry .= "
    ORDER BY 
        (l.place_id = '$user_place') DESC,
        (d.district_id = '$user_district') DESC,
        l.lab_name ASC
";

$res = $Conn->query($selQry);
?>

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lab List</title>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
    integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-image: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url('../Assets/Templates/Main/assets/img/w1.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    align-items: center;
    min-height: 100vh;
    margin: 0;
}

#form1 {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    width: 95%;
    max-width: 1500px;
    overflow-x: auto;
    margin: 40px auto;
}

/* --- Heading Styles --- */
h3 {
    color: #ffffff;
    margin-bottom: 30px;
    font-size: 2.2em;
    font-weight: 300;
    text-align: center;
    letter-spacing: 1px;
    position: relative;
    padding-bottom: 15px;
}
h3 u {
    text-decoration: none;
}
h3::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 3px;
    background-color: #ffffff;
    border-radius: 2px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #e9ecef;
}

tr:first-child {
    background-color: #f8f9fa;
    font-weight: 600;
}

td img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
}

td a {
    display: inline-block;
    text-decoration: none;
    color: #ffffff;
    background-color: #5A827E;
    padding: 8px 15px;
    margin: 2px;
    border-radius: 6px;
    transition: all 0.3s ease;
}

td a:hover {
    background-color: #4B6F6A;
    transform: translateY(-1px);
}

.filter-box {
    text-align: center;
    margin-bottom: 20px;
}

select, input[type=submit] {
    padding: 8px 12px;
    margin: 0 5px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 0.95em;
}

input[type=submit] {
    background-color: #5A827E;
    color: white;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #4B6F6A;
}
</style>
<script src="../Assets/JQ/jQuery.js"></script>
<script>
$(document).ready(function(){
    $("#sel_district").change(function(){
        var did = $(this).val();
        $.ajax({
            url: "../Assets/AjaxPages/AjaxPlace.php",
            data: { did: did },
            success: function(result){
                $("#sel_place").html(result);
            }
        });
    });
});
</script>
</head>

<body>
<h3><u>Lab List</u></h3>

<form id="form1" name="form1" method="post" action="">
    <!-- Filter Section -->
    <div class="filter-box">
        <select name="sel_district" id="sel_district">
            <option value="">Select District</option>
            <?php
            $disQry = "SELECT * FROM tbl_district";
            $disRes = $Conn->query($disQry);
            while($disData = $disRes->fetch_assoc()) {
                $sel = ($district == $disData['district_id']) ? "selected" : "";
                echo "<option value='{$disData['district_id']}' $sel>{$disData['district_name']}</option>";
            }
            ?>
        </select>

        <select name="sel_place" id="sel_place">
            <option value="">Select Place</option>
            <?php
            if (!empty($district)) {
                $plQry = "SELECT * FROM tbl_place WHERE district_id='$district'";
                $plRes = $Conn->query($plQry);
                while ($plData = $plRes->fetch_assoc()) {
                    $sel = ($place == $plData['place_id']) ? "selected" : "";
                    echo "<option value='{$plData['place_id']}' $sel>{$plData['place_name']}</option>";
                }
            }
            ?>
        </select>

        <input type="submit" value="Filter" />
    </div>

    <!-- Lab Table -->
    <table  width="100%" cellpadding="10" align="center">
        <tr>
            <td width="3%" >Sl.No</td>
            <td width="15%" >Name</td>
            <td width="20%" >Email</td>
            <td width="20%" >Address</td>
            <td width="10%" >District</td>
            <td width="8%" >Place</td>
            <td width="7%" >Contact</td>
            <td width="7%" >Photo</td>
            <td width="10%" >Action</td>
        </tr>
        <?php
        $i = 0;
        while($data = $res->fetch_assoc()) {
            $i++;
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $data['lab_name'] ?></td>
            <td><?php echo $data['lab_email'] ?></td>
            <td><?php echo $data['lab_address'] ?></td>
            <td><?php echo $data['district_name'] ?></td>
            <td><?php echo $data['place_name'] ?></td>
            <td><?php echo $data['lab_contact'] ?></td>
            <td><img src="../Assets/Files/Lab/Photo/<?php echo $data['lab_photo'] ?>" /></td>
            <td>
                <a href="ViewMore.php?viewid=<?php echo $data['lab_id'] ?>">View More</a><br>
                <a href="Appointment.php?aid=<?php echo $data['lab_id'] ?>">Book Appointment</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</form>
</body>
</html>

<?php include("Foot.php"); ?>
