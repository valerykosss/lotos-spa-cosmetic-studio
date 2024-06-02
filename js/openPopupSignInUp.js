/*для sign-in */
let popUpSignInBGSignIn = document.querySelector('.popup__bg__sign-in'); // Фон попап окна

let popupSignIn = document.querySelector('.popup__sign-in'); // Само окно

let openPopupSignInButtons = document.querySelectorAll('#sign-in__link'); // Кнопки для показа окна

let closePopupSignInButton = document.querySelector('.close-popup__sign-in'); // Кнопка для скрытия окна

/*для sign-up */
let popUpSignUpBGSignUp = document.querySelector('.popup__bg__sign-up'); // Фон попап окна

let popupSignUp = document.querySelector('.popup__sign-up'); // Само окно

let openPopupSignUpButtons = document.querySelectorAll('#sign-up__link'); // Кнопки для показа окна

let closePopupSignUpButton = document.querySelector('.close-popup__sign-up'); // Кнопка для скрытия окна

/*sign-in */
openPopupSignInButtons.forEach((button) => { // Перебираем все кнопки
    button.addEventListener('click', (e) => { // Для каждой вешаем обработчик событий на клик
        clear();
        e.preventDefault(); // Предотвращаем дефолтное поведение браузера
        popUpSignInBGSignIn.classList.add('active'); // Добавляем класс 'active' для фона
        popupSignIn.classList.add('active'); // И для самого окна

        popUpSignUpBGSignUp.classList.remove('active'); // Убираем активный класс с фона
        popupSignUp.classList.remove('active'); // И с окна
    })
});

closePopupSignInButton.addEventListener('click',() => { // Вешаем обработчик на крестик
    clear();
    popUpSignInBGSignIn.classList.remove('active'); // Убираем активный класс с фона
    popupSignIn.classList.remove('active'); // И с окна

    popUpSignUpBGSignUp.classList.remove('active'); // Убираем активный класс с фона
    popupSignUp.classList.remove('active'); // И с окна
});

document.addEventListener('click', (e) => { // Вешаем обработчик на весь документ
    if(e.target === popUpSignInBGSignIn) { // Если цель клика - фон, то:
        clear();
        popUpSignInBGSignIn.classList.remove('active'); // Убираем активный класс с фона
        popupSignIn.classList.remove('active'); // И с окна

        popUpSignUpBGSignUp.classList.remove('active'); // Убираем активный класс с фона
        popupSignUp.classList.remove('active'); // И с окна
    }
});

function clear() {
    $('#telephoneError').text('');
    $('#passwordError').text('');
    $('#nameError').text('');
    $('#telephone_regError').text('');
    $('#first_passwordError').text('');
    $('#second_passwordError').text('');
    $('input[name="telephone"]').removeClass("error");
    $('input[name="password"]').removeClass("error");
    $('input[name="name"]').removeClass("error");
    $('input[name="telephone_reg"]').removeClass("error");
    $('input[name="first_password"]').removeClass("error");
    $('input[name="second_password"]').removeClass("error");
    document.getElementById("sign-in__form").reset();
    // document.getElementById("sign-up__form").reset();
}
$(".data__phone").mask("+375 (99) 999-99-99");

/*авторизация*/
$('#sign-in__button').click(function (e) {
    e.preventDefault(); //тут отключаем стандартное поведение кнопки, т.е. отправку формы
    $(`input`).removeClass("error");
    let telephone = $('input[name="telephone"]').val(),
        password = $('input[name="password"]').val();
    $.ajax({
        url: '../handlers/signInHandler.php',
        type: 'POST',
        dataType: 'json',
        data: {
            telephone: telephone,
            password: password,
        },
        success(data) {
            if (data.status) { //если авторизовался(status===true)
                function reload() { top.location = '../index.php' };
                setTimeout(reload(), 0);
            }
            else {
                $('#telephoneError').text('');
                $('#passwordError').text('');
                if (data.type === 1) { //если data.type === 1, то ошибки, связанные с полями
                    data.fields.forEach(function (field) {
                        $(`input[name="${field}"]`).addClass("error")
                    });
                }
                $('#telephoneError').text(data.telephoneError);
                $('#passwordError').text(data.passwordError);
            }
        }
    })
})

/*sign-up */

openPopupSignUpButtons.forEach((button) => { // Перебираем все кнопки
    button.addEventListener('click', (e) => { // Для каждой вешаем обработчик событий на клик
        e.preventDefault(); // Предотвращаем дефолтное поведение браузера
        clear();
        popUpSignInBGSignIn.classList.remove('active'); // Убираем активный класс с фона
        popupSignIn.classList.remove('active'); // И с окна

        popUpSignUpBGSignUp.classList.add('active'); // Добавляем класс 'active' для фона
        popupSignUp.classList.add('active'); // И для самого окна
    })
});

closePopupSignUpButton.addEventListener('click',() => { // Вешаем обработчик на крестик
    clear();
    popUpSignUpBGSignUp.classList.remove('active'); // Убираем активный класс с фона
    popupSignUp.classList.remove('active'); // И с окна

    popUpSignInBGSignIn.classList.remove('active'); // Убираем активный класс с фона
    popupSignIn.classList.remove('active'); // И с окна
});

document.addEventListener('click', (e) => { // Вешаем обработчик на весь документ
    if(e.target === popUpSignUpBGSignUp) { // Если цель клика - фон, то:
        clear();
        popUpSignUpBGSignUp.classList.remove('active'); // Убираем активный класс с фона
        popupSignUp.classList.remove('active'); // И с окна

        popUpSignInBGSignIn.classList.remove('active'); // Убираем активный класс с фона
        popupSignIn.classList.remove('active'); // И с окна
    }
});

/*регистрация*/
$('#sign-up__button').click(function (e) {
    e.preventDefault(); //тут отключаем стандартное поведение кнопки, т.е. отправку формы
    $(`input`).removeClass("error");
    let name = $('input[name="name"]').val()
        telephone_reg = $('input[name="telephone_reg"]').val(),
        first_password = $('input[name="first_password"]').val(),
        second_password = $('input[name="second_password"]').val();
    $.ajax({
        url: '../handlers/signUpHandler.php',
        type: 'POST',
        dataType: 'json',
        data: {
            name: name,
            telephone_reg: telephone_reg,
            first_password: first_password,
            second_password: second_password
        },
        success(data) {
            if (data.status) {
                popUpSignUpBGSignUp.classList.remove('active'); // Убираем активный класс с фона
                popupSignUp.classList.remove('active'); // И с окна

                popUpSignInBGSignIn.classList.add('active'); // Убираем активный класс с фона
                popupSignIn.classList.add('active'); // И с окна
            }
            else {
                if (data.type === 1) {
                    data.fields.forEach(function (field) {
                        $(`input[name="${field}"]`).addClass("error")
                    });
                }
                $('#nameError').text(data.nameError);
                $('#telephone_regError').text(data.telephone_regError);
                $('#first_passwordError').text(data.first_passwordError);
                $('#second_passwordError').text(data.second_passwordError);
            }
        }
    })
})

// /*выход*/
// $('#logout__button').click(function (e) {
//     e.preventDefault(); //тут отключаем стандартное поведение кнопки, т.е. отправку формы
//     $.ajax({
//         url: '../handlers/logout.php',
//         type: 'POST',
//         dataType: 'json',
//         data: {
//             exit: true
//         },
//         success(data) {
//             if (data) {
//                 document.location.href = '../partials/index.php';
//             }

//         }
//     })
// })