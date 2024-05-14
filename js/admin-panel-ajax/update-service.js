document.addEventListener("DOMContentLoaded", function() {
    // Находим все фотографии и назначаем на них обработчики событий
    var photos = document.querySelectorAll('.service-photo-container img');
    photos.forEach(function(photo) {
        photo.onclick = function() {
            var input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.onchange = function(event) {
                uploadPhoto(event, photo);
            };
            input.click();
        };
    });

    // Функция для загрузки нового фото
    function uploadPhoto(event, photo) {
        var file = event.target.files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            var image = new Image();
            image.src = e.target.result;

            // Обработчик клика на изображение для выбора нового фото
            image.onclick = function() {
                var input = document.createElement('input');
                input.type = 'file';
                input.accept = 'image/*';
                input.onchange = function(event) {
                    uploadPhoto(event, photo);
                };
                input.click();
            };

            var td = photo.parentNode;
            td.innerHTML = '';
            td.appendChild(image);
        };

        reader.readAsDataURL(file);
    }

});
//одновление мастера
$(document).on('click', '.change-service__button', function () {
    var serviceId = $(this).attr('id');
    var service_type = $('tr#' + serviceId + ' select').val();
    var service_name = $('tr#' + serviceId + ' textarea').eq(0).val();
    var service_image = $('tr#' + serviceId + ' .service-photo-container img'); // получаем элемент input
    var service_description = $('tr#' + serviceId + ' textarea').eq(1).val();
    var duration = $('tr#' + serviceId + ' textarea').eq(2).val();
    var price = $('tr#' + serviceId + ' textarea').eq(3).val();
    var insication = $('tr#' + serviceId + ' textarea').eq(4).val();
    var results = $('tr#' + serviceId + ' textarea').eq(5).val();

    // Получение base64 изображения из тега img
    var service_image = service_image.prop('src');

    updateService(serviceId, service_type, service_name, service_image, service_description, duration, price, insication, results);
});


function updateService(serviceId, service_type, service_name, service_image, service_description, duration, price, insication, results) {
    $.ajax({
        url: '../handlers/admin-panel-handlers/updateServiceHandler.php',
        type: 'POST',
        dataType: 'json',
        data: {
            serviceId: serviceId,
            service_type: service_type,
            service_name: service_name,
            service_image: service_image,
            service_description: service_description,
            duration: duration,
            price: price,
            insication: insication,
            results: results
        },
        success: function (response) {
            if (response.success) {
                alert("Услуга обновлена!");
            } else {
                console.error('Произошла ошибка при обновлении услуги');
            }
        },
        error: function () {
            console.error('Произошла ошибка при обновлении услуги');
        }
    });
}