<?php
    require '../../database/db.php';
    if (session_id() == '')
    session_start();

    $service_id = $_POST['service_id'];
    $master_id = $_POST['master_id'];

    $service=mysqli_query($link, "SELECT `service_name` FROM `service` WHERE `id_service`=$service_id");
    $service=mysqli_fetch_assoc($service);
    $master=mysqli_query($link, "SELECT `master_name` FROM `master` WHERE `id_master`=$master_id");
    $master=mysqli_fetch_assoc($master);

    // Подготавливаем SQL-запрос для добавления мастера
    $query = "INSERT INTO `master_service` (`id_master`, `id_service`) 
            VALUES ('$master_id', '$service_id')";
    

    if (mysqli_query($link, $query)) {
        $masterServiceId = mysqli_insert_id($link); // Получаем ID нового мастера

        $response = [
            'success' => true,
            'master_service' => [
                'id' => $masterServiceId,
                'service_name' => $service['service_name'],
                'master_name' => $master['master_name'],
            ]
        ];
        echo json_encode($response);
    } else {
        $response = ['success' => false];
        echo json_encode($response);
    }
    
?>