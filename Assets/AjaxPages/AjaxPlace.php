 <option value="">--select--</option>
 <?php 
 include("../Connection/Connection.php");
		$selQry="select * from tbl_place where district_id='".$_GET['did']."'";
		$row=$Conn->query($selQry);
		
		while($data=$row->fetch_assoc())
		{
			?>
			<option
                value="<?php echo $data['place_id'] ?>">
                <?php echo $data['place_name'] ?>
			</option>
			<?php
		}
 ?>