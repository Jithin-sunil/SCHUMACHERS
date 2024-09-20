<?php
include('../Assets/connection/connection.php');
if(isset($_POST["btn_submit"]))
{
	$District=$_POST["sel_district"];
	$Place=$_POST["sel_place"];
	$Name=$_POST["txt_name"];
	$Contact=$_POST["txt_contact"];
	$Address=$_POST["txt_address"];
	$Email=$_POST["txt_email"];
	$Password=$_POST["txt_password"];
	$ConfirmPassword=$_POST["txt_confirmpassword"];
	
	$Photo=$_FILES['filephoto']['name'];
	$temp=$_FILES['filephoto']['tmp_name'];
	move_uploaded_file($temp,'../Assets/Files/User/Photo/'.$Photo);


$insqry="insert into tbl_user(place_id,user_name,user_photo,user_password,user_email,user_contact,user_address)values('".$Place."','".$Name."','".$Photo."','".$Password."','".$Email."','".$Contact."','".$Address."')";
if($con->query($insqry))
{
?>
<script>
alert('inserted');
window.location="Newuser.php";
</script>
<?php
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
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="200" border="1">
    <tr>
      <td>District</td>
      <td align="right"><label for="sel_district"></label>
        <select name="sel_district" id="sel_district" onChange="getPlace(this.value)">
        <option>---select---</option> 
        <?php
        $sel="select * from tbl_district";
		$row=$con->query($sel);
		while($data=$row->fetch_assoc())
		{
			?>
            <option value ="<?php echo  $data['district_id']?>"><?php echo $data['district_name']?></option>
            <?php
		}
		?>
      </select>
      </td>
    </tr>
    <tr>
      <td>Place</td>
      <td align="right"><label for="sel_place"></label>
        <select name="sel_place" id="sel_place">
        <option>---select---</option>
        
       
      </select></td>
    </tr>
    <tr>
      <td>Name</td>
      <td><label for="txt_name"></label>
      <input type="text" name="txt_name" id="txt_name" /></td>
    </tr>
   
      <td>Contact</td>
      <td><label for="txt_contact"></label>
      <input type="text" name="txt_contact" id="txt_contact" /></td>
    </tr>
    <tr>
      <td>Address</td>
      <td><label for="txt_address"></label>
      <textarea name="txt_address" id="txt_address" cols="45" rows="5"></textarea></td>
    </tr>
    <tr>
      <td>Email</td>
      <td><label for="txt_email"></label>
      <input type="text" name="txt_email" id="txt_email" /></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label for="txt_password"></label>
      <input type="text" name="txt_password" id="txt_password" /></td>
    </tr>
    <tr>
      <td>Confirm Password</td>
      <td><label for="txt_confirmpassword"></label>
      <input type="text" name="txt_confirmpassword" id="txt_confirmpassword" /></td>
    </tr>
    <tr>
      <td>Photo</td>
      <td><label for="filephoto"></label>
      <input type="file" name="filephoto" id="filephoto" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      <input type="submit" name="btn_cancel" id="btn_cancel" value="Cancel" /></td>
    </tr>
  </table>
</form>
</body>
</html>

 <script src="../Assets/JQ/jQuery.js"></script>
<script>
  function getPlace(did) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxPlace.php?did=" + did,
      success: function (result) {

        $("#sel_place").html(result);
      }
    });
  }

</script>
