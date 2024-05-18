<?php
    require '../../database/db.php';
    if (session_id() == '')
    session_start();

    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_phone = $_POST['user_phone'];
    $user_role = $_POST['user_role'];
    
    // Подготавливаем SQL-запрос для добавления мастера
    $query = "INSERT INTO `user` (`name`, `email`, `telephone`, `id_role`, `password`, `id_wheel_discount`, `avatar`) 
            VALUES ('$user_name', '$user_email', '$user_phone', '$user_role', NULL, NULL, NULL)";

    if (mysqli_query($link, $query)) {
        $userId = mysqli_insert_id($link); // Получаем ID нового мастера

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
    } else {
        $response = ['success' => false];
        echo json_encode($response);
    }
    
?>