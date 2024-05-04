<?php
    require '../database/db.php';
    if (session_id() == '')
    session_start();

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
    <link rel="stylesheet" href="../css/price-list.css">
    <link rel="stylesheet" href="../css/buttons.css">
    <link rel="stylesheet" href="../css/header-green.css">
    <link rel="stylesheet" href="../css/footer-green.css">

    <link rel="stylesheet" href="../css/sign-in-up.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

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
        <section class="page__price-list">
            <div class="price-list__body _container">
                <div class="service-type__header">косметические услуги</div>
                <div class="service-type__wrapper">
                    <div class="service-line">
                        <div class="left-column">
                            <p class="service-name"> «Целебное тепло» </p>
                            <p class="service-description">Релаксирующий спа-массаж с горячими камнями, чаепитие</p>
                        </div>
                        <div class="right-column">
                            <div class="service-duration">90 мин</div>
                            <div class="service-price">90 BYN</div>
                        </div>
                    </div>
                    <div class="service-line">
                        <div class="left-column">
                            <p class="service-name"> «Перезагрузка»  </p>
                            <p class="service-description">Классический массаж тела и лица,парафинотерапия рук и ног, чаепитие </p>
                        </div>
                        <div class="right-column">
                            <div class="service-duration">90 мин</div>
                            <div class="service-price">90 BYN</div>
                        </div>
                    </div>
                </div>
                <img src="../images/price-list-line.svg">
            </div>
        </section>
    </main>
    
    <?php require 'sign-in.php' ?>


    <?php require 'footer-green.php' ?>

<!-- ... -->


<!-- Далее ваши остальные скрипты -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

<script src="../libraries/swiper-bundle.min.js"></script>

<script src="../js/signInUp.js"></script>
<script src="../js/preloader.js"></script>

<!-- ... -->


</body>
</html>