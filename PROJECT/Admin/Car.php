<?php
include('../Assets/connection/connection.php');
$carname = "";
$carid = "";

if (isset($_POST["btn_submit"])) {
    $carid = $_POST['txt_id'];
    $carname = $_POST["txt_car"];

    if ($carid == "") {
        // Insert a new car name into tbl_car
        $insqry = "INSERT INTO tbl_car(car_name) VALUES ('" . $carname . "')";
        if ($con->query($insqry)) {
            ?>
            <script>
            alert('Car name inserted');
            window.location = "Car.php";
            </script>
            <?php
        }
    } else {
        // Update an existing car name in tbl_car
        $updqry = "UPDATE tbl_car SET car_name='" . $carname . "' WHERE car_id=" . $carid;
        if ($con->query($updqry)) {
            ?>
            <script>
            alert('Car name updated');
            window.location = "Car.php";
            </script>
            <?php
        }
    }
}

if (isset($_GET["delID"])) {
    // Delete a car by ID
    $delQry = "DELETE FROM tbl_car WHERE car_id='" . $_GET["delID"] . "'";
    if ($con->query($delQry)) {
        ?>
        <script>
        alert('Car deleted');
        window.location = "Car.php";
        </script>
        <?php
    }
}

if (isset($_GET['eid'])) {
    // Edit a car's name
    $selEdit = "SELECT * FROM tbl_car WHERE car_id=" . $_GET['eid'];
    $resEdit = $con->query($selEdit);
    $dataEdit = $resEdit->fetch_assoc();
    $carname = $dataEdit['car_name'];
    $carid = $dataEdit['car_id'];
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Car Management</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
<table width="200" border="1">
  <tr>
    <td align="center"><p>Car Name </p></td>
    <td>
      <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $carid ?>"/>
      <input type="text" name="txt_car" id="txt_car" value="<?php echo $carname ?>"/>
    </td>
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
    <td>Car</td>
    <td>Action</td>
  </tr>
  <?php
  $i = 0;
  $sel = "SELECT * FROM tbl_car";
  $row = $con->query($sel);
  while ($data = $row->fetch_assoc()) {
      $i++;
      ?>
      <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $data['car_name'] ?></td>
        <td>
          <a href="Car.php?delID=<?php echo $data['car_id'] ?>">Delete</a> ||
          <a href="Car.php?eid=<?php echo $data['car_id'] ?>">Edit</a>
        </td>
      </tr>
      <?php
  }
  ?>
</table>
</form>
<p>&nbsp;</p>
</body>
</html>
