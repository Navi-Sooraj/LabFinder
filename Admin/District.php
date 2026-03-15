<?php
include("../Assets/Connection/Connection.php");
include('Head.php');

$did="";
$dname="";

if(isset($_POST['btn_submit']))
{
    $district=$_POST['txt_district'];
    $did=$_POST['txt_id'];
    if($did=="")
    {
        $inserqry="insert into tbl_district(district_name) values('".$district."')";
        if($Conn->query($inserqry))
        {
            ?>
            <script>
                alert("inserted");
                window.location="District.php";
            </script>
            <?php
        }
    }
    else
    {
        $upQry="update tbl_district set district_name='".$district."' where district_id='".$did."'";
        if($Conn->query($upQry))
        {
            ?>
            <script>
                alert("Updated");
                window.location="District.php";
            </script>
            <?php
        }
    }
}
if(isset($_GET['Delid']))
{
    $delQry="delete from tbl_district where district_id='".$_GET['Delid']."'";
    if($Conn->query($delQry))
    {
        ?>
        <script>
            alert("Deleted");
            window.location="District.php";
        </script>
        <?php
    }
}
if(isset($_GET['Editid']))
{
    $selQry="select * from tbl_district where district_id='".$_GET['Editid']."'";
    $row=$Conn->query($selQry);
    $data=$row->fetch_assoc();
    $did=$data['district_id'];
    $dname=$data['district_name'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>District</title>
<style>
    /* --- General Styles --- */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-image: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url('../Assets/Templates/Main/assets/img/w1.png'); /* Added background image with overlay */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        /* background-color: #5A827E; Main background color */
        /* display: flex; */
        /* flex-direction: column; */
        /* justify-content: flex-start; Align to top */
        align-items: center;
        /* padding: 50px 20px; */
        min-height: 100vh;
        margin: 0;
        box-sizing: border-box;
    }

    /* --- Heading Styles --- */
    h3 { /* Changed from h4 for consistency */
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

    /* --- Form Container Styles --- */
    form {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        width: 100%;
        max-width: 700px;
        margin: auto;
        margin-bottom: 100px;
    }
    
    /* --- General Table Reset --- */
    table {
        border-collapse: collapse;
        border: none;
        width: 100%;
    }

    /* --- First Table (Input Form) Styles --- */
    form > table:first-of-type {
        margin-bottom: 40px;
    }
    
    form > table:first-of-type td {
        border: none;
        padding: 15px 10px;
        vertical-align: middle;
    }

    form > table:first-of-type td:first-child {
        width: 30%;
        font-weight: 600;
        color: #555;
        text-align: right;
        padding-right: 25px;
    }

    /* --- Input Field Styles --- */
    input[type="text"] {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-sizing: border-box;
        transition: all 0.3s ease;
        background-color: #f9f9f9;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    input[type="text"]:focus {
        border-color: #5A827E;
        outline: none;
        box-shadow: 0 0 8px rgba(90, 130, 126, 0.2);
        background-color: #fff;
    }

    /* --- Button Styles --- */
    input[type="submit"] {
        padding: 12px 25px;
        min-width: 150px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        font-size: 1em;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        background-color: #5A827E;
        color: white;
    }

    input[type="submit"]:hover {
        background-color: #4B6F6A;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    
    form > table:first-of-type td[colspan="2"] {
      text-align: center;
    }

    /* --- Second Table (Data Display) Styles --- */
    form > table:last-of-type {
        margin-top: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
    }

    form > table:last-of-type td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
        color: #333; /* Set text color to dark grey for visibility */
    }

    form > table:last-of-type tr:first-child {
        background-color: #f8f8f8;
        font-weight: bold;
        color: #333;
    }
    
    form > table:last-of-type tr:nth-child(even) {
        background-color: #fdfdfd;
    }
    
    form > table:last-of-type tr:last-child td {
      border-bottom:none;
    }

    /* --- Action Links as Buttons --- */
    form > table:last-of-type a {
        display: inline-block;
        padding: 6px 12px;
        margin: 2px;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: 500;
        font-size: 0.9em;
        transition: all 0.3s;
    }
    
    a[href*="Editid"] {
      background-color: #3498db; /* Blue for Edit */
    }
    
    a[href*="Editid"]:hover {
      background-color: #2980b9;
    }

    a[href*="Delid"] {
      background-color: #e74c3c; /* Red for Delete */
    }
    
    a[href*="Delid"]:hover {
      background-color: #c0392b;
    }

</style>
</head>

<body>
<h3 align="center"><b>Districts</b></h3>
<form action="" method="post">
<table width="310" height="86" border="1" align="center">
  <tr>
    <td>District</td>
    <td><label for="txt_district"></label>
    <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $did ?>"/>
      <input type="text" name="txt_district" id="txt_district" placeholder="Enter the District" value="<?php echo $dname ?>" required="required" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
</table>

<table width="409" height="89" border="1" align="center">
  <tr>
    <td width="89" height="37" align="center">SlNo</td>
    <td width="163" align="center">District Name</td>
    <td width="112" align="center">Action</td>
  </tr>
  <?php
  $i=0;
  $SelQry="select * from tbl_district";
  $row=$Conn->query($SelQry);
    while($data= $row->fetch_assoc())
    {
        $i++;
  ?>
  <tr>
    <td height="42" align="center"><?php echo $i ?></td>
    <td align="center"><?php echo $data['district_name']?></td>
    <td align="center">
     <a href="District.php?Editid=<?php echo $data['district_id']?>">Edit</a>
     <a href="District.php?Delid=<?php echo $data['district_id']?>">Delete</a>
    </td>
    </tr>
    <?php
    }
    ?>
</table>
</form>
</body>
</html>


<?php
include('Foot.php');
?>

