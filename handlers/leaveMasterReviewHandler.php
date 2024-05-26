<?php
if (session_id() == '')
    session_start();
require_once '../database/db.php';

if ($link->connect_error) {
    die('Ошибка подключения: ' . $link->connect_error);
}

 // Получение данных от AJAX запроса
 $review = $_POST['review'];
 $userId = $_SESSION['UserID'];
 $rating = $_POST['rating'];
 $currentDate = $_POST['currentDate'];
 $idMaster = $_POST['id'];
 $status = "На рассмотрении";


 // Запись данных в базу данных
 $sql = "INSERT INTO master_rating (id_master, id_user, master_rating, master_review, review_date, status) VALUES ('$idMaster', '$userId', '$rating', '$review', '$currentDate', '$status')";

 if ($link->query($sql) === TRUE) {
     echo "Отзыв успешно добавлен!";
 } else {
     echo "Ошибка: " . $sql . "<br>" . $link->error;
 }

 // Закрытие соединения с базой данных
 $link->close();
?>
