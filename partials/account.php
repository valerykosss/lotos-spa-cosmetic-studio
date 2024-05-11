<?php
require_once "../handlers/isAdmin.php";

require '../database/db.php';
require_once "../handlers/isAdmin.php";



if (session_id() == '')
    session_start();
if ($isAdmin==true || $isMaster==true || !isset($_SESSION['UserID'])){
        header("Location: index.php");
    }
$user_id = $_SESSION['UserID'];

$user_discount = mysqli_query($link, "SELECT wheel_discount.discount_name FROM `user`
                            inner join wheel_discount on user.id_wheel_discount=wheel_discount.id_wheel_discount
                            WHERE `id_user`=$user_id");
$user_discount = mysqli_fetch_assoc($user_discount);

$user_phone = mysqli_query($link, "SELECT telephone, name FROM user WHERE id_user=$user_id");
$user_phone = mysqli_fetch_assoc($user_phone);

$user_avatar = mysqli_query($link, "SELECT `avatar`, name FROM user WHERE id_user=$user_id");
$user_avatar = mysqli_fetch_assoc($user_avatar);

if($user_avatar['avatar']==NULL){
    $avatar="../images/icons/avatar.png";
}else{
    $avatar=$user_avatar['avatar'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аккаунт пользователя</title>
    <link rel="stylesheet" href="../css/generalStyles.css">
    <!-- <link rel="stylesheet" href="../css/specialists.css"> -->
    <link rel="stylesheet" href="../css/sign-in-up.css">
    <link rel="stylesheet" href="../css/admin-panel.css">
    <link rel="stylesheet" href="../css/header-white.css">
    <link rel="stylesheet" href="../css/footer-white.css">

</head>
<style>
    input[type="text"],
    input[type="email"] {
        border: 1px solid black;
        width: 200px;
        height: 40px
    }

    textarea {
        border: 1px solid black;
    }
</style>

<body>
<div class="preloader">
        <div class="preloader__row">
            <div class="preloader__item"></div>
            <div class="preloader__item"></div>
        </div>
    </div>
    <?php
    require 'header-white.php';
    ?>
    <main class="page">
        <section class="page__specialists">
            <div class="specialists__body _container">
                <div class="admin-panel-title ">Аккаунт пользователя</div>
                <div class="tab-admin-panel">


                    <div class="tab-content-admin-panel" style="display:block !important">
                        <?php
                        if ($user_discount != NULL) {

                        ?>
                            <p class="sub-header">Скидка колеса фортуны: <?php echo ($user_discount['discount_name']) ?></p>
                        <?php } ?>
                        <p class="sub-header">Все записи: </p>
                        <table class="table__to-update-delete">
                            <thead>
                                <tr>
                                    <th>Имя</th>
                                    <th>Услуга</th>
                                    <th>Дата записи</th>
                                    <th>Время записи</th>
                                    <th>Стоимость</th>
                                    <th>Статус</th>
                                </tr>
                            </thead>
                            <?php
                            $query = 'SELECT procedure_record.id_record, user.name, service.service_name, procedure_record.record_date, procedure_record.record_time, service.price, procedure_record_status.record_status_name FROM procedure_record inner join master_service on procedure_record.id_master_service=master_service.id_master_service inner join service on master_service.id_service=service.id_service inner join procedure_record_status on procedure_record.id_record_status=procedure_record_status.id_record_status inner join user on procedure_record.id_user=user.id_user WHERE user.id_user=' . $user_id;

                            echo "<tbody>";
                            $trBlock = '';

                            $result = mysqli_query($link, $query) or die('Ошибка' . mysqli_error($link));
                            if ($result) {
                                for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                                    $row = mysqli_fetch_row($result);

                                    $trBlock .= "
                                                <tr id='$row[0]'>
                                                <td>" . $row[1] . "</td>
                                                <td>" . $row[2] . "</td>
                                                <td>" . $row[3] . "</td>
                                                <td>" . $row[4] . "</td>
                                                <td>" . $row[5] . "</td>
                                                <td>" . $row[6] . "</td>
                                                </tr>";
                                }
                            }
                            echo $trBlock;
                            echo "</tbody>";
                            ?>

                        </table>

                    </div>
                </div>
            </div>
        </section>
        <section>
            <img class="avatar" src="<?php echo($avatar);?>" style="width:50px; height: 50px;">
            <input type="file" id="fileInput" style="display: none;">
            <button id="uploadButton">Сменить изображение</button>
        </section>
        <section>
            <input type="password" name="old-password" class="old-password" style="border: 1px solid black">
            <input type="password" name="new-password" class="new-password" style="border: 1px solid black">
            <input type="password" name="new-password-confirm" class="new-password-confirm" style="border: 1px solid black">
            <input type="button" name="change-password" value="Изменить пароль">
        </section>
    </main>
    <?php require_once 'footer-white.php' ?>
</body>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="../libraries/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
<script src="../js/admin-panel-ajax/change-master-data.js"></script>

<script src="../js/signInUp.js"></script>
<script src="../js/preloader.js"></script>
<script src="../js/change-pass.js"></script>
<script src="../js/change-avatar.js"></script>

</html>