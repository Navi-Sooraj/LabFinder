<?php
include("../Assets/Connection/Connection.php");
include("Head.php");

if(isset($_POST['btn_signup']))
{
	$uname=$_POST['txt_name'];
	$uemail=$_POST['txt_email'];
	$ucontact=$_POST['txt_contact'];
	$uaddress=$_POST['txt_address'];
	$ugender=$_POST['rb_gender'];
	$udob=$_POST['txt_dob'];
	
	$uphoto=$_FILES['file_photo']['name'];
	$upath=$_FILES['file_photo']['tmp_name'];
	move_uploaded_file($upath,"../Assets/Files/User/Photo/".$uphoto);
	
	$upassword=$_POST['txt_password'];
	$urepassword=$_POST['txt_repassword'];
    $psw_hint=$_POST['txt_hint'];
	$placeid=$_POST['sel_place'];
	
	
	$SelUser="select * from tbl_user where user_email='".$uemail."'";
	$resUser=$Conn->query($SelUser);
	
	$SelLab="select * from tbl_lab where lab_email='".$uemail."'";
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
		if($upassword == $urepassword)
		{
			$insQry="insert into tbl_user(user_name,user_email,user_contact,user_address,user_dob,user_gender,user_photo,user_password,place_id,user_password_hint) values('".$uname."','".$uemail."','".$ucontact."','".$uaddress."','".$udob."','".$ugender."','".$uphoto."','".$upassword."','".$placeid."','".$psw_hint."')";
			if($Conn->query($insQry))
			{
				?>
				<script>
					alert("Inserted");
					window.location="Login.php";
				</script>
				<?php 
			}
		}
		else
		{
			?>
			<script>
				alert("Error | Password Mismatch");
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
<title>User Registration</title>
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
input[type="date"], 
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
input[type="date"]:focus, 
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

/* --- Radio Button Styling --- */
input[type="radio"] {
    margin-right: 8px;
    margin-left: 15px;
    accent-color: #5A827E; /* Modern way to color radios/checkboxes */
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
input[name="btn_signup"] {
    background-color: #5A827E;
    color: white;
}

input[name="btn_signup"]:hover {
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

/* Style for the file input */
input[type="file"] {
    border: 1px solid #ddd;
    padding: 8px;
    border-radius: 8px;
    background-color: #f9f9f9;
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
<form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
<h3 align="center"><u>New User Registration</u></h3>
<table align="center">
<tr>
 <td>Name</td>
 <td><label for="txt_name"></label>
 <input type="text" name="txt_name" id="txt_name" placeholder="Enter your full name" required title="Name Allows Only Alphabets,Spaces and First Letter Must Be Capital Letter" pattern="^[A-Z]+[a-zA-Z ]*$" minlength="3"/></td>
</tr>
<tr>
 <td>Email</td>
 <td><label for="txt_email"></label> 
 <input type="email" name="txt_email" id="txt_email" placeholder="Enter your email address" required /></td>
</tr>
<tr>
 <td>Contact</td>
 <td><label for="txt_contact"></label>
 <input type="text" name="txt_contact" id="txt_contact" placeholder="Enter your 10-digit mobile number" maxlength="10" pattern="[6-9]{1}[0-9]{9}" title="Phone number must start with 6-9 and be 10 digits long" required/></td>
</tr>
<tr>
 <td>Address</td>
 <td><label for="txt_address"></label>
 <textarea name="txt_address" id="txt_address" placeholder="Enter your full address" ></textarea></td>
</tr>
<tr>
 <td>Gender</td>
 <td>
 <input type="radio" name="rb_gender" id="rb_gender_male" value="Male" required /><label for="rb_gender_male">Male</label>
 <input type="radio" name="rb_gender" id="rb_gender_female" value="Female" /><label for="rb_gender_female">Female</label>
 </td>
</tr>
<tr>
 <td>Date of Birth</td>
 <td><label for="txt_dob"></label>
 <input type="date" name="txt_dob" id="txt_dob" 
  max="<?php echo date('Y-m-d', strtotime('-15 years')); ?>" 
  min="<?php echo date('Y-m-d', strtotime('-105 years')); ?>" 
  required/>
 </td>
</tr>
<tr>
 <td>District</td>
 <td><label for="sel_district"></label>
 <select name="sel_district" id="sel_district" onChange="getPlace(this.value)"> 
  <option value="">---Select District---</option>
  <?php 
    $selQry="select * from tbl_district";
    $row=$Conn->query($selQry);
    while($data=$row->fetch_assoc())
    {
     ?>
     <option value="<?php echo $data['district_id'] ?>">
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
 <td><label for="sel_place"></label>
  <select name="sel_place" id="sel_place">
  <option value="">---Select Place---</option>
  </select>
 </td>
</tr>
<tr>
 <td>Photo</td>
 <td><label for="file_photo"></label>
 <input type="file" name="file_photo" id="file_photo" accept="image/*" /></td>
</tr>
<tr>
 <td>Password</td>
 <td><label for="txt_password"></label>
 <input type="password" name="txt_password" id="txt_password" placeholder="Enter a strong password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"/></td>
</tr>
<tr>
 <td>Confirm Password</td>
 <td><label for="txt_repassword"></label>
 <input type="password" name="txt_repassword" id="txt_repassword" placeholder="Re-type the password" required /></td>
</tr>
<tr>
 <td>Password Hint</td>
 <td>
 <input type="text" name="txt_hint" id="txt_hint" placeholder="Enter a hint" required /></td>
</tr>
<tr>
  <td colspan="2">
      <input type="submit" name="btn_signup" id="btn_signup" value="Sign Up" />
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
   success: function (result) 
   {
    $("#sel_place").html(result);
   }
  });
 }
</script>

<?php
include("Foot.php");
?>