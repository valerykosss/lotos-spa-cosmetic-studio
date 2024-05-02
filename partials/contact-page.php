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
    <link rel="stylesheet" href="../css/about-us.css">
    <link rel="stylesheet" href="../css/sign-in-up.css">

    <link rel="stylesheet" href="../css/header-green.css">
    <link rel="stylesheet" href="../css/footer-green.css">
</head>

<body>
<?php require 'header-green.php' ?>
    <main>
        <section class="page__about-us-page">
            <div class="about-us-page__body _container">
                <div class="about-us-page__info-block">
                    <p class="info-block-page__header">МЫ НА КАРТЕ</p>
                </div>

                <div class="about-us__facts-block">
                </div>
            </div>
            </div>
        </section>
        <section class="page__gallery">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2451.2512088630556!2d23.685060376416164!3d52.09335956772935!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47210befb0aa4ed5%3A0x83c51779d821b432!2z0YPQuy4g0JrQsNGA0LvQsCDQnNCw0YDQutGB0LAgMzMsINCR0YDQtdGB0YIsINCR0YDQtdGB0YLRgdC60LDRjyDQvtCx0LvQsNGB0YLRjCAyMjQwMDU!5e0!3m2!1sru!2sby!4v1713939554831!5m2!1sru!2sby" width="1440px" height="700px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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