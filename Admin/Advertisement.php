<?php
include("../Assets/Connection/Connection.php");
include("Head.php");
	
if(isset($_POST['btn_submit']))
{
	$title=$_POST['txt_title'];
	$description=$_POST['txt_description'];
	
	$image=$_FILES['file_image']['name'];
	$path=$_FILES['file_image']['tmp_name'];
	move_uploaded_file($path,"../Assets/Files/Ads/".$image);
	

	$insQry="insert into tbl_advertisement(advertisement_title,advertisement_description,advertisement_image,advertisement_date) values('".$title."','".$description."','".$image."',CURDATE())";	
	if($Conn->query($insQry))
    {
	    ?>
        <script>
	        alert("Inserted");
	        window.location="Advertisement.php";
	    </script>
        <?php
    }
}

if(isset($_GET['Delid']))
{
	$delQry="delete from tbl_advertisement where advertisement_id='".$_GET['Delid']."'";
	if($Conn->query($delQry))
    {
	    ?>
        <script>
	        alert("Deleted");
	        window.location="Advertisement.php";
	    </script>
        <?php
    }
}

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
        background-color: #5A827E; /* Fallback color */
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
        width: 100%;
        max-width: 900px; /* Wider for this page's content */
        margin: auto;
        margin-bottom: 100px;
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
        width: 25%;
        font-weight: 600;
        color: #555;
        text-align: right;
        padding-right: 25px;
    }

    /* --- Input Fields & Textarea Styles --- */
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
        color: #000000ff;
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
    
    form > table:first-of-type td[colspan="2"] {
        text-align: center;
    }

    /* --- Second Table (Data Display) Styles --- */
    form > table:last-of-type {
        margin-top: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
    }

    form > table:last-of-type td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
        color: #333;
    }

    form > table:last-of-type tr:first-child {
        background-color: #f8f8f8;
        font-weight: bold;
    }
    
    form > table:last-of-type tr:nth-child(even) {
        background-color: #fdfdfd;
    }
    
    form > table:last-of-type tr:last-child td {
        border-bottom: none;
    }

    form > table:last-of-type img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
    }

    /* --- Action Link as Button --- */
    form > table:last-of-type a {
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
    
    form > table:last-of-type a:hover {
        background-color: #c0392b;
    }

</style>
</head>

<body>
<h3 align="center">Manage Advertisements</h3>
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
  <table width="200" border="1" align="center">
    <tr>
      <td width="111" align="center">Title</td>
      <td width="73" align="center"><label for="txt_title"></label>
      <input type="text" name="txt_title" id="txt_title" placeholder="Enter the Title" required="required" title="First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" minlength="3" /></td>
    </tr>
    <tr>
      <td align="center">Description</td>
      <td align="center"><label for="txt_description"></label>
    <textarea name="txt_description" id="txt_description" placeholder="Enter the Description" cols="45" rows="5" required="required" minlength="15" ></textarea></td>
    </tr>
    <tr>
      <td align="center">Image</td>
      <td align="center"><label for="file_image"></label>
      <input type="file" name="file_image" id="file_image" required="required" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" /></td>
    </tr>
  </table>

  <table width="788" height="141" border="1" align="center">
    <tr>
      <td width="51" align="center">SlNo</td>
      <td width="113" align="center">Title</td>
      <td width="268" align="center">Description</td>
      <td width="206" align="center">Image</td>
      <td width="116" align="center">Action</td>
    </tr>
    <?php
  $i=0;
  $selQry="select * from tbl_advertisement where lab_id=0";
  $res=$Conn->query($selQry); 
  while($data=$res->fetch_assoc())
  {
    $i++;
  ?>
    <tr>
      <td height="104" align="center"><?php echo $i ?></td>
      <td align="center"><?php echo $data['advertisement_title'] ?></td>
      <td align="center"><?php echo $data['advertisement_description'] ?></td>
      <td align="center"><img width="100" height="100" src="../Assets/Files/Ads/<?php echo $data['advertisement_image'] ?>" /></td>
      <td align="center"><a href="Advertisement.php?Delid=<?php echo $data['advertisement_id'] ?>" >Delete</a></td>
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