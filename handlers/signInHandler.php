<?php
if (session_id() == '')
    session_start();
require_once '../database/db.php';
include 'function.php';
$errors = [];
$telephoneError = '';
$passwordError = '';
$telephone = $_POST["telephone"];

if ($telephone == '') {
    $telephoneError .= "Поле не может быть пустым";
    $errors[] = 'telephone';
} else {
    $query = "SELECT id_user FROM user WHERE telephone ='$telephone'";
    $result = mysqli_query($link, $query) or die("Ошибка выполнения запроса" .
        mysqli_error($link));
    if ($result) {
        $row = mysqli_fetch_row($result);
        if (empty($row[0])) {
            $errors[] = 'telephone';
            $telephoneError .= "Пользователь с таким номером телефона не найден";
        }
        
    }
}
$password = $_POST["password"];
clearString($password);
if ($password == '') {
    $errors[] = 'password';
    $passwordError .= "Поле не может быть пустым";
}

//$response это data в ajax файле
if (!empty($errors)) {
    $response = [
        "status" => false, //не авторизовался
        "type" => 1,
        "fields" => $errors,
        "telephoneError" => $telephoneError,
        "passwordError" => $passwordError
    ];
    echo json_encode($response); //преобразовать json в массив 
    die();
}

$passwordQuery = "SELECT password FROM user WHERE telephone ='$telephone'";
$passwordResult = mysqli_query($link, $passwordQuery) or die("Ошибка
выполнения запроса" . mysqli_error($link));
if ($passwordResult) {
    $passwordRow = mysqli_fetch_row($passwordResult);
    if (md5($password)== $passwordRow[0]) {
        $userExists = true;
        $nameQuery = "SELECT * FROM user WHERE telephone ='$telephone'";
        $nameResult = mysqli_query($link, $nameQuery) or die("Ошибка выполнения
            запроса" . mysqli_error($link));
        if ($nameResult) {
            $nameRow = mysqli_fetch_row($nameResult);
            $_SESSION["Name"] = $nameRow[1];
            $_SESSION["UserID"] = $nameRow[0];
            $_SESSION["UserTel"] = $nameRow[3];
            $_SESSION["RoleID"] = $nameRow[5];
        }
        $response = [
            "status" => true,
            "user_id" => $_SESSION["UserID"],
            "role_id" => $_SESSION["RoleID"],
        ];
        echo json_encode($response);
    } else {
        $userExists = false;
        $errors[] = 'password';
        $response = [
            "status" => false,
            "type" => 1,
            "passwordError" => 'Неверный пароль',
            "fields" => $errors
        ];
        echo json_encode($response);
    }
}
?>