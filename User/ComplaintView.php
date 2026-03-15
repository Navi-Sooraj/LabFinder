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
        /* background-color: #5A827E; Fallback color */
        background-image: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url('../Assets/Templates/Main/assets/img/w1.png'); /* Added background image with overlay */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
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
        max-width: 1450px; /* Wider container for the table */
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
        overflow: hidden; 
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

    /* Action Link (Delete) Styling */
    td a {
        display: inline-block;
        text-decoration: none;
        color: #ffffff;
        background-color: #e74c3c; /* Red for delete */
        padding: 8px 15px;
        margin: 2px;
        border-radius: 6px;
        transition: all 0.3s ease;
        font-size: 0.9em;
    }

    td a:hover {
        background-color: #c0392b; /* Darker red on hover */
        transform: translateY(-1px);
    }
</style>
</head>

<body>
<h3 align="center">Complaint View</h3>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="1" align="center">
    <tr>
      <td width="2%" align="center">SlNo</td>
      <td width="10%" align="center">Recipient </td>
      <td width="20%" align="center">Title</td>
      <td width="26.5%" align="center">Content</td>
      <td width="10%" align="center">Date</td>
      <td width="26.5%" align="center">Reply </td>
      <td width="5%" align="center">Action</td>
    </tr>
    <?php
    
    $i=0;
    $selQry="select * from tbl_complaint c left join tbl_lab l on c.lab_id = l.lab_id where user_id='".$_SESSION['uid']."'";
    $res=$Conn->query($selQry);
    while($data=$res->fetch_assoc())
    {
     $i++;
    ?>
    <tr>
      <td height="40" align="center"><?php echo $i?></td>
      <td align="center">
       <?php
       if($data['lab_id']!="")
       {
            echo $data['lab_name'];
            ?>
            <br/>
            <?php
            echo $data['lab_email'];
       }
       else
       {
            echo "Admin";
       }
       ?>   
      </td>
      <td width="150" align="center"><?php echo $data['complaint_title']?></td>
      <td width="262" align="left"><?php echo $data['complaint_content']?></td>
      <td width="50" align="center"><?php echo $data['complaint_date']?></td>
      <td width="256" align="left">
      <?php
      if($data['complaint_status']==0)
      {
            echo "Reply Pending";
      }
      else
      {
            echo $data['complaint_reply'];
      }
            
      ?>
      </td>
      <td width="10" align="center"><a href="ComplaintView.php?cid=<?php echo $data['complaint_id']?>">Delete</a></td>
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