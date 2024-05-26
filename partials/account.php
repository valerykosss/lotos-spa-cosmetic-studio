<?php
require_once "../handlers/isAdmin.php";

require '../database/db.php';
require_once "../handlers/isAdmin.php";



if (session_id() == '')
    session_start();
if ($isAdmin == true || $isMaster == true || !isset($_SESSION['UserID'])) {
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

if ($user_avatar['avatar'] == NULL) {
    $avatar = "../images/icons/avatar.png";
} else {
    $avatar = $user_avatar['avatar'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Аккаунт пользователя</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" />
    <!-- <link rel="stylesheet" href="../css/admin-panel.css"> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/ru.js"></script>


    <link rel="stylesheet" href="../css/generalStyles.css">
    <link rel="stylesheet" href="../css/buttons.css">
    <!-- <link rel="stylesheet" href="../css/admin-panel.css"> -->
    <link rel="stylesheet" href="../css/header-white.css">
    <link rel="stylesheet" href="../css/footer-white.css">

    <link rel="stylesheet" href="../css/popupSignInUp.css">
    <link rel="stylesheet" href="../css/account.css">


</head>
<style>
    /* input[type="text"],
    input[type="email"] {
        border: 1px solid black;
        width: 200px;
        height: 40px
    }

    textarea {
        border: 1px solid black;
    } */
</style>

<body>
    <!-- <div class="preloader">
        <div class="preloader__row">
            <div class="preloader__item"></div>
            <div class="preloader__item"></div>
        </div>
    </div> -->
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

        <section style="background-color: #355D48;">
            <textarea id="reviewText" placeholder="Напишите ваш отзыв..."></textarea>
            <div id="stars">
                <span class="star" data-rating="1"><img src="../images/icons/review-star-empty.svg" class="star-img"></span>
                <span class="star" data-rating="2"><img src="../images/icons/review-star-empty.svg" class="star-img"></span>
                <span class="star" data-rating="3"><img src="../images/icons/review-star-empty.svg" class="star-img"></span>
                <span class="star" data-rating="4"><img src="../images/icons/review-star-empty.svg" class="star-img"></span>
                <span class="star" data-rating="5"><img src="../images/icons/review-star-empty.svg" class="star-img"></span>
            </div>
            <a href="#" id="submitReview">Оставить отзыв</a>
        </section>

        <section class="page__user-profile">
            <div class="user-profile__body _container">
                <div class="profile__menu">
                    <div class="menu__user-avatar tooltiped" >
                        <img class="avatar" src="<?php echo ($avatar); ?>" id="uploadButton">
                        <input type="file" id="fileInput" style="display: none;">
                        <div class="tooltip">
                            <div class="tooltip-content">Нажмите, чтобы поменять фото</div>
                        </div>
                    </div>
                    <div class="menu__user-name"><?php echo ($_SESSION['Name']); ?></div>
                    <div class="menu__user-tel"><?php echo ($user_phone['telephone']); ?></div>
                    <div class="menu__header">Личная информация</div>

                    <div class="menu-tab" data-target="area1">
                        <div class="arrow">
                            <span class="arrow-left"></span>
                            <span class="arrow-right"></span>
                        </div>
                        <div class="menu__tab-header">Изменить пароль</div>
                    </div>

                    <div class="menu__header">Процедуры</div>
                    <div class="menu-tab" data-target="area2">
                        <div class="arrow">
                            <span class="arrow-left"></span>
                            <span class="arrow-right"></span>
                        </div>
                        <div class="menu__tab-header">Мои записи</div>
                    </div>

                    <div class="menu-tab" data-target="area3">
                        <div class="arrow">
                            <span class="arrow-left"></span>
                            <span class="arrow-right"></span>
                        </div>
                        <div class="menu__tab-header">Оставить отзыв</div>
                    </div>
                </div>

                <div class="profile__area" id="area1">
                    <p class="area-title">Изменение пароля</p>

                    <div class="change-password__body _profile-area-container">

                        <div class="label-input__group-profile">
                            <label>Старый пароль</label>
                            <input type="password" name="old-password" class="old-password" placeholder="Введите старый пароль">
                        </div>

                        <div class="label-input__group-profile">
                            <label>Новый пароль</label>
                            <input type="password" name="new-password" class="new-password" placeholder="Введите новый пароль">
                        </div>

                        <div class="label-input__group-profile">
                            <label>Повтор нового пароль</label>
                            <input type="password" name="new-password-confirm" class="new-password-confirm" placeholder="Повторите новый пароль">
                        </div>

                        <div class="button" id="change-password">
                            <span class="details">Поменять</span>
                        </div>  

                    </div>
                </div>
                <div class="profile__area" id="area2">
                <!-- <p class="area-title-calendar">Мои записи</p> -->
                    <div id="calendar"></div>
                      <!-- Start Event Modal -->
                <div id="leaveModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 id="leave_title" class="modal-title"> Подробности записи</h4>
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">Закрыть</span></button>
                            </div>

                            <div class="modal-body">
                                <form>
                                    <input type="hidden" id="eventIdInput">

                                    <div class="form-group" id="master_name"></div>

                                    <div class="form-group" id="service_name"></div>

                                    <div class="form-group" id="price"></div>

                                    <div class="form-group" id="duration"></div>

                                    <div class="form-group" id="leave_start"></div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal" id="leaveDeleteBtn">Отменить запись</button>
                                <button type="button" class="btn btn-info" data-dismiss="modal">Выйти</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Event Modal -->

                <!-- Start Success Message Modal -->
                <div id="msgSuccessModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Успешно!</h4>
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">Закрыть</span></button>
                            </div>
                            <div class="modal-body">
                                <p>Расписание было успешно добавлено!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Success Message Modal -->

                <!-- Start Updated Message Modal -->
                <div id="msgUpdatedModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Расписание обновлено!</h4>
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                            </div>
                            <div class="modal-body">
                                <p>Расписание было успешно обновлено!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Закрыть</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Updated Message Modal -->

                <!-- Start Deleted Message Modal -->
                <div id="msgDeletedModal" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Расписание удалено!</h4>
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">Закрыть</span></button>
                            </div>
                            <div class="modal-body">
                                <p>Расписание было успешно удалено!</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info" data-dismiss="modal">Закрыть</button>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="profile__area" id="area3">отзывы</div>
            </div>
        </section>

    </main>
    <?php require_once 'footer-white.php' ?>
</body>
<!-- <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="../libraries/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
<script src="../js/admin-panel-ajax/change-master-data.js"></script> -->

<script src="../js/openPopupSignInUp.js"></script>
<script src="../js/preloader.js"></script>
<script src="../js/change-pass.js"></script>
<script src="../js/change-avatar.js"></script>
<script src="../js/leaveReviewRating.js"></script>

<script src="../js/account.js"></script>
<script src="../js/timetable-user.js"></script>


</html>