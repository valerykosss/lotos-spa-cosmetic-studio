<?php

require_once "../handlers/isAdmin.php";
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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/sign-in-up.css">

    <link rel="stylesheet" href="../css/wheel.css">
</head>

<body>

    <?php require 'header-green.php' ?>

    <main class="page">
        <section class="page__slider">
            <!-- First Swiper -->
            <div class="swiper-container swiper1 _container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide background"
                        style="background-image: url('../images/main-page-slider/kosmeticheskie-proczedury-fon.png'); background-size: cover;">
                    </div>
                    <div class="swiper-slide background"
                        style="background-image: url('../images/main-page-slider/spa-programmy-fon.png'); background-size: cover;"></div>
                    <div class="swiper-slide background"
                        style="background-image: url('../images/main-page-slider/kosmeticheskie-proczedury-fon.png'); background-size: cover;">
                    </div>
                </div>

                <div class="swiper-pagination"></div>

                <div class="swiper-navigation-container">
                    <div class="swiper-button-next">Далее</div>
                    <div class="swiper-button-prev">Назад</div>
                </div>

                <div class="slider-counter">
                    <span class="slider-counter-current-number"></span>/05
                </div>

            </div>

            <!-- Second Swiper -->
            <div class="swiper-container swiper2 _container-main-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide front"
                        style="background-image: url('../images/main-page-slider/kosmeticheskie-proczedury-glavnaya.png'); background-size: cover;">
                        <p>Косметические услуги</p>

                        <div class="button">
                            <span class="details">ПОДРОБНЕЕ</span>
                        </div>
                    </div>
                    <div class="swiper-slide front"
                        style="background-image: url('../images/main-page-slider/spa-programmy-glavnaya.png'); background-size: cover;">
                        <p>Cпа-программы</p>

                        <div class="button">
                            <span class="details">ПОДРОБНЕЕ</span>
                        </div>
                    </div>
                    <div class="swiper-slide front"
                        style="background-image: url('../images/main-page-slider/kosmeticheskie-proczedury-glavnaya.png'); background-size: cover;">
                        <p>Косметические услуги</p>

                        <div class="button">
                            <span class="details">ПОДРОБНЕЕ</span>
                        </div>
                    </div>
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
                    <p class="info-block__header">lotos &mdash;</p>
                    <p class="info-block__text">
                        Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более
                        менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных
                        выступлений в домашних условиях. При создании генератора мы использовали небезизвестный
                        универсальный код речей. Текст генерируется абзацами случайным образом от двух до десяти
                        предложений в абзаце, что позволяет сделать текст более привлекательным и живым для
                        визуально-слухового восприятия.
                    </p>
                    <div class="info-block__button button">
                        <span class="details">ПОДРОБНЕЕ</span>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <section class="page__specialists">
            <div class="specialists__body">
                <div class="specialists-title _container">Специалисты</div>
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
                                        <li class="splide__slide">
                                            <img class="slide-img" src="../images/specialist-slider/specialist-1.png"
                                                alt="">
                                            <p class="slide-name">Валерия Косс</p>
                                            <p class="slide-description">Косметолог</p>
                                            <div class="slide-button button">
                                                <span class="details">ПОДРОБНЕЕ</span>
                                            </div>  
                                        </li>
                                        <li class="splide__slide">
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
                                        </li>
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
                                        <li class="splide__slide">
                                            <img class="slide-img" src="../images/specialist-slider/specialist-1.png"
                                                alt="">
                                            <p class="slide-name">Валерия Косс</p>
                                            <p class="slide-description">Косметолог</p>
                                            <div class="slide-button button">
                                                <span class="details">ПОДРОБНЕЕ</span>
                                            </div>  
                                        </li>
                                        <li class="splide__slide">
                                            <img class="slide-img" src="../images/specialist-slider/specialist-2.png"
                                                alt="">
                                            <p class="slide-name">Валерия Косс</p>
                                            <p class="slide-description">Косметолог</p>
                                            <div class="slide-button button">
                                                <span class="details">ПОДРОБНЕЕ</span>
                                            </div>  
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" id="content-3">
                        Содержимое 3... Lorem ipsum dolor sit, amet consectetur adipisicing elit. Similique eaque iure
                        debitis nostrum, vero ad totam ratione sequi! Suscipit, labore repellat cum soluta ullam
                        dignissimos perspiciatis sequi rerum sapiente ex.
                    </div>

                    <div class="tab-content" id="content-4">
                        Содержимое 4... Lorem ipsum dolor sit, amet consectetur adipisicing elit. Similique eaque iure
                        debitis nostrum, vero ad totam ratione sequi! Suscipit, labore repellat cum soluta ullam
                        dignissimos perspiciatis sequi rerum sapiente ex.
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
        <section class="page__wheel">
            <div class="wheel__body _container">
                <div class="wheel__left-column">
                    <div class="wheel-title">Вращай колесо — <br>выигрывай подарки!</div>
                    <div class="wheel-text">Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более.</div>
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
        <section class="page__quiz-block">
            <div class="quiz-block__body _container">
                <div class="quiz-block-title">Не подобрали<br>подходящую процедуру?</div>
                <div class="quiz-block-text">Пройдите тест и выберите ту процедуру, которая подходит именно вам!</div>
                <div class="quiz-block-button green-button">
                    <span class="details">ПРОЙТИ ТЕСТ</span>
                </div>
            </div>
        </section>
    </main>

    <?php require 'footer-white.php' ?>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="../libraries/swiper-bundle.min.js"></script>

    <script src="../js/script.js"></script>

    <script src ="../libraries/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <script src="../js/header.js"></script>

    <script src="../js/wheel.js"></script>
</body>

</html>