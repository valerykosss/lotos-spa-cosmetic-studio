<?php
require_once '../database/db.php';

if (isset($_SESSION['UserID'])) {
    $userId = $_SESSION['UserID'];

    $spins = mysqli_query($link, "SELECT `id_wheel_discount` FROM `user` WHERE `id_user`=$userId");
    $spins = mysqli_fetch_all($spins);
    if ($spins[0][0] != NULL) {
        $isSpinned = true;
    } else {
        $isSpinned = false;
    }
}
?>