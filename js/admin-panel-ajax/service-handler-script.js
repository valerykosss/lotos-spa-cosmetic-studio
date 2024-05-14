//добавление
$(".add-service__button").click(function () {
    var formData = new FormData();
    formData.append('service_type', $('.service_type').val());
    formData.append('service_name', $('.service_name').val().trim());
    var service_image = $('.service_image')[0].files[0];
    var reader = new FileReader();
    reader.readAsDataURL(service_image);
    reader.onload = function () {
        var service_image_base64 = reader.result;
        formData.append('service_image', service_image_base64);
        formData.append('service_description', $('.service_description').val().trim());
        formData.append('duration', parseInt($('.duration').val().trim()));
        formData.append('price', parseInt($('.price').val().trim()));
        formData.append('insication', $('.insication').val().trim());
        formData.append('results', $('.results').val().trim());

        addService(formData, $(this));
    };
});

function addService(formData, button) {
    $.ajax({
        url: '../handlers/admin-panel-handlers/addServiceHandler.php',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: formData,
        success: function (response) {
            if (response.success) {
                alert("Услуга добавлена!");
                var newService = response.service;
                var tableBody = $('.table__to-update-delete.service').find('tbody'); // находим tbody во второй таблице

                // Создаем новую строку для мастера
                var newRow = $('<tr id="' + newService.id + '"></tr>');

                // Создаем ячейки для новой строки
                newRow.append('<td><select id="id_service_type">' + newService.options + '</select></td>');
                newRow.append('<td><textarea id="' + newService.id + '">' + newService.service_name + '</textarea></td>');
                newRow.append('<td class="service-photo-container" id="photo_' + newService.id + '"><img style="width:100px;" src="' + newService.service_image + '"></td>');
                newRow.append('<td><textarea id="' + newService.id + '">' + newService.service_description + '</textarea></td>');
                newRow.append('<td><textarea class="digitsOnly" id="' + newService.id + '">' + newService.duration + '</textarea></td>');
                newRow.append('<td><textarea class="digitsOnly" id="' + newService.id + '">' + newService.price + '</textarea></td>');
                newRow.append('<td><textarea id="' + newService.id + '">' + newService.insication + '</textarea></td>');
                newRow.append('<td><textarea id="' + newService.id + '">' + newService.results + '</textarea></td>');
                newRow.append('<td><button class="change-service__button" id="' + newService.id + '"></button>' +
                    '<button class="delete-service__button" id="' + newService.id + '"></button></td>');

                // Добавляем новую строку в таблицу
                tableBody.append(newRow);

                $('.service_type').val('');
                $('.service_name').val('');
                $('.service_image').val('');
                $('.service_description').val('');
                $('.duration').val('');
                $('.price').val('');
                $('.insication').val('');
                $('.results').val('');

            } else {
                console.error('Произошла ошибка при добавлении услуги');
            }
        },
        error: function () {
            console.error('Произошла ошибка при добавлении услуги');
        }
    });
}

// Функция для проверки типа файла
function checkFileType(fileInput) {
    var validExtensions = ['image/jpeg', 'image/png', 'image/gif']; // Допустимые типы файлов

    var files = fileInput.files;

    for (var i = 0; i < files.length; i++) {
        if (!validExtensions.includes(files[i].type)) {
            alert("Недопустимый тип файла. Допустимые типы: JPEG, PNG, GIF.");
            fileInput.value = ''; // Очищаем значение поля input[type=file]
            return false; // Прерываем выполнение функции
        }
    }

    return true; // Тип файла соответствует требованиям
}

// Функция для проверки размера файла
function checkFileSize(fileInput) {
    var maxFileSize = 2 * 1024 * 1024; // 2 MB в байтах
    var files = fileInput.files;

    for (var i = 0; i < files.length; i++) {
        if (files[i].size > maxFileSize) {
            alert("Файл слишком большой. Максимальный размер файла 2 MB.");
            fileInput.value = ''; // Очищаем значение поля input[type=file]
            return false; // Прерываем выполнение функции
        }
    }

    return true; // Размер файла соответствует требованиям
}
// Получаем элемент input[type=file]
var fileInput = document.querySelector('.service_image');
// Назначаем обработчик события change
fileInput.addEventListener('change', function () {
    checkFileType(this); // При изменении файла проверяем его размер
    checkFileSize(this); // При изменении файла проверяем его размер
});

//удаление услуги
$(document).on('click', '.delete-service__button', function () {
    let id_service_to_delete = $(this).attr('id');
    deleteService(id_service_to_delete, $(this));
});

function deleteService(id_service_to_delete, button) {
    $.ajax({
        url: '../handlers/admin-panel-handlers/deleteServiceHandler.php',
        type: 'POST',
        data: {
            id_service_to_delete: id_service_to_delete
        },
        success: function (response) {
            let serviceRow = button.closest('tr'); // Используем closest для поиска ближайшего <tr>
            serviceRow.remove();
            alert("Услуга удалена!");
        },
        error: function () {
            console.error('Произошла ошибка при удалении услуги');
        }
    });
}

//обработчик клика по фото
document.addEventListener("DOMContentLoaded", function () {
    // Находим общий родительский элемент для всех фотографий и назначаем обработчик событий на него
    var parentContainer = document.querySelector('.table__to-update-delete.service');
    parentContainer.addEventListener('click', function (event) {
        var target = event.target;
        // Проверяем, является ли кликнутый элемент фотографией
        if (target.tagName === 'IMG' && target.parentNode.classList.contains('service-photo-container')) {
            var input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.onchange = function (event) {
                uploadPhoto(event, target);
            };
            input.click();
        }
    });

    // Функция для загрузки нового фото
    function uploadPhoto(event, photo) {
        var file = event.target.files[0];
        var reader = new FileReader();

        reader.onload = function (e) {
            var image = new Image();
            image.src = e.target.result;
            image.width = 100;

            // Обработчик клика на изображение для выбора нового фото
            image.onclick = function () {
                var input = document.createElement('input');
                input.type = 'file';
                input.accept = 'image/*';
                input.onchange = function (event) {
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

//обновление услуги

$(document).on('click', '.change-service__button', function () {
    var serviceId = $(this).attr('id');
    var service_type = $('.table__to-update-delete.service tr#' + serviceId + ' select').val();
    var service_name = $('.table__to-update-delete.service tr#' + serviceId + ' textarea').eq(0).val();
    var service_image = $('.table__to-update-delete.service tr#' + serviceId + ' .service-photo-container img'); // получаем элемент input
    var service_description = $('.table__to-update-delete.service tr#' + serviceId + ' textarea').eq(1).val();
    var duration = $('.table__to-update-delete.service tr#' + serviceId + ' textarea').eq(2).val();
    var price = $('.table__to-update-delete.service tr#' + serviceId + ' textarea').eq(3).val();
    var insication = $('.table__to-update-delete.service tr#' + serviceId + ' textarea').eq(4).val();
    var results = $('.table__to-update-delete.service tr#' + serviceId + ' textarea').eq(5).val();

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