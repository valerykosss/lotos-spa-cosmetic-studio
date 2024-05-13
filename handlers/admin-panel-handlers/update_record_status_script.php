<?php
    require_once "../../database/db.php";

    $recordId = $_POST['record_id'];
    $newStatus = $_POST['new_status'];

    $update_status=mysqli_query($link,"UPDATE `procedure_record` SET `id_record_status`='$newStatus' WHERE `id_record`=$recordId");
?>