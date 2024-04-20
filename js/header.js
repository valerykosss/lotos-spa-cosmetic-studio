$("#open__log-in__button").mousedown(function () {
    $("#sign-in__window").css("display", "block");
})
$(".close__form").mousedown(function () {
    clear();
    $("#sign-in__window").css("display", "none");
    $("#sign-up__window").css("display", "none");
})
$("#sign-up__link").mousedown(function () {
    clear();
    $("#sign-in__window").css("display", "none");
    $("#sign-up__window").css("display", "block");
})

$("#sign-in__link").mousedown(function () {
    clear();
    $("#sign-up__window").css("display", "none");
    $("#sign-in__window").css("display", "block");
})

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
    document.getElementById("sign-up__form").reset();
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
                $("#sign-in__window").css("display", "block");
                $("#sign-up__window").css("display", "none");
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


/*выход*/
$('#logout__button').click(function (e) {
    e.preventDefault(); //тут отключаем стандартное поведение кнопки, т.е. отправку формы
    $.ajax({
        url: '../handlers/logout.php',
        type: 'POST',
        dataType: 'json',
        data: {
            exit: true
        },
        success(data) {
            if (data) {
                document.location.href = '../partials/index.php';
            }

        }
    })
})

// $("#registration :input").tooltip({
//     // place tooltip on the right edge
//     position: "center right",
//     // a little tweaking of the position
//     offset: [-2, 10],
//     // use the built-in fadeIn/fadeOut effect
//     // effect: "fade",
//     // custom opacity setting
//     opacity: 1
//     });
