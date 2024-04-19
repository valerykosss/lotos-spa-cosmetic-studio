<?php
    require '../../database/db.php';
    if (session_id() == '')
        session_start();

    $id_master_to_delete = $_POST['id_master_to_delete'];

    if(isset($id_master_to_delete)){

        $queryToDelete = "DELETE FROM master WHERE id_master = ".$id_master_to_delete;
    
    }

    echo $queryToDelete;
   
    require '../../partials/table-master-admin-panel.php';
      
?>