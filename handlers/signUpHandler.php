<?php
if (session_id() == '')
    session_start();
require_once '../database/db.php';
include 'function.php';
$errors = [];
$nameError = '';
$telephone_regError = '';
$first_passwordError = '';
$second_passwordError = '';

$name = $_POST["name"];
clearString($name);
$nameRegex = '/^[A-ZА-ЯЁ]{1}[a-zа-яё]{2,}?/u'; //u для русских
if ($name == '') {
    $errors[] = 'name';
    $nameError .= "Поле не может быть пустым";
} else if (!preg_match($nameRegex, $name)) {
    $errors[] = 'name';
    $nameError .= "Имеет неверное значение";
}

$telephone = $_POST["telephone_reg"];
$phoneRegex = '/^\+375\s\((29|33|44|25)\)\s\d{3}-\d{2}-\d{2}$/';
if ($telephone == '') {
    $errors[] = 'telephone_reg';
    $telephone_regError .= "Поле не может быть пустым";
} else if (!preg_match($phoneRegex, $telephone)) {
    $errors[] = 'telephone_reg';
    $telephone_regError .= "Имеет неверное значение";
} else {
    $query = "SELECT id_user FROM user WHERE telephone = '$telephone'";
    $result = mysqli_query($link, $query) or die("Ошибка выполнения запроса" .
        mysqli_error($link));
    if ($result) {
        $row = mysqli_fetch_row($result);
        if (!empty($row[0])){
            $errors[] = 'telephone_reg';
            $telephone_regError .= "Аккаунт с таким номером телефона уже зарегистрирован";
        }
    }
}

$first_password = $_POST["first_password"];
clearString($first_password);
//$passwordRegex = '/^(?=.*[A-ZА-ЯЁ])(?=.*[!@#$&*-])(?=.*[0-9].*[0-9])(?=.*[a-zа-яё].*[a-zа-яё].*[a-zа-яё]).{8,}$/';

$passwordRegex = '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{4,}$/'; //Minimum eight characters, at least one letter and one number:
if ($first_password == '') {
    $errors[] = 'first_password';
    $first_passwordError .= "Поле не может быть пустым";
} else if (!preg_match($passwordRegex, $first_password)) {
    $errors[] = 'first_password';
    $first_passwordError .= "Имеет неверное значение";
}

$second_password = $_POST["second_password"];
clearString($second_password);
if ($second_password == '') {
    $errors[] = 'second_password';
    $second_passwordError .= "Поле не может быть пустым";
} else if ($second_password != $first_password) {
    $errors[] = 'second_password';
    $second_passwordError .= "Пароли не совпадают";
}


if (!empty($errors)) {
    $response = [
        "status" => false,
        "type" => 1,
        "fields" => $errors,
        "nameError" => $nameError,
        "telephone_regError" => $telephone_regError,
        "first_passwordError" => $first_passwordError,
        "second_passwordError" => $second_passwordError
    ];
    echo json_encode($response);
    die();
}
if ($first_password == $second_password) {
    $password = md5($first_password);
    $query = "INSERT INTO user (telephone, password, name, id_role)
    VALUES ('$telephone','$password', '$name', 2)";
    $result = mysqli_query($link, $query) or die("Ошибка " .
        mysqli_error($link));
    if ($result) {
        $response = [
            "status" => true,
        ];
        echo json_encode($response);

    } else {
        $response = [
            "status" => false
        ];
        echo json_encode($response);
    }
} else {
    $errors[] = 'second_password';
    $response = [
        "status" => false,
        "second_passwordError" => "Пароли не совпадают"
    ];
    echo json_encode($response);
}
?>