<div href="" id="sign-up__window">
    <form id="sign-up__form">
        <a href="#" class="close__form">
            <img class="close__form-image" height="35px" width="35px" src="../images/icons/cross.svg" />
        </a>
        <p class="form__window-title">Регистрация<p>
        <div id="form__data">

            <div class="data-label__text">Введите номер телефона</div>
            <input type="tel" placeholder="+375 (__) ___-__-__" class="data__phone" name="telephone_reg" autocomplete="off" title = 'Телефонные коды: 29 | 33 | 44 | 25'/>
            <p id="telephone_regError"></p>

            <div class="data-label__text">Введите имя</div>
            <input type="text" placeholder="Ваше имя" name="name"  autocomplete="off" title='Имя с большой буквы и не менее 3 символов'/>
            <p id="nameError"></p>

            <div class="data-label__text">Введите пароль</div>
            <!--type="password"-->
            <input type="text" placeholder="Пароль" name="first_password" autocomplete="off" title = 'Пароль не менее 8 символов, содержащий минимум одну букву в нижнем и верхнем регистрах, цифру и специальный символ'/>
            <p id="first_passwordError"></p>

            <div class="data-label__text">Повторите пароль</div>
            <!--type="password"-->
            <input type="text" placeholder="Повторите пароль" name="second_password" autocomplete="off"/>
            <p id="second_passwordError"></p>
        </div>
        <p class="form__retransfer-text">Есть аккаунт? <span id="sign-in__link">Авторизуйтесь</span></p>
        <button id="sign-up__button" type="submit">Зарегистрироваться</button>
    </form>
</div>