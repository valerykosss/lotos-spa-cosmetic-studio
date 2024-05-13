<?php
require '../database/db.php';
if (session_id() == '')
    session_start();

$master_id = $_GET['spec_id'];

$master_reviews=mysqli_query($link, "SELECT master_rating.id_master_rating, master.master_name, user.name, master_rating, master_review, review_date, user.avatar
FROM `master_rating`
INNER JOIN `master` ON master_rating.id_master=master.id_master
INNER JOIN user ON master_rating.id_user=user.id_user
WHERE `master_rating`.`id_master`=$master_id AND `master_rating`.`status`='Одобрен'");

$master_data = mysqli_query($link, "SELECT * FROM `master` WHERE `id_master`=$master_id");
$master_data = mysqli_fetch_assoc($master_data);

$master_services = mysqli_query($link, "SELECT distinct `service_type`.`service_type_name` FROM `master_service`
                                            inner join `service` on `master_service`.`id_service`=`service`.`id_service`
                                            inner join `service_type` on `service`.`id_service_type`=`service_type`.`id_service_type`
                                            WHERE `id_master`=$master_id");
$master_services = mysqli_fetch_all($master_services);

$master_rating = mysqli_query($link, "SELECT * FROM `master_rating` WHERE `id_master`=$master_id");
$master_rating = mysqli_fetch_all($master_rating);

$all_rating = 0;
$rating = 0;
$rating_length = count($master_rating);

if ($rating_length != 0) {
    foreach ($master_rating as $item) {
        $all_rating = $all_rating + (int)$item[3];
    }
    $rating = $all_rating / $rating_length;
}

// Функция для получения русского названия месяца
function russianMonth($monthNumber) {
    $months = array(
        'января', 'февраля', 'марта',
        'апреля', 'мая', 'июня',
        'июля', 'августа', 'сентября',
        'октября', 'ноября', 'декабря'
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
    <title>Лотос - Специалист</title>
    <link rel="stylesheet" href="../libraries/swiper-bundle.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="../css/generalStyles.css">
    <link rel="stylesheet" href="../css/buttons.css">
    <link rel="stylesheet" href="../css/specialist-page.css">
    <link rel="stylesheet" href="../css/header-white.css">
    <link rel="stylesheet" href="../css/footer-green.css">


    <link rel="stylesheet" href="../css/sign-in-up.css">
    <link rel="stylesheet" href="../css/sign-up-for-procedure-windows.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/ru.js"></script>

    <style>
        .fc-event,
        .fc-event-dot {
            background-color: #38624C;
            /* красный цвет фона */
            border: 1px solid #38624C;
        }

        .light-grey-background {
            background-color: lightgrey !important;
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
    <?php require 'header-white.php' ?>
    <main>
        <section class="page__speialist-profile">
            <div class="specialist-profile__body _container">
                <div class="specialist-profile__photo">
                    <img src="<?php echo ($master_data['master_photo']); ?>" alt="">
                </div>
                <div class="specialist-profile__info-block">
                    <p class="info-block-name"><?php echo ($master_data['master_name'] . " " . $master_data['master_surname']); ?></p>
                    <p class="info-block-specialization"><?php echo ($master_data['position']); ?></p>
                    <div class="info-block-rating-stars">
                        <p class="info-block-rating"> <?php echo ($rating); ?> </p>
                        <div class="info-block-star"></div>
                    </div>

                    <div class="info-block-gray">
                        <p class="info-block-gray-title">Профессиональная подготовка:</p>
                        <div class="info-block-checkmark-text">
                            <div class="info-block-checkmark"></div>
                            <div class="info-block-text"><?php echo ($master_data['education']); ?></div>
                        </div>
                    </div>

                    <div class="info-block-gray">
                        <p class="info-block-gray-title">Профессиональный стаж:</p>
                        <div class="info-block-checkmark-text">
                            <div class="info-block-checkmark"></div>
                            <div class="info-block-text"><?php echo ($master_data['work_experience']); ?> лет</div>
                        </div>
                    </div>

                    <div class="info-block-gray">
                        <p class="info-block-gray-title">Cпециализации:</p>
                        <?php
                        foreach ($master_services as $master_service) {
                            echo ("
                                    <div class='info-block-checkmark-text'>
                                        <div class='info-block-checkmark'></div>
                                        <div class='info-block-text'>" . $master_service[0] . "</div>
                                    </div>
                                ");
                        }
                        ?>

                    </div>
                    <?php
                    if (isset($_SESSION['UserID'])) {
                        echo "<div class='specialist-button green-button' id=" . $master_id . ">
                        <span class='details'>ЗАПИСАТЬСЯ</span>
                    </div>";
                    }
                    ?>

                </div>
            </div>
        </section>
        <section class="page__review">
            <div class="review__body">

                <!-- <div class="review__body-reviews">

                    <div class="review__card">
                        <img class="icon" src="../images/icons/review-profile-default-icon.svg">
                        <div class="text">
                            <p class="text_name-review-date">Яна Тараканова, 6 апр. 2024 г.</p>
                            <p class="text_review-text">Очень полюбила этот салон. Прекрасные, доброжелательные профессиональные специалисты. Сервис очень хороший.Все продумано до мелочей,что вызывает доверие и надежность. Спасибо за заботу о клиентах,чувствуешь себя как дома. Результат чувствую после каждого посещения. Спасибо за такую организацию!</p>
                        </div>
                        <div class="stars">
                            <img src="../images/icons/review-star.svg">
                            <img src="../images/icons/review-star.svg">
                            <img src="../images/icons/review-star.svg">
                            <img src="../images/icons/review-star.svg">
                            <img src="../images/icons/review-star.svg">
                        </div>
                    </div>

                </div> -->
                <?php if(mysqli_num_rows($master_reviews)>0)
                    {
                        $master_reviews=mysqli_fetch_all($master_reviews);
                        ?>
                <div class="swiper mySwiper">
                <div class="review__body-header">
                    <p>Отзывы</p>
                    <div class="swiper-navigation-container">
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                    </div>
                </div>
                    <div class="swiper-wrapper">
                        <?php
                            foreach($master_reviews as $master_review){
                                $date = strtotime($master_review[5]); // Преобразование строки в дату
                                $day = date('j', $date);
                                $month = date('n', $date);
                                $date = $day . ' ' . russianMonth($month);

                                $star="<img src='../images/icons/review-star.svg'>";
                                $stars="";
                                for($i=0; $i<$master_review[3]; $i++){
                                    $stars.=$star;
                                }

                                if($master_review[6]==NULL||$master_review[6]==""){
                                    $avatar="../images/icons/review-profile-default-icon.svg";
                                }else{
                                    $avatar=$master_review[6];
                                }

                                echo("
                                    <div class='swiper-slide'>
                                        <div class='review__card'>
                                            <img class='icon' src='".$avatar."'>
                                            <div class='text'>
                                                <p class='text_name-review-date'>".$master_review[2].", ".$date."</p>
                                                <p class='text_review-text'>".$master_review[4]."</p>
                                            </div>
                                            <div class='stars'>".$stars."</div>
                                        </div>
                                    </div>
                                ");
                            }
                        ?>
                    </div>
                </div>
                <?php }?>

            </div>

        </section>
    </main>

    <div id="sign-up-for-procedure__window">
        <form id="sign-up-for-procedure__form">
            <a href="#" class="close__form">
                <img class="close__form-image" height="35px" width="35px" src="../images/icons/cross.svg" />
            </a>
            <div id="sign-up-for-procedure__data">
                <select id="masters__data"></select>
                <select id="services__data"></select>
                <div id="calendar"></div>

            </div>
            <a id="sign-up-for-procedure__button">Записаться</a>
        </form>
    </div>

    <?php require 'sign-in.php' ?>


    <?php require 'footer-green.php' ?>


    <!-- Далее ваши остальные скрипты -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

    <script src="../libraries/swiper-bundle.min.js"></script>

    <script src="../js/signInUp.js"></script>
    <script src="../js/signUpForProcedureFromMaster.js"></script>
    <script src="../js/preloader.js"></script>
    <script src="../js/specialistPageReviewsSlider.js"></script>


</body>

</html>