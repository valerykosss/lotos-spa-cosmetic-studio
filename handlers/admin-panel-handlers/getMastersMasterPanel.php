<?php
require_once "../handlers/isAdmin.php";

require '../database/db.php';
if (session_id() == '')
    session_start();

?>
<?php
// Подключение к базе данных
$host = "localhost";
$database = "lotos";
$user = "root";
$password = "";

$id_master = $_SESSION["UserID"];
echo $id_master;

$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка" . mysqli_error($link));

// Запрос к базе данных для получения мастеров
$query = "SELECT id_master, master_name FROM master where id_master = $id_master";
$result = mysqli_query($link, $query);

$masters = [];

// Формирование массива мастеров
while ($row = mysqli_fetch_assoc($result)) {
    $masters[] = [
        'id' => $row['id_master'],  // Исправлено на id_master
        'name' => $row['master_name']  // Исправлено на master_name
    ];
}

// Возвращаем результат в формате JSON
echo json_encode($masters);

// Закрытие соединения с базой данных
mysqli_close($link);
?>
