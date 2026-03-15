<?php
include("../Assets/Connection/Connection.php");
include("Head.php");

if(isset($_POST['btn_submit']))
{
	$title=$_POST['txt_title'];
	$content=$_POST['txt_content'];
	
	if($_GET['labid'] !="")
	{

	    $insQry="insert into tbl_complaint(complaint_title,complaint_content,complaint_date,lab_id,user_id) values('".$title."','".$content."',CURDATE(),'".$_GET['labid']."','".$_SESSION['uid']."')";
	}
	else
	{
		$insQry="insert into tbl_complaint(complaint_title,complaint_content,complaint_date,user_id) values('".$title."','".$content."',CURDATE(),'".$_SESSION['uid']."')";
		
	}
	if($Conn->query($insQry))
    {
	    ?>
        <script>
	        alert("Inserted");
	        window.location="ComplaintView.php";
	    </script>
        <?php
    }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Complaint Registration</title>
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
        /* flex-direction: column; Stacks heading and form */
        /* justify-content: center; */
        align-items: center;
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
        max-width: 600px;
        margin: auto;
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
        width: 20%;
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
    textarea:focus {
        border-color: #5A827E;
        outline: none;
        box-shadow: 0 0 8px rgba(90, 130, 126, 0.2);
        background-color: #fff;
    }
    
    textarea {
        resize: vertical;
        min-height: 120px;
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

    /* Center submit button row */
    td[colspan="2"] {
        text-align: center !important;
        padding-top: 20px;
    }
</style>
</head>

<body>
<h3 align="center"><u>Complaint Registration</u></h3>

<form id="form1" name="form1" method="post" action="">
  <table width="520" border="1" align="center">
    <tr>
      <td width="77" align="center">Title</td>
      <td width="431" align="center"><label for="txt_title"></label>
      <input type="text" name="txt_title" id="txt_title" placeholder="Enter the Title" required="required" title="First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" minlength="3" /></td>
    </tr>
    <tr>
      <td align="center">Content</td>
      <td align="center"><label for="txt_content"></label>
      <textarea name="txt_content" id="txt_content" cols="45" rows="5" required="required" minlength="10" placeholder="Enter the Content"></textarea></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
  </table>

</form>

</body>
</html>

<?php
include("Foot.php");
?>
