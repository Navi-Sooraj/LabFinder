<?php
include("../Assets/Connection/Connection.php");
include("Head.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Appointments</title>
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
        /* flex-direction: column; */
        /* justify-content: center; */
        align-items: center;
        /* padding: 50px 20px; */
        min-height: 100vh;
        margin: 0;
        box-sizing: border-box;
    }

    /* --- Container Styles --- */
    #form1 {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        width: 100%;
        max-width: 1370px; /* Wider container for the table */
        overflow-x: auto; /* Add horizontal scroll on small screens */
        margin: auto;
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

    /* --- Table Styles --- */
    table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        border-radius: 8px;
        overflow: hidden; /* Ensures border-radius is applied to corners */
    }

    td {
        padding: 15px;
        /* text-align: center; */
        vertical-align: middle;
        border-bottom: 1px solid #e9ecef;
        color: #555;
    }

    /* Table Header Row */
    tr:first-child {
        background-color: #f8f9fa;
    }
    
    tr:first-child td {
        font-weight: 600;
        color: #333;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.9em;
    }
    
    /* Table Body Rows */
    tr:not(:first-child):hover {
        background-color: #f1f1f1;
        transition: background-color 0.3s;
    }

    /* Lab Details Cell */
    td:nth-child(2) {
        text-align: left;
        line-height: 1.5;
    }
    
    /* Status Cell Styling */
    td:nth-child(6) {
        font-weight: 500;
    }

    /* Action Link as Button */
    td a {
        text-decoration: none;
        color: #ffffff;
        background-color: #5A827E;
        padding: 8px 15px;
        border-radius: 6px;
        transition: background-color 0.3s ease;
        display: inline-block;
    }

    td a:hover {
        background-color: #4B6F6A; /* Darker shade on hover */
        transform: translateY(-1px);
    }

</style>
</head>

<body>
<h3 align="center"><u>My Appointments</u></h3>
<form id="form1" name="form1" method="post" action="">
  <table width="1200" border="1" align="center">
    <tr>
      <td width="47" align="center">SlNo</td>
      <td width="256" align="center">Lab Address</td>
      <td width="50" align="center">Place</td>
      <td width="50" align="center">District</td>
      <td width="207" align="left">Content</td>
      <td width="120" align="center">To date</td>
      <td width="60" align="center">Token</td>
      <td width="135" align="center">Status</td>
      <td width="135" align="center">Action</td>
    </tr>
    <?php
    include("../Assets/Connection/Connection.php");
    
    $i=0;
    $selQry="SELECT * from tbl_appointment a 
                inner join tbl_lab l on a.lab_id=l.lab_id 
                inner join tbl_place p on l.place_id=p.place_id 
                inner join tbl_district d on p.district_id=d.district_id
                where user_id=".$_SESSION['uid'];
    $res=$Conn->query($selQry);
    while($data=$res->fetch_assoc())
    {
        $i++;
    ?>
    <tr>
      <td align="center"><?php echo $i ?></td>
      <td align="center">
       <?php echo "<b>", $data['lab_name'], "</b> <br>";
             echo $data['lab_email'], "<br>";
             echo $data['lab_contact'], "<br>";
             echo $data['lab_address'] 
       ?>
      </td>
      <td align="center"><?php echo $data['place_name'] ?></td>
      <td align="center"><?php echo $data['district_name'] ?></td>
      <td align="left"><?php echo $data['appointment_content'] ?></td>
      <td align="center"><?php echo $data['appointment_todate'] ?></td>
      <td align="center"><?php echo $data['appointment_token'] ?></td>
      <td align="center">
       <?php 
            if($data['appointment_status']==0)
            {
                echo "Request Pending..";
            }
            else if($data['appointment_status']==1)
            {
              
                $current_timestamp = strtotime('today');
                $appointment_timestamp = strtotime($data['appointment_todate']);
                
                if ($current_timestamp < $appointment_timestamp)
                {
                    echo "Request Accepted..";
                }
                else 
                {
                    ?>
                    <a href="ViewResult.php?resultid=<?php echo $data['appointment_id'] ?>">View Result</a>
                    <?php
                } 
            }
            else
            {
                 echo "Rejected..";
            }
          
       ?>
      </td>
      <td align="center"><a href="Complaint.php?labid=<?php echo $data['lab_id']?>">Report</a><br>
      <br>
      <a href="Rating.php?rid=<?php echo $data['lab_id']?>">Rate</a>
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