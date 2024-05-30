$(document).ready(function() {
    // Обработчик нажатия на кнопку "Изменить пароль"
    $('#change-password').click(function() {
        // Получаем значения полей
        var oldPassword = $('input[name="old-password"]').val();
        var newPassword = $('input[name="new-password"]').val();
        var newPasswordConfirm = $('input[name="new-password-confirm"]').val();

        // Отправляем запрос на сервер
        $.ajax({
            type: 'POST',
            url: '../handlers/change_password_script.php',
            data: {
                'old-password': oldPassword,
                'new-password': newPassword,
                'new-password-confirm': newPasswordConfirm
            },
            dataType: 'json',
            success: function(response) {
                // Обрабатываем ответ от сервера
                if (response.success) {
                    // Выводим сообщение об успешном изменении пароля

                    $('input[name="old-password"]').val('');
                    $('input[name="new-password"]').val('');
                    $('input[name="new-password-confirm"]').val('');

                    // alert(response.message);
                    // Открытие нового окна popupES и установка текста
                    $('.popup__bg__error-success').addClass('active');
                    $('.popup__error-success').addClass('active');
                    $('.popup__error-success .data-title').text('Успешно!');
                    $('.popup__error-success .data-text').text(response.message);


                } else {
                    // Выводим сообщение об ошибке

                    // Открытие нового окна popupES и установка текста
                    $('.popup__bg__error-success').addClass('active');
                    $('.popup__error-success').addClass('active');
                    $('.popup__error-success .data-title').text('Ошибка отправки!');
                    $('.popup__error-success .data-text').text(response.message);
                    // alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                // Выводим сообщение об ошибке
                alert('Произошла ошибка при отправке запроса на сервер');
                console.error(error);
            }
        });
    });
});
