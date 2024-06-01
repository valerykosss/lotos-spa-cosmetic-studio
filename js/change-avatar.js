$(document).ready(function() {
    $('#uploadButton').click(function() {
        $('#fileInput').click();
        console.log('#uploadButton');
    });

    $('#fileInput').change(function() {
        var file = this.files[0];
        var fileType = file.type;
        var fileSize = file.size;

        // Проверяем тип файла и размер
        if (fileType.match('image.*') && fileSize <= 2 * 1024 * 1024) {
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function(e) {
                var imageData = e.target.result;
                uploadImage(imageData);
            };
        } else {
            // Открытие нового окна popupES и установка текста
            $('.popup__bg__error-success').addClass('active');
            $('.popup__error-success').addClass('active');
            $('.popup__error-success .data-title').text('Ошибка!');
            $('.popup__error-success .data-text').text('Выберите изображение в формате JPEG, PNG или GIF и размером до 2 МБ!');

        }
    });

    function uploadImage(imageData) {
        $.ajax({
            type: 'POST',
            url: '../handlers/change_avatar_script.php',
            data: { image: imageData },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('.popup__bg__error-success').addClass('active');
                    $('.popup__error-success').addClass('active');
                    $('.popup__error-success .data-title').text('Успешно!');
                    $('.popup__error-success .data-text').text('Изображение загружено и сохранено в базе данных');
                    $('.avatar').attr('src', imageData);

                } else {
                    alert('Произошла ошибка при загрузке изображения.');
                }
            },
            error: function(xhr, status, error) {
                alert('Произошла ошибка при отправке запроса на сервер.');
                console.error(error);
            }
        });
    }
});