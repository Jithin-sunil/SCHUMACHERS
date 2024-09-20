<?php
include('../Assets/Connection/Connection.php');
session_start();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  < width="538" border="1">
    <tr>
      <td>Si.No</td>
      <td>Date</td>
      <td>Content</td>
      <td>File</td>
      <td>Reply</td>
      <td>Action</td>
    </tr>
    <?php
  $sel=" select * from tbl_complaint where user_id=".$_SESSION['uid'];
  $result=$con->query($sel);
  $i=0;
  while($row=$result->fetch_assoc()){
      $i++;
    ?>
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $row['complaint_date']?></td>
      <td><?php echo $row['complaint_content']?></td>
      <td><a href="../Assets/Files/User/<?php echo $row['complaint_file']?>">ViewFile</a></td>
      <td><?php
      if( $row['complaint_status'] ==0)
      {
        echo "Not Replyed";
      }
      else
      {
        echo $row['complaint_reply'];
      }
      ?></td>
      <td><a href="MyComplaints.php?id=<?php echo $row['complaint_id']?>">Delete</a></td>
    </tr>
    <?php
  }
  ?>
  </table>
</form>
</body>
</html>