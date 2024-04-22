<?php
if (session_id() == '')
    session_start();
require_once '../database/db.php';

// Получение данных из POST-запроса
$selectedId = $_POST['selectedId'];

    // Проверка наличия пользователя в сессии или создание нового пользователя
    if (isset($_SESSION['UserID'])) {
        $userId = $_SESSION['UserID'];
    } 
    else{
        echo json_encode(['success' => false]);
        die();
    }

    // Сохранение selectedId в базе данных
    $sql = mysqli_query($link, "UPDATE user SET id_wheel_discount = $selectedId  WHERE id_user = $userId ");


?>
