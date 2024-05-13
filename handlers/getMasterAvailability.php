<?php
require_once '../database/db.php';

// // Получение данных из GET-запроса
// $id_master = $_GET['id_master'];
// $endOfYear = date('Y-12-31'); // Конец текущего года

// try {
//     $availabilities = [];

//     // Цикл по всем месяцам до конца года
//     for ($month = 1; $month <= 12; $month++) {
//         $startOfMonth = date('Y-m-d', strtotime("first day of $month"));
//         $endOfMonth = date('Y-m-t', strtotime("last day of $month"));

//         // Запрос к базе данных для получения доступности мастера
//         $sql = "SELECT start, end FROM master_timetable 
//                 WHERE id_master = ? AND start >= ? AND end <= ?";
        
//         $stmt = $link->prepare($sql);
//         $stmt->bind_param("iss", $id_master, $startOfMonth, $endOfMonth);
//         $stmt->execute();
//         $result = $stmt->get_result();

//         while ($row = $result->fetch_assoc()) {
//             $availabilities[] = [
//                 'start' => $row['start'],
//                 'end' => $row['end']
//             ];
//         }
        
//         $stmt->close();
//     }

//     // Отправка данных в формате JSON
//     header('Content-Type: application/json');
//     echo json_encode($availabilities);

//     // Закрытие соединения
//     $link->close();

// } catch (Exception $e) {
//     // Обработка ошибок
//     http_response_code(500);
//     echo json_encode(['error' => 'Ошибка при загрузке доступности мастера']);
// }
?>
