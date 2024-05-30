document.addEventListener('DOMContentLoaded', function() {
    $("#tel").mask("+375 (99) 999-99-99");
    $('.need-consult-form').on('submit', function(e) {
        e.preventDefault();

        var name = $('#name').val();
        var phone = $('#tel').val();
        var comment = $('#comment').val();
        if (name !== "" && phone !== "") {
            $.ajax({
                type: 'POST',
                url: '../handlers/callback_script.php',
                data: {
                    name: name,
                    phone: phone,
                    comment: comment
                },
                success: function(response) {
                    console.log('Письмо отправлено!');
                    $('#name').val('');
                    $('#tel').val('');
                    $('#comment').val('');

                        // Открытие нового окна popupES и установка текста
                        $('.popup__bg__error-success').addClass('active');
                        $('.popup__error-success').addClass('active');
                        $('.popup__error-success .data-title').text('Спасибо за обратную связь!');
                        $('.popup__error-success .data-text').text('Наш администратор свяжется с вами в течение суток и ответит на все интересующие вас вопросы!');

                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }else{
             // Открытие нового окна popupES и установка текста
             $('.popup__bg__error-success').addClass('active');
             $('.popup__error-success').addClass('active');
             $('.popup__error-success .data-title').text('Ошибка отправки!');
             $('.popup__error-success .data-text').text('По всей видимости, вы не заполнили все данные для отправки:(');

        }
    });
});