<?php
session_start();
require_once "../../database/db.php";

$get_users=mysqli_query($link, "SELECT `id_user`, `name`, `telephone` FROM `user` where `id_role`=2");

$users = [];

while ($row = mysqli_fetch_all($get_users)) {
    $users = $row;
}

echo json_encode($users);

?>