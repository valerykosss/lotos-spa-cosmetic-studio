<?php
    require '../../database/db.php';
    require '../../handlers/mail/mail_client_connect.php';

    if (session_id() == '')
    session_start();

    function generateRandomPassword($length = 8) {
        // Строка символов, из которых будет состоять пароль
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomPassword = '';
    
        // Генерируем случайный пароль
        for ($i = 0; $i < $length; $i++) {
            $randomPassword .= $characters[random_int(0, $charactersLength - 1)];
        }
    
        return $randomPassword;
    }
    
    $password = generateRandomPassword();
    $userPassword=md5($password);
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_phone = $_POST['user_phone'];
    $user_role = $_POST['user_role'];
    
    // Подготавливаем SQL-запрос для добавления мастера
    $query = "INSERT INTO `user` (`name`, `email`, `telephone`, `password`, `id_role`, `id_wheel_discount`, `avatar`) 
            VALUES ('$user_name', '$user_email', '$user_phone', '$userPassword', '$user_role', NULL, NULL)";

    if (mysqli_query($link, $query)) {
        $userId = mysqli_insert_id($link); // Получаем ID нового мастера
        
        $body="<p>Вы зарегистрированы на сайте центра гармонии души и тела 'Лотос'!</p>
        <p>Ваши данные для входа:</p>
        <p>Телефон: ".$user_phone."</p>
        <p>Пароль: ".$password."</p>
        <p>Также по этой почте вы будете получать напоминания о процедуре!</p>
        <p>Ваш Лотос!</p>";

        $user_roles=mysqli_query($link, "SELECT `id_role`, `role_name` FROM `role`");
        $user_roles=mysqli_fetch_all($user_roles);

        $options="";
        foreach($user_roles as $row){
            if($row[0]==$user_role){
                $option="<option value=".$row[0]." selected>".$row[1]."</option>";
            }else{
                $option="<option value=".$row[0].">".$row[1]."</option>";
            }
            $options.=$option;
        }
        $response = [
            'success' => true,
            'user' => [
                'id' => $userId,
                'options' => $options,
                'user_name' => $user_name,
                'user_email' => $user_email,
                'user_phone' => $user_phone
            ]
        ];
        echo json_encode($response);
        send_mail($settings['mail_settings'], [$user_email], 'Приветствуем вас в нашем центре!', $body);

    } else {
        $response = ['success' => false];
        echo json_encode($response);
    }
    
?>