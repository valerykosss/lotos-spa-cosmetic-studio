<?php
if(session_id()==""){
    session_start();
}

    require_once "../database/db.php";
    require_once "mail/mail_client_connect.php";

    $id_user=$_SESSION['UserID'];
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $user_email=htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $message=$_POST['message'];

    $email="valery.kosss@gmail.com";
    if($user_email!=""){
        $body="
        <h3>Имя: </h3>".$name."<br>
        <h3>Почта: </h3>".$user_email."<br><br>
        <h3>Номер телефона: </h3>".$phone."<br><br>
        <p>".$message."</p>
    ";
    $insert_callback=mysqli_query($link, "INSERT INTO requested_feedback VALUES (NULL, $id_user, $phone, $user_email, '$message')");

    }else{
        $body="
        <h3>Имя: </h3>".$name."<br>
        <h3>Номер телефона: </h3>".$phone."<br><br>
        <p>".$message."</p>
    ";
    $insert_callback=mysqli_query($link, "INSERT INTO requested_feedback VALUES (NULL, $id_user, '$phone', NULL, '$message')");
    }

    var_dump(send_mail($settings['mail_settings'], [$email], 'У Вас вопрос от клиента!', $body));
?>