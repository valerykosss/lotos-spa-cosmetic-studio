<?php
    require '../../database/db.php';
    if (session_id() == '')
        session_start();

    $id_service_type_to_delete = $_POST['id_service_type_to_delete'];
    $queryToDelete=mysqli_query($link, "DELETE FROM `service_type` WHERE `id_service_type` = $id_service_type_to_delete"); 

?>