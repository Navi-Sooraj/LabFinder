<?php
	include("../Assets/Connection/Connection.php");
	include("Head.php");
	
	if(isset($_GET['aid'])) 
	{
		$appointment_id = $_GET['aid'];

		// Step 1: Get appointment_todate for this appointment
		$getDateQry = "SELECT appointment_todate FROM tbl_appointment WHERE appointment_id = '$appointment_id'";
		$result = $Conn->query($getDateQry);
		
		if($row = $result->fetch_assoc()) 
		{
			$appointment_todate = $row['appointment_todate'];

			// Step 2: Count accepted appointments for the same date (earlier ones)
			$countQry = "SELECT COUNT(*) AS token_number FROM tbl_appointment 
						 WHERE appointment_todate = '$appointment_todate' 
						 AND appointment_status = 1 
						 AND appointment_date <= (SELECT appointment_date FROM tbl_appointment WHERE appointment_id = '$appointment_id')";
			$countResult = $Conn->query($countQry);
			$countRow = $countResult->fetch_assoc();
			
			$token_number = $countRow['token_number'] + 1;

			// Step 3: Update status and token
			$updateQry = "UPDATE tbl_appointment 
						  SET appointment_status = 1, appointment_token = '$token_number' 
						  WHERE appointment_id = '$appointment_id'";

			if($Conn->query($updateQry)) 
			{
				?>
				<script>
					alert("Accepted. Token number: <?php echo $token_number; ?>");
					window.location="ViewAppointment.php";
				</script>
				<?php
			}
		}
	}
	
	if(isset($_GET['rid']))
	{
		$appointment_id = $_GET['rid'];
		
		// Update status 
			$updateQry = "UPDATE tbl_appointment 
						  SET appointment_status = 2 
						  WHERE appointment_id = '$appointment_id'";

			if($Conn->query($updateQry)) 
			{
				?>
				<script>
					alert("Rejected");
					window.location="ViewAppointment.php";
				</script>
				<?php
			}	
	}
	
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Appointment</title>
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
        /* flex-direction: column; Stacks heading and form */
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
        max-width: 1350px; /* Wider for more columns */
		margin: auto;
    }

    /* --- Table Styles --- */
    table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden; /* Ensures border-radius is respected */
    }

    td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
        line-height: 1.5;
    }

    .td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
        line-height: 1.5;
    }

    /* Header Row */
    tr:first-child {
        background-color: #f8f8f8;
        font-weight: bold;
        color: #333;
        font-size: 1.04em;
    }
    
    /* Alternating Row Colors */
    tr:nth-child(even) {
        background-color: #fdfdfd;
    }

    tr:last-child td {
        border-bottom: none;
    }

    /* --- Action Button Styles --- */
    td a {
        display: inline-block;
        padding: 6px 14px;
        margin: 2px;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: 500;
        font-size: 0.9em;
        transition: all 0.3s ease;
    }
    
    /* Accept Button */
    a[href*="ViewAppointment.php?aid="] {
        background-color: #2ecc71; /* Green */
    }
    a[href*="ViewAppointment.php?aid="]:hover {
        background-color: #27ae60;
    }
    
    /* Reject Button */
    a[href*="ViewAppointment.php?rid="] {
        background-color: #e74c3c; /* Red */
    }
    a[href*="ViewAppointment.php?rid="]:hover {
        background-color: #c0392b;
    }

    /* Upload Button */
    a[href*="Upload.php?uploadid="] {
        background-color: #3498db; /* Blue */
    }
    a[href*="Upload.php?uploadid="]:hover {
        background-color: #2980b9;
    }
</style>
</head>

<body>
<h3 align="center"><u>View Appointments</u></h3>
<form id="form1" name="form1" method="post" action="">
    <table width="950" border="1" align="center">
        <tr>
            <td width="50" align="center">SlNo</td>
            <td width="256" class="td">Customer Details</td>
            <td width="106" align="center">Contact</td>
            <td width="204" align="center">Content</td>
            <td width="110" align="center">To Date</td>
            <td width="88" align="center">Token</td>
            <td width="160" align="center">Status</td>
        </tr>
        <?php
            
        $i=0;
        $selQry="SELECT * from tbl_appointment a inner join tbl_user u on a.user_id=u.user_id where lab_id=".$_SESSION['lid'];
        $res=$Conn->query($selQry);
        while($data=$res->fetch_assoc())
        {
            $i++;
        ?>
        <tr>
            <td align="center"><?php echo $i ?></td>
            <td class="td">
              <?php 
                  echo "<b>", $data['user_name'],"</b> <br>";
                  echo "Email: ", $data['user_email'], "<br>";
                  echo "Address: ", $data['user_address'] 
              ?>
            </td>
            <td align="center"><?php echo $data['user_contact'] ?></td>          
            <td align="center"><?php echo $data['appointment_content'] ?></td>
            <td align="center"><?php echo $data['appointment_todate'] ?></td>
            <td align="center"><?php echo $data['appointment_token'] ?></td>
            <td align="center">
              <?php 
                if($data['appointment_status'] == 0)
                {
                    ?>
                    <a href="ViewAppointment.php?aid=<?php echo $data['appointment_id']?>">Accept</a> | <a href="ViewAppointment.php?rid=<?php echo $data['appointment_id']?>">Reject</a> <br />
                    <?php
                }
                elseif($data['appointment_status']==1 && $data['result_status']==1) 
                {
                    echo "Result uploaded";
                }
                elseif($data['appointment_status'] == 1)
                {
                    $appointment_timestamp = strtotime($data['appointment_todate']);
                    $end_timestamp = strtotime('+14 days', $appointment_timestamp);
                    $current_timestamp = strtotime('today');

                    if($current_timestamp < $appointment_timestamp) 
                    {
                        echo "Request Accepted..";
                    }

                    elseif ($current_timestamp >= $appointment_timestamp && $current_timestamp <= $end_timestamp && $data['result_status']==0) 
                    {    
                            ?>
                             <br /><a href="Upload.php?uploadid=<?php echo htmlspecialchars($data['appointment_id']); ?>">Upload Result</a>
                            <?php   
                    }
                    else
                    {
                        echo "Upload window expired";
                    }
                }
                else
                {
                    echo "Rejected.";
                }
              
              ?>
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