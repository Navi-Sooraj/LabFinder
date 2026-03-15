<?php
include("../Assets/Connection/Connection.php");
include("Head.php");

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Advertisement</title>
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
        max-width: 900px; /* Adjust width as needed */
        overflow-x: auto; /* Add horizontal scroll on small screens */
        margin: auto;
    }

    /* --- Heading Styles (Added for consistency) --- */
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
        text-align: center;
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
    
    /* Description cell alignment */
    td:nth-child(3) {
        text-align: left;
    }
    
    /* Image cell styling */
    td img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
    }

</style>
</head>

<body>
<h3 align="center"><u>Advertisements</u></h3>
<form id="form1" name="form1" method="post" action="">
  <table width="475" height="64" border="1" align="center">
    <tr>
      <td width="81" align="center">SlNo</td>
      <td width="76" align="center">Title</td>
      <td width="204" align="center">Description</td>
      <td width="86" align="center">Image</td>
    </tr>
    <?php
  $i=0;
  $selQry="select * from tbl_advertisement";
  $res=$Conn->query($selQry);
  while($data=$res->fetch_assoc())
  {
    $i++;
  ?>
    <tr>
      <td align="center"><?php echo $i ?></td>
      <td align="center"><?php echo $data['advertisement_title'] ?></td>
      <td align="left"><?php echo $data['advertisement_description']?></td>
      <td align="center"><img src="../Assets/Files/Ads/<?php echo $data['advertisement_image']?>"/></td>
    </tr>
    <?php
  }
  ?>
  </table>
</form>
</body>
</html>

<br>
<br>
<br>
  <br>
<br>
  <br>
<br>
  <br>
<br>
<?php
include("Foot.php");
?>