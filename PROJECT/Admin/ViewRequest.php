<?php


include("../Assets/Connection/Connection.php");


$query = "SELECT *
          FROM tbl_request r 
          INNER JOIN tbl_car c ON r.car_id = c.car_id 
          INNER JOIN tbl_modification m ON r.modification_id = m.modification_id 
          INNER JOIN tbl_modificationtype t ON m.type_id = t.type_id 
          INNER JOIN tbl_user u ON r.user_id = u.user_id";
$result = $con->query($query);
?>

<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Untitled Document</title>
</head>

<body>
  <form id="form1" name="form1" method="post" action="">
    < width="503" border="1">
      <tr>
        <td>Si.No</td>
        <td>User Name</td>
        <td>Contact</td>
        <td>
          <p>Modification Type</p>
        </td>
        <td>Modification</td>
        <td>Car</td>
        <td>Details</td>
        <td>File</td>
        <td>Action</td>
      </tr>
      <?php
      $i = 0;
      while ($row = $result->fetch_assoc()) {
        $i++;
        ?>
        <tr>
          <td><?php echo $i; ?></td>
          <td><?php echo $row['user_name'] ?></td>
          <td><?php echo $row['user_contact'] ?></td>
          <td><?php echo $row['type_name']; ?></td>
          <td><?php echo $row['modification_name']; ?></td>
          <td><?php echo $row['car_name']; ?></td>
          <td><?php echo $row['request_details']; ?></td>
          <td><a href="../Assets/Files/User/Photo/<?php echo $row['request_file']; ?>">View File</a></td>
          <td><?php
          if ($row['request_status'] == 0) {
            ?>
              <a href="ViewRequest.php?aid=<?php echo $row['request_id'] ?>&sts=1">Accept </a>
              <a href="ViewRequest.php?aid=<?php echo $row['request_id'] ?>&sts=2">Reject </a>
              <?php
          } else if ($row['request_status'] == 1) {
            echo ' Request Approved..';
            ?>
                <a href="Amount.php?aid=<?php echo $row['request_id'] ?>">Estimate Amount </a>

              <?php
          }
          else if ($row['request_status'] == 3) {
            echo "Payment Pending...";
          }
          else if ($row['request_status'] == 4) {
            echo "Payment Completed...";
          } else {
            echo "Rejected";
          }
          ?>
          </td>
        </tr>
        <?php
      }
      ?>
      </table>
  </form>
</body>

</html>