<?php
    session_start();

    $isAdmin = false;
    $isClient = false;
    $isMaster = false;

    if(isset($_SESSION["UserID"])){
        if ($_SESSION["RoleID"] == 1) {
            $isAdmin = true;
        } else if ($_SESSION["RoleID"] == 2) {
            $isClient = true;
        } else if ($_SESSION["RoleID"] == 3) {
            $isMaster = true;
        }
    }
?>