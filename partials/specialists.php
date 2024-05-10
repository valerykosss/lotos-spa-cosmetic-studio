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
    <link rel="stylesheet" href="../css/generalStyles.css">
    <link rel="stylesheet" href="../css/buttons.css">
    <link rel="stylesheet" href="../css/header-white.css">
    <link rel="stylesheet" href="../css/specialists.css">
    <link rel="stylesheet" href="../css/sign-in-up.css">
    <link rel="stylesheet" href="../css/need-consult-block-green.css">
    <link rel="stylesheet" href="../css/footer-white.css">

    <link rel="stylesheet" href="../css/popupBook.css">


    <script src="../libraries/jquery-3.6.0.min.js"></script>
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
        <section class="page__speialists-page">
            <div class="specialists-page__body _container">
                <div class="specialists-page__info-block">
                    <p class="specialists-header">специалисты</p>
                    <p class="specialists-text">
                        Специалисты центра массажа и косметологии "Лотос" — это высококвалифицированные профессионалы, обладающие глубокими знаниями и опытом в области оздоровления и красоты. Наша команда состоит из сертифицированных массажистов, косметологов и терапевтов, которые постоянно совершенствуют свои навыки и следят за последними тенденциями и инновациями в сфере SPA-ухода.
                    </p>
                    <div class="specialists-button green-button" class="button">
                        <span class="details">Записаться</span>
                    </div>

                    <div class="popup__bg">
                        <form class="popup">
                            <img src="../images/icons/exit.svg" class="close-popup">
                            <div class="booking-stages__wrapper">
                                <p class="stage-title active-stage">Услуга</p>
                                <p class="stage-title">Специалист</p>
                                <p class="stage-title">Дата и время</p>
                                <p class="stage-title">Детали записи</p>
                            </div>

                            <div class="service__data _container-window">
                                <div class="filters-service__body">

                                    <div class="filter-service__body-item">
                                        <input type="text" id="search_box-service" placeholder="Поиск услуги" name="search-service">
                                    </div>

                                    <div class="filter-service__body-item">
                                        <select class="sort-service" id="sort-selector-first__service">
                                            <option value="">Косметические услуги</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- <button class="reset-button">Сбросить все фильтры
                                            <span class="reset-icon"></span>
                                    </button> -->
                            </div>

                            <div class="services__body _container-window">
                                <p class="service-type__header">Косметические услуги</p>
                                <div class="service__item"> 
                                    <div class="service-item__img">
                                        <img src="../images/1.png">
                                    </div>
                                    <div class="service-item__info">
                                        <p class="service-name">консультация, глубокое очищение + маска по типу кожи</p>
                                        <p class="service-description">HELEO4™ – это запатентованная специализированная программа, разработанная для безопасного и комплексного омоложения кожи.</p>
                                        <p class="service-price">40 byn</p>
                                    </div>
                                    <div class="service-item__radio">
                                        <input type="radio">
                                    </div>
                                </div>
                            </div>



                        </form>
                    </div>

                </div>
            </div>
            </div>
        </section>
        <section class="page__specialists-catalog">

            <div class="filters-block _container">
                <div class="filters-block__body">
                    <div class="filters__body">
                        <div class="filter__body-item">
                            <input type="text" class="search-box" id="search_box" placeholder="Поиск специалиста" name="search">
                        </div>

                        <div class="filter__body-item">
                            <select class="sort" id="sort-selector-first">
                                <option value="popularity">По популярности</option>
                                <option value="rating">По рейтингу</option>
                                <option value="work_experience">По стажу</option>
                            </select>
                        </div>

                        <div class="filter__body-item">
                            <select class="sort" id="sort-selector-second">
                                <option value="" disabled selected hidden>По специализации</option>
                                <option value="all">Все</option>
                                <option value="massagist">Массажист</option>
                                <option value="cosmetologist">Косметолог</option>
                            </select>
                        </div>
                    </div>
                    <!-- <button class="reset-button">Сбросить все фильтры
                            <span class="reset-icon"></span>
                    </button> -->
                </div>
            </div>

            <div class="specialists-catalog__body _container" id="paginated-list" data-current-page="1" aria-live="polite">
                <?php

                $query = "SELECT 
                    m.id_master,
                    m.master_name,
                    m.master_surname,
                    m.master_photo,
                    m.position,
                    COUNT(pr.id_record) AS total_records
                FROM 
                    master m
                LEFT JOIN 
                    master_service ms ON m.id_master = ms.id_master
                LEFT JOIN 
                    procedure_record pr ON ms.id_master_service = pr.id_master_service GROUP BY 
             m.id_master,
             m.master_name,
             m.master_surname
         ORDER BY 
             total_records DESC;";
                require 'specialistCards.php'
                ?>
                <!-- <div class="card-specialist__body">
                    <img class="specialist-img" src="../images/specialist-slider/specialist-1.png" alt="">
                    <p class="specialist-name">Валерия Косс</p>
                    <p class="specialist-description">Косметолог</p>
                    <div class="specialist-button button">
                        <span class="details">ПОДРОБНЕЕ</span>
                    </div>
                </div>-->
            </div>

            <!-- <nav class="pagination-container">

                <button class="pagination-button" id="prev-button" aria-label="Previous page" title="Previous page">
                    &lt;
                </button>

                <div id="pagination-numbers"></div>

                <button class="pagination-button" id="next-button" aria-label="Next page" title="Next page">
                    &gt;
                </button>
            </nav> -->
        </section>
        <?php require_once 'need-consult-block-green.php' ?>
    </main>

    <?php require 'footer-white.php' ?>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- <script src="../js/pagination.js"></script> -->

    <script src="../libraries/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <script src="../js/signInUp.js"></script>

    <script src="../js/specialistsFilter.js"></script>
    <script src="../js/preloader.js"></script>
    <script src="../js/openBooking.js"></script>
</body>

</html>