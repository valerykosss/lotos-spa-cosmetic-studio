<?php
$isLoggedIn=false;
if(isset($_SESSION['Name'])&&isset($_SESSION['UserTel'])&&isset($_SESSION['UserID'])){
    $isLoggedIn=true;

    $name=$_SESSION['Name'];
    $tel=$_SESSION['UserTel'];

    if (session_id() == '')
    session_start();
}
?>
<style>
    .stage-title{
        width: calc(100% / 3);
    }
</style>
<div class="popup__bg">
    <form class="popup">
        <img src="../images/icons/exit.svg" class="close-popup">
        <div class="booking-stages__wrapper">
            <p class="stage-title active-stage" id="service-stage">Услуга</p>
            <!-- <p class="stage-title" id="master-stage">Специалист</p> -->
            <p class="stage-title" id="date-time-stage">Дата и время</p>
            <p class="stage-title" id="details-stage">Детали записи</p>
        </div>

        <div class="service__wrapper">
            <div class="service__data _container-window">
                <div class="filters-service__body">

                    <!-- <div class="filter-service__body-item">
                        <input type="text" id="search_box-service" placeholder="Поиск услуги" name="search-service">
                    </div> -->

                    <div class="filter-service__body-item">
                        <select class="sort-service" id="sort-selector-first__service">
                            <option value="">Выберите услугу</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="services__body _container-window">
                <p class="service-type__header"></p>
                <div id="service-items-container"></div>

                <div class="service__buttons">
                    <!-- <button type="button" id="prevBtn" class="green-button">
                        <span class="details">Назад</span>
                    </button> -->

                    <button type="button" id="nextBtnToDateTime" class="green-button">
                        <span class="details">Далее</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- <div class="master__wrapper" style="display: none">

            <div class="masters__body _container-window">

            <div id="masters-items-container"></div>

                <div class="master__buttons">
                    <button type="button" id="prevBtnToService" class="green-button">
                        <span class="details">Назад</span>
                    </button>

                    <button type="button" id="nextBtnToDateTime" class="green-button">
                        <span class="details">Далее</span>
                    </button>
                </div>
            </div>

        </div> -->

        <div class="date-time__wrapper" style="display: none">
            <div class="date-time__body _container-window">
                <div id="calendar" class=""></div>
                <div class="date-time__buttons">
                    <button type="button" id="prevBtnToService" class="green-button">
                        <span class="details">Назад</span>
                    </button>

                    <button type="button" id="nextBtnToDetails" class="green-button">
                        <span class="details">Далее</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="details__wrapper" style="display: none">
            <div class="details__body _container-window"></div>

            <?php if(!isset($_SESSION['UserID'])) { ?>

             <p class="border"></p>

            <div class="book-procedure-form _container-window" action="">

                <div class="label-input__group">
                    <label for="name">Имя</label>
                    <input type="text" id="new_user_name" placeholder="Введите имя" name="name" <?php if($isLoggedIn==true){echo("value='".$name."'");}?>>
                </div>

                <div class="label-input__group">
                    <label for="tel">Телефон</label>
                    <input type="tel" id="new_user_tel" name="telephone" placeholder="+375 (__) ___-__-__" autocomplete="off" <?php if($isLoggedIn==true){echo("value='".$tel."'");}?>/>
                </div>

                <div class="label-input__group">
                    <label for="mail">Почта</label>
                    <input type="text" id="new_user_email" name="mail" placeholder="Введите почту" />
                </div>

            </div>

            <?php } ?>

            <div class="details__buttons _container-window">
                    <button type="button" id="prevBtnToDateTime" class="green-button">
                        <span class="details">Назад</span>
                    </button>

                    <button type="button" id="book" class="green-button">
                        <span class="details">Записаться</span>
                    </button>
                </div>

        </div>

    </form>
</div>