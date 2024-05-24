<?php

//insert.php

$connect = new PDO('mysql:host=localhost;dbname=lotos', 'root', 'root');

$start = $_POST['start'];
$end = $_POST['end'];
$newFormatStart;
$newFormatEnd;

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


 $query = "
 INSERT INTO master_timetable 
 (id_master, start, end) 
 VALUES (:id_master, :start, :end)
 ";
 $statement = $connect->prepare($query);
 $statement->execute(
  array(
   ':id_master'  => $_POST['id_master'],
   ':start' => $newFormatStart,
   ':end' => $newFormatEnd,
  )
 );


?>
