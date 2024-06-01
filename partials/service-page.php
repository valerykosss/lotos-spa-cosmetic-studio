<?php
    require '../database/db.php';
    if (session_id() == '')
    session_start();

    $service_id=$_GET['service_id'];

    $service_reviews=mysqli_query($link, "SELECT id_service_rating, user.name, service.service_name, service_review, service_rating, review_date, user.avatar
    FROM service_rating
    INNER JOIN user ON service_rating.id_user=user.id_user
    INNER JOIN service ON service_rating.id_service=service.id_service
    WHERE service_rating.id_service=$service_id AND `service_rating`.`status`='Одобрен'");

    $service_data=mysqli_query($link, "SELECT `service_name`, `service_image`, `service_description`,  `duration`, `price`, `insication`, `results`  FROM `service` WHERE `id_service`=$service_id");
    $service_data=mysqli_fetch_assoc($service_data);
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
    <title>Лотос - Услуга </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../libraries/swiper-bundle.css">

    <link rel="stylesheet" href="../css/generalStyles.css">
    <link rel="stylesheet" href="../css/service-page.css">
    <link rel="stylesheet" href="../css/buttons.css">
    <link rel="stylesheet" href="../css/header-green.css">

    <link rel="stylesheet" href="../css/footer-green.css">

    <link rel="stylesheet" href="../css/popUpErrorSuccess.css">

    <link rel="stylesheet" href="../css/popupSignInUp.css">
    <link rel="stylesheet" href="../css/popupBook.css">
    <link rel="stylesheet" href="../css/need-consult-block-white.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/locale/ru.js"></script>

    <style>
        .fc-event, .fc-event-dot{
        background-color: #38624C; /* красный цвет фона */
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
<?php require 'header-green.php' ?>
    <main>
        <!-- <section class="page__speialist-profile">
            <div class="specialist-profile__body _container">
                <div class="specialist-profile__photo">
                    <img src="..<?php //echo($service_data['service_image']);?>" alt="">
                </div>
                <div class="specialist-profile__info-block">
                    <p class="info-block-name"><?php //echo($service_data['service_name']);?></p>
                    
                    <p class="info-block-specialization"></p>
                    <p class="info-block-description"><?php //echo($service_data['service_description']);?></p>

                    <div class="info-block-gray">
                        <p class="info-block-gray-title">Длительность процедуры:</p>
                        <div class="info-block-checkmark-text">
                            <div class="info-block-checkmark"></div>
                            <div class="info-block-text"><?php //echo($service_data['duration']);?> минут</div>
                        </div>
                    </div>

                    <div class="info-block-gray">
                        <p class="info-block-gray-title">Строимость процедуры:</p>
                        <div class="info-block-checkmark-text">
                            <div class="info-block-checkmark"></div>
                            <div class="info-block-text"><?php //echo($service_data['price']);?> рублей</div>
                        </div>
                    </div>

                    <?php
                    // if(isset($_SESSION['UserID'])) {
                    //     echo "<div class='service-button green-button' id=". $service_id.">
                    //     <span class='details'>ЗАПИСАТЬСЯ</span>
                    // </div>";
                    // }
                    ?>

                </div>
            </div>
        </section> -->

        <section class="page__service-page">
            <div class="service-page__body _container" style="background-image: url('<?php echo($service_data['service_image']);?>');">
                <div class="service__info">
                    <p class="service__info-name"><?php echo($service_data['service_name']);?></p>
                    <p class="service__info-description"><?php echo($service_data['service_description']);?></p>
                    <div class='service-button green-button' id="<?php echo($service_id)?>" data-duration="<?php echo($service_data['duration']) ?>">
                        <span class='details'>ЗАПИСАТЬСЯ</span>
                    </div>
                </div>
                <div class="service__tag-column">
                    <div class="service__tag">
                            <p class="service__tag-duration">Длительность процедуры: <span> <?php echo($service_data['duration']);?> мин </span></p>
                            <p class="service__tag-price">Стоимость:  <span> <?php echo($service_data['price']);?> руб</span></p> 
                    </div>
                </div>
            </div>
            <div class="service-insication__body _container">
                <div class="insication-text__wrapper">
                    <div class="insication-header">показания:</div>
                    <ul class="insication-list">
                        <?php
                            $insications=explode(", ", $service_data['insication']);
                            foreach($insications as $insication){
                                echo("<li>".$insication."</li>");
                            }
                        ?>
                    </ul>
                </div>

                <div class="insication-photo__wrapper">
                    <img src="<?php echo($service_data['service_image']);?>">
                </div>

            </div>

            <div class="service-result__body _container">
                <div class="results-text__wrapper">
                    <div class="results-header">результаты:</div>
                    <ul class="results-list">
                        <?php
                            $results=explode(", ", $service_data['results']);
                            foreach($results as $result){
                                echo("<li>".$result."</li>");
                            }
                        ?>
                    </ul>
                </div>

                <div class="results-photo__wrapper">
                    <img src="<?php echo($service_data['service_image']);?>">
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
                <?php if(mysqli_num_rows($service_reviews)>0)
                    {
                        $service_reviews=mysqli_fetch_all($service_reviews);
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
                            foreach($service_reviews as $service_review){
                                $date = strtotime($service_review[5]); // Преобразование строки в дату
                                $day = date('j', $date);
                                $month = date('n', $date);
                                $date = $day . ' ' . russianMonth($month);

                                $star="<img src='../images/icons/review-star.svg'>";
                                $stars="";
                                for($i=0; $i<$service_review[4]; $i++){
                                    $stars.=$star;
                                }

                                if($service_review[6]==NULL||$service_review[6]==""){
                                    $avatar="../images/icons/review-profile-default-icon.svg";
                                }else{
                                    $avatar=$service_review[6];
                                }

                                echo("
                                    <div class='swiper-slide'>
                                        <div class='review__card'>
                                            <img class='icon' src='".$avatar."'>
                                            <div class='text'>
                                                <p class='text_name-review-date'>".$service_review[1].", ".$date."</p>
                                                <p class='text_review-text'>".$service_review[3]."</p>
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
    
    <?php require 'sign-in.php' ?>
    <?php require 'popUpBookFromService.php' ?>
    <?php require 'popUpErrorSuccess.php' ?>


    <?php require_once 'need-consult-block-white.php' ?>

    <?php require 'footer-green.php' ?>

<!-- ... -->


<!-- Далее ваши остальные скрипты -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

<script src="../libraries/swiper-bundle.min.js"></script>

<script src="../js/openPopupSignInUp.js"></script>

<script src="../js/preloader.js"></script>
<script src="../js/servicePageReviewsSlider.js"></script>

<script src="../js/openBookingFromService.js"></script>
    <script src="../js/fromServiceBooking.js"></script>

    <script src="../js/openErrorSuccess.js"></script>

<!-- ... -->


</body>
</html>