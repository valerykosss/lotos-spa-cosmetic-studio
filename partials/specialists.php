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
    <link rel="stylesheet" href="../css/header-white.css">
    <link rel="stylesheet" href="../css/specialists.css">
    <link rel="stylesheet" href="../css/buttons.css">
    <link rel="stylesheet" href="../css/popupSignInUp.css">
    <link rel="stylesheet" href="../css/need-consult-block-green.css">
    <link rel="stylesheet" href="../css/footer-white.css">

    <link rel="stylesheet" href="../css/popupBook.css">
    <link rel="stylesheet" href="../css/popUpErrorSuccess.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
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
                    <?php require 'popUpBook.php' ?>
                    <?php require 'popUpErrorSuccess.php' ?>
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

    <!-- <script src="../js/pagination.js"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <script src="../js/openPopupSignInUp.js"></script>

    <script src="../js/header.js"></script>

    <script src="../js/specialistsFilter.js"></script>
    <script src="../js/preloader.js"></script>
    
    <script src="../js/openBooking.js"></script>
    <script src="../js/serviceBooking.js"></script>

    <script src="../js/openErrorSuccess.js"></script>
    <!-- <script src="../js/signUpForProcedureFromMaster.js"></script> -->

</body>

</html>