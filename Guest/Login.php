<?php
include("../Assets/Connection/Connection.php");
include("Head.php");


if(isset($_POST['btn_login']))
{	
	$email=$_POST['txt_email'];
	$password=$_POST['txt_password'];
	
	$selQadmin="select * from tbl_admin where admin_email='".$email."' and admin_password='".$password."'";
	$adminres=$Conn->query($selQadmin);
	
	$selQuser="select * from tbl_user where user_email='".$email."' and user_password='".$password."'";
	$userres=$Conn->query($selQuser);
	
	$selQlab="select * from tbl_lab where lab_email='".$email."' and lab_password='".$password."' and lab_status=1";
	$labres=$Conn->query($selQlab);
	
	if($userdata=$userres->fetch_assoc())
	{
		$_SESSION['uid']=$userdata['user_id'];
        ?>
		    <script>
                window.location="../User/Homepage.php";
            </script> 
        <?php
	}
	else if($labdata=$labres->fetch_assoc())
	{
		$_SESSION['lid']=$labdata['lab_id'];
		?>
		    <script>
                window.location="../Lab/HomePageL.php";
            </script> 
        <?php
	}
	else if($admindata=$adminres->fetch_assoc())
	{
		$_SESSION['aid']=$admindata['admin_id'];
        ?>
		    <script>
                window.location="../Admin/HomePageA.php";
            </script> 
        <?php
	}
	else
	{
		?>
		<script>
			alert("Invalid Login");
			window.location="Login.php";
		</script>
		<?php
	}
	
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
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
        /* justify-content: center; */
        align-items: center; /* Vertically center the form */
        /* padding: 50px 20px; */
        min-height: 100vh;
        margin: 0;
        box-sizing: border-box;
    }

    /* --- Form Container Styles --- */
    #form1 {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        width: 100%;
        max-width: 450px; /* Adjusted max-width for a login form */
        margin: auto;
    }

    /* --- Heading Styles --- */
    h2 {
        color: #333;
        margin-top: 0;
        margin-bottom: 30px;
        font-size: 2em;
        font-weight: 300; /* Lighter font for a modern look */
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
        background-color: #5A827E;
        border-radius: 2px;
    }

    /* --- Table Styles --- */
    table {
        width: 100%;
        border-collapse: collapse;
        border: none; /* Override inline border attribute */
        margin-top: 20px;
    }

    table tr td {
        border: none; /* Ensure no borders on cells */
        padding: 12px 0;
    }

    /* Label column */
    td:first-child {
        font-weight: 600;
        color: #555;
        width: 100px; /* Fixed width for labels */
    }

    /* Input column */
    td:last-child {
        text-align: left;
    }

    /* --- Input Field Styles --- */
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-sizing: border-box;
        transition: all 0.3s ease;
        background-color: #f9f9f9;
        font-size: 1em;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
        border-color: #5A827E;
        outline: none;
        box-shadow: 0 0 8px rgba(90, 130, 126, 0.2);
        background-color: #fff;
    }
    
    /* --- Button Styles --- */
    input[type="submit"] {
        width: 100%;
        padding: 12px 25px;
        margin-top: 15px;
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
        background-color: #4B6F6A; /* Darker shade on hover */
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    
    /* --- Link Styles --- */
    td[colspan="2"] a {
        color: #5A827E;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    td[colspan="2"] a:hover {
        color: #3e5a57;
        text-decoration: underline;
    }
    
    /* Center submit button and links */
    td[colspan="2"] {
        text-align: center !important;
        padding-top: 10px;
    }

</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <h2 align="center"><u>Login</u></h2>
  <table width="426" height="136" border="1" align="center">
    <tr>
      <td width="120" align="center">Email</td>
      <td width="292" align="center"><label for="txt_email"></label>
      <input type="email" name="txt_email" id="txt_email" placeholder="Enter Your Email" required /></td>
    </tr>
    <tr>
      <td align="center">Password</td>
      <td align="center"><label for="txt_password"></label>
      <input type="password" name="txt_password" id="txt_password" placeholder="Enter Your Password" required="required" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
      <input type="submit" name="btn_login" id="btn_login" value="Login" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
      <a href="LabRegistration.php">NewLab</a> / <a href="UserRegistration.php">NewUser</a>
      </td>
    </tr>
    <tr>
     <td colspan="2" align="center">   
       <a href="forget_psw.php" style="color: #414141c5;">Forget Password?</a> 
     </td>
    </tr>
  </table>
</form>
</body>
</html>

<?php
include("Foot.php");
?>