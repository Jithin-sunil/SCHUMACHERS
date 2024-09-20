
<?php
include('../Assets/Connection/Connection.php');
session_start();

if(isset($_POST['']))
{
  $content = $_POST['txt_content'];
  $file = $_FILES['filebrowse']['name'];
  $temp_name = $_FILES['filebrowse']['tmp_name'];
  move_uploaded_file($file,'../Assets/Files/User/'.$temp_name);
  $ins = "INSERT INTO tbl_complaint (complaint_content, user_id, complaint_file,complaint_date) VALUES ('".$content."','".$_SESSION['uid']."','".$file."',curdate())";
  if($con->query($ins)){
    ?>
    <script>alert('Complaint submitted successfully!');</script>
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
      <td>Content</td>
      <td><label for="txt_content"></label>
      <textarea name="txt_content" id="txt_content" cols="45" rows="5"></textarea></td>
    </tr>
    <tr>
      <td>File</td>
      <td><label for="filebrowse"></label>
      <input type="file" name="filebrowse" id="filebrowse" /></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      </div></td>
    </tr>
  </table>
</form>
</body>
</html>
