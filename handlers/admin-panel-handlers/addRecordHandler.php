<?php
    require '../../database/db.php';
    if (session_id() == '')
    session_start();

    $service_name = $_POST['service_name'];
    $master_name = $_POST['master_name'];
    $client_name = $_POST['client_name'];
    $record_date = $_POST['record_date'];
    $record_time = $_POST['record_time'];

    $id_master_service=mysqli_query($link, "SELECT `id_master_service` FROM `master_service` WHERE `id_master`=$master_name AND `id_service`=$service_name");
    $id_master_service=mysqli_fetch_assoc($id_master_service);
    $id_master_service=$id_master_service['id_master_service'];
    
    $service=mysqli_query($link, "SELECT `service_name` FROM `service` WHERE `id_service`=$service_name");
    $service=mysqli_fetch_assoc($service);
    $master=mysqli_query($link, "SELECT `master_name` FROM `master` WHERE `id_master`=$master_name");
    $master=mysqli_fetch_assoc($master);
    $client=mysqli_query($link, "SELECT `name` FROM `user` WHERE `id_user`=$client_name");
    $client=mysqli_fetch_assoc($client);

    // Подготавливаем SQL-запрос для добавления мастера
    $query = "INSERT INTO `procedure_record` (`id_record`, `id_master_service`, `id_user`, `record_date`, `record_time`, `id_record_status`) 
            VALUES (NULL, '$id_master_service', '$client_name', '$record_date', '$record_time', '1')";

    if (mysqli_query($link, $query)) {


        $recordId = mysqli_insert_id($link); // Получаем ID нового мастера
        $response = [
            'success' => true,
            'record' => [
                'id' => $recordId,
                'service_name' => $service['service_name'],
                'master_name' => $master['master_name'],
                'client_name' => $client['name'],
                'record_date' => $record_date,
                'record_time' => $record_time
            ]
        ];
        echo json_encode($response);
    } else {
        $response = ['success' => false];
        echo json_encode($response);
    }
    
?>