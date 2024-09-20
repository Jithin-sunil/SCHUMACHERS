<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Modification Management</title>
</head>

<?php
include('../Assets/Connection/Connection.php');


if (isset($_POST['btn_submit'])) {
    $type_id = $_POST['list_Select'];  
    $modification = $_POST['txt_modification']; 

    
    $ins = "INSERT INTO tbl_modification (modification_name, type_id) VALUES ('" . $modification . "', '" . $type_id . "')";
    if ($con->query($ins)) {
        header("location:modification.php");
    }
}


if (isset($_GET['id'])) {
    $del = "DELETE FROM tbl_modification WHERE modification_id = '" . $_GET['id'] . "'";
    if ($con->query($del)) {
        header("location:modification.php");
    }
}
?>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="323" border="1" align="center" cellpadding="10">
    <tr>
      <td>Type</td>
      <td>
        <select name="list_Select" id="list_Select" required>
            <option value="">-----Select-----</option>
            <?php
 
            $sel = "SELECT * FROM tbl_modificationtype";
            $row = $con->query($sel);
            while ($data = $row->fetch_assoc()) {
            ?>
                <option value="<?php echo $data['type_id']; ?>"><?php echo $data['type_name']; ?></option>
            <?php
            }
            ?>
        </select>
      </td>
    </tr>
    <tr>
      <td>Modification</td>
      <td><input type="text" name="txt_modification" id="txt_modification" required /></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
        <input type="submit" name="btn_submit" id="btn_submit" value="Submit" />
      </td>
    </tr>
  </table>
</form>

<table width="500" border="1" align="center" cellpadding="10">
  <thead>
    <tr>
      <th>Si.No</th>
      <th>Type</th>
      <th>Modification</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i = 0;
  
    $sel = "SELECT * FROM tbl_modification m 
            INNER JOIN tbl_modificationtype t ON m.type_id = t.type_id";
    $row = $con->query($sel);
    while ($data = $row->fetch_assoc()) {
        $i++;
    ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $data['type_name']; ?></td>
      <td><?php echo $data['modification_name']; ?></td>
      <td align="center">
        <a href="modification.php?id=<?php echo $data['modification_id']; ?>">Delete</a>
      </td>
    </tr>
    <?php
    }
    ?>
  </tbody>
</table>

</body>
</html>
