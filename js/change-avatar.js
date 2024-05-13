$(document).ready(function() {
    $('#uploadButton').click(function() {
        $('#fileInput').click();
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
            alert('Выберите изображение в формате JPEG, PNG или GIF и размером до 2 МБ.');
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
                    alert('Изображение успешно загружено и сохранено в базе данных.');
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