<?php
    require '../../database/db.php';
    if (session_id() == '')
        session_start();

    $id_master_to_delete = $_POST['id_master_to_delete'];
    $queryToDelete=mysqli_query($link, "DELETE FROM `master` WHERE `id_master`=$id_master_to_delete"); 

    

?>