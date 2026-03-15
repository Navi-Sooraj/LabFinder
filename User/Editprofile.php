<?php
 include("../Assets/Connection/Connection.php");
 include("Head.php");
 
 $selQry="select * from tbl_user where user_id='".$_SESSION['uid']."'";
 $res=$Conn->query($selQry);
 $data=$res->fetch_assoc();

 $name="";
 $address="";
 $contact="";
 $address="";
 if(isset($_POST['btn_update']))
 {
	 $name=$_POST['txt_name'];
	 $email=$_POST['txt_email'];
	 $contact=$_POST['txt_contact'];
	 $address=$_POST['txt_address'];
	
	 $upQry="update tbl_user set user_name='".$name."',user_email='".$email."',user_contact='".$contact."',user_address='".$address."' where user_id='".$_SESSION['uid']."'";
	 if($Conn->query($upQry))
	 {
		 ?>
		 <script>
			alert("Updated");
			window.location="Myprofile.php";
		 </script>
     	 <?php
     }
 }
 
 if(isset($_POST['btn_cancel']))
 {
	 ?>
	 <script>
	 	window.location="Myprofile.php";
	 </script>
	 <?php
 }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Edit Profile</title>
<style>
    /* --- General Styles --- */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-image: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url('../Assets/Templates/Main/assets/img/w1.png'); /* Added background image with overlay */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        /* background-color: #5A827E; Main background color */
        /* display: flex; */
        /* flex-direction: column; Stacks heading and form */
        /* justify-content: center; */
        align-items: center;
        /* padding: 50px 20px; */
        min-height: 100vh;
        margin: 0;
        box-sizing: border-box;
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
    
    /* --- Form Container Styles --- */
    #form1 {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        width: 100%;
        max-width: 600px;
        margin: auto;
    }

    /* --- Table Styles --- */
    table {
        width: 100%;
        border-collapse: collapse;
        border: none;
    }

    td {
        border: none;
        padding: 15px 10px;
        vertical-align: middle;
    }
    
    /* Label column */
    td:first-child {
        width: 25%;
        font-weight: 600;
        color: #555;
        text-align: right;
        padding-right: 25px;
    }

    /* Input column */
    td:last-child {
        text-align: left;
    }

    /* --- Input Field Styles --- */
    input[type="text"],
    input[type="email"],
    textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-sizing: border-box;
        transition: all 0.3s ease;
        background-color: #f9f9f9;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    textarea:focus {
        border-color: #5A827E;
        outline: none;
        box-shadow: 0 0 8px rgba(90, 130, 126, 0.2);
        background-color: #fff;
    }
    
    textarea {
        resize: vertical;
        min-height: 100px;
    }

    /* --- Button Styles --- */
    input[type="submit"] {
        padding: 12px 25px;
        margin: 5px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        font-size: 1em;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }
    
    /* Primary Button (Update) */
    input[name="btn_update"] {
        background-color: #5A827E;
        color: white;
    }
    
    input[name="btn_update"]:hover {
        background-color: #4B6F6A;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    
    /* Secondary Button (Cancel) */
    input[name="btn_cancel"] {
        background-color: #f1f1f1;
        color: #555;
    }
    
    input[name="btn_cancel"]:hover {
        background-color: #e1e1e1;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    /* Center submit button row */
    td[colspan="2"] {
        text-align: center !important;
        padding-top: 20px;
    }
</style>
</head>

<body>

<h3 align="center"><u>Edit Profile</u></h3>

<form id="form1" name="form1" method="post" action="">
 
  <table width="316" height="235" border="1" align="center">
    <tr>
      <td width="97" align="center">Name</td>
      <td width="203" align="center"><label for="txt_name"></label>
      <input type="text" name="txt_name" id="txt_name" value="<?php echo $data['user_name'] ?>" required title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" minlength="3" /></td>
    </tr>
    <tr>
      <td align="center">Email</td>
      <td align="center"><label for="txt_email"></label>
      <input type="email" name="txt_email" id="txt_email" value="<?php echo $data['user_email'] ?>" required/></td>
    </tr>
    <tr>
      <td align="center"><p>Contact</p></td>
      <td align="center"><label for="txt_contact"></label>
      <input type="text" name="txt_contact" id="txt_contact" value="<?php echo $data['user_contact']?>" maxlength="10" pattern="[6-9]{1}[0-9]{9}" title="Phone number start with 6-9 and remaning 9 digit with 0-9" required /></td>
    </tr>
    <tr>
      <td align="center">Address</td>
      <td align="center"><label for="txt_address"></label>
      <textarea name="txt_address" id="txt_address" cols="45" rows="5"><?php echo $data['user_address']?></textarea></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
      
      <input type="submit" name="btn_update" id="btn_update" value="Update" />
      <input type="submit" name="btn_cancel" id="btn_cancel" value="cancel" />
      </td>
    </tr>
  </table>
  <p>&nbsp;</p>
  
</form>
<p>&nbsp;</p>
</body>
</html>

<?php
include("Foot.php");
?>