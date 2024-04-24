<?php
require_once "../database/db.php";
    // Получение данных из POST-запроса
    $id = $_POST['id'];
    $value = $_POST['value'];
    $field = $_POST['field'];

    // Экранирование данных
    $id = mysqli_real_escape_string($link, $id);
    $value = mysqli_real_escape_string($link, $value);
    $field = mysqli_real_escape_string($link, $field);

    // Запрос на обновление данных в базе
    $query = mysqli_query($link, "UPDATE procedure_record SET $field = '$value' WHERE id_record = $id");
?>