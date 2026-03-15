<?php
include("../Assets/Connection/Connection.php");
include("Head.php");

if(isset($_POST['btn_submit']))
{
	
    // --- SECURE FILE UPLOAD ---
    // 1. Get original file info
    $tmp_filename = $_FILES['file_result']['name'];
    $path = $_FILES['file_result']['tmp_name'];

    // 2. Get the parts of the name
    $file_extension = pathinfo($tmp_filename, PATHINFO_EXTENSION);
    $filename_only = pathinfo($tmp_filename, PATHINFO_FILENAME);

    // 3. Create a new, safe, unique filename
    // This is the variable you will save in the database
    $result = $filename_only . '_'. time() . '.' . $file_extension;

    // 4. Set the full destination path
    $destination = "../Assets/Files/Lab/Result/" . $result;
    
    // 5. Move the file
    move_uploaded_file($path, $destination);
    // --- END SECURE UPLOAD ---

	$description=$_POST['txt_description'];
    $appointment_id = $_GET['uploadid'];

    // ---Update Query Part---
    $upQry="UPDATE tbl_appointment SET result_status=1 WHERE appointment_id=?";
    $stmt = $Conn->prepare($upQry);
    $stmt->bind_param("i", $appointment_id);
    $stmt->execute();
    $stmt->close();
 
	// ---Insert Query Part---
	$insQry="INSERT INTO tbl_result(result_file,result_description,result_date,appointment_id) VALUES (?,?,CURDATE(),?)";
	$inStmt = $Conn->prepare($insQry);
    $inStmt->bind_param("ssi", $result, $description, $appointment_id);

    if($inStmt->execute())
    {
	    ?>
        <script>
	        alert("Result Uploaded");
	        window.location="ViewAppointment.php";
	    </script>
        <?php
    }
    $inStmt->close();

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload Result</title>
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
    h4 {
        color: #ffffff;
        margin-bottom: 30px;
        font-size: 2.2em;
        font-weight: 300;
        text-align: center;
        letter-spacing: 1px;
        position: relative;
        padding-bottom: 15px;
    }
    
    h4 u {
      text-decoration:none;
    }

    h4::after {
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
    
    /* --- File Input Styling --- */
    input[type="file"] {
        border: 1px solid #ddd;
        padding: 8px;
        border-radius: 8px;
        background-color: #f9f9f9;
        width: 100%;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    input[type="file"]::file-selector-button {
        background-color: #5A827E;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    input[type="file"]::file-selector-button:hover {
        background-color: #4B6F6A;
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
        min-width: 150px;
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
    
    /* Center the button row */
    td[colspan="2"] {
        text-align: center !important;
        padding-top: 20px;
    }

</style>
</head>

<body>
<h4 align="center"><u>Upload Result</u></h4>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="486" height="189" border="1" align="center">
    <tr>
      <td width="117" align="center">Test Result</td>
      <td width="319" align="center"><label for="file_result"></label>
      <input type="file" name="file_result" id="file_result" required /></td>
    </tr>
    <tr>
      <td align="center">Description</td>
      <td align="center"><label for="txt_description"></label>
      <input type="text" name="txt_description" id="txt_description" required placeholder="Enter the Description" /></td>
    </tr>
    <tr>
      <td height="52" colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
  </table>
</form>
</body>
</html>

<?php
include("Foot.php");
?>