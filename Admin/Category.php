<?php
include("../Assets/Connection/Connection.php");
$catid="";
$catname="";
if(isset($_POST['btn_submit']))
{
	$catname=$_POST['txt_ctgname'];
	$catid=$_POST['txt_id'];
	if($catid=="")
	{
	
	$inserqry="insert into tbl_category(category_name) values('".$catname."')";
	if($Conn->query($inserqry))
	{
		?>
        
        <script>
		    alert("Inserted");
		    window.location="Category.php";
		</script>
        <?php
    }
	}
	else
	{
		$upqry="update tbl_category set category_name='".$catname."' where category_id='".$catid."'";
		if($Conn->query($upqry))
		{
		?>
        <script>
		alert("Updated");
		window.location="Category.php";
		</script>
        <?php
		}
	}
}
if(isset($_GET['delid']))
{
	$delqry="delete from tbl_category where category_id='".$_GET['delid']."'";
		if($Conn->query($delqry)) 
		{
			?>
            <script>
			alert("Deleted");
			window.location="Category.php";
            </script>
            <?php 
		}
}

if(isset($_GET['Editid']))
{
	$selqry="select * from tbl_category where category_id='".$_GET['Editid']."'";	    $row=$Conn->query($selqry);
	$data=$row->fetch_assoc();
	$catid=$data['category_id'];
	$catname=$data['category_name'];
	
}

   
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Category</title>
</head>

<body>
<form action="Category.php" method="post">

<table width="435" border="1" align="center">
  <tr>
    <td width="203" height="54" align="center">Category Name:</td>
    <td width="216"><label for="txt_ctgname"></label>
    <input type="hidden" name="txt_id" id="txt_id" placeholder="Enter the name" value="<?php echo $catid ?>" />
    <input type="text" name="txt_ctgname" id="txt_ctgname"  value="<?php echo $catname ?>" /></td>
  </tr>
  <tr>
    <td height="71" colspan="2" align="center">
      <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
    </td>
    </tr>
</table>
<p>&nbsp;</p>
<table width="307" height="139" border="1" align="center">
  <tr>
    <td width="62" height="55"><div align="center">SlNo</div></td>
    <td width="113"><div align="center">Category</div></td>
    <td width="84"><div align="center">Action</div></td>
  </tr>
  <?php
  $i=0;
  $selqry="select * from tbl_category";
  $row=$Conn->query($selqry);
  while($data=$row->fetch_assoc())
  {
	  $i++;
  ?>  
  <tr>
    <td height="58"><div align="center"><?php echo $i ?></div></td>
    <td><div align="center"><?php echo $data['category_name'] ?></div></td>
    <td><div align="center"> <a href="Category.php?Editid=<?php echo $data['category_id']?>">Edit</a> <a href="Category.php?delid=<?php echo $data['category_id'] ?>">Delete</a></div></td>
  </tr>
  <?php
 }
  ?>
</table>
<p>&nbsp;</p>

</form>
</body>
</html>