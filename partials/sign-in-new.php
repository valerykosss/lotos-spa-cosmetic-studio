<div class="popup__bg__sign-in">
    <form class="popup__sign-in" id="sign-in__form">
        <img src="../images/icons/exit.svg" class="close-popup__sign-in">

        <p class="form__window-title">Вход</p>
        <div class="form__data">
            <div class="label-input__group">
                <label for="telephone">номер телефона</label>
                <input class="data__phone" type="tel" name="telephone" placeholder="+375 (__) ___-__-__" autocomplete="off">
                <p id="telephoneError"></p>
            </div>

            <div class="label-input__group">
                <label for="password">пароль</label>
                <input type="password" name="password" placeholder="Введите пароль" autocomplete="off">
                <p  id="passwordError"></p>
            </div>

            <p class="form__retransfer-text">Нет аккаунта? <span id="sign-up__link">Зарегистрируйтесь</span></p>

            <div class="sign-in-button green-button" id="sign-in__button">
                <button type="submit">
                    <span class="details">Войти</span>
                </button>
            </div>
        </div>
    </form>
</div>