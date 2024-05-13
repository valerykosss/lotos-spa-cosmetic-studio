<?php
    require '../../database/db.php';
    if (session_id() == '')
        session_start();

    $id_record_to_delete = $_POST['id_record_to_delete'];
    $queryToDelete=mysqli_query($link, "DELETE FROM `procedure_record` WHERE `id_record` = $id_record_to_delete"); 

?>