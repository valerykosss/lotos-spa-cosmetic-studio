<?php
    require_once "../../database/db.php";

    $feedbackId = $_POST['feedback_id'];
    $newStatus = $_POST['new_status'];

    $update_status=mysqli_query($link,"UPDATE `master_rating` SET `status`='$newStatus' WHERE `id_master_rating`=$feedbackId");
?>