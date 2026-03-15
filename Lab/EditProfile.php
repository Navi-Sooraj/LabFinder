<?php
include("../Assets/Connection/Connection.php");
include("Head.php");

$selQry="select * from tbl_lab where lab_id='".$_SESSION['lid']."'"; 
$res=$Conn->query($selQry);
$data=$res->fetch_assoc();

$name="";
$email="";
$address="";
$contact="";

if(isset($_POST['btn_submit']))
{
	$name=$_POST['txt_name'];
	$email=$_POST['txt_email'];
	$address=$_POST['txt_address'];
	$contact=$_POST['num_contact'];

	$upQry="update tbl_lab set lab_name='".$name."',lab_email='".$email."',lab_address='".$address."',lab_contact='".$contact."' where lab_id='".$_SESSION['lid']."'";
	if($Conn->query($upQry))
	{
		?>
		<script>
			alert("Updated");
			window.location="MyProfile.php";
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
<title>Edit-Profile</title>
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
        width: 30%;
        font-weight: 600;
        color: #555;
        text-align: right;
        padding-right: 25px;
    }

    /* Right column (Inputs) */
    td:last-child {
        width: 70%;
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

    input[name="btn_submit"] {
        background-color: #5A827E;
        color: white;
    }

    input[name="btn_submit"]:hover {
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
<h3 align="center">Edit Profile</h3>
<form id="form1" name="form1" method="post" action="">
  <table width="521" height="150" border="1" align="center">
    <tr>
      <td width="78" align="center">Name</td>
      <td width="431" align="center"><label for="txt_name"></label>
      <input type="text" name="txt_name" id="txt_name" value="<?php echo $data['lab_name'] ?>" required/></td>
    </tr>
    <tr>
      <td align="center"><p>Email</p></td>
      <td align="center"><label for="txt_email"></label>
      <input type="email" name="txt_email" id="txt_email" value="<?php echo $data['lab_email'] ?>" required="required" /></td>
    </tr>
    <tr>
      <td align="center">Address</td>
      <td align="center"><label for="txt_address"></label>
      <textarea name="txt_address" id="txt_address" cols="45" rows="5" required="required" ><?php echo $data['lab_address'] ?></textarea></td>
    </tr>
    <tr>
      <td align="center">Contact</td>
      <td align="center"><label for="num_contact"></label>
      <input type="text" name="num_contact" id="num_contact" value="<?php echo $data['lab_contact'] ?>" required="required" /></td>
    </tr>
      <tr>
      <td colspan="2" align="center">
      <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
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