<?php
    require_once "../database/db.php";

    $services_data=mysqli_query($link, "SELECT service_type.service_type_name, service_name, service_description, duration, price
    FROM service
    INNER JOIN service_type ON service.id_service_type=service_type.id_service_type");
    $services_data=mysqli_fetch_all($services_data);

    $services_arr=array();
    foreach ($services_data as $row) {
        $service_type = $row[0];
        $service_name = $row[1];
        $service_description=$row[2];
        $service_price=$row[4];
        $service_duration=$row[3];

        // Если тип услуги уже присутствует в массиве, добавляем услугу к существующему типу
        if (array_key_exists($service_type, $services_arr)) {
            $services_arr[$service_type][] = array('name' => $service_name, 'description' => $service_description, 'price' => $service_price, 'duration' => $service_duration);
        } else {
            // Если тип услуги новый, создаем новый элемент массива
            $services_arr[$service_type] = array(array('name' => $service_name, 'description' => $service_description, 'price' => $service_price, 'duration' => $service_duration));
        }
    }
?>