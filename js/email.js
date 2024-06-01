$('#add-update-mail').on('click', function () {
    // Получаем значение из поля ввода почты
    var email = $('.mail').val();

    // Создаем объект данных FormData
    var formData = new FormData();

    // Добавляем значение почты в объект FormData
    formData.append('email', email);

    // Проверка корректности email с помощью регулярного выражения
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        $('.error-message').show();
        return; // Прерываем выполнение функции, если email некорректный
    } else {
        $('.error-message').hide();
    }

    if (email) {
        // Отправляем данные на сервер
        $.ajax({
            url: '../handlers/addUpdateEmail.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                // Обработка успешного ответа от сервера
                console.log(data);
                // Отображение сообщения об успешном обновлении
                $('.popup__bg__error-success').addClass('active');
                $('.popup__error-success').addClass('active');
                $('.popup__error-success .data-title').text('Успех!');
                $('.popup__error-success .data-text').text('Email успешно обновлен');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                // Обработка ошибки
                console.error('Произошла ошибка:', errorThrown);
                // Отображение сообщения об ошибке
                $('.popup__bg__error-success').addClass('active');
                $('.popup__error-success').addClass('active');
                $('.popup__error-success .data-title').text('Ошибка!');
                $('.popup__error-success .data-text').text('Произошла ошибка при обновлении Email');
            }
        });
    } else {
        // Отображение сообщения об ошибке в случае пустого поля
        $('.popup__bg__error-success').addClass('active');
        $('.popup__error-success').addClass('active');
        $('.popup__error-success .data-title').text('Ошибка!');
        $('.popup__error-success .data-text').text('Введите почту');
    }
});
