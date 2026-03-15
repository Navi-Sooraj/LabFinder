<?php
include("../Assets/Connection/Connection.php");
include("Head.php");

if(isset($_POST['btn_changepsw']))
{
	$selQry="select * from tbl_user where user_id='".$_SESSION['uid']."'";
	$res=$Conn->query($selQry);
	$data=$res->fetch_assoc();
	$oldpassword=$data['user_password'];

	if($_POST['txt_oldpsw']==$oldpassword)
	{
		$newpassword=$_POST['txt_newpsw'];
		$retypepassword=$_POST['txt_retypepsw'];
	
		if($newpassword==$retypepassword)
		{
			$upQry="update tbl_user set user_password='".$newpassword."' where '".$newpassword."'='".$retypepassword."' and user_id='".$_SESSION['uid']."'";
			
			if($Conn->query($upQry))
			{
				?>
				<script>
					alert("Password Changed");
					window.location="Myprofile.php";
				</script>
				<?php
			}
		}
		else
		{
			?>
				<script>
					alert("Password Error");
					window.location="ChangePassword.php";
				</script>
				<?php
		}
	}
	else
	{
		?>
			<script>
				alert("Wrong Old Password");
				window.location="ChangePassword.php";
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
<title>Change password</title>
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
    form {
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
        width: 35%; /* Adjusted for longer text */
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
    input[type="password"] {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-sizing: border-box;
        transition: all 0.3s ease;
        background-color: #f9f9f9;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    input[type="password"]:focus {
        border-color: #5A827E;
        outline: none;
        box-shadow: 0 0 8px rgba(90, 130, 126, 0.2);
        background-color: #fff;
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
    
    /* Primary Button (Change Password) */
    input[name="btn_changepsw"] {
        background-color: #5A827E;
        color: white;
    }
    
    input[name="btn_changepsw"]:hover {
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

<h3 align="center"><u>Change Password</u></h3>

<form action="" method="post">
  <table width="484" height="196" border="1" align="center">
    <tr>
      <td width="199" align="center">Old Password</td>
      <td width="269" align="center"><label for="txt_oldpsw"></label>
      <input type="password" name="txt_oldpsw" id="txt_oldpsw" placeholder="Enter the Old Password" required /></td>
    </tr>
    <tr>
      <td align="center">New Password</td>
      <td align="center"><label for="txt_newpsw"></label>
      <input type="password" name="txt_newpsw" id="txt_newpsw" placeholder="Enter the New Password"  required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" /></td>
    </tr>
    <tr>
      <td align="center">Re-Type Password</td>
      <td align="center"><label for="txt_retypepsw"></label>
      <input type="password" name="txt_retypepsw" id="txt_retypepsw" placeholder="Re-Type the password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
      <input type="submit" name="btn_changepsw" id="btn_changepsw" value="Change Password" />
      <input type="submit" name="btn_cancel" id="btn_cancel" value="Cancel" />
      </td>
    </tr>
  </table>
</form>
</body>
</html>

<?php
include("Foot.php");
?>