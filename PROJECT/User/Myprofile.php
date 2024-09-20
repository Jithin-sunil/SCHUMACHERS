
<?php 
session_start();
include('../Assets/connection/connection.php');
$user="select * from tbl_user n inner join tbl_place p on n.place_id =p.place_id inner join tbl_district d on d.district_id=p.district_id where n.user_id='".$_SESSION['uid']."'";

$rows=$con->query($user);
$data=$rows->fetch_assoc();

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
      <td colspan="2"><div align="center"><img src="../Assets/Files/User/Photo/<?php echo $data['user_photo']?>" width="150" /></div></td>
    </tr>
    <tr>
      <td align="center">Name</td>
      <td><?php echo $data['user_name']?></td>
    </tr>
    <tr>
      <td align="center">Email</td>
      <td><?php echo $data['user_email']?></td>
    </tr>
    <tr>
      <td align="center">Contact</td>
      <td><?php echo $data ['user_contact']?></td>
    </tr>
    <tr>
      <td align="center">Address</td>
      <td><?php echo $data['user_address']?></td>
    </tr>
    <tr>
      <td align="center">District</td>
      <td><?php echo $data['district_name']?></td>
    </tr>
    <tr>
      <td align="center">Place</td>
      <td><?php echo $data['place_name']?></td>
    </tr>
    <tr>
     
     
    <tr>
      <td colspan="2" align="center"><a href="EditProfile.php">EditProfile</a>||<a href="Changepassword.php">ChangePassword</a> </td></tr>
  </table>
</form>
</body>
</html>