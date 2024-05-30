<?php

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

$last_procedure = mysqli_query($link, "SELECT 
pr.id_record, 
pr.id_master_service,
pr.record_date,
pr.record_time,
m.master_name, 
m.id_master, 
s.service_name, 
s.id_service, 
s.price, 
s.duration
FROM 
procedure_record pr
JOIN 
master_service ms ON pr.id_master_service = ms.id_master_service
JOIN 
master m ON ms.id_master = m.id_master
JOIN 
service s ON ms.id_service = s.id_service
WHERE 
pr.id_user = $user_id
AND pr.id_record_status = 2
AND CONCAT(pr.record_date, ' ', pr.record_time) = (
    SELECT 
        CONCAT(pr_inner.record_date, ' ', pr_inner.record_time)
    FROM 
        procedure_record pr_inner
    WHERE 
        pr_inner.id_user = pr.id_user
        AND pr_inner.id_record_status = 2
        AND CONCAT(pr_inner.record_date, ' ', pr_inner.record_time) < NOW()
    ORDER BY 
        CONCAT(pr_inner.record_date, ' ', pr_inner.record_time) DESC
    LIMIT 1
);");

$last_procedure = mysqli_fetch_assoc($last_procedure);

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> -->
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/ru.js"></script>


    <link rel="stylesheet" href="../css/generalStyles.css">
    <link rel="stylesheet" href="../css/buttons.css">
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

        <section class="page__user-profile">
            <div class="user-profile__body _container">
                <div class="profile__menu">
                    <div class="menu__user-avatar tooltiped">
                        <img class="avatar" src="<?php echo ($avatar); ?>" id="uploadButton">
                        <input type="file" id="fileInput" style="display: none;">
                        <div class="tooltip">
                            <div class="tooltip-content">Нажмите, чтобы поменять фото</div>
                        </div>
                    </div>
                    <div class="menu__user-name"><?php echo ($_SESSION['Name']); ?></div>
                    <div class="menu__user-tel"><?php echo ($user_phone['telephone']); ?></div>
                    <div class="menu__user-discount"> Скидка колеса фортуны: <br> <span> <?php echo ($user_discount['discount_name']) ?> </span> </div>
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
                <div class="profile__area" id="area3">
                    <p class="area-title">Отзывы</p>

                    <?php if ($last_procedure) { ?>
                        <div class="leave-review__body _profile-area-container">
                            <p class="procedure-info">Последняя посещенная вами процедура: <span><?php echo ($last_procedure['service_name']) ?></span></p>
                            <label>Ваш отзыв на услугу</label>
                            <textarea id="serviceReviewText" data-service-id="<?php echo ($last_procedure['id_service']) ?>" placeholder="Напишите ваш отзыв..."></textarea>
                            <label>Ваш рейтинг на услугу</label>
                            <div id="serviceStars" data-service-id="<?php echo ($last_procedure['id_service']) ?>">
                                <span class="star" data-rating="1"><img src="../images/icons/review-star-empty-new.svg" class="star-img"></span>
                                <span class="star" data-rating="2"><img src="../images/icons/review-star-empty-new.svg" class="star-img"></span>
                                <span class="star" data-rating="3"><img src="../images/icons/review-star-empty-new.svg" class="star-img"></span>
                                <span class="star" data-rating="4"><img src="../images/icons/review-star-empty-new.svg" class="star-img"></span>
                                <span class="star" data-rating="5"><img src="../images/icons/review-star-empty-new.svg" class="star-img"></span>
                            </div>
                            <div class="button review-button" id="submitServiceReview">
                                <span class="details">Оставить</span>
                            </div>
                        </div>

                        <p class="border"></p>

                        <div class="leave-review__body _profile-area-container">
                            <p class="procedure-info">Мастер, который выполнял эту процедуру: <span><?php echo ($last_procedure['master_name']) ?></span></p>
                            <label>Ваш отзыв о мастере</label>
                            <textarea id="masterReviewText" data-master-id="<?php echo ($last_procedure['id_master']) ?>" placeholder="Напишите ваш отзыв..."></textarea>
                            <label>Ваш рейтинг мастеру</label>
                            <div id="masterStars" data-master-id="<?php echo ($last_procedure['id_master']) ?>">
                                <span class="star" data-rating="1"><img src="../images/icons/review-star-empty-new.svg" class="star-img"></span>
                                <span class="star" data-rating="2"><img src="../images/icons/review-star-empty-new.svg" class="star-img"></span>
                                <span class="star" data-rating="3"><img src="../images/icons/review-star-empty-new.svg" class="star-img"></span>
                                <span class="star" data-rating="4"><img src="../images/icons/review-star-empty-new.svg" class="star-img"></span>
                                <span class="star" data-rating="5"><img src="../images/icons/review-star-empty-new.svg" class="star-img"></span>
                            </div>
                            <div class="button review-button" id="submitMasterReview">
                                <span class="details">Оставить</span>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if (!$last_procedure) {
                        echo "<p class='procedure-info'>У вас еще нет записей!</p>";
                    } ?>
                </div>

            </div>
        </section>

    </main>
    <?php require_once 'footer-white.php' ?>
</body>
<!-- <script src="../libraries/jquery-3.6.0.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script src="../js/openPopupSignInUp.js"></script>
<script src="../js/preloader.js"></script>
<script src="../js/change-pass.js"></script>
<script src="../js/change-avatar.js"></script>
<script src="../js/leaveReviewRating.js"></script>

<script src="../js/account.js"></script>
<script src="../js/timetable-user.js"></script>


</html>