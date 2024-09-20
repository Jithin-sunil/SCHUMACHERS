<?php

session_start();
include("../Assets/Connection/Connection.php");


$query = "SELECT *
          FROM tbl_request r 
          INNER JOIN tbl_car c ON r.car_id = c.car_id 
          INNER JOIN tbl_modification m ON r.modification_id = m.modification_id 
          INNER JOIN tbl_modificationtype t ON m.type_id = t.type_id
          WHERE r.user_id =" . $_SESSION['uid'];
$result = $con->query($query);

if(isset(($_GET['aid'])))
{
  $updqry="update tbl_request set request_status='".$_GET['sts']."' where request_id='".$_GET['aid']."'";
  if($con->query($updqry))
  {
    ?>
    <script>
      alert('Request status updated');
      window.location="Request.php";
    </script>
    <?php
  }

}
?>

<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Modification Requests</title>
</head>

<body>
  <form id="form1" name="form1" method="post" action="">
    <table width="558" border="1">
      <tr>
        <th>Si.No</th>
        <th>Modification Type</th>
        <th>Modification</th>
        <th>Car</th>
        <th>Details</th>
        <th>File</th>
        <th>Action</th>
      </tr>

      <?php
      $i = 0;
      while ($row = $result->fetch_assoc()) {
        $i++
          ?>
        <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $row['type_name']; ?></td>
          <td><?php echo $row['modification_name']; ?></td>
          <td><?php echo $row['car_name']; ?></td>
          <td><?php echo $row['request_details']; ?></td>
          <td><a href="../Assets/Files/User/Photo/<?php echo $row['request_file']; ?>">File</a></td>
          <td><?php
          if ($row['request_status'] == 0) {
            echo 'You Request is Pending..';
          } else if ($row['request_status'] == 1) {
            echo 'You Request is Verified..';
          } else if ($row['request_status'] == 3) {
            echo 'You Estimate Amount' . $row['request_amount'];
            ?>
                  <a href="Payment.php?cid=<?php echo $row['request_id']?>">Payment</a>
              <?php
          } else if ($row['request_status'] == 4) {
            echo "Payment Completed...";
          } else {
            echo "Rejected";
          }
          ?>
          </td>
        </tr>
      <?php } ?>
    </table>
  </form>
</body>

</html>