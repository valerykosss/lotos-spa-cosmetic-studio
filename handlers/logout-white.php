<?php
//Запускаем сессию
if (session_id() == '')
    session_start();
unset($_SESSION['Name']);
session_unset();
echo true;
?>