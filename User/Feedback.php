<?php
include("../Assets/Connection/Connection.php");

    
if(isset($_POST['btn_submit']))
{
    $content=$_POST['txt_content'];
    
    $insQry="insert into tbl_feedback(feedback_content,user_id,feedback_date) values('".$content."','".$_SESSION['uid']."',CURDATE())"; 
    if($Conn->query($insQry))
    {
        ?>
        <script>
            alert("Inserted");
            window.location="Homepage.php";
        </script>
        <?php
    }
}

if(isset($_GET['Delid']))
{
    $delQry="delete from tbl_feedback where feedback_id='".$_GET['Delid']."'";
    if($Conn->query($delQry))
    {
        ?>
        <script>
            alert("Deleted");
            window.location="Homepage.php";
        </script>
        <?php
    }
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Feedback</title>
<style>
    /* --- General Styles --- */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #F0F8FF; Main background color
        /* background-image: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url('../Assets/Templates/Main/assets/img/w1.png'); Added background image with overlayz */
        /* background-size: cover; */
        /* background-position: center; */
        /* background-repeat: no-repeat; */
        align-items: center;
        min-height: 100vh;
        margin: 0;
        /* padding: 50px 20px; */
        box-sizing: border-box;
    }

    /* --- Heading Styles --- */
    .he3 {
        color: #163438ff;
        margin-bottom: 30px;
        font-size: 2.2em;
        font-weight: 400;
        text-align: center;
        letter-spacing: 1px;
        position: relative;
        padding-bottom: 15px;
    }

    .he3 u {
        text-decoration: none;
    }

    .he3::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background-color: #163438ff;
        border-radius: 2px;
    }

    /* --- Form Container Styles --- */
    #form1 {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        width: 100%;
        max-width: 900px;
        margin: auto;
    }
    
    /* --- General Table Reset --- */
    table {
        border-collapse: collapse;
        border: none;
    }

    /* --- First Table (Entry Form) Styles --- */
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
    
    /* --- Second Table (Data Display) Styles --- */
    #form1 > table:last-of-type {
        width: 100%;
        margin-top: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
    }

    #form1 > table:last-of-type td,
    #form1 > table:last-of-type th {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
    }

    #form1 > table:last-of-type th {
        background-color: #f8f8f8;
        font-weight: bold;
        color: #333;
    }
    
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
<!-- <h3 class="he3" align="center"><u>Feedback</u></h3> -->
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
    <table>
       <tr>
         <td>Content</td>
         <td>
           <textarea name="txt_content" id="txt_content" cols="45" rows="5" required minlength="10" placeholder="Enter the Content"></textarea>
         </td>
       </tr>
       <tr>
         <td colspan="2">
           <input type="submit" name="btn_submit" id="btn_submit" value="Feedback" />
         </td>
       </tr>
    </table>
  
    <!-- <table>
        <tr>
          <th>SlNo</th>
          <th>Date</th>
          <th>Content</th>
          <th>Action</th>
        </tr>
        <?php
            $i=0;
            $selQry="select * from tbl_feedback where user_id='".$_SESSION['uid']."'";
            $res=$Conn->query($selQry); 
            while($data=$res->fetch_assoc())
            {
                $i++;
                ?>
        <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $data['feedback_date'] ?></td>
          <td><?php echo $data['feedback_content'] ?></td>
          <td><a href="Feedback.php?Delid=<?php echo $data['feedback_id'] ?>" >Delete</a></td>
        </tr>
        <?php
        }
        ?>
    </table> -->
</form>
</body>
</html>
<br>



