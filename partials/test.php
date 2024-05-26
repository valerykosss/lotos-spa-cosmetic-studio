<?php
require '../database/db.php';
if (session_id() == '')
    session_start();

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лотос - Тест </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/generalStyles.css">
    <link rel="stylesheet" href="../css/test.css">
    <link rel="stylesheet" href="../css/buttons.css">
    <link rel="stylesheet" href="../css/price-list.css">
    <link rel="stylesheet" href="../css/header-green.css">
    <link rel="stylesheet" href="../css/footer-green.css">

    <link rel="stylesheet" href="../css/popupSignInUp.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
        <section class="page__test">
            <div class="page-test__body _container">
                <form id="testForm">
                    <p class="test-title">узнайте за 1 минуту, какая процедура подходит именно вам</p>
                    <p class="test-number"> вопрос 1</p>
                    <div id="questionContainer">
                        <!-- Вопросы и ответы будут добавлены с помощью JavaScript -->
                    </div>
                    <div class="buttons">
                        <button type="button" id="prevBtn" class="button" style="display: none;">
                            <span class="details">Предыдущий</span>
                        </button>
                        <button type="button" id="nextBtn" class="button" style="display: none;">
                            <span class="details">Следующий</span>
                        </button>
                        <button type="button" id="showResults" class="button" style="display: none;">
                            <span class="details">К результату</span>
                        </button>
                    </div>
                </form>
                <div id="resultsContainer"></div>
            </div>
        </section>
    </main>

    <?php require 'footer-green.php' ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <script src="../js/test.js"></script>
    <script src="../js/openPopupSignInUp.js"></script>
    <script src="../js/preloader.js"></script>
</body>

</html>