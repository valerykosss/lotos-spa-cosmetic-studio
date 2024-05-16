<?php
    require '../database/db.php';
    require_once "../handlers/get_services_data_script.php";
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

    <link rel="stylesheet" href="../css/popupSignInUp.css">

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
                <?php
                foreach ($services_arr as $service_type => $services) {
                    echo ("<div class='service-type__header'>".$service_type."</div>");
                    echo("<div class='service-type__wrapper'>");
                    foreach ($services as $service) {
                        echo ("<div class='service-line'>
                                <div class='left-column'>
                                    <p class='service-name'> «".$service['name']."» </p>
                                    <p class='service-description'>".$service['description']."</p>
                                </div>
                                <div class='right-column'>
                                    <div class='service-duration'>".$service['duration']." мин</div>
                                    <div class='service-price'>".$service['price']." BYN</div>
                                </div>
                            </div>
                        ");
                    }
                    echo("</div>");
                    echo("<img class='price-list_line' src='../images/price-list-line.svg'>");
                }
                ?>
            </div>
        </section>
    </main>
    
    <?php require 'sign-in.php' ?>


    <?php require 'footer-green.php' ?>

<!-- ... -->


<!-- Далее ваши остальные скрипты -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

<script src="../libraries/swiper-bundle.min.js"></script>

<script src="../js/openPopupSignInUp.js"></script>
<script src="../js/preloader.js"></script>

<!-- ... -->


</body>
</html>