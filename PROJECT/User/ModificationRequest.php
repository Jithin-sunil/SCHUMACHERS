<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Request Submission</title>
</head>

<?php
include('../Assets/Connection/Connection.php');
session_start();
if (isset($_POST['btn_submit'])) {

  $modification_id = $_POST['sel_modification'];
  $car_id = $_POST['car'];
  $request_details = $_POST['request_details'];


  $file_name = $_FILES['request_file']['name'];
  $file_tmp = $_FILES['request_file']['tmp_name'];
  move_uploaded_file($file_tmp, '../Assets/Files/User/Photo/' . $file_name);


  $ins = "INSERT INTO tbl_request ( modification_id, car_id, request_details, request_file,request_date,user_id) 
                VALUES ( '$modification_id', '$car_id', '$request_details', '$file_name',curdate(),'" . $_SESSION['uid'] . "')";

  if ($con->query($ins)) {
    echo "<script>alert('Request submitted successfully!');</script>";
  } else {
    echo "<script>alert('Error in request submission');</script>";
  }


}

?>

<body>
  <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
    <table width="348" border="1">
      <tr>
        <td width="136">Modification Type</td>
        <td width="48">
          <select name="modification_type" id="modification_type" onchange="getmodification(this.value)" required>
            <option value="">---Select Modification---</option>
            <?php

            $sel_mod = "SELECT * FROM tbl_modificationtype";
            $mod_res = $con->query($sel_mod);
            while ($mod_data = $mod_res->fetch_assoc()) {
              echo "<option value='" . $mod_data['type_id'] . "'>" . $mod_data['type_name'] . "</option>";
            }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Modification</td>
        <td><select name="sel_modification" id="sel_modification">

            <option value="">--Select--</option>
          </select></td>
      </tr>
      <tr>
        <td>Car</td>
        <td>
          <select name="car" id="car" required>
            <option value="">---Select Car---</option>
            <?php

            $sel_car = "SELECT * FROM tbl_car";
            $car_res = $con->query($sel_car);
            while ($car_data = $car_res->fetch_assoc()) {
              echo "<option value='" . $car_data['car_id'] . "'>" . $car_data['car_name'] . "</option>";
            }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td>Car Details</td>
        <td>
          <textarea name="request_details" id="request_details" cols="45" rows="5" required></textarea>
        </td>
      </tr>
      <tr>
        <td>File</td>
        <td>
          <input type="file" name="request_file" id="request_file" required />
        </td>
      </tr>
      <tr>
        <td colspan="2">
          <div align="center">
            <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
          </div>
        </td>
      </tr>
    </table>
  </form>
</body>

</html>
<script src="../Assets/JQ/jQuery.js"></script>
<script>
  function getmodification(did) {
    $.ajax({
      url: "../Assets/AjaxPages/AjaxModification.php?did=" + did,
      success: function (result) {

        $("#sel_modification").html(result);
      }
    });
  }

</script>