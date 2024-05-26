<?php
session_start();
require_once "../../database/db.php";


$data = array();
$id_user = $_SESSION['UserID'];

// Подготовка SQL-запроса
$query = "
    SELECT 
        pr.id_record, 
        pr.id_master_service,
        pr.record_date,
        pr.record_time,
        m.master_name, 
        s.service_name, 
        s.price, 
        s.duration
    FROM 
        procedure_record pr
    JOIN 
        master_service ms ON pr.id_master_service = ms.id_master_service
    JOIN 
        master m ON ms.id_master = m.id_master
    JOIN 
        service s ON ms.id_service = s.id_service
    WHERE 
        pr.id_user = ?
        AND (
            pr.record_date > CURDATE()
            OR (pr.record_date = CURDATE() AND pr.record_time > CURTIME())
        )
        AND pr.id_record_status = 1
";

// Подготовка и выполнение запроса
$stmt = $link->prepare($query);
$stmt->bind_param('i', $id_user);
$stmt->execute();
$result = $stmt->get_result();

// Обработка результатов
while ($row = $result->fetch_assoc()) {
    $minutesToAdd = $row['duration'];
    $dateTime = new DateTime($row['record_time']);

    // Добавляем минуты, используя переменную
    $dateInterval = new DateInterval('PT' . $minutesToAdd . 'M');
    $dateTime->add($dateInterval);

    // Получаем новое время в формате H:i:00
    $end = $dateTime->format('H:i:00');
    $end = $row['record_date'] . ' ' . $end;
    $start = $row['record_date'] . ' ' . $row['record_time'];

    $data[] = array(
        'id_record'   => $row["id_record"],
        'master_name' => $row["master_name"],
        'service_name' => $row["service_name"],
        'price'       => $row["price"],
        'duration'    => $row["duration"],
        'start'       => $start,
        'end'         => $end,
    );
}

// Закрываем соединение
$stmt->close();
$link->close();

// Возвращаем данные в формате JSON
echo json_encode($data);

?>
