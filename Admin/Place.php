<?php
    include("../Assets/Connection/Connection.php");
    include("Head.php");
    
    if(isset($_POST['btn_submit']))
    {
        $did=$_POST['sel_district'];
        $pname=$_POST['txt_place'];
        // $pcode=$_POST['txt_pin'];
        
        $pid=$_POST['txt_id'];
        if($pid=="")
        {
            $insQry="insert into tbl_place(district_id,place_name) values('".$did."','".$pname."')";                                                                                                                                                                                                                                                                                                                                                                                                                                         
            if($Conn->query($insQry))                                                                                                                                                                                                                                                                                                                                                                                                                                              
            {
                ?>
                <script>
                    alert("Inserted");
                    window.location="Place.php";
                </script>
                <?php
            }
        }
        else
        {
            $upQry="update tbl_place set place_name='".$pname."',district_id='".$did."' where place_id='".$pid."'";
            if($Conn->query($upQry))                                                                                                                                                                                                                                                                                                                                                                                                                                              
            {
                ?>
                <script>
                    alert("Updated");
                    window.location="Place.php";
                </script>
                <?php
            }
        }
    }
    
    if(isset($_GET['Delid']))
    {
        $delQry="delete from tbl_place where place_id='".$_GET['Delid']."'";
        if($Conn->query($delQry))
        {
            ?>
            <script>
                alert("Deleted");
                window.location="Place.php";
            </script>
            <?php   
                
        }
    }
    
    $pid="";
    $pname="";
    // $pcode="";
    $disid="";
    if(isset($_GET['Editid']))
    {
        $selQry="select * from tbl_place where place_id='".$_GET['Editid']."'";
        $row=$Conn->query($selQry);
        $data=$row->fetch_assoc();
        $disid=$data['district_id'];
        $pid=$data['place_id'];
        $pname=$data['place_name'];
        // $pcode=$data['place_pincode'];
    
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Place</title>
<style>
    /* --- General Styles --- */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #121212; /* Dark background color */
        min-height: 100vh;
        margin: 0;
        box-sizing: border-box;
        color: #e0e0e0; /* Light gray text for contrast */
        padding-top: 40px; /* Add some space at the top */
    }

    /* --- Heading Styles --- */
    h3 {
        color: #ffffff; /* White heading */
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
        background-color: #ffffffff; /* Teal accent */
        border-radius: 2px;
    }

    /* --- Form Container Styles --- */
    form {
        background-color: #1d202bdf; /* Darker panel background */
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3); /* Subtle dark shadow */
        width: 100%;
        max-width: 800px;
        margin: auto;
        border: 1px solid #333; /* Soft border for definition */
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
        color: #a0a0a0; /* Lighter gray for labels */
        text-align: right;
        padding-right: 25px;
    }

    /* --- Input Field & Select Styles --- */
    input[type="text"],
    select {
        width: 100%;
        padding: 12px;
        border: 1px solid #333; /* Darker border */
        border-radius: 8px;
        box-sizing: border-box;
        transition: all 0.3s ease;
        background-color: #2a2a2a; /* Dark input background */
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #e0e0e0; /* Light text in input */
    }

    input[type="text"]:focus,
    select:focus {
        border-color: #64ffda; /* Teal border on focus */
        outline: none;
        box-shadow: 0 0 8px rgba(100, 255, 218, 0.2); /* Teal shadow on focus */
        background-color: #3a3a3a; /* Slightly lighter dark on focus */
    }

    /* --- Button Styles (Partially Reverted) --- */
    input[type="submit"] {
        padding: 12px 25px;
        margin: 5px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        font-size: 1em;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    /* -- START: ORIGINAL BUTTON COLORS -- */
    input[name="btn_submit"] {
        background-color: #5A827E;
        color: white;
    }
    input[name="btn_submit"]:hover {
        background-color: #4B6F6A;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    input[name="btn_cancel"] {
        background-color: #f1f1f1;
        color: #555;
    }
    input[name="btn_cancel"]:hover {
        background-color: #e1e1e1;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }
    /* -- END: ORIGINAL BUTTON COLORS -- */

    form > table:first-of-type td[colspan="2"] {
        text-align: center;
    }

    /* --- Second Table (Data Display) Styles --- */
    form > table:last-of-type {
        margin-top: 20px;
        border: 1px solid #333; /* Darker border for the data table */
        border-radius: 8px;
        overflow: hidden;
        background-color: #1e1e1e; /* Same as form background */
    }

    form > table:last-of-type td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #2a2a2a; /* Slightly darker border for rows */
        vertical-align: middle;
        color: #e0e0e0; /* Light text for data */
    }

    form > table:last-of-type tr:first-child {
        background-color: #2a2a2a; /* Darker header row */
        font-weight: bold;
        color: #ffffff; /* White text for header */
    }
    
    form > table:last-of-type tr:nth-child(even) {
        background-color: #232323; /* slightly different dark background for even rows */
    }
    
    form > table:last-of-type tr:last-child td {
        border-bottom: none;
    }

    /* --- Action Links as Buttons (Reverted) --- */
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
    
    /* -- START: ORIGINAL LINK COLORS -- */
    a[href*="Editid"] {
        background-color: #226fc1ff; /* Blue for Edit */
    }
    a[href*="Editid"]:hover {
        background-color: #12405fff;
    }

    a[href*="Delid"] {
        background-color: #c33a2b9c; /* Red for Delete */
    }
    a[href*="Delid"]:hover {
        background-color: #c03a2b81;
    }
    /* -- END: ORIGINAL LINK COLORS -- */
    
    /* Remove italics from buttons */
    em {
        font-style: normal;
    }

</style>
</head>

<body>
<h3 align="center"><b>Manage Places</b></h3>
<form id="form1" name="form1" method="post" action="Place.php">
  <table>
    <tr>
      <td>District</td>
      <td><label for="sel_district"></label>
        <select name="sel_district" id="sel_district" >
         <option>--Select--</option>
                <?php
                $selQry="select * from tbl_district";
                $row=$Conn->query($selQry);
                while($data=$row->fetch_assoc())
                {
                ?>
         <option
         <?php
         if($disid==$data['district_id'])
         {
             echo "selected";
         }
         ?>
          value="<?php echo $data['district_id'] ?>">
          <?php echo $data['district_name'] ?>
          </option>
                <?php
                }
                ?>
        </select></td>
    </tr>
    <tr>
      <td><p>Place</p></td>
      <td><label for="txt_place"></label>
      <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $pid ?>" />
      <input type="text" name="txt_place" id="txt_place" placeholder="Enter the Place" value="<?php echo $pname ?>" required="required"/></td>
    </tr>
    <!-- <tr>
      <td>Pincode</td>
      <td><label for="txt_pin"></label>
      <input type="text" name="txt_pin" id="txt_pin" placeholder="Enter the Pincode" value="<?php echo $pcode ?>" /></td>
    </tr> -->
    <tr>
      <td colspan="2"><em>
        <input type="submit" name="btn_submit" id="btn_submit" value="Save" />
        <input type="submit" name="btn_cancel" id="btn_cancel" value="Cancel" />
      </em></td>
    </tr>
  </table>
  
  <table>
    <tr>
      <td>SLNo</td>
      <td>District</td>
      <td>Place</td>
      <td>Pincode</td>
      <td>Action</td>
    </tr>
    <?php
    $i=0;
    $selQry="select * from tbl_place p inner join tbl_district d on p.district_id=d.district_id";
    $row=$Conn->query($selQry);
    while($data=$row->fetch_assoc())
    {
        $i++;
    ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $data['district_name'] ?></td>
      <td><?php echo $data['place_name'] ?></td>
      <td><?php  echo $data['place_pincode'] ?></td>
      <td>
      <a href="Place.php?Editid=<?php echo $data['place_id']?>">Edit</a> 
      <a href="Place.php?Delid=<?php echo $data['place_id'] ?>">Delete</a>
      </td>
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