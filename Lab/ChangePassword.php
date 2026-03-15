<?php
include("../Assets/Connection/Connection.php");
include("Head.php");

if(isset($_POST['btn_change']))	
{
	$selQry="select * from tbl_lab where lab_id='".$_SESSION['lid']."'";
	$res=$Conn->query($selQry);
	$data=$res->fetch_assoc();
	$oldpassword=$data['lab_password'];
	
	
	if($_POST['txt_oldpassword']==$oldpassword)
	{
		if($_POST['txt_newpassword']==$_POST['txt_repassword'])
		{
			$upQry="update tbl_lab set lab_password='".$_POST['txt_newpassword']."' where lab_id='".$_SESSION['lid']."'";
			if($Conn->query($upQry))
			{
				?>
				<script>
					alert("Password Changed");
					window.location="MyProfile.php";
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
<title>Change Password</title>
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
      text-decoration:none;
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
        padding: 15px 10px;
        vertical-align: middle;
        border: none;
    }

    /* Left column (Labels) */
    td:first-child {
        width: 40%;
        font-weight: 600;
        color: #555;
        text-align: right;
        padding-right: 25px;
    }

    /* Right column (Inputs) */
    td:last-child {
        width: 60%;
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

    input[name="btn_change"] {
        background-color: #5A827E;
        color: white;
    }

    input[name="btn_change"]:hover {
        background-color: #4B6F6A;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    input[name="btn_cancel"] {
        background-color: #f1f1f1;
        color: #555;
    }

    input[name="btn_cancel"]:hover {
        background-color: #e1e1e1;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }
    
    /* Center the button row */
    td[colspan="2"] {
        text-align: center !important;
        padding-top: 20px;
    }

</style>
</head>

<body>
<h3 align="center"><u>Change Password</u></h3>
<form id="form1" name="form1" method="post" action="">
  <table width="422" height="179" border="1" align="center">
    <tr>
      <td width="194" align="center">Old Password</td>
      <td width="212" align="center"><label for="txt_oldpassword"></label>
      <input type="password" name="txt_oldpassword" id="txt_oldpassword" required placeholder="Enter the Old Password" /></td>
    </tr>
    <tr>
      <td align="center">New Password</td>
      <td align="center"><label for="txt_newpassword"></label>
      <input type="password" name="txt_newpassword" id="txt_newpassword" required placeholder="Enter the new Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" /></td>
    </tr>
    <tr>
      <td align="center">Re-type Password</td>
      <td align="center"><label for="txt_repassword"></label>
      <input type="password" name="txt_repassword" id="txt_repassword" required placeholder="Re-type the new Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" /></td>
    </tr>
    <tr>
      <td height="31" colspan="2" align="center">
      <input type="submit" name="btn_change" id="btn_change" value="Change Password" />
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