
<?php
include('../Assets/connection/connection.php');
if(isset($_POST["btn_reg"]))
{
	$Name=$_POST["txt_name"];
	$Email=$_POST["txt_Email"];
	$Password=$_POST["txt_Password"];
	$insqry="insert into tbl_admin(admin_name,admin_email,admin_password)values('".$Name."','".$Email."','".$Password."')";
     if($con->query($insqry))
	{
	?>
    <script>
	alert('inserted');
	window.loction="Adminreg.php";
	</script>
    <?php
	}
}if(isset($_GET["delID"]))
{
	 
	$delqry="delete  from tbl_admin where admin_id='".$_GET["delID"]."'";
     if($con->query($delqry))
	 {
	 echo"inserted";
	header("loaction:AdminRegistration.php");
	 }
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
      <td>Name</td>
      <td><label for="txt_name"></label>
      <input type="text" name="txt_name" id="txt_name" /></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txt_Email"></label>
      <input type="text" name="txt_Email" id="txt_Email" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txt_Password"></label>
      <input type="text" name="txt_Password" id="txt_Password" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_reg" id="btn_reg" value="Register" />
        <label for="txt_Register"></label>
      </td>
    </tr>
  </table>
  <p>&nbsp;</p>

<table width="200" border="1">
  <tr>
    <td>sl.no</td>
    <td>Name</td>
    <td>Email</td>
    <td>Password</td>
    <td>Action</td>
  </tr><?php
	$i=0;
	$sel="select * from tbl_admin";
	$row=$con->query($sel);
	while($data=$row->fetch_assoc())
	{
		$i++;
		?>
   <tr>
      <td><?php echo $i?></td>
      <td><?php echo $data['admin_name']?></td>
      <td><?php echo $data['admin_email']?></td>
      <td><?php echo $data['admin_password']?></td>
      <td><a href="AdminRegistration.php?delID=<?php echo $data['admin_id']?>">Delete</a></td>
    </tr>
    <?php
	}
	?>
 </table>
</form>
</body>
</html>