<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Place Management</title>
</head>
<?php

include('../Assets/Connection/Connection.php');


if(isset($_POST['btn_save'])) {
    $place = $_POST['txt_place'];
    $district = $_POST['sel_panchayath'];

    $ins = "INSERT INTO tbl_place (place_name, district_id) VALUES ('" . $place . "','" . $district . "')";
    if ($con->query($ins)) {
        header("location:Place.php");
    }
}

if (isset($_GET['id'])) {
    $del = "DELETE FROM tbl_place WHERE place_id = '" . $_GET['id'] . "'";
    if ($con->query($del)) {
        header("location:Place.php");
    }
}
?>

<body>
<form method="post">
    <table border="1" align="center" cellpadding="10">
        <tr>
            <td>District</td>
            <td>
                <select name="sel_district" id="sel_district" required >
                    <option value="">-----Select-----</option>
                    <?php
                    $sel = "SELECT * FROM tbl_district";
                    $row = $con->query($sel);
                    while ($data = $row->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $data['district_id']; ?>"><?php echo $data['district_name']; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </td>
        </tr>
        
        <tr>
            <td>Place</td>
            <td>
                <input type="text" name="txt_place" id="txt_place" required />
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" name="btn_save" value="Save" />
            </td>
        </tr>
    </table>
</form>

<table border="1" align="center" cellpadding="10">
    <thead>
        <tr>
            <th>Sl.No</th>
            <th>District</th>
            
            <th>Place</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 0;
        $sel = "SELECT * FROM tbl_place p 
                
                INNER JOIN tbl_district d ON p.district_id = d.district_id";
        $row = $con->query($sel);
        while ($data = $row->fetch_assoc()) {
            $i++;
            ?>
            <tr>
                <td align="center"><?php echo $i; ?></td>
                <td align="center"><?php echo $data['district_name']; ?></td>
                
                <td align="center"><?php echo $data['place_name']; ?></td>
                <td align="center">
                    <a href="place.php?id=<?php echo $data['place_id']; ?>">Delete</a>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>



</body>
</html>
