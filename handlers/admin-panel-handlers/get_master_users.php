<?php
session_start();
require_once "../../database/db.php";

$query = "SELECT `user`.`id_user`, `user`.`name` FROM user LEFT JOIN master ON `user`.`id_user` = `master`.`id_user` WHERE `master`.`id_user` IS NULL AND `user`.`id_role` = 3";
$result = mysqli_query($link, $query);

if (!$result) {
    die('Query error: ' . mysqli_error($link));
}

$users = array();
while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

echo json_encode($users);
mysqli_close($link);
?>
