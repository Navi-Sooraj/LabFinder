<?php
include("../Assets/Connection/Connection.php");
include("Head.php");

if(isset($_POST['btn_submit']))
{
   
    // 1. Get your data from the user
    $reply = $_POST['txt_reply'];
    $complaint_id = $_GET['rid'];

    // 2. Write the SQL query with placeholders (?)
    // This is the "form"
    $upQry = "UPDATE tbl_complaint SET complaint_reply = ?, complaint_status = 1 WHERE complaint_id = ?";
    
    // 3. Prepare the statement
    $stmt = $Conn->prepare($upQry);
    
    // 4. Bind the data (put it in the "boxes")
    // "s" = string (for $reply)
    // "i" = integer (for $complaint_id)
    $stmt->bind_param("si", $reply, $complaint_id);
    
    if ($stmt->execute()) {
        ?>
        <script>
            alert("Reply Sended");
            window.location = "HomePageA.php";
        </script>
        <?php
    } else {
        echo "Error: Could not send reply.";
    }
    
    // 6. Close the statement
    $stmt->close();
    
}


?>

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Complaint Reply</title>
<style>
    /* --- General Styles --- */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-image: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url('../Assets/Templates/Main/assets/img/w1.png');
        /* background-size: cover; */
        /* background-position: center; */
        /* background-repeat: no-repeat; */
        align-items: center;
        min-height: 100vh;
        margin: 0;
        /* padding: 50px 20px; */
        box-sizing: border-box;
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

    /* --- Form Container Styles --- */
    form {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        width: 100%;
        max-width: 700px;
        margin: auto;
    }
    
    /* --- Table Styles --- */
    table {
        border-collapse: collapse;
        border: none;
        width: 100%;
    }

    td {
        border: none;
        padding: 15px 10px;
        vertical-align: middle;
    }

    td:first-child {
        width: 20%;
        font-weight: 600;
        color: #555;
        text-align: right;
        padding-right: 25px;
    }

    /* --- Correctly center the submit button row --- */
    td[colspan="2"] {
        text-align: center;
    }

    /* --- Input Field Styles --- */
    textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-sizing: border-box;
        transition: all 0.3s ease;
        background-color: #f9f9f9;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        resize: vertical;
        min-height: 150px;
    }

    textarea:focus {
        border-color: #5A827E;
        outline: none;
        box-shadow: 0 0 8px rgba(90, 130, 126, 0.2);
        background-color: #fff;
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
</style>
</head>

<body>
<h3 align="center" style="margin-top:100px;">Complaint Reply</h3>
<form action="" method="post" style="margin-bottom:100px;">
  <table width="200" border="1" align="center">
    <tr>
      <td align="center">Reply</td>
      <td align="center">
        <textarea name="txt_reply" id="txt_reply" cols="45" rows="5" required minlength="15" placeholder="Enter the reply message..." ></textarea>
      </td>
    </tr>
    <tr>
      <td height="31" colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
  </table>
</form>
</body>
</html>

<?php
include("Foot.php");
?>