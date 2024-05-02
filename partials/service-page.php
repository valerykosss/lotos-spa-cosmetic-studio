<?php
    require '../database/db.php';
    if (session_id() == '')
    session_start();

    $service_id=$_GET['service_id'];

    $service_data=mysqli_query($link, "SELECT `service_name`, `service_image`, `service_description`,  `duration`, `price`  FROM `service` WHERE `id_service`=$service_id");
    $service_data=mysqli_fetch_assoc($service_data);

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лотос - Услуга </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/specialist-page.css">
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
<?php require 'header-white.php' ?>
    <main>
        <section class="page__speialist-profile">
            <div class="specialist-profile__body _container">
                <div class="specialist-profile__photo">
                    <img src="..<?php echo($service_data['service_image']);?>" alt="">
                </div>
                <div class="specialist-profile__info-block">
                    <p class="info-block-name"><?php echo($service_data['service_name']);?></p>
                    
                    <p class="info-block-specialization"></p>
                    <p class="info-block-description"><?php echo($service_data['service_description']);?></p>

                    <div class="info-block-gray">
                        <p class="info-block-gray-title">Длительность процедуры:</p>
                        <div class="info-block-checkmark-text">
                            <div class="info-block-checkmark"></div>
                            <div class="info-block-text"><?php echo($service_data['duration']);?> минут</div>
                        </div>
                    </div>

                    <div class="info-block-gray">
                        <p class="info-block-gray-title">Строимость процедуры:</p>
                        <div class="info-block-checkmark-text">
                            <div class="info-block-checkmark"></div>
                            <div class="info-block-text"><?php echo($service_data['price']);?> рублей</div>
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


    <?php require 'footer-white.php' ?>

<!-- ... -->


<!-- Далее ваши остальные скрипты -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

<script src="../js/signInUp.js"></script>
<script src="../js/signUpForProcedureFromMaster.js"></script>
<script src="../js/preloader.js"></script>

<!-- ... -->


</body>
</html>