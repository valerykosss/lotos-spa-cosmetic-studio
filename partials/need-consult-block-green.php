<?php
$isLoggedIn=false;
if(isset($_SESSION['Name'])&&isset($_SESSION['UserTel'])&&isset($_SESSION['UserID'])){
    $isLoggedIn=true;

    $name=$_SESSION['Name'];
    $tel=$_SESSION['UserTel'];
}
?>
<section class="page__need-consult-block-green">
    <div class="need-consult__body _container">
        <div class="need-consult-title">необходима консультация?</div>
        <div class="need-consult-text">Оставьте заявку на сайте наш специалист свяжется с вами и
            проконсультирует по всем вопросам.</div>
        <form class="need-consult-form" action="">

            <div class="label-input__group">
                <label for="name">Имя</label>
                <input type="text" id="name" placeholder="Введите имя" name="name" <?php if($isLoggedIn==true){echo("value='".$name."'");}?>>
            </div>

            <div class="label-input__group">
                <label for="tel">Телефон</label>
                <input type="tel" id="tel" name="telephone" placeholder="+375 (__) ___-__-__" autocomplete="off" <?php if($isLoggedIn==true){echo("value='".$tel."'");}?>/>
            </div>

            <div class="label-input__group">
                <label for="comment">Комментарий</label>
                <input type="text" id="comment" name="comment" placeholder="Комментарий к заявке" />
            </div>

            <div class="label-input__group">
                <button type="submit" class="need-consult-button">Оставить заявку на консультацию</button>
            </div>

        </form>
    </div>
</section>
<script src="../js/callback.js"></script>