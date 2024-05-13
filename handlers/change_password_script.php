<?php
session_start();

$userId=$_SESSION['UserID'];
require_once "../database/db.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['old-password'], $_POST['new-password'], $_POST['new-password-confirm'])) {
        $oldPassword = $_POST['old-password'];
        $newPassword = $_POST['new-password'];
        $newPasswordConfirm = $_POST['new-password-confirm'];

        if($oldPassword!=""&&$newPassword!=""&&$newPasswordConfirm){
            $old_pass=mysqli_query($link, "SELECT `password` FROM `user` WHERE `id_user`=$userId");
            $old_pass=mysqli_fetch_assoc($old_pass);
    
            if($old_pass['password']==md5($oldPassword)){
                if ($newPassword === $newPasswordConfirm) {
                    $newPassword=md5($newPassword);
                    $change_pass=mysqli_query($link, "UPDATE `user` SET `password`='$newPassword' WHERE `id_user`=$userId");
    
                    echo json_encode(['success' => true, 'message' => 'Пароль успешно изменен']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'Новый пароль и его подтверждение не совпадают']);
                }
            }else{
                echo json_encode(['success' => false, 'message' => 'Вы неправильно ввели старый пароль']);
            }
        }else{
            echo json_encode(['success' => false, 'message' => 'Заполните все поля']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Не все поля были отправлены']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Метод запроса должен быть POST']);
}
