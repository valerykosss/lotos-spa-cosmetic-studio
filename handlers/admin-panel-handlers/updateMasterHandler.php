<?php
    require '../../database/db.php';
    if (session_id() == '')
    session_start();

// Получаем данные из POST-запроса
$masterId = $_POST['masterId'];
$master_name = $_POST['master_name'];
$master_surname = $_POST['master_surname'];
$master_photo = $_POST['master_photo'];
$education = $_POST['education'];
$work_experience = $_POST['work_experience'];
$position = $_POST['position'];

// Подготавливаем SQL-запрос для обновления мастера
$query = "UPDATE `master` SET 
            `master_name` = '$master_name', 
            `master_surname` = '$master_surname', 
            `master_photo` = '$master_photo', 
            `education` = '$education', 
            `work_experience` = '$work_experience', 
            `position` = '$position' 
          WHERE `id_master` = $masterId";

if (mysqli_query($link, $query)) {
    $response = [
        'success' => true,
        'message' => 'Мастер успешно обновлен'
    ];
    echo json_encode($response);
} else {
    $response = [
        'success' => false,
        'message' => 'Ошибка при обновлении мастера: ' . mysqli_error($link)
    ];
    echo json_encode($response);
}

?>
