<?php
    require_once '../../database/db.php';

    if (session_id() == '')
    session_start();

    $services=mysqli_query($link, "SELECT `id_service`, `service_name` FROM `service`");
    $services=mysqli_fetch_all($services);

    $discount_name = $_POST['discount_name'];
    $sector_wheel_color = $_POST['sector_wheel_color'];
    $id_service = $_POST['id_service'];

    // Подготавливаем SQL-запрос для добавления мастера
    $query = "INSERT INTO `wheel_discount` (`discount_name`, `sector_wheel_color`, `id_service`) 
            VALUES ('$discount_name', '$sector_wheel_color', '$id_service')";

    if (mysqli_query($link, $query)) {
        $sectorId = mysqli_insert_id($link); // Получаем ID нового мастера

        $options="";

        foreach($services as $service){
            if($service[0]==$id_service){
                $option="<option value=".$service[0]." selected>".$service[1]."</option>";
            }else{
                $option="<option value=".$service[0].">".$service[1]."</option>";
            }
            $options.=$option;
        }
        $response = [
            'success' => true,
            'wheel_discount' => [
                'id' => $sectorId,
                'discount_name' => $discount_name,
                'sector_wheel_color' => $sector_wheel_color,
                'options' => $options,
            ]
        ];
        echo json_encode($response);
    } else {
        $response = ['success' => false];
        echo json_encode($response);
    }
    
?>