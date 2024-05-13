<div href="" id="sign-in__window">
    <form id="sign-in__form">
        <a href="#" class="close__form"> 
            <img class="close__form-image" height="35px" width="35px" src="../images/icons/cross.svg" /> 
        </a>
        <p class="form__window-title">Вход<p> 
        <div id="form__data"> 
            
            <div class="data-label__text">Номер телефона</div>
            <input class="data__phone" name="telephone" type="tel" placeholder="+375 (__) ___-__-__"  autocomplete="off" />
            <p id="telephoneError"></p>

            <div class="data-label__text">Пароль</div>
             <!--type="password"-->
            <input type="password" name="password" placeholder="Введите пароль" autocomplete="off" />
            <p id="passwordError"></p>
        </div>
        <p class="form__retransfer-text">Нет аккаунта? <span id="sign-up__link">Зарегистрируйтесь</span></p>
        <button id="sign-in__button" type="submit">Войти</button>
    </form>
</div>