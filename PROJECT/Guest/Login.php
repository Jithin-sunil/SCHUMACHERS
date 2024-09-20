<?php
session_start();
include('../Assets/connection/connection.php');
 if(isset($_POST['btn_login']))
 {
	 $Email=$_POST['txt_email'];
	 $Password=$_POST['txt_password'];
	 
	 $User="select * from tbl_user where user_email='".$Email."' and user_password='".$Password."'";
	 $rowuser=$con->query($User);
	 
	 
	 
	 $Admin="select * from tbl_admin where admin_email='".$Email."' and admin_password='".$Password."'";
	 $rowadmin=$con->query($Admin);
	 
	 if($datauser=$rowuser->fetch_assoc())
	 {
		 $_SESSION['uid']=$datauser['user_id'];
		 $_SESSION['uname']=$datauser['user_name'];
		 header('location:../User/Homepage.php');
	 }
	 
	 else if($dataadmin=$rowadmin->fetch_assoc())
	 {
		 $_SESSION['aid']=$dataadmin['admin_id'];
		 $_SESSION['aname']=$dataadmin['admin_name'];
		 header('location:../Admin/Homepage.php');
	 }
	 else
	 {
		 ?>
         <script>
         alert('incorrect data');
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
<form id="form1" name="form1" method="post" action="">
  <table width="200" border="1">
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
      <td colspan="2" align="center"><p>
        <input type="submit" name="btn_login" id="btn_login" value="Login" />
      </p>
      <p><a href="Newuser.php">NEWUSER</a> </p></td>
    </tr>
  </table>
</form>
</body>
</html>