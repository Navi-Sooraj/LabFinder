<?php
include("../Assets/Connection/Connection.php");
include("Head.php");

if(isset($_GET['resultid']))
{
    $selQry="SELECT * from tbl_result where appointment_id='".$_GET['resultid']."'";
    $res=$Conn->query($selQry);
    $data=$res->fetch_assoc();
    
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload Result</title>
<style>
    /* --- General Styles --- */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-image: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url('../Assets/Templates/Main/assets/img/w1.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
        margin: 0;
        /*  padding: 50px 20px; Added padding */
        box-sizing: border-box;
    }

    /* --- Heading Styles --- */
    h3 {
        color: #ffffff;
        margin-bottom: 30px;
        font-size: 2em;
        font-weight: 400;
        text-align: center;
        letter-spacing: 1px;
        position: relative;
        padding-bottom: 15px;
    }
    
    h3 u {
      text-decoration:none;
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
        max-width: 800px;
        margin: auto;
    }

    /* --- Table Styles --- */
    table {
        width: 100%;
        border-collapse: collapse;
        border: none;
    }

    td {
        padding: 15px 10px;
        vertical-align: middle;
        border: none;
        border-bottom: 1px solid #f0f0f0; /* Light border for rows */
    }
    
    tr:last-child td {
        border-bottom: none; /* Remove border from last row */
    }

    /* Left column (Labels) */
    td:first-child {
        width: 30%;
        font-weight: 600;
        color: #555;
        text-align: Left; /* Aligns "Result" and "Description" to the right */
        padding-right: 25px;
    }

    /* Right column (Data) */
    td:last-child {
        width: 70%;
        text-align: left; /* Overrides the HTML align="center" */
        color: #333;
        font-weight: 500;
    }
    
    /* --- "View" Link as Button --- */
    form table a {
        display: inline-block;
        padding: 6px 12px;
        margin: 2px;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        font-weight: 500;
        font-size: 0.9em;
        transition: all 0.3s;
        background-color: #638780; /* Blue for "View" */
    }
    form table a:hover {
        background-color: #4B6F6A;
        color: #fff;
    }

</style>
</head>

<body>
<h3>
<?Php
    if(!empty($data['result_file']))
    {
        echo "<u>Result</u>";
    }
    else
    {
        echo "<u>Result Pending...</u>";
    }
?>
</h3>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table align="center">
    <tr>
      <td width="50" align="center">Result</td>
      <td width="256">
        <?Php
            if(!empty($data['result_file']))
            {
                ?>
                <a href="../Assets/Files/Lab/Result/<?php echo $data['result_file']?>" target="_blank"><b>View</b></a>
                <?php
            }
            else
            {
                echo "-----";
            }
        ?>
      </td>
    </tr>
    <tr>
      <td align="center">Description</td>
      <td align="center">
        <?Php
            if(!empty($data['result_description']))
            {
                echo $data['result_description'];
            }
            else
            {
                echo "-----";
            }
        ?>
      </td>
    </tr>
  </table>
</form>
</body>
</html>

<?php
include("Foot.php");
?>
