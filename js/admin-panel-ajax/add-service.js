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
                var newRow = $('<tr id="' + newService.id+'"></tr>');

                // Создаем ячейки для новой строки
                newRow.append('<td><textarea id="' + newService.id + '">' + newService.service_type + '</textarea></td>');
                newRow.append('<td><textarea id="' + newService.id + '">' + newService.service_name + '</textarea></td>');
                newRow.append('<td class="photo-container" id="photo_' + newService.id + '"><img src="' + newService.service_image + '"></td>');
                newRow.append('<td><textarea id="' + newService.id + '">' + newService.service_description + '</textarea></td>');
                newRow.append('<td><textarea id="' + newService.id + '">' + newService.duration + '</textarea></td>');
                newRow.append('<td><textarea id="' + newService.id + '">' + newService.price + '</textarea></td>');
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
fileInput.addEventListener('change', function() {
    checkFileType(this); // При изменении файла проверяем его размер
    checkFileSize(this); // При изменении файла проверяем его размер
});
