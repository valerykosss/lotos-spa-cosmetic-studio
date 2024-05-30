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
 $idService = $_POST['id'];

 $recordId = $_POST['recordId'];

 $status = "На рассмотрении";


 // Запись данных в базу данных
 $sql = "INSERT INTO service_rating (id_service, id_user, service_rating, service_review, review_date, status) VALUES ('$idService', '$userId', '$rating', '$review', '$currentDate', '$status')";

 if ($link->query($sql) === TRUE) {
     echo "Отзыв успешно добавлен!";
 } else {
     echo "Ошибка: " . $sql . "<br>" . $link->error;
 }

 $id_service_rating=mysqli_insert_id($link);

  // Запись данных в базу данных
  $sql2 = "UPDATE procedure_record set id_service_rating =  $id_service_rating where id_record =  $recordId";

if ($link->query($sql2) === TRUE) {
    echo "Запись обновлена отзывом на услугу!";
} else {
    echo "Ошибка: " . $sql2 . "<br>" . $link->error;
}



 // Закрытие соединения с базой данных
 $link->close();
?>
