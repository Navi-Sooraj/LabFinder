<?php
include("../Assets/Connection/Connection.php");
include("Head.php");

if(isset($_GET['cid']))
{
	$delQry="delete from tbl_complaint where complaint_id='".$_GET['cid']."'";
	if($Conn->query($delQry))
	{
		?>
        <script>
	        alert("Deleted");
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
<title>Complaint View</title>
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
        max-width: 1300px;
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
        /* text-align: center; */
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
    }

    /* Header Row */
    tr:first-child {
        background-color: #f8f8f8;
        font-weight: bold;
        color: #333;
    }

    /* Table Body Rows */
    tr:not(:first-child):hover {
        background-color: #f1f1f1;
        transition: background-color 0.3s;
    }
    
    /* Alternating Row Colors */
    tr:nth-child(even) {
        background-color: #fdfdfd;
    }

    tr:last-child td {
        border-bottom: none;
    }

</style>
</head>

<body>
<h3 align="center">Customer Complaints</h3>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="1" align="center">
    <tr>
      <td width="2%" align="center">SlNo</td>
      <td width="20%" align="center">Customer Name</td>
      <td width="25%" align="center">Title</td>
      <td width="43%" align="center">Content</td>
      <td width="10%" align="center">Date</td>
    </tr>
    <?php
 
  $i=0;
  $selQry="select * from tbl_complaint c inner join tbl_user u on c.user_id=u.user_id where lab_id='".$_SESSION['lid']."'";
  $res=$Conn->query($selQry);
  while($data=$res->fetch_assoc())
  {
   $i++;
  ?>
    <tr>
      <td align="center"><?php echo $i?></td>
      <td align="center"><?php echo $data['user_name'] ?></td>
      <td align="center"><?php echo $data['complaint_title']?></td>
      <td align="left"><?php echo $data['complaint_content']?></td>
      <td align="center"><?php echo $data['complaint_date']?></td>
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