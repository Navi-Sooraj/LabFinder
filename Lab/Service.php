<?php
include("../Assets/Connection/Connection.php");
include("Head.php");
    
if(isset($_POST['btn_submit']))
{
    $name=$_POST['txt_name'];
    $description=$_POST['txt_description'];
    
    $photo=$_FILES['file_photo']['name'];
    $path=$_FILES['file_photo']['tmp_name'];
    move_uploaded_file($path,"../Assets/Files/Lab/service/".$photo);
    

    // Corrected session variable from 'uid' to 'lid' to match the context of the page
    $insQry="insert into tbl_service(service_name,service_description,service_photo,lab_id) values('".$name."','".$description."','".$photo."','".$_SESSION['lid']."')";    
    if($Conn->query($insQry))
   {
       ?>
       <script>
           alert("Inserted");
           window.location="Service.php";
       </script>
       <?php
   }
}

if(isset($_GET['Delid']))  
{
    $delQry="delete from tbl_service where service_id='".$_GET['Delid']."'";
    if($Conn->query($delQry))
   {
       ?>
       <script>
           alert("Deleted");
           window.location="Service.php";
       </script>
       <?php
   }
}
?>  

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Services</title>
<style>
    /* --- General Styles --- */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-image: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url('../Assets/Templates/Main/assets/img/w1.png'); /* Added background image with overlay */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        align-items: center;
        /* padding: 50px 20px; Added padding */
        min-height: 100vh;
        margin: 0;
        box-sizing: border-box;
    }

    /* --- Heading Styles (Copied from Timing.php) --- */
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

    /* --- Form & Main Container Styles --- */
    #form1 {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        width: 100%;
        max-width: 800px; /* Wider for more content */
        margin: auto;
    }

    /* --- General Table Reset --- */
    table {
        border-collapse: collapse;
        border: none;
        width: 100%;
    }

    /* --- First Table (Service Entry Form) Styles --- */
    #form1 > table:first-of-type {
        width: 100%;
        margin-bottom: 40px;
    }

    #form1 > table:first-of-type td {
        border: none;
        padding: 15px 10px;
        vertical-align: middle;
    }

    #form1 > table:first-of-type td:first-child {
        width: 20%;
        font-weight: 600;
        color: #555;
        text-align: right;
        padding-right: 25px;
    }
    
    /* --- This is the fix for the submit button --- */
    #form1 > table:first-of-type td[colspan="2"] {
        text-align: center;
    }

    /* --- Input Field Styles --- */
    input[type="text"],
    textarea {
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
    textarea:focus {
        border-color: #5A827E;
        outline: none;
        box-shadow: 0 0 8px rgba(90, 130, 126, 0.2);
        background-color: #fff;
    }

    textarea {
        resize: vertical;
        min-height: 100px;
    }

    /* --- File Input Styling --- */
    input[type="file"] {
        border: 1px solid #ddd;
        padding: 8px;
        border-radius: 8px;
        background-color: #f9f9f9;
        width: 100%;
        box-sizing: border-box;
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
    
    /* --- Second Table (Service Data Display) Styles --- */
    #form1 > table:last-of-type {
        width: 100%;
        margin-top: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden; /* Ensures border-radius is respected */
    }

    #form1 > table:last-of-type th,
    #form1 > table:last-of-type td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
        color: #333;
    }

    /* Header Row */
    #form1 > table:last-of-type th {
        background-color: #f8f8f8;
        font-weight: bold;
    }
    
    /* Alternating Row Colors */
    #form1 > table:last-of-type tr:nth-child(even) {
        background-color: #fdfdfd;
    }

    #form1 > table:last-of-type tr:last-child td {
        border-bottom: none;
    }

    #form1 > table:last-of-type img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
    }
    
    /* Action Link (Delete) */
    #form1 > table:last-of-type a {
        display: inline-block;
        padding: 6px 12px;
        background-color: #e74c3c;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: 500;
        font-size: 0.9em;
        transition: background-color 0.3s;
    }

    #form1 > table:last-of-type a:hover {
        background-color: #c0392b;
    }

</style>
</head>

<body>
<h3 align="center"><u>Manage Services</u></h3>
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
  <table>
    <tr>
      <td width="111" align="center">Service</td>
      <td width="431" align="center"><label for="txt_name"></label>
      <input type="text" name="txt_name" id="txt_name" required placeholder="Enter the service" title="First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" minlength="3"/></td>
    </tr>
    <tr>
      <td align="center"><p>Description</p></td>
      <td align="center"><label for="txt_description"></label>
      <textarea name="txt_description" id="txt_description" cols="45" rows="5" required placeholder="Enter the Description"></textarea></td>
    </tr>
    <tr>
      <td align="center">Photo</td>
      <td align="center"><label for="file_photo"></label>
      <input type="file" name="file_photo" id="file_photo" /></td>
    </tr>
    <tr align="center">
      <td height="36" colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
  </table>
  
  <table>
    <tr>
      <th width="50" align="center">SlNo</th>
      <th width="113" align="center">Service</th>
      <th width="225" align="center">Description</th>
      <th width="90" align="center">Photo</th>
      <th width="90" align="center">Action</th>
    </tr>
    <?php
      $i=0;
      $selQry="SELECT * from tbl_service where lab_id='".$_SESSION['lid']."'";
      $res=$Conn->query($selQry);
      while($data=$res->fetch_assoc())
      {
        $i++;
    ?>
    <tr>
      <td align="center"><?php echo $i ?></td>
      <td align="center"><?php echo $data['service_name'] ?></td>
      <td align="center"><?php echo $data['service_description'] ?></td>
      <td align="center"><img width="100" height="100" src="../Assets/Files/Lab/service/<?php echo $data['service_photo'] ?>" /></td>
      <td align="center"><a href="Service.php?Delid=<?php echo $data['service_id'] ?>">Delete</a></td>
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
