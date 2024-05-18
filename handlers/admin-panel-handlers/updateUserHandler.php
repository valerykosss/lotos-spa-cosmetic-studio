<?php
    require '../../database/db.php';
    if (session_id() == '')
    session_start();

// Получаем данные из POST-запроса
$userId = $_POST['userId'];
$user_name = $_POST['user_name'];
$user_email = $_POST['user_email'];
$user_phone = $_POST['user_phone'];
$user_role = $_POST['user_role'];

// Подготавливаем SQL-запрос для обновления мастера
$query = "UPDATE `user` SET 
            `name` = '$user_name', `email`='$user_email', `telephone`='$user_phone', `id_role`='$user_role' 
          WHERE `id_user` = $userId";

if (mysqli_query($link, $query)) {
    $response = [
        'success' => true,
        'message' => 'Пользователь успешно обновлен'
    ];
    echo json_encode($response);
} else {
    $response = [
        'success' => false,
        'message' => 'Ошибка при обновлении пользователя: ' . mysqli_error($link)
    ];
    echo json_encode($response);
}

?>
