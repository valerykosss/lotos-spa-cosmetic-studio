<?php
    // session_start();

    require_once "handlers/isAdmin.php";

    if ($isClient==true){
        header('Location: partials/index.php');
    } else if ($isAdmin == true){
        header('Location: partials/admin-panel.php');
    } else if ($isMaster == true){
        header('Location: partials/master-panel.php');
    } 
    else if ($isMaster == false && $isAdmin == false && $isClient == false) {
        header('Location: partials/index.php');
    }
    
?>