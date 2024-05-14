<?php
    require '../../database/db.php';
    if (session_id() == '')
    session_start();

    $service_type = $_POST['service_type'];
    $service_name = $_POST['service_name'];
    $service_image = $_POST['service_image'];
    $service_description = $_POST['service_description'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];
    $insication = $_POST['insication'];
    $results = $_POST['results'];
    
    // Подготавливаем SQL-запрос для добавления мастера
    $query = "INSERT INTO `service` (`id_service_type`, `service_name`, `service_image`, `service_description`, `duration`, `price`, `insication`, `results`) 
            VALUES ('$service_type', '$service_name', '$service_image', '$service_description', '$duration', '$price', '$insication', '$results')";

    if (mysqli_query($link, $query)) {
        $serviceId = mysqli_insert_id($link); // Получаем ID нового мастера

        $service_types=mysqli_query($link, "SELECT `id_service_type`, `service_type_name` FROM `service_type`");
        $service_types=mysqli_fetch_all($service_types);

        $options="";
        foreach($service_types as $row){
            if($row[0]==$service_type){
                $option="<option value=".$row[0]." selected>".$row[1]."</option>";
            }else{
                $option="<option value=".$row[0].">".$row[1]."</option>";
            }
            $options.=$option;
        }
        $response = [
            'success' => true,
            'service' => [
                'id' => $serviceId,
                'options' => $options,
                'service_name' => $service_name,
                'service_image' => "$service_image",
                'service_description' => $service_description,
                'duration' => $duration,
                'price' => $price,
                'insication' => $insication,
                'results' => $results
            ]
        ];
        echo json_encode($response);
    } else {
        $response = ['success' => false];
        echo json_encode($response);
    }
    
?>