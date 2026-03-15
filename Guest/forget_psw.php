<?php
include("../Assets/Connection/Connection.php");
include("Head.php");

$password_hint = null;

if(isset($_POST['btn_submit']))
{	
	$email=$_POST['txt_email'];
	
	$selQuser="select * from tbl_user where user_email='".$email."'";
	$userres=$Conn->query($selQuser);
	
	$selQlab="select * from tbl_lab where lab_email='".$email."' and lab_status=1";
	$labres=$Conn->query($selQlab);
	
	if($userdata=$userres->fetch_assoc())
	{
		$password_hint = $userdata['user_password_hint'];
	}
	else if($labdata=$labres->fetch_assoc())
	{
		$password_hint = $labdata['lab_password_hint'];
	}
	else
	{
		?>
		<script>
			alert("Invalid Email");
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
<title>Forget Password</title>
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
    input[type="password"],
    input[type="text"] { /* Added text type for hint */
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
    input[type="password"]:focus,
    input[type="text"]:focus {
        border-color: #5A827E;
        outline: none;
        box-shadow: 0 0 8px rgba(90, 130, 126, 0.2);
        background-color: #fff;
    }
    
    /* Style for read-only hint field */
    input[readonly] {
        background-color: #e9e9e9;
        color: #555;
        cursor: default;
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
    <h2 align="center"><u>Forget Password</u></h2>
    <table width="426" height="136" border="1" align="center">
        <tr>
            <td width="120" align="center">Email</td>
            <td width="292" align="center"><label for="txt_email"></label>
            <input type="email" name="txt_email" id="txt_email" placeholder="Enter Your Email" 
                   value="<?php echo htmlspecialchars($email ?? ''); ?>" required /></td>
        </tr>
        <?php
        // Only show the hint field if a hint was found after submission
        if ($password_hint !== null) {
            ?>
            <tr>
                <td width="120" align="center">Hint</td>
                <td width="292" align="center">
                <input type="text" name="txt_hint" id="txt_hint" 
                       value="<?php echo htmlspecialchars($password_hint); ?>" 
                       readonly />
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center" style="padding-top: 20px;">
                    <a href="Login.php">Go back to Login</a>
                </td>
            </tr>
            <?php
        } else {
            // Show the submit button only if the hint is not yet found
            ?>
            <tr>
                <td colspan="2" align="center">
                <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
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
include("Foot.php");
?>