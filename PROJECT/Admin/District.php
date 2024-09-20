`<?php
include('../Assets/connection/connection.php');
$distname="";
$distid="";
if(isset($_POST["btn_submit"]))
{
	$distid=$_POST['txt_id'];
	$district=$_POST["txt_district"];
	if($distid==""){
	$insqry="insert into tbl_district(district_name)values('".$district."')";
     if($con->query($insqry))
	{
		?>
        <script>
	alert('inserted');
	window.location="District.php";
	</script>
    <?php
	}
}

else{
	$updqry="update tbl_district set district_name='".$district."' where district_id=".$distid;
	if($con->query($updqry))
{
?>
<script>
alert('updated');
window.location="District.php";
</script>
<?php
}
}
}
if(isset($_GET["delID"]))
{
	$delQry="delete from tbl_district where district_id='".$_GET["delID"]."'";
    if($con->query($delQry))
	{
		?>
        <script>
		alert('Deleted');
		window.loction="District.php";
		</script>
        <?php
				 
				 
	}
}

if(isset($_GET['eid'])){
	 $selEdit="select * from tbl_district where district_id=".$_GET['eid'];
	$resEdit=$con->query($selEdit);
	$dataEdit=$resEdit->fetch_assoc();
	$distname=$dataEdit['district_name'];
	$distid=$dataEdit['district_id'];
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
    <td align="center"><p>District Name </p></td>
    <td><label for="txt_district"></label>
    <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $distid ?>"/>
    <input type="text" name="txt_district" id="txt_district"value="<?php echo $distname?> "/></td>
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
      <td>District</td>
      <td>Action</td>
    </tr>
    <?php
	$i=0;
	$sel="select * from tbl_district";
	$row=$con->query($sel);
	while($data=$row->fetch_assoc())
	{
		$i++;
		?>
    
    <tr>
      <td><?php echo $i?></td>
      <td><?php echo $data['district_name']?></td>
      <td><a href="District.php?delID=<?php echo $data['district_id']?>">Delete</a>||<a href="District.php?eid=<?php echo $data['district_id']?>">Edit</a></td>
    </tr>
    <?php
	}
	?>
  </table>
</form>
<p>&nbsp;</p>
</body>
</html>