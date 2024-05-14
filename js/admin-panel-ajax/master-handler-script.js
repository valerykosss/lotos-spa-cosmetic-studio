$(".add-master__button").click(function () {
    var formData = new FormData();
    formData.append('master_name', $('.master_name').val().trim());
    formData.append('master_surname', $('.master_surname').val().trim());
    var master_photo = $('.master_photo')[0].files[0];
    var reader = new FileReader();
    reader.readAsDataURL(master_photo);
    reader.onload = function () {
        var master_photo_base64 = reader.result;
        formData.append('master_photo', master_photo_base64);
        formData.append('education', $('.education').val().trim());
        formData.append('work_experience', parseInt($('.work_experience').val().trim(), 10));
        formData.append('position', $('.position').val().trim());

        addMaster(formData, $(this)); 
    };
});

function addMaster(formData, button) {
    $.ajax({
        url: '../handlers/admin-panel-handlers/addMasterHandler.php',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: formData,
        success: function (response) {
            console.log(typeof response)
            if (response.success) {
                alert("Мастер добавлен!");
                var newMaster = response.master;
                var tableBody = $('.table__to-update-delete.master').find('tbody'); // находим tbody во второй таблице

                // Создаем новую строку для мастера
                var newRow = $('<tr id="' + newMaster.id+'"></tr>');

                // Создаем ячейки для новой строки
                newRow.append('<td><textarea id="' + newMaster.id + '">' + newMaster.master_name + '</textarea></td>');
                newRow.append('<td><textarea id="' + newMaster.id + '">' + newMaster.master_surname + '</textarea></td>');
                newRow.append('<td class="master-photo-container" id="photo_' + newMaster.id + '"><img style="width: 200px" src="' + newMaster.master_photo + '"></td>');
                newRow.append('<td><textarea id="' + newMaster.id + '">' + newMaster.education + '</textarea></td>');
                newRow.append('<td><textarea class="digitsOnly" id="' + newMaster.id + '">' + newMaster.work_experience + '</textarea></td>');
                newRow.append('<td><textarea id="' + newMaster.id + '">' + newMaster.position + '</textarea></td>');
                newRow.append('<td><button class="change-master__button" id="' + newMaster.id + '"></button>' +
                    '<button class="delete-master__button" id="' + newMaster.id + '"></button></td>');

                // Добавляем новую строку в таблицу
                tableBody.append(newRow);

                $('.master_name').val('');
                $('.master_surname').val('');
                $('.master_photo').val('');
                $('.education').val('');
                $('.work_experience').val('');
                $('.position').val('');

            } else {
                console.error('Произошла ошибка при добавлении мастера');
            }
        },
        error: function () {
            console.error('Произошла ошибка при добавлении мастера');
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
var fileInput = document.querySelector('.master_photo');

// Назначаем обработчик события change
fileInput.addEventListener('change', function() {
    checkFileType(this); // При изменении файла проверяем его размер
    checkFileSize(this); // При изменении файла проверяем его размер
});

//удаление мастера
$(document).on('click', '.delete-master__button', function () {
    let id_master_to_delete = $(this).attr('id');
    deleteMaster(id_master_to_delete, $(this));
});

function deleteMaster(id_master_to_delete, button) {
    $.ajax({
        url: '../handlers/admin-panel-handlers/deleteMasterHandler.php',
        type: 'POST',
        data: {
            id_master_to_delete: id_master_to_delete
        },
        success: function (response) {
            let masterRow = button.closest('tr'); // Используем closest для поиска ближайшего <tr>
            masterRow.remove();
            alert("Мастер удален!");
        },
        error: function () {
            console.error('Произошла ошибка при удалении мастера');
        }
    });
}

document.addEventListener("DOMContentLoaded", function() {
    // Находим общий родительский элемент для всех фотографий мастеров и назначаем обработчик событий на него
    var parentContainer = document.querySelector('.table__to-update-delete.master');
    parentContainer.addEventListener('click', function(event) {
        var target = event.target;
        // Проверяем, является ли кликнутый элемент фотографией мастера
        if (target.tagName === 'IMG' && target.parentNode.classList.contains('master-photo-container')) {
            var input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.onchange = function(event) {
                uploadPhoto(event, target);
            };
            input.click();
        }
    });

    // Функция для загрузки нового фото
    function uploadPhoto(event, photo) {
        var file = event.target.files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            var image = new Image();
            image.src = e.target.result;
            image.width = 200;

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

//обновление мастера
$(document).on('click', '.change-master__button', function () {
    var masterId = $(this).attr('id');
    var master_name = $('tr#' + masterId + ' textarea').eq(0).val();
    var master_surname = $('tr#' + masterId + ' textarea').eq(1).val();
    var master_photo = $('tr#' + masterId + ' .master-photo-container img').eq(0); // получаем элемент input
    var education = $('tr#' + masterId + ' textarea').eq(2).val();
    var work_experience = $('tr#' + masterId + ' textarea').eq(3).val();
    var position = $('tr#' + masterId + ' textarea').eq(4).val();

    // Получение base64 изображения из тега img
    var master_photo = master_photo.prop('src');

    updateMaster(masterId, master_name, master_surname, master_photo, education, work_experience, position);
});


function updateMaster(masterId, master_name, master_surname, master_photo, education, work_experience, position) {
    $.ajax({
        url: '../handlers/admin-panel-handlers/updateMasterHandler.php',
        type: 'POST',
        dataType: 'json',
        data: {
            masterId: masterId,
            master_name: master_name,
            master_surname: master_surname,
            master_photo: master_photo,
            education: education,
            work_experience: work_experience,
            position: position
        },
        success: function (response) {
            if (response.success) {
                alert("Мастер обновлен!");

                // Обновляем данные в таблице
                $('textarea#'+ masterId).eq(0).val(master_name);
                $('textarea#'+ masterId).eq(1).val(master_surname);
                $('textarea#'+ masterId).eq(2).val(master_photo);
                $('textarea#'+ masterId).eq(3).val(education);
                $('textarea#'+ masterId).eq(4).val(work_experience);
                $('textarea#'+ masterId).eq(5).val(position);
            } else {
                console.error('Произошла ошибка при обновлении мастера');
            }
        },
        error: function () {
            console.error('Произошла ошибка при обновлении мастера');
        }
    });
}