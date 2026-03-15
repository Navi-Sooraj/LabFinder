<?php
     include("../Assets/Connection/Connection.php");
     
     if(isset($_POST['btn_submit']))
     {
         
         $admin_name=$_POST['txt_name'];
         $admin_email=$_POST['txt_email'];
         $admin_password=$_POST['txt_psw'];

         $aphoto=$_FILES['file_photo']['name'];
         $apath=$_FILES['file_photo']['tmp_name'];
         move_uploaded_file($apath,"../Assets/Files/Admin/Photo/".$aphoto);
         
         $Aid=$_POST['txt_id'];
         if($Aid=="")
         {
               $insquery="insert into tbl_admin(admin_name,admin_email,admin_photo,admin_password) values('".$admin_name."','".$admin_email."','".$aphoto."','".$admin_password."')";
               if($Conn->query($insquery))
               {
                   ?> 
                   <script>
                   alert("inserted");
                   window.location="Adminregistration.php";
                   </script>
                   <?php       
               }
         }
         else
         {
               $upQry="update tbl_admin set admin_name='".$admin_name."',admin_email='".$admin_email."',admin_password='".$admin_password."' where admin_id='".$Aid."'";
               if($Conn->query($upQry))
               {
                   ?>
                   <script>
                       alert("Updated");
                       window.location="Adminregistration.php";
                   </script>
                   <?php
               }
         }
     }
               
           
     if(isset($_GET['Delid']))
     {
         $Delqry="delete from tbl_admin where admin_id='".$_GET['Delid']."'";
         if($Conn->query($Delqry))
         {
             ?>
             <script>
                 alert("Deleted");
                 window.location="Adminregistration.php";
             </script>
             <?php
         }
     }
     $Aid="";
     $Aname="";
     $Aemail="";
     $Apsw="";
     if(isset($_GET['Editid']))
     {
         $selQry="select * from tbl_admin where admin_id='".$_GET['Editid']."'";
         $row=$Conn->query($selQry);
         $data=$row->fetch_assoc();
         $Aid=$data['admin_id'];
         $Aname=$data['admin_name'];
         $Aemail=$data['admin_email'];
         $Apsw=$data['admin_password'];
     }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Registration</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
    /* --- General Styles --- */
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #121212;
        background-image: linear-gradient(rgba(18, 18, 18, 0.85), rgba(18, 18, 18, 0.85)), url('https://images.unsplash.com/photo-1519681393784-d120267933ba');
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
        color: #e0e0e0;
        margin: 0;
        padding: 40px 20px;
        box-sizing: border-box;
    }

    /* --- Heading Styles --- */
    h3, h4 {
        text-align: center;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    h3 {
        font-size: 2.2em;
        color: #ffffff;
        padding-bottom: 10px;
        border-bottom: 2px solid #00aaff;
        display: table;
        margin: 0 auto 30px auto;
    }
    
    h3 u, h4 u {
        text-decoration: none;
    }

    h4 {
        font-size: 1.5em;
        color: #00aaff;
        margin-top: 50px;
        margin-bottom: 25px;
    }

    /* --- Form & Container Styles --- */
    form {
        max-width: 800px;
        margin: 0 auto;
    }

    .form-container,
    .list-container {
        background-color: #1f1f1f;
        padding: 30px 40px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        border: 1px solid #333;
    }
    
    .list-container {
        margin-top: 40px;
    }

    /* --- General Table Reset --- */
    table {
        border-collapse: collapse;
        width: 100%;
        border: none;
    }
    
    table td {
        border: none;
    }

    /* --- Form Table Styles --- */
    .form-container table td {
        padding: 12px 5px;
        vertical-align: middle;
    }

    .form-container table td:first-child {
        width: 30%;
        text-align: right;
        padding-right: 20px;
        font-weight: 500;
        color: #aaa;
    }

    /* --- Input Field Styles --- */
    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 12px;
        background-color: #2b2b2b;
        border: 1px solid #444;
        border-radius: 8px;
        color: #e0e0e0;
        font-family: 'Poppins', sans-serif;
        box-sizing: border-box;
        transition: all 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus {
        background-color: #333;
        border-color: #00aaff;
        outline: none;
        box-shadow: 0 0 10px rgba(0, 170, 255, 0.2);
    }
    
    input[type="file"] {
        color: #999;
        padding: 8px;
        width: 100%;
        box-sizing: border-box;
        border: 1px solid #444;
        background-color: #2b2b2b;
        border-radius: 8px;
        font-size: 0.9em;
    }
    
    input[type="file"]::file-selector-button {
        background-color: #00aaff;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 5px;
        cursor: pointer;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        transition: background-color 0.3s;
    }
    
    input[type="file"]::file-selector-button:hover {
        background-color: #0088cc;
    }

    /* --- Button Styles --- */
    input[type="submit"] {
        background-color: #00aaff;
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #0088cc;
        box-shadow: 0 5px 15px rgba(0, 170, 255, 0.2);
        transform: translateY(-2px);
    }

    /* --- List Table Styles --- */
    .list-container table {
        border: 1px solid #333;
        border-radius: 8px;
        overflow: hidden;
    }

    .list-container table td {
        padding: 15px;
        border-bottom: 1px solid #333;
    }

    .list-container table tr:first-child td {
        background-color: #2a2a2a;
        color: #00aaff;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .list-container table tr:last-child td {
        border-bottom: none;
    }

    /* --- Action Link Buttons --- */
    .list-container table a {
        display: inline-block;
        padding: 5px 10px;
        margin: 0 4px;
        text-decoration: none;
        border-radius: 5px;
        color: white;
        font-weight: 500;
        font-size: 0.9em;
        transition: all 0.3s ease;
    }
    
    .list-container a[href*="Editid"] {
        background-color: #0077bb;
    }
    .list-container a[href*="Editid"]:hover {
        background-color: #00aaff;
    }

    .list-container a[href*="Delid"] {
        background-color: #bb0000;
    }
    .list-container a[href*="Delid"]:hover {
        background-color: #e74c3c;
    }
</style>
</head>

<body>
<h3 align="center"><u>Admin Registration</u></h3>
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
  <div class="form-container">
    <table width="320" border="1" align="center">
      <tr>
        <td width="92" align="center">Name</td>
        <td width="216" align="center">
          <label for="txt_name"></label>
          <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $Aid ?>" />
          <input type="text" name="txt_name" id="txt_name" required placeholder="Enter the name" value="<?php echo $Aname ?>"/>
        </td>
      </tr>
      <tr>
        <td align="center">Email</td>
        <td align="center">
          <label for="txt_email"></label>
          <input type="email" name="txt_email" id="txt_email" required placeholder="Enter the email" value="<?php echo $Aemail ?>" />
        </td>
      </tr>
      <tr>
        <td>Photo</td>
        <td><label for="file_photo"></label>
          <input type="file" name="file_photo" id="file_photo" accept="image/*" />
          </td>
      </tr>
      <tr>
        <td align="center">Password</td>
        <td align="center">
          <label for="txt_psw"></label>
          <input type="password" name="txt_psw" id="txt_psw" required placeholder="Enter the password" value="<?php echo $Apsw ?>" />
        </td>
      </tr>
      <tr>
        <td colspan="2" align="center">
          <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
        </td>
      </tr>
    </table>
  </div>

  <div class="list-container">
    <h4 align="center"><u>Admin List</u></h4>
    <table width="690" height="82" border="1" align="center">
      <tr>
        <td width="61" height="31" align="center">SlNo</td>
        <td width="125" align="center">Name</td>
        <td width="104" align="center">Email</td>
        <td width="192" align="center">Password</td>
        <td width="123" align="center">Action</td>
      </tr>
      <?php
      $i=0;
      $selqry="select * from tbl_admin";
      
      $row=$Conn->query($selqry);
      while($data=$row->fetch_assoc())
      {
          $i++;
      ?>
      <tr>
        <td height="31" align="center"><?php echo $i ?></td>
        <td align="center"><?php echo $data['admin_name'] ?></td>
        <td align="center"><?php echo $data['admin_email'] ?></td>
        <td align="center"><?php echo $data['admin_password'] ?></td>
        <td align="center"> 
            <a href="Adminregistration.php?Editid=<?php echo $data['admin_id'] ?>">Edit</a> 
            <a href="Adminregistration.php?Delid=<?php echo $data['admin_id'] ?>">Delete</a> 
        </td>
      </tr>
      <?php
      }
      ?>
      </table>
    </div>
</form>
</body>
</html>
