document.addEventListener('DOMContentLoaded', function() {
    $("#tel").mask("+375 (99) 999-99-99");
    $('.need-consult-form').on('submit', function(e) {
        e.preventDefault();

        var name = $('#name').val();
        var phone = $('#tel').val();
        var comment = $('#comment').val();

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
                // Очищаем поля ввода после успешной отправки
                $('#name').val('');
                $('#tel').val('');
                $('#comment').val('');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});