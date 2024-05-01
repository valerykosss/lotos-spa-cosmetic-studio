<?php
    require '../database/db.php';
    if (session_id() == '')
    session_start();

    $master_id=$_GET['spec_id'];
    //$master_id = $_POST['id'];
    //$master_id=$_SESSION['id_master'];

    $master_data=mysqli_query($link, "SELECT * FROM `master` WHERE `id_master`=$master_id");
    $master_data=mysqli_fetch_assoc($master_data);

    $master_services=mysqli_query($link, "SELECT distinct `service_type`.`service_type_name` FROM `master_service`
                                            inner join `service` on `master_service`.`id_service`=`service`.`id_service`
                                            inner join `service_type` on `service`.`id_service_type`=`service_type`.`id_service_type`
                                            WHERE `id_master`=$master_id");
    $master_services=mysqli_fetch_all($master_services);

    $master_rating=mysqli_query($link, "SELECT * FROM `master_rating` WHERE `id_master`=$master_id");
    $master_rating=mysqli_fetch_all($master_rating);

    $all_rating=0;
    $rating=0;
    $rating_length=count($master_rating);

    if($rating_length!=0){
        foreach($master_rating as $item){
            $all_rating=$all_rating+(int)$item[3];
        }
        $rating=$all_rating/$rating_length;
    }



?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лотос - Специалист</title>
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
<?php require 'header-white.php' ?>
    <main>
        <section class="page__speialist-profile">
            <div class="specialist-profile__body _container">
                <div class="specialist-profile__photo">
                    <img src="..<?php echo($master_data['master_photo']);?>" alt="">
                </div>
                <div class="specialist-profile__info-block">
                    <p class="info-block-name"><?php echo($master_data['master_name']." ".$master_data['master_surname']);?></p>
                    <div class="info-block-rating-stars">
                        <p class="info-block-rating"> <?php echo($rating);?> </p>
                        <div class="info-block-star"></div>
                    </div>
                    <p class="info-block-specialization"><?php echo($master_data['position']);?></p>
                    <!-- <p class="info-block-description">Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях.</p> -->

                    <div class="info-block-gray">
                        <p class="info-block-gray-title">Профессиональная подготовка:</p>
                        <div class="info-block-checkmark-text">
                            <div class="info-block-checkmark"></div>
                            <div class="info-block-text"><?php echo($master_data['education']);?></div>
                        </div>
                    </div>

                    <div class="info-block-gray">
                        <p class="info-block-gray-title">Профессиональный стаж:</p>
                        <div class="info-block-checkmark-text">
                            <div class="info-block-checkmark"></div>
                            <div class="info-block-text"><?php echo($master_data['work_experience']);?> лет</div>
                        </div>
                    </div>

                    <div class="info-block-gray">
                        <p class="info-block-gray-title">Cпециализации:</p>
                        <?php
                            foreach($master_services as $master_service){
                                echo("
                                    <div class='info-block-checkmark-text'>
                                        <div class='info-block-checkmark'></div>
                                        <div class='info-block-text'>".$master_service[0]."</div>
                                    </div>
                                ");
                            }
                        ?>

                    </div>
                    <?php
                    if(isset($_SESSION['UserID'])) {
                        echo "<div class='specialist-button green-button' id=". $master_id.">
                        <span class='details'>ЗАПИСАТЬСЯ</span>
                    </div>";
                    }
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

<!-- ... -->


</body>
</html>