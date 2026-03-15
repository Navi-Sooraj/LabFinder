<?php
include("../Assets/Connection/Connection.php");
include("Head.php");
   
 $SelQry="select * from tbl_lab l inner join tbl_place p on l.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where lab_id='".$_SESSION['lid']."'";
 $res=$Conn->query($SelQry);
 $data=$res->fetch_assoc();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Profile</title>
<style>
    /* --- General Styles --- */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-image: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url('../Assets/Templates/Main/assets/img/w1.png'); /* Added background image with overlayz */
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
    h2 {
        color: #ffffff;
        margin-bottom: 30px;
        font-size: 2.2em;
        font-weight: 300;
        text-align: center;
        letter-spacing: 1px;
        position: relative;
        padding-bottom: 15px;
    }

    h2 u {
        text-decoration: none;
    }

    h2::after {
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
    #form1 {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        width: 100%;
        max-width: 500px; /* Adjusted for a profile card */
        margin: auto;
    }

    /* --- Table Styles --- */
    table {
        width: 100%;
        border-collapse: collapse;
        border: none;
    }

    td {
        padding: 15px 10px;
        vertical-align: middle;
        border-bottom: 1px solid #f0f0f0; /* Softer separator */
    }

    tr:last-child td {
        border-bottom: none;
    }

    /* Profile Image */
    td[colspan="2"] img {
        border-radius: 50%; /* Make the image circular */
        object-fit: cover;
        border: 4px solid #f0f0f0;
    }

    /* Left column (Labels) */
    td:first-child {
        font-weight: 600;
        color: #555;
        text-align: right;
        padding-right: 25px;
        width: 40%;
    }

    /* Right column (Data) */
    td:last-child {
        color: #333;
        text-align: left;
        width: 60%;
    }

    /* --- Action Links as Buttons --- */
    td[colspan="2"] a {
        display: inline-block;
        padding: 10px 20px;
        margin: 5px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        font-size: 0.9em;
        letter-spacing: 0.5px;
        text-decoration: none;
        transition: all 0.3s ease;
        text-align: center;
    }

    a[href*="EditProfile.php"] {
        background-color: #5A827E;
        color: white;
    }

    a[href*="EditProfile.php"]:hover {
        background-color: #294844ff;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    
    a[href*="ChangePassword.php"] {
        background-color: #5A827E;
        color: white;
    }
    
    a[href*="ChangePassword.php"]:hover {
        background-color: #294844ff;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }
    
    /* Center align the content of the first and last rows */
    tr:first-child td[colspan="2"],
    tr:last-child td[colspan="2"] {
        text-align: center !important;
    }


</style>
</head>

<body>
<h2 align="center"><u>My Profile</u></h2>
<form id="form1" name="form1" method="post" action="">
  <table width="348" height="371" border="1" align="center">
    <tr>
      <td height="109" colspan="2" align="center"><img width="100" height="100" src="../Assets/Files/Lab/Photo/<?php echo $data['lab_photo'] ?>" /></td>
    </tr>
    <tr>
      <td width="102" align="center">Name</td>
      <td width="82" align="center"><?php echo $data['lab_name']?></td>
    </tr>
    <tr>
      <td align="center">Email</td>
      <td align="center"><?php echo $data['lab_email']?></td>
    </tr>
    <tr>
      <td align="center">Contact</td>
      <td align="center"><?php echo $data['lab_contact']?></td>
    </tr>
    <tr>
      <td align="center">Address</td>
      <td align="center"><?php echo $data['lab_address']?></td>
    </tr>
    <tr>
      <td align="center">District</td>
      <td align="center"><?php echo $data['district_name']?></td>
    </tr>
    <tr>
      <td align="center">Place</td>
      <td align="center"><?php echo $data['place_name']?></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
      <a href="EditProfile.php" >Edit Profile</a> | 
      <a href="ChangePassword.php">Change Password</a></td>
    </tr>
  </table>
</form>
</body>
</html>


<?php
include("Foot.php");
?>