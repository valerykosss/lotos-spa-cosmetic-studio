<?php
if (session_id() == '')
    session_start();
require_once '../database/db.php';
if ($link->connect_error) {
    die('Ошибка подключения: ' . $link->connect_error);
}

// Получение данных из POST-запроса
$id_master = $_POST['id_master'];
$id_service = $_POST['id_service'];
$startDate = $_POST['startDate'];
$endDate = $_POST['endDate'];
if(isset($_SESSION['UserID'])){
    $id_user = $_SESSION['UserID']; // Предполагается, что UserID уже установлен в сессии
}else{
    $new_user_name=$_POST['new_user_name'];
    $new_user_email=$_POST['new_user_email'];
    $new_user_tel=$_POST['new_user_tel'];
}

// Форматирование даты и времени
$record_date = date('Y-m-d', strtotime($startDate));
$record_time = date('H:i', strtotime($startDate));

// Поиск id_master_service по id_master и id_service
$query = "SELECT id_master_service FROM master_service WHERE id_master = ? AND id_service = ?";
$stmt = $link->prepare($query);
$stmt->bind_param('ii', $id_master, $id_service);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$id_master_service = $row['id_master_service'];

// Закрытие подготовленного запроса
$stmt->close();

if(isset($_SESSION['UserID']) &&  $id_user){
    $query = "INSERT INTO procedure_record (id_master_service, id_user, record_date, record_time, id_record_status) VALUES (?, ?, ?, ?, 1)";
    $stmt = $link->prepare($query);
    $stmt->bind_param('iiss', $id_master_service, $id_user, $record_date, $record_time);    
}else{
    $insert_user=mysqli_query($link, "INSERT INTO `user` (`name`, `email`, `telephone`, `password`, `id_role`, `id_wheel_discount`, `avatar`) VALUES ('$new_user_name', '$new_user_email', '$new_user_tel', NULL, 2, NULL, NULL)");

    $new_user_id=mysqli_insert_id($link);

    // Вставка данных в таблицу procedure_record
    $query = "INSERT INTO procedure_record (id_master_service, id_user, record_date, record_time, id_record_status) VALUES (?, ?, ?, ?, 1)";
    $stmt = $link->prepare($query);
    $stmt->bind_param('iiss', $id_master_service, $new_user_id, $record_date, $record_time);
}


if ($stmt->execute()) {
    $response = ['success' => true];
} else {
    $response = ['success' => false, 'error' => $stmt->error];
}

// Закрытие подготовленного запроса и соединения
$stmt->close();
$link->close();

// Возвращаем ответ в формате JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
