<?php
include("../Assets/Connection/Connection.php");
include("Head.php");

// --- Handles multi-delete form submission ---
if(isset($_POST['btn_delete']))
{
    if(!empty($_POST['lab_ids']))
    {
        $labIds = $_POST['lab_ids'];
        // Sanitize all inputs to ensure they are integers
        $sanitizedIds = array_map('intval', $labIds);
        $idsString = implode(',', $sanitizedIds);

        // Proceed only if there are valid IDs
        if (!empty($idsString)) {
            $delQry = "DELETE FROM tbl_lab WHERE lab_id IN (" . $idsString . ")";
            if($Conn->query($delQry))
            {
                ?>
                <script>
                    alert("Selected labs have been deleted.");
                    window.location="LabList.php";
                </script>
                <?php
            }
        }
    }
    else
    {
        ?>
        <script>
            alert("No labs were selected for deletion.");
        </script>
        <?php
    }
}

// --- Handles Accept/Decline actions ---
if(isset($_GET['AcceptId']))
{
  $upQry="update tbl_lab set lab_status=1 where lab_id='".$_GET['AcceptId']."'";
  if($Conn->query($upQry))
  {
    ?>
        <script>
      alert("Accepted");
      window.location="LabList.php";
    </script>
        <?php
  }
}

if(isset($_GET['DeclineId']))
{
  $upQry="update tbl_lab set lab_status=2 where lab_id='".$_GET['DeclineId']."'";
  if($Conn->query($upQry))
  {
    ?>
        <script>
      alert("Declined");
      window.location="LabList.php";
    </script>
        <?php
  }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Lab List</title>
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
        /* padding: 50px 20px; */
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

    /* --- Form Container --- */
    #labListForm {
        background-color: #ffffff;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        width: 100%;
        max-width: 95%; /* Make it responsive */
        margin: auto;
        overflow-x: auto; /* Makes table scrollable on small screens */
        margin-bottom: 100px;
    }
    
    /* --- Table Styles --- */
    table {
        border-collapse: collapse;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        width: 100%;
        min-width: 1200px; /* Prevent table from squishing too much */
    }
    table td, table th {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
        color: #333;
    }
    table th {
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

    b {
      color: #3a9ca5ff;
    }

    b:hover {
        color: #834040ff;
    }

    a[href*="AcceptId"] { background-color: #27ae60; }
    a[href*="AcceptId"]:hover { background-color: #229954; }
    a[href*="DeclineId"] { background-color: #e74c3c; }
    a[href*="DeclineId"]:hover { background-color: #c0392b; }
    
    /* --- Status Text Styles --- */
    .status-accepted {
        color: #27ae60;
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }
    .status-declined {
        color: #e74c3c;
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    /* --- Checkbox Column Styles --- */
    .lab-checkbox {
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
</head>
<body>
<h3 align="center">Lab List</h3>
<form id="labListForm" name="labListForm" method="post" action="">
  <table>
    <tr>
      <th class="lab-checkbox">Select</th>
      <th>SlNo</th>
      <th>Name</th>
      <th>Email</th>
      <th>Address</th>
      <th>District</th>
      <th>Place</th>
      <th>Contact</th>
      <th>Photo</th>
      <th>Proof</th>
      <th>Action</th>
      <th>Aspects</th>

    </tr>
    <?php
      $i=0;
      $selQry = "SELECT * from tbl_lab l inner join tbl_place p on l.place_id=p.place_id inner join tbl_district d on p.district_id=d.district_id WHERE l.lab_status IN (0, 2)";
      $res=$Conn->query($selQry);
      while($data=$res->fetch_assoc())
      {
        $i++;
        ?>
 
        <tr>
          <td class="lab-checkbox">
              <input type="checkbox" name="lab_ids[]" value="<?php echo $data['lab_id'] ?>" class="lab-checkbox-input">
          </td>
          <td><?php echo $i ?></td>
          <td><?php echo $data['lab_name'] ?></td>
          <td><?php echo $data['lab_email']?></td>
          <td align="left"><?php echo $data['lab_address']?></td>
          <td><?php echo $data['district_name']?></td>
          <td><?php echo $data['place_name']?></td>
          <td><?php echo $data['lab_contact']?></td>
          <td><img src="../Assets/Files/Lab/photo/<?php echo $data['lab_photo']?>" /></td>
          <td><a href="../Assets/Files/Lab/Proof/<?php echo $data['lab_proof']?>" target="_blank"><b>View Proof</b></a></td>
            
          <td>
              <?php
                if ($data['lab_status'] == 1) {
                    echo '<span class="status-accepted">Accepted</span>';
                    echo '<a href="LabList.php?DeclineId=' . $data['lab_id'] . '">Decline</a>';
                } else if ($data['lab_status'] == 2) {
                    echo '<span class="status-declined">Declined</span>';
                    echo '<a href="LabList.php?AcceptId=' . $data['lab_id'] . '">Accept</a>';
                } else {
                    echo '<a href="LabList.php?AcceptId=' . $data['lab_id'] . '">Accept</a>';
                    echo '<a href="LabList.php?DeclineId=' . $data['lab_id'] . '">Decline</a>';
                }
              ?>
          </td>
          <td><a href="ViewMore.php?viewid=<?php echo $data['lab_id'] ?>"><b>Details</b></a></td>
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
        document.querySelectorAll('.lab-checkbox').forEach(el => el.style.display = 'table-cell');
        document.getElementById('edit-btn').style.display = 'none';
        document.getElementById('delete-btn').style.display = 'inline-block';
        document.getElementById('cancel-btn').style.display = 'inline-block';
    }

    function cancelEditMode() {
        document.querySelectorAll('.lab-checkbox-input').forEach(input => input.checked = false);
        document.querySelectorAll('.lab-checkbox').forEach(el => el.style.display = 'none');
        document.getElementById('edit-btn').style.display = 'inline-block';
        document.getElementById('delete-btn').style.display = 'none';
        document.getElementById('cancel-btn').style.display = 'none';
        document.getElementById('delete-btn').disabled = true;
    }

    function updateDeleteButtonState() {
        const anyChecked = document.querySelectorAll('.lab-checkbox-input:checked').length > 0;
        document.getElementById('delete-btn').disabled = !anyChecked;
    }

    document.querySelectorAll('.lab-checkbox-input').forEach(input => {
        input.addEventListener('change', updateDeleteButtonState);
    });
</script>

</body>
</html>

<?php
include("Foot.php");
?>

