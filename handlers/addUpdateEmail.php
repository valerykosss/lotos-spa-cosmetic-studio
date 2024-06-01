<?php
session_start();
require_once "../database/db.php";

$user_id = $_SESSION["UserID"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"])) {
        $email = $_POST["email"];

        // Защита от SQL-инъекций (рекомендуется использовать подготовленные запросы)
        $email = mysqli_real_escape_string($link, $email);

        // Получаем ID пользователя из сессии или откуда-либо еще
        // Например, $user_id = $_SESSION["user_id"];

        // Обновляем поле email в базе данных
        $query = "UPDATE user SET email = '$email' WHERE id_user = $user_id";

        if (mysqli_query($link, $query)) {
            echo "Email успешно обновлен";
        } else {
            echo "Ошибка при обновлении Email: " . mysqli_error($link);
        }
    } else {
        echo "Поле email не было передано";
    }
} else {
    echo "Недопустимый метод запроса";
}
?>
