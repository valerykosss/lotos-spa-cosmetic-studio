<?php
require_once "../../database/db.php";

$id=$_POST['id'];
$discount_name=$_POST['discount_name'];
$color=$_POST['color'];
$service=$_POST['wheel_service'];

$update_wheel=mysqli_query($link, "UPDATE wheel_discount SET discount_name='$discount_name', sector_wheel_color='$color', id_service='$service' WHERE id_wheel_discount=$id");
?>