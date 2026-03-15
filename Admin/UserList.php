<?php
include("../Assets/Connection/Connection.php");
include("Head.php");

// --- Handles multi-delete form submission ---
if(isset($_POST['btn_delete']))
{
    if(!empty($_POST['user_ids']))
    {
        $userIds = $_POST['user_ids'];
        // Sanitize all inputs to ensure they are integers
        $sanitizedIds = array_map('intval', $userIds);
        $idsString = implode(',', $sanitizedIds);

        // Proceed only if there are valid IDs
        if (!empty($idsString)) {
            $delQry = "DELETE FROM tbl_user WHERE user_id IN (" . $idsString . ")";
            if($Conn->query($delQry))
            {
                ?>
                <script>
                    alert("Selected users have been deleted.");
                    window.location="userList.php";
                </script>
                <?php
            }
        }
    }
    else
    {
        ?>
        <script>
            alert("No users were selected for deletion.");
        </script>
        <?php
    }
}

?>

<style>
/* --- Checkbox Column Styles --- */
    .user-checkbox {
        display: none; /* Hidden by default */
        width: 50px;
    }

    /* --- Bottom Links & Buttons --- */
    .bottom-links {
        text-align: center;
        margin-top: 30px;
    }
    .bottom-links button {
        color: #5A827E;
        text-decoration: none;
        font-weight: 600;
        margin: 0 10px;
        padding: 8px 16px;
        border: 1px solid #5A827E;
        border-radius: 8px;
        transition: all 0.3s ease;
        background-color: white;
        cursor: pointer;
        font-size: 1em;
    }
    .bottom-links button:hover {
        background-color: #5A827E;
        color: white;
    }
    #delete-btn {
        border-color: #e74c3c;
        color: #e74c3c;
    }
    #delete-btn:hover:not(:disabled) {
        background-color: #e74c3c;
        color: white;
    }
    #delete-btn:disabled {
        border-color: #ccc;
        color: #ccc;
        cursor: not-allowed;
        background-color: #f1f1f1;
    }
</style>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>user List</title>
<style>
    /* --- General Styles --- */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
        max-width: 95%; /* Wider for the large table */
        margin: auto;
        overflow-x: auto; /* Makes table scroluserle on small screens */
        margin-bottom: 100px;
    }
    
    /* --- Table Styles --- */
    table {
        border-collapse: collapse;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        width: 100%;
    }

    table td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
        color: #333;
    }

    table tr:first-child {
        background-color: #f8f8f8;
        font-weight: bold;
    }
    
    table tr:nth-child(even) {
        background-color: #fdfdfd;
    }
    
    table tr:last-child td {
        border-bottom: none;
    }

    table img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
    }

    /* --- Action Links as Buttons --- */
    table a {
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
    
    a[href*="AcceptId"] {
      background-color: #27ae60; /* Green for Accept */
    }
    
    a[href*="AcceptId"]:hover {
      background-color: #229954;
    }

    a[href*="DeclineId"] {
      background-color: #e74c3c; /* Red for Decline */
    }
    
    a[href*="DeclineId"]:hover {
      background-color: #c0392b;
    }
    
    /* --- Bottom Links Container --- */
    .bottom-links {
        text-align: center;
        margin-top: 30px;
    }
    
    .bottom-links a {
        color: #5A827E;
        text-decoration: none;
        font-weight: 600;
        margin: 0 15px;
        padding: 8px 16px;
        border: 1px solid #5A827E;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .bottom-links a:hover {
        background-color: #5A827E;
        color: white;
    }

</style>
</head>

<body>
<h3 align="center">User List</h3>
<form id="form1" name="form1" method="post" action="">
  <table width="1072" height="193" border="1" align="center">
    <tr>
      <td width="47" height="93" align="center">SlNo</td>
      <td width="90" align="center">Name</td>
      <td width="123" align="center">Email</td>
      <td width="115" align="center">Address</td>
      <td width="88" align="center">District</td>
      <td width="86" align="center">Place</td>
      <td width="109" align="center">Contact</td>
      <td width="100" align="center">Photo</td>
    </tr>
    <?php
      $i=0;
      $selQry="select * from tbl_user l inner join tbl_place p inner join tbl_district d on l.place_id=p.place_id and p.district_id=d.district_id";
      $res=$Conn->query($selQry);
      while($data=$res->fetch_assoc())
      {
        $i++;
        ?>
        
        <tr>
          <td class="user-checkbox">
             <input type="checkbox" name="user_ids[]" value="<?php echo $data['user_id'] ?>" class="user-checkbox-input">
          </td>
          <td height="50" align="center"><?php echo $i ?></td>
          <td align="center"><?php echo $data['user_name'] ?></td>
          <td align="center"><?php echo $data['user_email']?></td>
          <td align="left"><?php echo $data['user_address']?></td>
          <td align="center"><?php echo $data['district_name']?></td>
          <td align="center"><?php echo $data['place_name']?></td>
          <td align="center"><?php echo $data['user_contact']?></td>
          <td align="center"><img width="100" height="100" src="../Assets/Files/user/photo/<?php echo $data['user_photo']?>" /></td>
        </tr>
        <?php
      }
    ?>
  </table>
  <div class="bottom-links">
    <button type="button" id="edit-btn" onclick="enterEditMode()">Edit</button>
    <button type="submit" name="btn_delete" id="delete-btn" style="display:none;" disabled>Delete Selected</button>
    <button type="button" id="cancel-btn" onclick="cancelEditMode()" style="display:none;">Cancel</button>
  </div>
</form>

<script>
    function enterEditMode() {
        document.querySelectorAll('.user-checkbox').forEach(el => el.style.display = 'table-cell');
        document.getElementById('edit-btn').style.display = 'none';
        document.getElementById('delete-btn').style.display = 'inline-block';
        document.getElementById('cancel-btn').style.display = 'inline-block';
    }

    function cancelEditMode() {
        document.querySelectorAll('.user-checkbox-input').forEach(input => input.checked = false);
        document.querySelectorAll('.user-checkbox').forEach(el => el.style.display = 'none');
        document.getElementById('edit-btn').style.display = 'inline-block';
        document.getElementById('delete-btn').style.display = 'none';
        document.getElementById('cancel-btn').style.display = 'none';
        document.getElementById('delete-btn').disabled = true;
    }

    function updateDeleteButtonState() {
        const anyChecked = document.querySelectorAll('.user-checkbox-input:checked').length > 0;
        document.getElementById('delete-btn').disabled = !anyChecked;
    }

    document.querySelectorAll('.user-checkbox-input').forEach(input => {
        input.addEventListener('change', updateDeleteButtonState);
    });
</script>

</body>
</html>

<?php
include("Foot.php");
?>