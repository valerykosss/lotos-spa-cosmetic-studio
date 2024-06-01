<?php

require_once "../handlers/isAdmin.php";
require_once "../handlers/isWheelSpinned.php";
require_once "../handlers/get_swiper_data_script.php";
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лотос - Главная</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../libraries/swiper-bundle.css">

    <link rel="stylesheet" href="../libraries/splide.min.css">
    <script src="../libraries/splide.min.js"></script>

    <script src="../libraries/splide-extension-auto-scroll.min.js"></script>
    <link rel="stylesheet" href="../css/generalStyles.css">
    <link rel="stylesheet" href="../css/buttons.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/header-green.css">
    <link rel="stylesheet" href="../css/footer-white.css">
    <link rel="stylesheet" href="../css/wheel.css">

    <link rel="stylesheet" href="../css/popupSignInUp.css">
</head>

<body>
    <div class="preloader">
        <div class="preloader__row">
            <div class="preloader__item"></div>
            <div class="preloader__item"></div>
        </div>
    </div>
    <?php require 'header-green.php' ?>

    <main class="page">
        <section class="page__slider">
            <!-- First Swiper -->
            <div class="swiper-container swiper1 _container">
                <!-- <div class="swiper-wrapper">
                    <div class="swiper-slide background" style="background-image: url('../images/main-page-slider/kosmeticheskie-proczedury-fon.png'); background-size: cover;">
                    </div>
                    <div class="swiper-slide background" style="background-image: url('../images/main-page-slider/spa-programmy-fon.png'); background-size: cover;"></div>
                    <div class="swiper-slide background" style="background-image: url('../images/main-page-slider/massage-lica-fon.png'); background-size: cover;">
                    </div>
                    <div class="swiper-slide background" style="background-image: url('../images/main-page-slider/massage-tela-fon.png'); background-size: cover;">
                    </div>
                </div> -->

                <div class="swiper-container swiper1 _container">
                    <div class="swiper-wrapper">
                    <?php

                    foreach ($first_swiper as $item) {
                        if($item[2]== 'NULL' || $item[3]== 'NULL'){
                            continue;
                        }
                        echo (" <div class='swiper-slide background' style='background-image: url(.." . $item[3] . "); background-size: cover;'></div>");
                    }
                    ?>
                    </div>
                </div>

                <div class="swiper-pagination"></div>

                <div class="swiper-navigation-container">
                    <div class="swiper-button-next">Далее</div>
                    <div class="swiper-button-prev">Назад</div>
                </div>

                <div class="slider-counter">
                    <span class="slider-counter-current-number"></span>/04
                </div>

            </div>

            <!-- Second Swiper -->
            <div class="swiper-container swiper2 _container-main-slider">
                <div class="swiper-wrapper">
                    <?php
                    foreach ($first_swiper as $item) {
                        if($item[2]== 'NULL' || $item[3]== 'NULL'){
                            continue;
                        }
                        echo ("
                                <div class='swiper-slide front'
                                    style='background-image: url(.." . $item[2] . "); background-size: cover;'>
                                    <p>" . $item[1] . "</p>
            
                                    <div class='button'>
                                        <a href='service-type-page.php?stype_id=" . $item[0] . "' style='color: #333; text-decoration:none'>
                                            <span class='details'>ПОДРОБНЕЕ</span>
                                        </a>
                                        
                                    </div>
                                </div>
                            ");
                    }
                    ?>

                    <!-- <div class="swiper-slide front"
                        style="background-image: url('../images/main-page-slider/spa-programmy-glavnaya.png'); background-size: cover;">
                        <p>Cпа-программы</p>

                        <div class="button">
                            <span class="details">ПОДРОБНЕЕ</span>
                        </div>
                    </div>
                    <div class="swiper-slide front"
                        style="background-image: url('../images/main-page-slider/massage-lica-glavnaya.png'); background-size: cover;">
                        <p>Массаж лица</p>

                        <div class="button">
                            <span class="details">ПОДРОБНЕЕ</span>
                        </div>
                    </div>
                    <div class="swiper-slide front"
                        style="background-image: url('../images/main-page-slider/massage-tela-glavnaya.png'); background-size: cover;">
                        <p>Массаж тела</p>

                        <div class="button">
                            <span class="details">ПОДРОБНЕЕ</span>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>
        <section class="page__about-us">
            <div class="about-us__body _container">
                <div class="about-us__icons-block">
                    <div class="icons-block__row">
                        <div class="icon-block">
                            <img class="icon" src="../images/icons/stars.svg">
                            <p class="text">Лучший персонал
                        </div>

                        <div class="icon-block">
                            <img class="icon" src="../images/icons/lock.svg">
                            <p class="text">Надежность
                        </div>
                    </div>

                    <div class="icons-block__row">

                        <div class="icon-block">
                            <img class="icon" src="../images/icons/drops.svg">
                            <p class="text">Чистота и порядок
                        </div>

                        <div class="icon-block">
                            <img class="icon" src="../images/icons/trophy.svg">
                            <p class="text">Результат
                        </div>
                    </div>

                </div>

                <div class="about-us__info-block">
                    <div class='info-block__header-text'>
                        <p class="info-block__header">lotos &mdash;</p>
                        <p class="info-block__text">
                            Наша миссия – помочь вам обрести гармонию и баланс в жизни, достигнуть внутреннего равновесия и спокойствия. "Центр Лотос" предлагает широкий спектр услуг для улучшения физического и психологического состояния. Отдайте время себе, позвольте себе расслабиться и восстановить силы в нашем уютном и спокойном центре.
                        </p>
                    </div>
                    <a href="about-us.php">
                        <div class="info-block__button button">
                            <span class="details">ПОДРОБНЕЕ</span>
                        </div>
                    </a>
                </div>
            </div>
            </div>
        </section>
        <section class="page__specialists">
            <div class="specialists__body">
                <div class="specialists-title-button  _container">
                    <div class="specialists-title">Специалисты</div>
                    <a class="specialists-button" href="specialists.php"> Все специалисты </a>
                </div>
                <div class="tab">
                    <div class="radio-buttons__body _container">
                        <input checked id="tab-btn-1" name="tab-btn" type="radio" value="">
                        <label for="tab-btn-1">Все</label>

                        <input id="tab-btn-2" name="tab-btn" type="radio" value="">
                        <label for="tab-btn-2">Косметические услуги</label>

                        <input id="tab-btn-3" name="tab-btn" type="radio" value="">
                        <label for="tab-btn-3">Спа программы</label>

                        <input id="tab-btn-4" name="tab-btn" type="radio" value="">
                        <label for="tab-btn-4">Массаж</label>

                    </div>


                    <div class="tab-content" id="content-1">
                        <div class="auto-scroll-wrap">
                            <div id="splide-autoscroll-1" class="splide">
                                <div class="splide__track">
                                    <ul class="splide__list">
                                        <?php
                                        foreach ($all_masters as $master) {
                                            echo ("
                                                <li class='splide__slide'>
                                                    <img class='slide-img' src='" . $master[3] . "'
                                                        alt=''>
                                                    <p class='slide-name'>" . $master[1] . " " . $master[2] . "</p>
                                                    <p class='slide-description'>" . $master[6] . "</p>
                                                    <a style='display: flex; justify-content: center;' href='specialist-page.php?spec_id=" . $master[0] . "'> 
                                                        <div class='slide-button button'>
                                                            <span class='details'>ПОДРОБНЕЕ</span>
                                                        </div>
                                                    </a>
                                                </li>
                                                ");
                                        }
                                        ?>

                                        <!-- <li class="splide__slide">
                                            <img class="slide-img" src="../images/specialist-slider/specialist-2.png"
                                                alt="">
                                            <p class="slide-name">Валерия Косс</p>
                                            <p class="slide-description">Косметолог</p>
                                            <div class="slide-button button">
                                                <span class="details">ПОДРОБНЕЕ</span>
                                            </div>  
                                        </li>
                                        <li class="splide__slide">
                                            <img class="slide-img" src="../images/specialist-slider/specialist-3.png"
                                                alt="">
                                            <p class="slide-name">Валерия Косс</p>
                                            <p class="slide-description">Косметолог</p>
                                            <div class="slide-button button">
                                                <span class="details">ПОДРОБНЕЕ</span>
                                            </div>  
                                        </li>
                                        <li class="splide__slide">
                                            <img class="slide-img" src="../images/specialist-slider/specialist-4.png"
                                                alt="">
                                            <p class="slide-name">Валерия Косс</p>
                                            <p class="slide-description">Косметолог</p>
                                            <div class="slide-button button">
                                                <span class="details">ПОДРОБНЕЕ</span>
                                            </div>  
                                        </li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content" id="content-2">
                        <div class="auto-scroll-wrap">
                            <div id="splide-autoscroll-2" class="splide">
                                <div class="splide__track">
                                    <ul class="splide__list">
                                        <?php
                                        foreach ($all_masters_cosmetic as $master) {
                                            echo ("
                                                    <li class='splide__slide'>
                                                        <img class='slide-img' src='" . $master[3] . "'
                                                            alt=''>
                                                        <p class='slide-name'>" . $master[1] . " " . $master[2] . "</p>
                                                        <p class='slide-description'>" . $master[4] . "</p>
                                                        <a style='display: flex; justify-content: center;' href='specialist-page.php?spec_id=" . $master[0] . "'>
                                                            <div class='slide-button button'>
                                                                <span class='details'>ПОДРОБНЕЕ</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                ");
                                        }
                                        ?>

                                        <!-- <li class="splide__slide">
                                            <img class="slide-img" src="../images/specialist-slider/specialist-2.png"
                                                alt="">
                                            <p class="slide-name">Валерия Косс</p>
                                            <p class="slide-description">Косметолог</p>
                                            <div class="slide-button button">
                                                <span class="details">ПОДРОБНЕЕ</span>
                                            </div>  
                                        </li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" id="content-3">
                        <div class="auto-scroll-wrap">
                            <div id="splide-autoscroll-3" class="splide">
                                <div class="splide__track">
                                    <ul class="splide__list">
                                        <?php
                                        foreach ($all_masters_spa as $master) {
                                            echo ("
                                                    <li class='splide__slide'>
                                                        <img class='slide-img' src='" . $master[3] . "'
                                                            alt=''>
                                                        <p class='slide-name'>" . $master[1] . " " . $master[2] . "</p>
                                                        <p class='slide-description'>" . $master[4] . "</p>
                                                        <a style='display: flex; justify-content: center;' href='specialist-page.php?spec_id=" . $master[0] . "'>
                                                            <div class='slide-button button'>
                                                                <span class='details'>ПОДРОБНЕЕ</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                ");
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content" id="content-4">
                        <div class="auto-scroll-wrap">
                            <div id="splide-autoscroll-4" class="splide">
                                <div class="splide__track">
                                    <ul class="splide__list">
                                        <?php
                                        foreach ($all_masters_massage as $master) {
                                            echo ("
                                                    <li class='splide__slide'>
                                                        <img class='slide-img' src='" . $master[3] . "'
                                                            alt=''>
                                                        <p class='slide-name'>" . $master[1] . " " . $master[2] . "</p>
                                                        <p class='slide-description'>" . $master[4] . "</p>
                                                        <a style='display: flex; justify-content: center;' href='specialist-page.php?spec_id=" . $master[0] . "'>
                                                            <div class='slide-button button'>
                                                                <span class='details'>ПОДРОБНЕЕ</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                ");
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="auto-scroll-wrap">
                        <div id="splide-autoscroll" class="splide">
                          <div class="splide__track">
                            <ul class="splide__list">
                              <li class="splide__slide">
                                <img src="https://images.unsplash.com/photo-1682685797769-481b48222adf?ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="">
                              </li>
                              <li class="splide__slide">
                                <img src="https://images.unsplash.com/photo-1682685797208-c741d58c2eff?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="">
                              </li>
                              <li class="splide__slide">
                                <img src="https://images.unsplash.com/photo-1682695794816-7b9da18ed470?ixlib=rb-4.0.3&ixid=M3wxMjA3fDF8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="">
                              </li>
                            </ul>
                          </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>
        <?php
        if (isset($_SESSION["UserID"]) && $isSpinned == false) { ?>
            <section class="page__wheel">
                <div class="wheel__body _container">
                    <div class="wheel__left-column">
                        <div class="wheel-title">Вращай колесо — <br>выигрывай подарки!</div>
                        <div class="wheel-text">Добро пожаловать в наш центр! Прокрути колесо и получи скидку нового клиента!</div>
                        <button class="btn-spin">Испытай удачу</button>
                    </div>
                    <div class="wheel__right-column">
                        <!-- <img class="wheel" src="../images/wheel.png"> -->

                        <!-- главный блок -->
                        <div class="deal-wheel">
                            <!-- блок с призами -->
                            <ul class="spinner"></ul>
                            <!-- язычок барабана -->
                            <div class="ticker"></div>
                        </div>
                    </div>
                </div>
            </section>
        <?php } elseif (!isset($_SESSION["UserID"])) { ?>
            <section class="page__wheel">
                <div class="wheel__body _container">
                    <div class="wheel__left-column">
                        <div class="wheel-title">Вращай колесо — <br>выигрывай подарок!</div>
                        <div class="wheel-text">Акция действует только для НОВЫХ полователей! Зарегистрируйся, чтобы выиграть свою скидку при ПЕРВОМ прокурте колеса!</div>
                        <div id="sign-up__link" class="sign-up-button button">
                            <span class="details">Зарегистрироваться</span>
                        </div>
                    </div>
                    <div class="wheel__right-column">
                        <!-- <img class="wheel" src="../images/wheel.png"> -->


                        <!-- главный блок -->
                        <div class="deal-wheel">
                            <!-- блок с призами -->
                            <ul class="spinner"></ul>
                            <style>
                                .spinner li {
                                    filter: blur(4px);
                                }
                            </style>
                            <!-- язычок барабана -->
                            <div class="ticker"></div>
                        </div>
                    </div>
                </div>
            </section>
        <?php }
        ?>

        <section class="page__quiz-block">
            <div class="quiz-block__body _container">
                <div class="quiz-block-title">Не подобрали<br>подходящую процедуру?</div>
                <div class="quiz-block-text">Пройдите тест и выберите ту процедуру, которая подходит именно вам!</div>
                <a href="test.php" class="quiz-block-button green-button">
                    <span class="details">ПРОЙТИ ТЕСТ</span>
                </a>             
            </div>
        </section>
    </main>

    <?php require 'footer-white.php' ?>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="../libraries/swiper-bundle.min.js"></script>

    <script src="../js/script.js"></script>

    <script src="../libraries/jquery-3.6.0.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> -->
    <script src="../libraries/jquery.maskedinput.min.js"></script>
    <!-- <script src="../js/signInUp.js"></script> -->

    <script src="../js/wheel.js"></script>
    <script src="../js/preloader.js"></script>
    <script src="../js/openPopupSignInUp.js"></script>
</body>

</html>