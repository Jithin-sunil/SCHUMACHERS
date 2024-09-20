`<?php
include('../Assets/connection/connection.php');
$typename="";
$typeid="";
if(isset($_POST["btn_submit"]))
{
	$typeid=$_POST['txt_id'];
	$type=$_POST["txt_type"];
	if($typeid==""){
	$insqry="insert into tbl_modificationtype(type_name)values('".$type."')";
     if($con->query($insqry))
	{
		?>
        <script>
	alert('inserted');
	window.location="ModificationType.php";
	</script>
    <?php
	}
}

else{
	$updqry="update tbl_modificationtype set type_name='".$type."' where type_id=".$typeid;
	if($con->query($updqry))
{
?>
<script>
alert('updated');
window.location="ModificationType.php";
</script>
<?php
}
}
}
if(isset($_GET["delID"]))
{
	$delQry="delete from tbl_modificationtype where type_id='".$_GET["delID"]."'";
    if($con->query($delQry))
	{
		?>
        <script>
		alert('Deleted');
		window.loction="ModificationType.php";
		</script>
        <?php
				 
				 
	}
}

if(isset($_GET['eid'])){
	 $selEdit="select * from tbl_modificationtype where type_id=".$_GET['eid'];
	$resEdit=$con->query($selEdit);
	$dataEdit=$resEdit->fetch_assoc();
	$typename=$dataEdit['type_name'];
	$typeid=$dataEdit['type_id'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
<table width="200" border="1">
  <tr>
    <td align="center"><p>type Name </p></td>
    <td><label for="txt_type"></label>
    <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $typeid ?>"/>
    <input type="text" name="txt_type" id="txt_type"value="<?php echo $typename?> "/></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
      <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      <input type="submit" name="btn_cancel" id="btn_cancel" value="Cancel" />
   </td>
  </tr>
</table>
<p>&nbsp;</p>

  <table width="200" border="1">
    <tr>
      <td><h3>#</h3></td>
      <td>type</td>
      <td>Action</td>
    </tr>
    <?php
	$i=0;
	$sel="select * from tbl_modificationtype";
	$row=$con->query($sel);
	while($data=$row->fetch_assoc())
	{
		$i++;
		?>
    
    <tr>
      <td><?php echo $i?></td>
      <td><?php echo $data['type_name']?></td>
      <td><a href="ModificationType.php?delID=<?php echo $data['type_id']?>">Delete</a>||<a href="ModificationType.php?eid=<?php echo $data['type_id']?>">Edit</a></td>
    </tr>
    <?php
	}
	?>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>