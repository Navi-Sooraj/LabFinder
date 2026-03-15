<?php
include("../Assets/Connection/Connection.php");
include("Head.php");

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
        background-image: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url('../Assets/Templates/Main/assets/img/w1.png'); /* Added background image with overlay */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
       
        min-height: 100vh;
        margin: 0;
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
        width: 95%;
        max-width: 2500px; /* Wider for the large table */
        overflow-x: auto; /* Add horizontal scroll on small screens */
        margin: auto;
        margin-bottom: 100px;
    }
    
    /* --- Table Styles --- */
    table {
        border-collapse: collapse;
        border: 1px solid #ddd;
        border-radius: 8px;
        border-spacing: 0;
        overflow: hidden;
        width: 100%;
        max-width: 2000px;
        min-width: 1200px;
    }

    table td {
        padding: 12px;
        /* text-align: center; */
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
        color: #333;
    }

    table tr:first-child {
        background-color: #f8f8f8;
        font-weight: bold;
    }
    
    table tr:nth-child(even) {
        background-color: #fdfdfd;
    }
    
    table tr:last-child td {
        border-bottom: none;
    }

    /* Table Body Rows */
    tr:not(:first-child):hover {
        background-color: #f1f1f1;
        transition: background-color 0.3s;
    }

    /* --- Action Links as Buttons --- */
    table a {
        display: inline-block;
        padding: 6px 12px;
        margin: 2px;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: 500;
        font-size: 0.9em;
        transition: all 0.3s;
    }
    
    a[href*="rid"] {
      background-color: #5A827E; /* Blue for Reply */
    }
    
    a[href*="rid"]:hover {
      background-color: #27534dff;
    }

</style>
</head>

<body>
<h3 align="center"><u>Customer Complaints</u></h3>
<form id="form1" name="form1" method="post" action="">
  <table align="center">
    <tr>
      <td width="1%" align="center">SlNo</td>
      <td width="10%" align="center">Recipient </td>
      <td width="10%" align="center">Customer name</td>
      <td width="15%%" align="center">Title</td>
      <td width="26.5%%" align="center">Content</td>
      <td width="26.5%" align="center">Reply </td>
      <td width="11%" align="center">Date</td>
    </tr>
    <?php
    
    $i=0;
    $selQry="SELECT * from tbl_complaint c inner join tbl_user u on c.user_id=u.user_id left join tbl_lab l on c.lab_id=l.lab_id";
    $res=$Conn->query($selQry);
    while($data=$res->fetch_assoc())
    {
     $i++;
    ?>
    <tr>
      <td align="center"><?php echo $i?></td>
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
      <td align="center"><?php echo $data['user_name'] ?></td>
      <td align="center"><?php echo $data['complaint_title']?></td>
      <td align="left"><?php echo $data['complaint_content']?></td>
      <td align="left">
          <?php
      if($data['complaint_status']==0)
        {
            echo "Reply Pending, <br>";
            ?>
          <a href="Reply.php?rid=<?php echo $data['complaint_id'] ?>">Reply</a>
          <?php
      }
      else
        {
            echo $data['complaint_reply'];
        }
        
        ?>
      </td>
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
