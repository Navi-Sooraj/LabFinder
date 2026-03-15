<?php
include("../Assets/Connection/Connection.php");
include("Head.php");

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
        background-image: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url('../Assets/Templates/Main/assets/img/w1.png'); /* Added background image with overlay */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        align-items: center;
        min-height: 100vh;
        margin: 0;
        /* padding: 50px 20px; Added padding for better spacing */
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
    #form1 {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        width: 95%;
        max-width: 2000px;
        margin: auto;
        margin-bottom: 100px;

    }
    
    /* --- General Table Reset --- */
    table {
        border-collapse: collapse;
        border: none;
    }

    /* --- Data Display Table Styles --- */
    #form1 table {
        width: 100%;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden; /* Ensures border-radius is respected on child elements */
    }

    td {
        padding: 12px;
        /* text-align: center; */
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
        color: #333;
    }

    #form1 table th {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
    }

    #form1 table th {
        background-color: #f8f8f8;
        font-weight: bold;
        color: #333;
    }
    
    /* This rule sets the text color for the data cells to black */
    #form1 table td {
        color: #000000;
    }
    
    #form1 table tr:nth-child(even) {
        background-color: #fdfdfd;
    }

    #form1 table tr:last-child td {
        border-bottom: none;
    }

    #form1 table tr:first-child {
        background-color: #f8f8f8;
        font-weight: bold;
    }

    /* Table Body Rows */
    #form1 tr:not(:first-child):hover {
        background-color: #f1f1f1;
        transition: background-color 0.3s;
    }
</style>
</head>

<body>
<h3 align="center"><u>Feedback</u></h3>
<form id="form1" name="form1" method="post" action="">
    <table>
        <tr>
            <th align="center">SlNo</th>
            <th align="center">Date</th>
            <th align="center">From</th>
            <th align="center">E-mail</th>
            <th align="center">Content</th>
            <!-- <th>Action</th> -->
        </tr>
        <?php
            $i=0;
            $selQry="select * from tbl_feedback f inner join tbl_user u on f.user_id=u.user_id";
            $res=$Conn->query($selQry); 
            while($data=$res->fetch_assoc())
            {
                $i++;
                ?>
        <tr>
            <td width="3%" align="center"><?php echo $i ?></td>
            <td width="10%" align="center"><?php echo $data['feedback_date'] ?></td>
            <td width="20%" align="center"><?php echo $data['user_name'] ?></td>
            <td width="20%"align="center"><?php echo $data['user_email'] ?></td>
            <td width="47%" align="left"><?php echo $data['feedback_content'] ?></td>
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