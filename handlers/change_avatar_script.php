<?php
session_start();
require_once "../database/db.php";
$userId=$_SESSION['UserID'];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['image'])) {
    $imageData = $_POST['image'];

    $change_avatar=mysqli_query($link, "UPDATE `user` SET `avatar`='$imageData' WHERE `id_user`=$userId");
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
