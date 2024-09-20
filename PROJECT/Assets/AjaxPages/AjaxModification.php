 <?php
include('../connection/connection.php');

?>
 <option>--Select--</option>
 
 
 <?php
        $sel="select * from tbl_modification where type_id=".$_GET['did'];
		$row=$con->query($sel);
		while($data=$row->fetch_assoc())
		{
			?>
            <option value ="<?php echo  $data['modification_id']?>"><?php echo $data['modification_name']?></option>
            <?php
		}
		?>