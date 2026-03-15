<?php
include("../Assets/Connection/Connection.php");
include("Head.php");


if(isset($_POST['btn_submit']))
{
	$labname=$_POST['txt_name'];
	$labemail=$_POST['txt_email'];
	$labaddress=$_POST['txt_address'];
	$labcontact=$_POST['num_contact'];
	$placeid=$_POST['sel_place'];
	
	$labphoto=$_FILES['file_photo']['name'];
	$labpath=$_FILES['file_photo']['tmp_name'];
	move_uploaded_file($labpath,"../Assets/Files/Lab/Photo/".$labphoto);
	
	$labproof=$_FILES['file_proof']['name'];
	$proofpath=$_FILES['file_proof']['tmp_name'];
	move_uploaded_file($proofpath,"../Assets/Files/Lab/Proof/".$labproof);
	 
	$labpassword=$_POST['txt_password'];
  $labrepassword=$_POST['txt_repassword'];
  $psw_hint=$_POST['txt_hint'];
	
		
	$SelUser="select * from tbl_user where user_email='".$labemail."'";
	$resUser=$Conn->query($SelUser);
	
	$SelLab="select * from tbl_lab where lab_email='".$labemail."'";
	$resLab=$Conn->query($SelLab);
	
	
	if($resLab->num_rows>0 || $resUser->num_rows>0)
	{
		?>
        <script>	
			alert("Email Already Exist");
		</script>	
        <?php
	}
	else
	{
	  if($labpassword == $labrepassword)
	  {	
	    $insQry="insert into tbl_lab(lab_name,lab_email,lab_address,lab_contact,place_id,lab_photo,lab_proof,lab_password,lab_password_hint) values('".$labname."','".$labemail."','".$labaddress."','".$labcontact."','".$placeid."','".$labphoto."','".$labproof."','".$labpassword."','".$psw_hint."')";
      if($Conn->query($insQry))
      {
       	 ?>
       	 <script>
	        alert("Inserted");
	        window.location="LabRegistration.php";
       	 </script>
       	 <?php
      }
    }
    else
		{
			?>
			<script>
				alert("Password Mismatch");
			</script>
			<?php
		}
	}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lab Registration</title>
<style>
    /* --- General Styles (from User Registration page) --- */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-image: linear-gradient(rgba(0, 0, 0, 0.25), rgba(0, 0, 0, 0.25)), url('../Assets/Templates/Main/assets/img/w1.png'); /* Added background image with overlay */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        /* background-color: #5A827E; Main background color */
        /* display: flex; */
        /* justify-content: center; */
        align-items: flex-start;
        /* padding: 50px 20px; */
        min-height: 100vh;
        margin: 0;
    }

    /* --- Form Container Styles --- */
    #form1 {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        width: 100%;
        max-width: 700px;
        margin: auto;
    }

    h3 {
        color: #333;
        margin-bottom: 30px;
        font-size: 2em;
        font-weight: 300; /* Lighter font for a modern look */
        text-align: center;
        letter-spacing: 1px;
        position: relative;
        padding-bottom: 15px;
    }

    h3 u {
        text-decoration: none; /* Remove default underline */
    }

    /* Custom underline for heading */
    h3::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background-color: #5A827E;
        border-radius: 2px;
    }

    /* --- Table Styles (Core Layout) --- */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table tr {
        border-bottom: 1px solid #f0f0f0; /* Softer separator */
    }

    table tr:last-child {
        border-bottom: none;
    }

    td {
        padding: 18px 10px;
        vertical-align: middle;
    }

    /* Left column (Labels) */
    td:first-child {
        width: 30%;
        font-weight: 600; /* Bolder for better readability */
        color: #555;
        text-align: right;
        padding-right: 25px;
    }

    /* Right column (Inputs) */
    td:last-child {
        width: 70%;
        text-align: left;
    }

    /* --- Input Field Styles --- */
    input[type="text"],
    input[type="email"],
    input[type="password"],
    textarea,
    select {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-sizing: border-box;
        margin: 0;
        transition: all 0.3s ease;
        background-color: #f9f9f9;
    }

    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus,
    textarea:focus,
    select:focus {
        border-color: #5A827E;
        outline: none;
        box-shadow: 0 0 8px rgba(90, 130, 126, 0.2);
        background-color: #fff;
    }

    textarea {
        resize: vertical;
        min-height: 100px;
    }

    /* --- Button Styles --- */
    input[type="submit"] {
        padding: 12px 25px;
        margin: 10px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        font-size: 1em;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    /* Sign Up Button (Primary Action) */
    input[name="btn_submit"] {
        background-color: #5A827E;
        color: white;
    }

    input[name="btn_submit"]:hover {
        background-color: #4B6F6A; /* Darker shade on hover */
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Cancel Button (Secondary Action) */
    input[name="btn_cancel"] {
        background-color: #f1f1f1; /* Light grey for secondary action */
        color: #555;
    }   

    input[name="btn_cancel"]:hover {
        background-color: #e1e1e1;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
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

    /* Style for the full-width button row */
    td[colspan="2"] {
        text-align: center !important;
        padding: 30px 0 10px 0;
    }
</style>
</head>

<body>
<form id="form1" name="form1" method="post" enctype="multipart/form-data" action="">
  <h3><u>Lab Registration</u></h3>
  <table>
    <tr>
      <td>Name</td>
      <td>
        <input type="text" name="txt_name" id="txt_name" placeholder="Enter the lab's name" required title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" minlength="3" />
      </td>
    </tr>
    <tr>
      <td>Email</td>
      <td>
        <input type="email" name="txt_email" id="txt_email" placeholder="Enter the official email" required/>
      </td>
    </tr>
    <tr>
      <td>Address</td>
      <td>
        <textarea name="txt_address" id="txt_address" placeholder="Enter the lab's full address" required></textarea>
      </td>
    </tr>
    <tr>
      <td>Contact</td>
      <td>
        <input type="text" name="num_contact" id="num_contact" placeholder="Enter the contact number" maxlength="10" pattern="[6-9]{1}[0-9]{9}" title="Phone number must start with 6-9 and be 10 digits long" required />
      </td>
    </tr> 
    <tr>
      <td>District</td>
      <td>
        <select name="sel_district" id="sel_district" onChange="getPlace(this.value)" required>
          <option value="">--Select District--</option>
          <?php 

            // This PHP code will run on your server
            $selQry="select * from tbl_district";
            $res=$Conn->query($selQry);
            while($data=$res->fetch_assoc())
            {
          ?>
          <option value="<?php echo $data['district_id']?>">
            <?php echo $data['district_name'] ?>
          </option>
          <?php
            }
        
          ?> 
        </select>
      </td>
    </tr>
    <tr>
      <td>Place</td>
      <td>
        <select name="sel_place" id="sel_place" required>
          <option value="">--Select Place--</option>
          </select>
      </td>
    </tr>
    <tr>
      <td>Photo</td>
      <td>
        <input type="file" name="file_photo" id="file_photo" accept="image/*" />
      </td>
    </tr>
    <tr>
      <td>Proof</td>
      <td>
        <input type="file" name="file_proof" id="file_proof" accept="application/pdf,image/*" required/>
      </td>
    </tr>
    <tr>
      <td>Password</td>
      <td>
        <input type="password" name="txt_password" id="txt_password" placeholder="Enter a strong password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"/>
      </td>
    </tr>
    <tr>
      <td>Re-Password</td>
      <td>
        <input type="password" name="txt_repassword" id="txt_repassword" placeholder="Re-type the password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"/>
      </td>
    </tr>
    <tr>
      <td>Password Hint</td>
      <td>
      <input type="text" name="txt_hint" id="txt_hint" placeholder="Enter a hint" required /></td>
    </tr>
    <tr>
      <td colspan="2">
        <input type="submit" name="btn_submit" id="btn_submit" value="Sign Up" />
        <input type="submit" name="btn_cancel" id="btn_cancel" value="Cancel" />
      </td>
    </tr>
  </table>
</form>
</body>
</html>

<script src="../Assets/JQ/jQuery.js"></script>
<script>
	function getPlace(did)
	{
		$.ajax({
			url: "../Assets/AjaxPages/AjaxPlace.php?did=" + did,
			success: function(result)
			{
				$("#sel_place").html(result);
			}
		});
	}	
</script>

<?php
include("Foot.php");
?>