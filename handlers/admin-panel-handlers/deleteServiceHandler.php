<?php
    require '../../database/db.php';
    if (session_id() == '')
        session_start();

    $id_service_to_delete = $_POST['id_service_to_delete'];
    $queryToDelete=mysqli_query($link, "DELETE FROM `service` WHERE `id_service` = $id_service_to_delete"); 

?>