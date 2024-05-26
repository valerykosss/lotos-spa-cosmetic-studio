<?php
require_once "../database/db.php";
// Подключение к базе данных

// Получение конкатенации select_query из POST-запроса
$resultQuery = isset($_POST['query']) ? $_POST['query'] : '';

// Выполнение запроса к базе данных
if (!empty($resultQuery)) {
    // Формирование SQL-запроса
    $sql = "SELECT id_service, service_name, service_description FROM service $resultQuery";
    $query= mysqli_query($link, $sql);

    // Получение результатов запроса
    $results = mysqli_fetch_all($query);
    // echo "<pre>";

    // var_dump($results);
    // echo "</pre>";


    // Формирование HTML-ответа
    $htmlResponse = '';
    if (!empty($results)) {
        $htmlResponse .= '<p class="test__result-title">по результатам опроса, больше всего вам подходит:</p>';
        foreach ($results as $result) {
            $htmlResponse .= '<p class="test__result-service-name">' . $result[1] . '</p>';
            $htmlResponse .= '<p class="test__result-service-description">' . $result[2] . '</p>';
            $htmlResponse .= '<div class="buttons-container"><button class="bookService button" data-id="' . $result[0] . '"><span class="details">Записаться<span></button>';
            $htmlResponse .= '<button id="restartTest" class="button"><span class="details">Пройти еще<span></button></div>';
        }
    } else {
        $htmlResponse = '<p>Подходящие услуги не найдены.</p><br>
        <button id="restartTest">Пройти тест заново</button>';
    }
    // Возвращение HTML-ответа
    echo $htmlResponse;
} else {
    // Если конкатенация select_query пуста, возвращаем сообщение об ошибке
    echo '<p>Ошибка: Нет данных для запроса.</p>';
}
?>
