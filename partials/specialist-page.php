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
    <title>Лотос - Специалисты</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/specialist-page.css">
    <link rel="stylesheet" href="../css/sign-in-up.css">
    <link rel="stylesheet" href="../css/sign-up-for-procedure-windows.css">

    <script src="../libraries/jquery-3.6.0.min.js"></script>
</head>

<body>
<?php require 'header-white.php' ?>
    <main>
        <section class="page__speialist-profile">
            <div class="specialist-profile__body _container">
                <div class="specialist-profile__photo">
                    <img src="../images/specialist-profile/specialist-profile-image.png" alt="">
                </div>
                <div class="specialist-profile__info-block">
                    <p class="info-block-name">ВАЛЕРИЯ КОСС</p>
                    <div class="info-block-rating-stars">
                        <p class="info-block-rating"> 4.7 </p>
                        <div class="info-block-star"></div>
                    </div>
                    <p class="info-block-specialization">Косметолог-эстетист с медицинским образованием</p>
                    <p class="info-block-description">Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях.</p>

                    <div class="info-block-gray">
                        <p class="info-block-gray-title">Образование:</p>
                        <div class="info-block-checkmark-text">
                            <div class="info-block-checkmark"></div>
                            <div class="info-block-text">Белорусский государственный университет физической <br> культуры, инструктор-методист ЛФК</div>
                        </div>
                    </div>

                    <div class="info-block-gray">
                        <p class="info-block-gray-title">Профессиональный стаж:</p>
                        <div class="info-block-checkmark-text">
                            <div class="info-block-checkmark"></div>
                            <div class="info-block-text">Более 8 лет</div>
                        </div>
                    </div>

                    <div class="info-block-gray">
                        <p class="info-block-gray-title">Cпециализации:</p>
                        <div class="info-block-checkmark-text">
                            <div class="info-block-checkmark"></div>
                            <div class="info-block-text">Массаж</div>
                        </div>

                        <div class="info-block-checkmark-text">
                            <div class="info-block-checkmark"></div>
                            <div class="info-block-text">Лечение акне</div>
                        </div>

                        <div class="info-block-checkmark-text">
                            <div class="info-block-checkmark"></div>
                            <div class="info-block-text">Пилинг</div>
                        </div>

                        <div class="info-block-checkmark-text">
                            <div class="info-block-checkmark"></div>
                            <div class="info-block-text">Анти-возрастные процедуры</div>
                        </div>

                        <div class="info-block-checkmark-text">
                            <div class="info-block-checkmark"></div>
                            <div class="info-block-text">Косметический массаж лица</div>
                        </div>
                    </div>

                    <div class="specialist-button green-button" id="1">
                        <span class="details">ЗАПИСАТЬСЯ</span>
                    </div>

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

            </div>
            <button id="sign-up-for-procedure__button" type="submit">Записаться</button>
        </form>
    </div>
    
    <?php require 'sign-in.php' ?>


    <?php require 'footer-white.php' ?>

    <script src ="../libraries/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <script src="../js/header.js"></script>

    <script src="../js/signUpForProcedureFromMaster.js"></script>
</body>
</html>