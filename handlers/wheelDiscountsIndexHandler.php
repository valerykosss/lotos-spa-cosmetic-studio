<?php
if (session_id() == '')
    session_start();
require_once '../database/db.php';

// Запрос к базе данных
$sql = "SELECT * FROM wheel_discount";
$result = $link->query($sql);

$prizes = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $prize = [
            'id' => $row['id_wheel_discount'],
            'text' => $row['discount_name'],
            'color' => $row['sector_wheel_color'],
        ];
        $prizes[] = $prize;
    }
}

// Возвращаем данные в формате JSON
echo json_encode($prizes);

?>
