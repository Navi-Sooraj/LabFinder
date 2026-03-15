<?php
include("../Assets/Connection/Connection.php");
include("Head.php");

if(isset($_POST['btn_submit']))
{
    $insQry="insert into tbl_timing(timing_time,days_id,lab_id) values('".$_POST['txt_time']."','".$_POST['sel_days']."','".$_SESSION['lid']."')";
    if($Conn->query($insQry))
    {
        ?>
        <script>
            alert("Inserted");
            window.location="Timing.php";
        </script>
        <?php
    }
}

if(isset($_GET['Delid']))  
{
    $delQry="delete from tbl_timing where timing_id='".$_GET['Delid']."'";
    if($Conn->query($delQry))
   {
       ?>
       <script>
           alert("Deleted");
           window.location="Timing.php";
       </script>
       <?php
   }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Timing</title>
<style>
    /* --- General Styles --- */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-image: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url('../Assets/Templates/Main/assets/img/w1.png'); /* Added background image with overlay */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
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
    form {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        width: 100%;
        max-width: 700px; /* Standard width for forms */
        margin: auto;
    }
    
    /* --- General Table Reset --- */
    table {
        border-collapse: collapse;
        border: none;
        width: 100%;
    }

    /* --- First Table (Input Form) Styles --- */
    form > table:first-of-type {
        margin-bottom: 40px;
    }
    
    form > table:first-of-type td {
        border: none;
        padding: 15px 10px;
        vertical-align: middle;
    }

    form > table:first-of-type td:first-child {
        width: 30%;
        font-weight: 600;
        color: #555;
        text-align: right;
        padding-right: 25px;
    }

    form > table:first-of-type td[colspan="2"] {
        text-align: center;
    }

    /* --- Input Field & Select Styles --- */
    input[type="text"],
    select {
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
    select:focus {
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

    /* --- Second Table (Data Display) Styles --- */
    form > table:last-of-type {
        margin-top: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
    }

    form > table:last-of-type th,
    form > table:last-of-type td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
        color: #333;
    }

    form > table:last-of-type th {
        background-color: #f8f8f8;
        font-weight: bold;
    }
    
    form > table:last-of-type tr:nth-child(even) {
        background-color: #fdfdfd;
    }
    
    form > table:last-of-type tr:last-child td {
        border-bottom: none;
    }

    /* --- Action Links as Buttons --- */
    form > table:last-of-type a {
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
    
    a[href*="Delid"] {
        background-color: #e74c3c; /* Red for Delete */
    }
    a[href*="Delid"]:hover {
        background-color: #c0392b;
    }
</style>
</head>

<body>
<h3 align="center">Manage Timings</h3>
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1" align="center">
    <tr>
      <td width="74" align="center">Day</td>
      <td width="110" align="center"><label for="sel_days"></label>
        <select name="sel_days" id="sel_days" required>
        <option value="">--Select Day--</option>
        <?php
    $selQry="select * from tbl_days";
    $res=$Conn->query($selQry);
    
    while($data=$res->fetch_assoc())
    {
      ?>
      <option value="<?php echo $data['days_id'] ?>">
       <?php echo $data['days_name'] ?>
      </option>
      <?php 
    }
    ?>
        </select>
      </td>
    </tr>
    <tr>
      <td align="center">Time</td>
      <td align="center"><label for="txt_time"></label>
      <input 
        type="text" 
        name="txt_time" 
        id="txt_time" 
        required 
        placeholder="e.g., 9:00 AM - 5:00 PM"
        pattern="((0?[1-9]|1[0-2]):[0-5][0-9]\s?[AaPp][Mm])\s?-\s?((0?[1-9]|1[0-2]):[0-5][0-9]\s?[AaPp][Mm])|Closed" 
        title="Please use the format: 9:00 AM - 5:00 PM or Closed"
      />
      </td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      </td>
    </tr>
  </table>

  <h5 style="text-align: center; color: #555; margin-top: 40px; margin-bottom: 20px; font-weight: 400;">Existing Timings</h5>
  <table width="506" height="117" border="1" align="center">
    <tr>
      <th width="50" align="center">SlNo</th>
      <th width="113" align="center">Day</th>
      <th width="225" align="center">Time</th>
      <th width="90" align="center">Action</th>
    </tr>
    <?php
      $i=0;
      $selQry="SELECT * from tbl_timing t inner join tbl_days d on t.days_id=d.days_id where lab_id='".$_SESSION['lid']."'";
      $res=$Conn->query($selQry);
      while($data=$res->fetch_assoc())
      {
        $i++;
      ?>
    <tr>
      <td align="center"><?php echo $i ?></td>
      <td align="center"><?php echo $data['days_name'] ?></td>
      <td align="center"><?php echo $data['timing_time'] ?></td>
      <td align="center"><a href="Timing.php?Delid=<?php echo $data['timing_id'] ?>">Delete</a></td>
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

