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
    <title>Лотос - О нас</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="../css/generalStyles.css">
    <link rel="stylesheet" href="../css/buttons.css">
    <link rel="stylesheet" href="../css/about-us.css">
    <link rel="stylesheet" href="../css/header-green.css">
    <link rel="stylesheet" href="../css/footer-green.css">

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
    <main>
        <section class="page__about-us-page">
            <div class="about-us-page__body _container">
                <div class="about-us-page__info-block">
                    <p class="info-block-page__header">о нас</p>
                    <p class="info-block-page__text">
                    Центр массажа и косметологии "Лотос" — это уютное и современное место, где каждый может отдохнуть душой и телом, обрести внутреннее равновесие и красоту. Наша команда профессионалов состоит из опытных массажистов, косметологов и терапевтов, которые заботятся о вашем благополучии, предлагая индивидуальные подходы и высококачественные процедуры. В "Лотосе" мы используем только проверенные и эффективные методики, современное оборудование и натуральные косметические средства для достижения видимых и долгосрочных результатов. Приходите и окунитесь в атмосферу релаксации, красоты и гармонии в нашем уютном центре.
                    </p>
                </div>

                <div class="about-us__facts-block">
                    <div class="facts-block__row">
                        <div class="fact-block">
                            <p class="header">1 факт</p>
                            <p class="text">Проверенные средства</p>
                        </div>

                        <div class="fact-block">
                            <p class="header">2 факт</p>
                            <p class="text">Широкий спектр услуг</p>
                        </div>

                        <div class="fact-block">
                            <p class="header">3 факт</p>
                            <p class="text">Каждый клиент ценится</p>
                        </div>
                    </div>

                    <div class="facts-block__row">

                        <div class="fact-block">
                            <p class="header">4 факт</p>
                            <p class="text">Атмосфера уюта</p>
                        </div>

                        <div class="fact-block">
                            <p class="header">5 факт</p>
                            <p class="text">Совершнествумся постоянно</p>
                        </div>

                        <div class="fact-block">
                            <p class="header">6 факт</p>
                            <p class="text">Инновация в своей сфере</p>
                        </div>
                    </div>

                </div>
            </div>
            </div>
        </section>
        <section class="page__gallery">
            <div class="gallery__body _container">
                <img src="../images/about-us-page/photo-1.png">
                <img src="../images/about-us-page/photo-2.png">
                <img src="../images/about-us-page/photo-3.png">
                <img src="../images/about-us-page/photo-4.png">
                <img src="../images/about-us-page/photo-5.png">
            </div>
        </section>
    </main>
    <?php require 'footer-green.php' ?>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <script src ="../libraries/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <script src="../js/openPopupSignInUp.js"></script>
    <script src="../js/preloader.js"></script>
</body>

</html>