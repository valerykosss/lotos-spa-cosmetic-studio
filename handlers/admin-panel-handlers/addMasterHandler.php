<?php
    require '../../database/db.php';
    if (session_id() == '')
    session_start();

    $master_name = $_POST['master_name'];
    $master_surname = $_POST['master_surname'];
    $master_photo = $_POST['master_photo'];
    $education = $_POST['education'];
    $work_experience = $_POST['work_experience'];
    $position = $_POST['position'];
    
    // Подготавливаем SQL-запрос для добавления мастера
    $query = "INSERT INTO `master` (`master_name`, `master_surname`, `master_photo`, `education`, `work_experience`, `position`) 
            VALUES ('$master_name', '$master_surname', '$master_photo', '$education', '$work_experience', '$position')";

    if (mysqli_query($link, $query)) {
        $masterId = mysqli_insert_id($link); // Получаем ID нового мастера
        $response = [
            'success' => true,
            'master' => [
                'id' => $masterId,
                'master_name' => $master_name,
                'master_surname' => $master_surname,
                'master_photo' => "$master_photo",
                'education' => $education,
                'work_experience' => $work_experience,
                'position' => $position
            ]
        ];
        echo json_encode($response);
    } else {
        $response = ['success' => false];
        echo json_encode($response);
    }
    
?>