<?php
    require '../database/db.php';
    if (session_id() == '')
    session_start();

    $stype_id=$_GET['stype_id'];

    $stype=mysqli_query($link, "SELECT * FROM `service_type` WHERE `id_service_type`=$stype_id");
    $stype=mysqli_fetch_assoc($stype);

    $service_info=mysqli_query($link, "SELECT * FROM service WHERE id_service_type = $stype_id");
    $service_info=mysqli_fetch_assoc($service_info);
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лотос - Косметические процедуры</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/generalStyles.css">
    <link rel="stylesheet" href="../css/buttons.css">
    <link rel="stylesheet" href="../css/service-type-page.css">
    <link rel="stylesheet" href="../css/header-green.css">
    <link rel="stylesheet" href="../css/footer-green.css">

    <link rel="stylesheet" href="../css/sign-in-up.css">

    <script src="../libraries/jquery-3.6.0.min.js"></script>
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
        <section class="page__services-page">
            <div class="services-page__body _container">
                <div class="services-page__info-block">
                    <p class="services-header"><?php echo($stype['service_type_name'])?></p>
                    <p class="services-text">
                        Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более
                        менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных
                        выступлений в домашних условиях.
                    </p>
                </div>
            </div>
            </div>
        </section>
        <section class="page__services-catalog">
            <div class="services-catalog__body _container">
                <?php
                    $query = "SELECT * FROM service WHERE id_service_type = $stype_id";
                    require 'serviceCards.php'
                ?>

                <!-- <div class="card-service__body">
                    <img class="service-img" src="../images/specialist-slider/specialist-1.png" alt="">
                    <p class="service-name">Валерия Косс</p>
                    <p class="service-description">Косметолог</p>
                    <div class="service-button green-button">
                        <span class="details">ПОДРОБНЕЕ</span>
                    </div>
                </div> -->
            </div>
        </section>
        <section class="page__need-consult-block">
            <div class="need-consult-gray__body _container">
                <div class="need-consult-title-gray">необходима консультация?</div>
                <div class="need-consult-text-gray">Оставьте заявку на сайте наш специалист свяжется с вами и
                    проконсультирует по всем вопросам.</div>
                <div class="need-consult-button green-button">
                    <span class="details">ПОДРОБНЕЕ</span>
                </div>
            </div>
        </section>
    </main>

    <?php require 'footer-green.php' ?>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script src ="../libraries/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <script src="../js/signInUp.js"></script>
    <script src="../js/preloader.js"></script>

</body>

</html>