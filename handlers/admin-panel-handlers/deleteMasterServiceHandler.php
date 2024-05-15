<?php
    require '../../database/db.php';
    if (session_id() == '')
        session_start();

    $id_ms_to_delete = $_POST['id_ms_to_delete'];
    $queryToDelete=mysqli_query($link, "DELETE FROM `master_service` WHERE `id_master_service` = $id_ms_to_delete"); 

?>