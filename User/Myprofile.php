<?php
 include("../Assets/Connection/Connection.php");

 include("Head.php");
   
 $SelQry="select * from tbl_user u inner join tbl_place p on u.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id where user_id='".$_SESSION['uid']."'";
 $res=$Conn->query($SelQry);
 $data=$res->fetch_assoc();
 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Profile</title>
<style>
    /* --- General Styles --- */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-image: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url('../Assets/Templates/Main/assets/img/w1.png'); /* Added background image with overlay */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        /* display: flex; */
        /* flex-direction: column; Allow heading and form to stack */
        /* justify-content: center; */
        align-items: center;
        /* padding: 50px 20px; */
        min-height: 100vh;
        margin: 0;
        box-sizing: border-box;
    }

    /* --- Form & Main Container Styles --- */
    #form1 {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        width: 100%;
        max-width: 500px; /* Good width for a profile card */
        margin: auto;
    }

    /* --- Heading Styles --- */
    h2 {
        color: #ffffff; /* Make heading visible against the dark background */
        margin-bottom: 30px;
        font-size: 2.2em;
        font-weight: 300;
        text-align: center;
        letter-spacing: 1px;
        position: relative;
        padding-bottom: 15px;
    }

    h2 u {
        text-decoration: none; /* Remove default underline */
    }

    /* Custom underline for heading */
    h2::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background-color: #ffffff; /* White underline to match text */
        border-radius: 2px;
    }

    /* --- Table Styles for Profile --- */
    table {
        width: 100%;
        border-collapse: collapse;
        border: none;
    }

    td {
        padding: 15px 10px;
        border-bottom: 1px solid #f0f0f0; /* Soft separator for rows */
        vertical-align: middle;
    }
    
    table tr:last-child td {
        border-bottom: none; /* Remove border on the last row */
    }

    /* Profile Picture Row */
    td[colspan="2"] {
        text-align: center;
    }
    
    .img1 {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%; /* Circular profile picture */
        border: 4px solid #f0f0f0;
    }

    /* Label Cells (e.g., "Name", "Email") */
    td:first-child:not([colspan="2"]) {
        font-weight: 600;
        color: #555;
        width: 30%;
        text-align: right;
        padding-right: 20px;
    }
    
    /* Data Cells */
    td:last-child:not([colspan="2"]) {
        color: #333;
        text-align: left;
    }

    /* --- Links/Actions Row --- */
    tr:last-child td[colspan="2"] {
        padding-top: 30px;
    }

    a {
        text-decoration: none;
        color: #5A827E;
        font-weight: 600;
        padding: 8px 12px;
        border-radius: 6px;
        transition: all 0.3s ease;
    }

    a:hover {
        background-color: #f0f8f7;
        color: #4B6F6A;
    }

</style>
</head>

<body>
<h2 align="center"><u>My Profile</u></h2>

<form id="form1" name="form1" method="post" action="">
  <table width="369" height="382" border="1" align="center">
    <tr>
      <td height="131" colspan="2" align="center"><img class="img1" width="100" height="100" src="../Assets/Files/User/Photo/<?php echo $data['user_photo'] ?>" /></td>
    </tr>
    <tr>
      <td width="103" align="center">Name</td>
      <td width="250" align="center"><?php echo $data['user_name'] ?></td>
    </tr>
    <tr>
      <td align="center">Email</td>
      <td align="center"><?php echo $data['user_email']?></td>
    </tr>
    <tr>
      <td align="center">Contact</td>
      <td align="center"><?php echo $data['user_contact']?></td>
    </tr>
    <tr>
      <td align="center">Address</td>
      <td align="center"><?php echo $data['user_address']?></td>
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
      <td height="47" colspan="2" align="center">
        <a href="Editprofile.php" >Edit Profile</a> | 
        <a href="ChangePassword.php">Change Password</a>
      </td>
    </tr>
  </table>
</form>
</body>
</html>

<?php
include("Foot.php");
?>


