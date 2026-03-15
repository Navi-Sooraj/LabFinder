<?php
include("../Assets/Connection/Connection.php");
include("Head.php");

if(isset($_POST['btn_submit']))
{
	$insQry="insert into tbl_appointment(appointment_content,appointment_todate,user_id,lab_id,appointment_date) values('".$_POST['txt_content']."','".$_POST['txt_todate']."','".$_SESSION['uid']."','".$_GET['aid']."',CURDATE())";
	if($Conn->query($insQry))
	{
		?>
        <script>
	        alert("Inserted");
	        window.location="MyAppointments.php";
	    </script>
        <?php
	}
	
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Booking Appointment</title>
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
        max-width: 500px; /* Adjusted max-width for this form */
        margin: auto;
    }

    /* --- Heading Styles --- */
    h3 {
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

    h3 u {
        text-decoration: none; /* Remove default underline */
    }

    /* Custom underline for heading */
    h3::after {
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
        width: 120px; /* Fixed width for labels */
        text-align: center;
    }

    /* Input column */
    td:last-child {
        text-align: left;
    }

    /* --- Input Field Styles --- */
    input[type="text"],
    input[type="date"] {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-sizing: border-box;
        transition: all 0.3s ease;
        background-color: #f9f9f9;
        font-size: 1em;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Ensure consistent font */
        color: #333;
    }

    input[type="text"]:focus,
    input[type="date"]:focus {
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
    
    /* Center submit button */
    td[colspan="2"] {
        text-align: center !important;
        padding-top: 10px;
    }

</style>
</head>

<body>
  <form id="form1" name="form1" method="post" action="">
    <h3 align="center"><u>Book Appointment</u></h3>
    <table width="200" border="1" align="center">
      <tr>
        <td align="center">Content</td>
        <td align="center"><label for="txt_content"></label>
        <input type="text" name="txt_content" id="txt_content" placeholder="Enter the Content" required/></td>
      </tr>
      <tr>
        <td align="center">To Date</td>
        <td align="center"><label for="txt_todate"></label>
            <input type="date" name="txt_todate" id="txt_todate" required 
                min="<?php echo date('Y-m-d'); ?>"
                max="<?php echo date('Y-m-d', strtotime('+1 year')); ?>"
            />    
        </td>
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