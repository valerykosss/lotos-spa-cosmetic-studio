<div class="popup__bg__sign-up">
    <form class="popup__sign-up" id="sign-up__form">
        <img src="../images/icons/exit.svg" class="close-popup__sign-up">

        <p class="form__window-title">Регистрация</p>
        <div class="form__data">
            <div class="label-input__group">
                <label for="telephone_reg">номер телефона</label>
                <input class="data__phone" name="telephone_reg" type="tel" placeholder="+375 (__) ___-__-__" autocomplete="off" title = 'Телефонные коды: 29 | 33 | 44 | 25'>
                <p id="telephone_regError"></p>
            </div>

            <div class="label-input__group">
                <label for="name">имя</label>
                <input name="name" type="text" placeholder="Ваше имя" autocomplete="off" title='Имя с большой буквы и не менее 3 символов'>
                <p id="nameError"></p>
            </div>

            <div class="label-input__group">
                <label for="first_password">пароль</label>
                <input type="password" name="first_password" placeholder="Введите пароль" autocomplete="off"  title = 'Пароль не менее 8 символов, содержащий минимум одну букву в нижнем и верхнем регистрах, цифру и специальный символ'/>
                <p id="first_passwordError"></p>
            </div>

            <div class="label-input__group">
                <label for="second_password">повтор пароля</label>
                <input type="password" name="second_password" placeholder="Повторите пароль" autocomplete="off" />
                <p id="second_passwordError"></p>
            </div>

            <p class="form__retransfer-text">Есть аккаунта? <span id="sign-in__link">Авторизуйтесь</span></p>

            <div class="sign-up-button green-button" id="sign-up__button">
                <button type="submit">
                    <span class="details">Зарегистрироваться</span>
                </button>
            </div>
        </div>
    </form>
</div>