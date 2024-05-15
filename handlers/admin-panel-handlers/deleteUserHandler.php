<?php
    require '../../database/db.php';
    if (session_id() == '')
        session_start();

    $id_user_to_delete = $_POST['id_user_to_delete'];
    $queryToDelete=mysqli_query($link, "DELETE FROM `user` WHERE `id_user` = $id_user_to_delete"); 

?>