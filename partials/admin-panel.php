<?php
require_once "../handlers/isAdmin.php";

if ($isAdmin == false || !isset($_SESSION['UserID'])) {
    header("Location: index.php");
}
require_once '../database/db.php';
require_once "../handlers/admin-panel-handlers/adminpanel_info_script.php";
if (session_id() == '')
    session_start();

    function russianMonth($monthNumber)
    {
        $months = array(
            'января',
            'февраля',
            'марта',
            'апреля',
            'мая',
            'июня',
            'июля',
            'августа',
            'сентября',
            'октября',
            'ноября',
            'декабря'
        );
        return $months[$monthNumber - 1];
    }
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лотос - Панель администратора</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

    <link rel="stylesheet" href="../css/generalStyles.css">
    <link rel="stylesheet" href="../css/popupSignInUp.css">
    <link rel="stylesheet" href="../css/header-white-admin-master.css">
    <link rel="stylesheet" href="../css/admin-panel.css">

    <style>
        .add-wheel__button {
            width: 18px;
            height: 18px;
            background-image: url('../images/icons/add-icon.svg');
            background-size: cover;
            background-color: transparent;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="preloader">
        <div class="preloader__row">
            <div class="preloader__item"></div>
            <div class="preloader__item"></div>
        </div>
    </div>

    <?php
    require 'header-white-admin-master.php';
    ?>
    <main class="page">
        <section class="page__specialists">
            <div class="specialists__body _container">
                <div class="admin-panel-title ">Панель Администратора</div>
                <div class="tab-admin-panel">
                    <div class="radio-buttons__body-admin-panel">
                        <input checked id="tab-btn-1" name="tab-btn" type="radio" value="">
                        <label for="tab-btn-1">Мастера</label>

                        <input id="tab-btn-2" name="tab-btn" type="radio" value="">
                        <label for="tab-btn-2">Услуги</label>

                        <input id="tab-btn-3" name="tab-btn" type="radio" value="">
                        <label for="tab-btn-3">Записи на услугу</label>

                        <input id="tab-btn-4" name="tab-btn" type="radio" value="">
                        <label for="tab-btn-4">Обратная связь</label>

                        <input id="tab-btn-5" name="tab-btn" type="radio" value="">
                        <label for="tab-btn-5">Колесо фортуны</label>

                        <input id="tab-btn-6" name="tab-btn" type="radio" value="">
                        <label for="tab-btn-6">Модерация отзывов</label>

                        <input id="tab-btn-7" name="tab-btn" type="radio" value="">
                        <label for="tab-btn-7">Мастер-сервис</label>

                        <input id="tab-btn-8" name="tab-btn" type="radio" value="">
                        <label for="tab-btn-8">Типы услуг</label>

                        <input id="tab-btn-9" name="tab-btn" type="radio" value="">
                        <label for="tab-btn-9">Пользователи</label>

                    </div>

                    <div class="tab-content-admin-panel" id="content-1">

                        <p class="sub-header">Введите данные нового мастера: </p>
                        <table class="table__to-add master">
                            <thead>
                                <tr>
                                    <th>Имя мастера</th>
                                    <th>Фамилия</th>
                                    <th>Фото</th>
                                    <th>Курсы</th>
                                    <th>Опыт работы(лет)</th>
                                    <th>Специализация</th>
                                    <th>Пользователь</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><textarea class="master_name"></textarea></td>
                                    <td><textarea class="master_surname"></textarea></td>
                                    <td><input type="file" class="master_photo" name="master_photo"></input></td>
                                    <td><textarea class="education"></textarea></td>
                                    <td><textarea class="work_experience digitsOnly"></textarea></td>
                                    <td><textarea class="position"></textarea></td>
                                    <td>
                                        <select class="user_master">
                                            <option selected disabled>Выберите пользователя</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button class='add-master__button'></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <p class="sub-header">Все мастера: </p>
                        <table class="table__to-update-delete master">
                            <thead>
                                <tr>
                                    <th>Имя мастера</th>
                                    <th>Фамилия</th>
                                    <th>Фото</th>
                                    <th>Курсы</th>
                                    <th>Опыт работы (лет)</th>
                                    <th>Специальность</th>
                                    <th>Пользователь</th>
                                </tr>
                            </thead>
                            <?php
                            $query = "SELECT `master`.`id_master`, `master`.`master_name`, `master`.`master_surname`, `master`.`master_photo`, `master`.`education`, `master`.`work_experience`, `master`.`position`, `user`.`id_user`, `user`.`name` FROM `master` INNER JOIN `user` ON `master`.`id_user` = `user`.`id_user`";

                            echo "<tbody>";
                            $trBlock = '';

                            // $users_master = mysqli_query($link, "SELECT `id_user`, `name` FROM `user`");
                            // $users_master = mysqli_fetch_all($users_master);

                            $result = mysqli_query($link, $query) or die('Ошибка' . mysqli_error($link));
                            if ($result) {
                                for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                                    $row = mysqli_fetch_row($result);
                                    // $options = "";
                                    // foreach ($users_master as $role) {
                                    //     if ($row[7] == $role[0]) {
                                    //         $option = "<option value=" . $role[0] . " selected>" . $role[1] . "</option>";
                                    //     } else {
                                    //         $option = "<option value=" . $role[0] . ">" . $role[1] . "</option>";
                                    //     }
                                    //     $options .= $option;
                                    // }

                                    $trBlock .= "
                                                <tr id='$row[0]'>
                                                    <td><textarea id='" . $row[0] . "'>" . $row[1] . "</textarea></td>
                                                    <td><textarea id='" . $row[0] . "'>" . $row[2] . "</textarea></td>
                                                    <td class='master-photo-container' id='photo_" . $row[0] . "'><img src='" . $row[3] . "' alt='photo' style='width: 150px'></td>
                                                    <td><textarea id='" . $row[0] . "'>" . $row[4] . "</textarea></td>
                                                    <td><textarea class='digitsOnly' id='" . $row[0] . "'>" . $row[5] . "</textarea></td>
                                                    <td><textarea id='" . $row[0] . "'>" . $row[6] . "</textarea></td>
                                                    <td>".$row[8]."</td>
                                                    
                                                    <td>
                                                        <button class='change-master__button' id='" . $row[0] . "'></button>
                                                        <button class='delete-master__button' id='" . $row[0] . "'></button>
                                                    </td>
                                                </tr>";
                                }
                            }
                            echo $trBlock;
                            echo "</tbody>";
                            ?>
                        </table>

                    </div>

                    <div class="tab-content-admin-panel" id="content-2">
                        <p class="sub-header">Введите данные новой услуги: </p>
                        <table class="table__to-add service">
                            <thead>
                                <tr>
                                    <th>Тип услуги</th>
                                    <th>Название услуги</th>
                                    <th>Фото</th>
                                    <th>Описание</th>
                                    <th>Дли-<br>тель-<br>ность (мин)</th>
                                    <th>Цена (руб)</th>
                                    <th>Показания</th>
                                    <th>Результаты</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="service_type">
                                            <option selected disabled>Выберите тип услуги</option>
                                        </select>
                                    </td>
                                    <td><textarea class="service_name"></textarea></td>
                                    <td><input type="file" class="service_image" name="service_image"></input></td>
                                    <td><textarea class="service_description"></textarea></td>
                                    <td><textarea class="duration digitsOnly"></textarea></td>
                                    <td><textarea class="price digitsOnly"></textarea></td>
                                    <td><textarea class="insication"></textarea></td>
                                    <td><textarea class="results"></textarea></td>
                                    <td>
                                        <button class='add-service__button'></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <p class="sub-header">Все услуги: </p>
                        <table class="table__to-update-delete service">
                            <thead>
                                <tr>
                                    <th>Тип услуги</th>
                                    <th>Название услуги</th>
                                    <th>Фото</th>
                                    <th>Описание</th>
                                    <th>Дли-<br>тель-ность (мин)</th>
                                    <th>Цена (руб)</th>
                                    <th>Показания</th>
                                    <th>Результаты</th>
                                </tr>
                            </thead>
                            <?php
                            $query = 'SELECT `service`.`id_service`, `service_type`.`id_service_type`, `service_type`.`service_type_name`, `service`.`service_name`, `service`.`service_image`, `service`.`service_description`, `service`.`duration`, `service`.`price`, `service`.`insication`, `service`.`results`
                                    FROM `service`
                                    INNER JOIN `service_type` ON `service`.`id_service_type`=`service_type`.`id_service_type`;';

                            echo "<tbody>";
                            $trBlock = '';

                            $result = mysqli_query($link, $query) or die('Ошибка' . mysqli_error($link));
                            if ($result) {
                                for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                                    $row = mysqli_fetch_row($result);
                                    $options = "";

                                    foreach ($service_types as $type) {
                                        if ($type[0] == $row[1]) {
                                            $option = "<option value='" . $type[0] . "' selected>" . $type[1] . "</option>";
                                        } else {
                                            $option = "<option value='" . $type[0] . "'>" . $type[1] . "</option>";
                                        }
                                        $options .= $option;
                                    }
                                    $trBlock .= "
                                                <tr id='$row[0]'>
                                                    <td>
                                                        <select class='id_service_type'>
                                                            " . $options . "
                                                        </select>
                                                    </td>
                                                    <td><textarea>" . $row[3] . "</textarea></td>
                                                    <td class='service-photo-container' id='photo_" . $row[0] . "'><img style='width:100px;' src='" . $row[4] . "'></td>
                                                    <td><textarea>" . $row[5] . "</textarea></td>
                                                    <td><textarea class='digitsOnly'>" . $row[6] . "</textarea></td>
                                                    <td><textarea class='digitsOnly'>" . $row[7] . "</textarea></td>
                                                    <td><textarea>" . $row[8] . "</textarea></td>
                                                    <td><textarea>" . $row[9] . "</textarea></td>
                                                    
                                                    <td>
                                                        <button class='change-service__button' id='" . $row[0] . "'></button>
                                                        <button class='delete-service__button' id='" . $row[0] . "'></button>
                                                    </td>
                                                </tr>";
                                }
                            }
                            echo $trBlock;
                            echo "</tbody>";
                            ?>

                        </table>
                    </div>

                    <div class="tab-content-admin-panel" id="content-3">
                        <p class="sub-header">Добавить запись:</p>
                        <div style="overflow-y:scroll">
                        <table class="table__to-add record">
                            <thead>
                                <tr>
                                    <th>Услуга</th>
                                    <th>Мастер</th>
                                    <th>Клиент</th>
                                    <th>Дата и время</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="service" id="service">
                                            <option selected disabled>Выберите услугу</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select id="master" name="master">
                                            <option selected disabled>Выберите мастера</option>
                                        </select>
                                    </td>
                                    <!-- <td><textarea class="client_name digitsOnly" name="client_name"></textarea></td>
                                    <td><input type="date" class="new-record_date" name="new-record_date"></td>
                                    <td><input type="time" class="new-record_time" name="new-record_time"></td>-->
                                    <td>
                                        <select id="user">
                                            <option selected disabled>Выберите юзера</option>
                                        </select>
                                    </td>
                                    <td> 
                                        <select id="dateTime">
                                            <option selected disabled>Выберите дату и время</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button class='add-record__button'></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                        <table class="table__to-update-delete record">
                            <thead>
                                <tr>
                                    <th>Номер записи</th>
                                    <th>Мастер</th>
                                    <th>Услуга</th>
                                    <th>Клиент</th>
                                    <th>Дата записи</th>
                                    <th>Время записи</th>
                                    <th>Статус</th>
                                </tr>
                            </thead>

                            <?php
                            $query = 'SELECT `procedure_record`.`id_record`, `master`.`master_name`, `service`.`service_name`, `user`.`name`, `procedure_record`.`record_date`, `procedure_record`.`record_time`, `procedure_record_status`.`id_record_status`, `user`.`telephone`
                                        FROM `procedure_record`
                                        INNER JOIN `master_service` ON `procedure_record`.`id_master_service`=`master_service`.`id_master_service`
                                        INNER JOIN `master` ON `master_service`.`id_master`=`master`.`id_master`
                                        INNER JOIN `service` ON `master_service`.`id_service`=`service`.`id_service`
                                        INNER JOIN `procedure_record_status` ON `procedure_record`.`id_record_status`=`procedure_record_status`.`id_record_status`
                                        INNER JOIN `user` ON `procedure_record`.`id_user`=`user`.`id_user`
                                        ORDER BY `procedure_record`.`record_date` ASC, `procedure_record`.`record_time` ASC;';

                            echo "<tbody>";
                            $trBlock = '';

                            $result = mysqli_query($link, $query) or die('Ошибка' . mysqli_error($link));
                            if ($result) {
                                for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                                    $row = mysqli_fetch_row($result);

                                    $date = strtotime($row[4]); // Преобразование строки в дату
                                    $day = date('j', $date);
                                    $month = date('n', $date);
                                    $year = date('Y', $date);
                                    $date = $day . ' ' . russianMonth($month) . ' '. $year;

                                    $time = $row[5];
                                    $formatted_time = substr($time, 0, 5);


                                    $options = "";

                                    foreach ($record_statuses as $status) {
                                        if ($status[0] == $row[6]) {
                                            $option = "<option value='" . $status[0] . "' selected>" . $status[1] . "</option>";
                                        } else {
                                            $option = "<option value='" . $status[0] . "'>" . $status[1] . "</option>";
                                        }
                                        $options .= $option;
                                    }
                                    $trBlock .= "
                                                <tr id='$row[0]'>
                                                    <td>" . $row[0] . "</td>
                                                    <td>" . $row[1] . "</td>
                                                    <td>" . $row[2] . "</td>
                                                    <td>" . $row[3] . '</br>'. $row[7]. "</td>
                                                    <td>" . $date . "</td>
                                                    <td>" . $formatted_time . "</td>
                                                    <td>
                                                        <select class='record-status'>
                                                            " . $options . "
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button class='delete-record__button' id='" . $row[0] . "'></button>
                                                    </td>
                                                </tr>";
                                }
                            }
                            echo $trBlock;
                            echo "</tbody>";
                            ?>

                        </table>
                    </div>

                    <div class="tab-content-admin-panel" id="content-4">
                        <p class="sub-header">Обратная связь:</p>
                        <table class="table__to-update-delete">
                            <thead>
                                <tr>
                                    <th>Номер обращения</th>
                                    <th>Имя</th>
                                    <th>Номер телефона</th>
                                    <th>Сообщение</th>
                                    <th>Статус</th>
                                </tr>
                            </thead>
                            <?php
                            $query = 'SELECT `id_requested_feedback`, `requested_feedback`.`name`, `requested_feedback`.`tel`, `requested_feedback`.`message_text`, `requested_feedback`.`status`
                            FROM `requested_feedback`;';

                            echo "<tbody>";
                            $trBlock = '';

                            $result = mysqli_query($link, $query) or die('Ошибка' . mysqli_error($link));
                            if ($result) {
                                for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                                    $row = mysqli_fetch_row($result);

                                    $options = "";
                                    if ($row[4] == "получено") {
                                        $options = "
                                                    <option value='" . $row[4] . "' selected>Получено</option>
                                                    <option value='обработано'>Обработано</option>
                                                    ";
                                    } else if ($row[4] == "обработано") {
                                        continue;
                                    }
                                    $trBlock .= "
                                                <tr id='$row[0]'>
                                                    <td>" . $row[0] . "</td>
                                                    <td>" . $row[1] . "</td>
                                                    <td>" . $row[2] . "</td>
                                                    <td>" . $row[3] . "</td>
                                                    <td>
                                                        <select class='feedback-status'>
                                                            " . $options . "
                                                        </select>
                                                    </td>
                                                </tr>";
                                }
                            }
                            echo $trBlock;
                            echo "</tbody>";
                            ?>
                        </table>
                    </div>

                    <div class="tab-content-admin-panel" id="content-5">
                        <p class="sub-header">Введите данные нового сектора колеса: </p>
                        <table class="table__to-add">
                            <thead>
                                <tr>
                                    <th>Название скидки</th>
                                    <th>Цвет сектора</th>
                                    <th>Относящаяся к скидке процедура</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><textarea class="discount_name"></textarea></td>
                                    <td><input type="color" class="sector_wheel_color"></input></td>
                                    <td>
                                        <select class="wheel_service" id="wheel_service">
                                            <option selected disabled>Выберите услугу</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button class='add-wheel__button'></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <p class="sub-header">Все секторы колеса: </p>
                        <table class="table__to-update-delete wheel">
                            <thead>
                                <tr>
                                    <th>Название скидки</th>
                                    <th>Цвет сектора</th>
                                    <th>Относящаяся к скидке процедура</th>
                                </tr>
                            </thead>
                            <?php
                            $query = 'SELECT * from wheel_discount';

                            echo "<tbody>";
                            $trBlock = '';

                            $result = mysqli_query($link, $query) or die('Ошибка' . mysqli_error($link));
                            if ($result) {
                                for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                                    $row = mysqli_fetch_row($result);

                                    $options = "";

                                    foreach ($services as $service) {
                                        if ($service[0] == $row[3]) {
                                            $option = "<option value=" . $service[0] . " selected>" . $service[1] . "</option>";
                                        } else {
                                            $option = "<option value=" . $service[0] . ">" . $service[1] . "</option>";
                                        }
                                        $options .= $option;
                                    }

                                    $trBlock .= "
                                                <tr id='$row[0]'>
                                                    <td><textarea name='discount_name'>" . $row[1] . "</textarea></td>
                                                    <td><input type='color' class='colorpicker' value='" . $row[2] . "' name='color'></td>
                                                    <td>
                                                        <select class='wheel_service' id='wheel_service'>
                                                            " . $options . "
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button class='change-wheel__button' id='" . $row[0] . "'></button>
                                                        <button class='delete-wheel__button' id='" . $row[0] . "'></button>
                                                    </td>
                                                </tr>";
                                }
                            }
                            echo $trBlock;
                            echo "</tbody>";
                            ?>
                        </table>
                    </div>

                    <div class="tab-content-admin-panel" id="content-6">
                        <p class="sub-header">Модерация отзывов мастера:</p>
                        <table class="table__to-update-delete master-rating">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Мастер</th>
                                    <th>Клиент</th>
                                    <th>Оценка</th>
                                    <th>Отзыв</th>
                                    <th>Дата</th>
                                    <th>Статус</th>
                                </tr>
                            </thead>
                            <?php
                            $query = 'SELECT master_rating.id_master_rating, master.master_name, user.name, master_rating, master_review, review_date, `status` FROM `master_rating` INNER JOIN `master` ON master_rating.id_master=master.id_master INNER JOIN user ON master_rating.id_user=user.id_user';

                            echo "<tbody>";
                            $trBlock = '';

                            $result = mysqli_query($link, $query) or die('Ошибка' . mysqli_error($link));
                            if ($result) {
                                for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                                    $row = mysqli_fetch_row($result);

                                    $date = strtotime($row[5]); // Преобразование строки в дату
                                    $day = date('j', $date);
                                    $month = date('n', $date);
                                    $year = date('Y', $date);
                                    $date = $day . ' ' . russianMonth($month) . ' '. $year;

                                    $options = "";
                                    if ($row[6] == "На рассмотрении") {
                                        $options = "
                                                    <option value='На рассмотрении' selected>На рассмотрении</option>
                                                    <option value='Одобрен'>Одобрен</option>
                                                    ";
                                    } else if ($row[6] == "Одобрен") {
                                        $options = "
                                                    <option value='На рассмотрении'>На рассмотрении</option>
                                                    <option value='Одобрен' selected>Одобрен</option>
                                                    ";
                                    }
                                    $trBlock .= "
                                                <tr id='$row[0]'>
                                                    <td>" . $row[0] . "</td>
                                                    <td>" . $row[1] . "</td>
                                                    <td>" . $row[2] . "</td>
                                                    <td>" . $row[3] . "</td>
                                                    <td>" . $row[4] . "</td>
                                                    <td>" . $date . "</td>
                                                    <td>
                                                        <select class='master-review-status'>
                                                            " . $options . "
                                                        </select>
                                                    </td>
                                                </tr>";
                                }
                            }
                            echo $trBlock;
                            echo "</tbody>";
                            ?>
                        </table>
                        <p class="sub-header">Модерация отзывов услуги:</p>
                        <table class="table__to-update-delete service-rating">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Услуга</th>
                                    <th>Клиент</th>
                                    <th>Оценка</th>
                                    <th>Отзыв</th>
                                    <th>Дата</th>
                                    <th>Статус</th>
                                </tr>
                            </thead>
                            <?php
                            $query = 'SELECT id_service_rating, user.name, service.service_name, service_review, service_rating, review_date, `status`
                            FROM service_rating
                            INNER JOIN user ON service_rating.id_user=user.id_user
                            INNER JOIN service ON service_rating.id_service=service.id_service';

                            echo "<tbody>";
                            $trBlock = '';

                            $result = mysqli_query($link, $query) or die('Ошибка' . mysqli_error($link));
                            if ($result) {
                                for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                                    $row = mysqli_fetch_row($result);

                                    $date = strtotime($row[5]); // Преобразование строки в дату
                                    $day = date('j', $date);
                                    $month = date('n', $date);
                                    $year = date('Y', $date);
                                    $date = $day . ' ' . russianMonth($month) . ' '. $year;

                                    $options = "";
                                    if ($row[6] == "На рассмотрении") {
                                        $options = "
                                                    <option value='На рассмотрении' selected>На рассмотрении</option>
                                                    <option value='Одобрен'>Одобрен</option>
                                                    ";
                                    } else if ($row[6] == "Одобрен") {
                                        $options = "
                                                    <option value='На рассмотрении'>На рассмотрении</option>
                                                    <option value='Одобрен' selected>Одобрен</option>
                                                    ";
                                    }
                                    $trBlock .= "
                                                <tr id='$row[0]'>
                                                    <td>" . $row[0] . "</td>
                                                    <td>" . $row[2] . "</td>
                                                    <td>" . $row[1] . "</td>
                                                    <td>" . $row[4] . "</td>
                                                    <td>" . $row[3] . "</td>
                                                    <td>" . $date . "</td>
                                                    <td>
                                                        <select class='service-review-status'>
                                                            " . $options . "
                                                        </select>
                                                    </td>
                                                </tr>";
                                }
                            }
                            echo $trBlock;
                            echo "</tbody>";
                            ?>
                        </table>
                    </div>

                    <div class="tab-content-admin-panel" id="content-7">
                        <p class="sub-header">Cоздайте соответствие мастер-сервис:</p>
                        <table class="table__to-add master-service">
                            <thead>
                                <tr>
                                    <th>Услуга</th>
                                    <th>Мастер</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="service_ms" id="service_ms">
                                            <option selected disabled>Выберите услугу</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="master_ms" id="master_ms">
                                            <option selected disabled>Выберите мастера</option>
                                        </select>
                                    </td>
                                    <td>
                                        <button class='add-master-service__button'></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <p class="sub-header">Все соответствия мастер-сервис:</p>

                        <table class="table__to-delete master-service">
                            <thead>
                                <tr>
                                    <th>Номер соответствия</th>
                                    <th>Услуга</th>
                                    <th>Мастер</th>
                                </tr>
                            </thead>
                            <?php
                            $query = 'SELECT `master_service`.`id_master_service`, `master_service`.`id_master`, `master_service`.`id_service`, `master`.`master_name`, `service`.`service_name`  FROM `master_service`
                                INNER JOIN `master` ON `master_service`.`id_master`=`master`.`id_master`
                                INNER JOIN `service` ON `master_service`.`id_service`=`service`.`id_service`';

                            echo "<tbody>";
                            $trBlock = '';

                            $result = mysqli_query($link, $query) or die('Ошибка' . mysqli_error($link));
                            if ($result) {
                                for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                                    $row = mysqli_fetch_row($result);
                                    $trBlock .= "
                                                    <tr id='$row[0]'>
                                                        <td>" . $row[0] . "</td>
                                                        <td>" . $row[4] . "</td>
                                                        <td>" . $row[3] . "</td>
                                                        <td>
                                                            <button class='delete-ms__button' id='" . $row[0] . "'></button>
                                                        </td>
                                                    </tr>";
                                }
                            }
                            echo $trBlock;
                            echo "</tbody>";
                            ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-content-admin-panel" id="content-8">
                        <p class="sub-header">Введите название нового типа услуги:</p>
                        <table class="table__to-add service-type">
                            <thead>
                                <tr>
                                    <th>Название типа услуги</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><textarea class="service-type_name"></textarea></td>
                                    <td>
                                        <button class='add-service-type__button'></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <p class="sub-header">Все типы услуг:</p>

                        <table class="table__to-update-delete service-type">
                            <thead>
                                <tr>
                                    <th>Название типа услуги</th>
                                </tr>
                            </thead>
                            <?php
                            $query = 'SELECT `id_service_type`, `service_type_name` FROM `service_type`';

                            echo "<tbody>";
                            $trBlock = '';

                            $result = mysqli_query($link, $query) or die('Ошибка' . mysqli_error($link));
                            if ($result) {
                                for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                                    $row = mysqli_fetch_row($result);
                                    $trBlock .= "
                                                    <tr id='$row[0]'>
                                                        <td><textarea name='service-type-name' id='" . $row[0] . "'>" . $row[1] . "</textarea></td>
                                                        <td>
                                                            <button class='change-type-service__button' id='" . $row[0] . "'></button>
                                                            <button class='delete-type-service__button' id='" . $row[0] . "'></button>
                                                        </td>
                                                    </tr>";
                                }
                            }
                            echo $trBlock;
                            echo "</tbody>";
                            ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-content-admin-panel" id="content-9">
                        <?php
                        $user_roles = mysqli_query($link, "SELECT * FROM `role`");
                        $user_roles = mysqli_fetch_all($user_roles);
                        ?>
                        <p class="sub-header">Введите нового пользователя:</p>
                        <table class="table__to-add user">
                            <thead>
                                <tr>
                                    <th>Имя</th>
                                    <th>Почта</th>
                                    <th>Телефон</th>
                                    <th>Роль</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><textarea class="user_name"></textarea></td>
                                    <td><textarea class="user_email"></textarea></td>
                                    <td><textarea class="user_phone"></textarea></td>
                                    <td>
                                        <select class="user_role">
                                            <option selected disabled>Выберите роль</option>
                                            <?php
                                            foreach ($user_roles as $role) {
                                                echo "<option value='" . $role[0] . "'>" . $role[1] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <button class='add-user__button'></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="sub-header">Все пользователи:</p>

                        <table class="table__to-update-delete user">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Имя</th>
                                    <th>Почта</th>
                                    <th>Телефон</th>
                                    <th>Скидка</th>
                                    <th>Роль</th>
                                </tr>
                            </thead>
                            <?php
                            $query = 'SELECT user.id_user, user.name, user.email, user.telephone, role.role_name, wheel_discount.discount_name, role.id_role
                                FROM user
                                LEFT JOIN wheel_discount ON user.id_wheel_discount=wheel_discount.id_wheel_discount
                                INNER JOIN role ON user.id_role=role.id_role';

                            echo "<tbody>";
                            $trBlock = '';
                            $user_roles = mysqli_query($link, "SELECT `id_role`, `role_name` FROM `role`");
                            $user_roles = mysqli_fetch_all($user_roles);

                            $result = mysqli_query($link, $query) or die('Ошибка' . mysqli_error($link));
                            if ($result) {
                                for ($i = 0; $i < mysqli_num_rows($result); $i++) {
                                    $row = mysqli_fetch_row($result);
                                    if ($row[6] == 1) {
                                        continue;
                                    }
                                    $options = "";
                                    foreach ($user_roles as $role) {
                                        if ($row[6] == $role[0]) {
                                            $option = "<option value=" . $role[0] . " selected>" . $role[1] . "</option>";
                                        } else {
                                            $option = "<option value=" . $role[0] . ">" . $role[1] . "</option>";
                                        }
                                        $options .= $option;
                                    }
                                    $trBlock .= "
                                                    <tr id='$row[0]'>
                                                        <td>" . $row[0] . "</td>
                                                        <td><textarea name='user-name'>" . $row[1] . "</textarea></td>
                                                        <td><textarea name='user-email'>" . $row[2] . "</textarea></td>
                                                        <td><textarea name='user-phone'>" . $row[3] . "</textarea></td>
                                                        <td>" . $row[5] . "</td>
                                                        <td><select class='user-role'>" . $options . "</select></td>
                                                        <td>
                                                            <button class='change-user__button' id='" . $row[0] . "'></button>
                                                            <button class='delete-user__button' id='" . $row[0] . "'></button>
                                                        </td>
                                                    </tr>";
                                }
                            }
                            echo $trBlock;
                            echo "</tbody>";
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php
    // require 'footer-white.php' 
    ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Обработчик для таблицы мастера
            var masterTableAdd = document.querySelector('.table__to-add.master');
            masterTableAdd.addEventListener('input', function(event) {
                const target = event.target;
                // Проверяем, является ли элемент textarea с классом "digitsOnly"
                if (target.classList.contains('digitsOnly')) {
                    const text = target.value;
                    target.value = text.replace(/\D/g, ''); // Оставляем только цифры
                }
            });
            // Обработчик для таблицы мастера
            var masterTable = document.querySelector('.table__to-update-delete.master');
            masterTable.addEventListener('input', function(event) {
                const target = event.target;
                // Проверяем, является ли элемент textarea с классом "digitsOnly"
                if (target.classList.contains('digitsOnly')) {
                    const text = target.value;
                    target.value = text.replace(/\D/g, ''); // Оставляем только цифры
                }
            });

            // Обработчик для таблицы услуг
            var serviceTableAdd = document.querySelector('.table__to-add.service');
            serviceTableAdd.addEventListener('input', function(event) {
                const target = event.target;
                // Проверяем, является ли элемент textarea с классом "digitsOnly"
                if (target.classList.contains('digitsOnly')) {
                    const text = target.value;
                    target.value = text.replace(/\D/g, ''); // Оставляем только цифры
                }
            });
            // Обработчик для таблицы услуг
            var serviceTable = document.querySelector('.table__to-update-delete.service');
            serviceTable.addEventListener('input', function(event) {
                const target = event.target;
                // Проверяем, является ли элемент textarea с классом "digitsOnly"
                if (target.classList.contains('digitsOnly')) {
                    const text = target.value;
                    target.value = text.replace(/\D/g, ''); // Оставляем только цифры
                }
            });

            // Обработчик для таблицы услуг
            var recordTableAdd = document.querySelector('.table__to-add.record');
            recordTableAdd.addEventListener('input', function(event) {
                const target = event.target;
                // Проверяем, является ли элемент textarea с классом "digitsOnly"
                if (target.classList.contains('digitsOnly')) {
                    const text = target.value;
                    target.value = text.replace(/\D/g, ''); // Оставляем только цифры
                }
            });
        });
    </script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script src="../js/tabs-admin-panel.js"></script>


    <script src="../libraries/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

    <!-- <script src="../js/openPopupSignInUp.js"></script> -->

    <script src="../js/admin-panel-ajax/master-handler-script.js"></script>
    <!-- <script src="../js/admin-panel-ajax/delete-master.js"></script>
    <script src="../js/admin-panel-ajax/update-master.js"></script> -->

    <script src="../js/admin-panel-ajax/service-handler-script.js"></script>
    <!-- <script src="../js/admin-panel-ajax/delete-service.js"></script>
    <script src="../js/admin-panel-ajax/update-service.js"></script> -->

    <script src="../js/admin-panel-ajax/service-type-for-service.js"></script>

    <script src="../js/admin-panel-ajax/add-wheel.js"></script>
    <script src="../js/admin-panel-ajax/update-wheel.js"></script>
    <script src="../js/admin-panel-ajax/delete-wheel.js"></script>

    <script type="module" src="../js/admin-panel-ajax/change_record_status.js"></script>
    <script type="module" src="../js/admin-panel-ajax/add-record.js"></script>
    <script type="module" src="../js/admin-panel-ajax/delete-record.js"></script>

    <script type="module" src="../js/admin-panel-ajax/change-feedback-status.js"></script>
    <script type="module" src="../js/admin-panel-ajax/change-service-review-status.js"></script>
    <script type="module" src="../js/admin-panel-ajax/change-master-review-status.js"></script>

    <script src="../js/admin-panel-ajax/master-service-handler.js"></script>

    <script src="../js/admin-panel-ajax/service-type-handler.js"></script>

    <script src="../js/admin-panel-ajax/user-handler.js"></script>


    <script src="../js/preloader.js"></script>

    <!-- <script src="../js/admin-panel-ajax/add-service.js"></script>
    <script src="../js/admin-panel-ajax/delete-service.js"></script>
    <script src="../js/admin-panel-ajax/update-service.js"></script> -->

</body>

</html>