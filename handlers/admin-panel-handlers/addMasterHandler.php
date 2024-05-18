<?php
require '../../database/db.php';
if (session_id() == '') session_start();

$master_name = $_POST['master_name'];
$master_surname = $_POST['master_surname'];
$master_photo = $_POST['master_photo'];
$education = $_POST['education'];
$work_experience = $_POST['work_experience'];
$position = $_POST['position'];
$user_master = $_POST['user_master'];

// Подготавливаем SQL-запрос для добавления мастера
$query = "INSERT INTO `master` (`master_name`, `master_surname`, `master_photo`, `education`, `work_experience`, `position`, `id_user`) 
          VALUES ('$master_name', '$master_surname', '$master_photo', '$education', '$work_experience', '$position', '$user_master')";

if (mysqli_query($link, $query)) {
    $masterId = mysqli_insert_id($link); // Получаем ID нового мастера

    // Запрос для получения имени пользователя
    $userQuery = "SELECT `name` FROM `user` WHERE `id_user` = '$user_master'";
    $userResult = mysqli_query($link, $userQuery);

    if ($userResult && mysqli_num_rows($userResult) > 0) {
        $userRow = mysqli_fetch_assoc($userResult);
        $user_name = $userRow['name'];

        $response = [
            'success' => true,
            'master' => [
                'id' => $masterId,
                'master_name' => $master_name,
                'master_surname' => $master_surname,
                'master_photo' => "$master_photo",
                'education' => $education,
                'work_experience' => $work_experience,
                'position' => $position,
                'user_master' => $user_master,
                'user_name' => $user_name // Добавляем имя пользователя в ответ
            ]
        ];
        echo json_encode($response);
    } else {
        $response = ['success' => false, 'message' => 'User not found'];
        echo json_encode($response);
    }
} else {
    $response = ['success' => false, 'message' => 'Insert failed'];
    echo json_encode($response);
}

mysqli_close($link);
?>
