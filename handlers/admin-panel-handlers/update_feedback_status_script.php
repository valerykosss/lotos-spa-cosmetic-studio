<?php
    require_once "../../database/db.php";

    $feedbackId = $_POST['feedback_id'];
    $newStatus = $_POST['new_status'];

    $update_status=mysqli_query($link,"UPDATE `requested_feedback` SET `status`='$newStatus' WHERE `id_requested_feedback`=$feedbackId");
?>