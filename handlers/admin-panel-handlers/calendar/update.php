<?php

//update.php

try {
    $connect = new PDO('mysql:host=localhost;dbname=lotos', 'root', 'root');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $start = $_POST['start'];
    $end = $_POST['end'];
    $newFormatStart;
    $newFormatEnd;
    
    if(isset($_POST["id"])) {

        if (!empty($start) && !empty($end)) {
            // Создаем объект DateTime из строки, указывая исходный формат
            $dateTimeStart = DateTime::createFromFormat('d-m-Y H:i', $start);
            $dateTimeEnd = DateTime::createFromFormat('d-m-Y H:i', $end);
        
            // Проверяем, успешно ли создан объект DateTime
            if ($dateTimeStart === false || $dateTimeEnd === false ) {
                // Обработка ошибки
                echo "Ошибка при разборе даты";
            } else {
                
                // Преобразуем дату и время в формат YYYY-MM-DD HH:mm
                $newFormatStart = $dateTimeStart->format('Y-m-d H:i');
                $newFormatEnd = $dateTimeEnd->format('Y-m-d H:i');
        
                echo $newFormatStart; // Вывод преобразованной даты
                echo $newFormatEnd; // Вывод преобразованной даты
            }
        } else {
            echo "Дата не передана";
        }

        $query = "UPDATE master_timetable 
                  SET id_master=:id_master, start=:start, end=:end 
                  WHERE id=:id";

        $statement = $connect->prepare($query);
        $result = $statement->execute(
            array(
                ':id_master'  => $_POST['id_master'],
                ':start'      => $newFormatStart,
                ':end'        => $newFormatEnd,
                ':id'         => $_POST['id']
            )
        );

        if($result) {
            echo json_encode(['status' => 'success', 'message' => 'Event updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update event']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Event ID is missing']);
    }
} catch(PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

echo $_POST['id_master'];
echo $_POST['start'];
echo $_POST['end'];
echo $_POST['id'];
// echo $_POST['id'];
?>
