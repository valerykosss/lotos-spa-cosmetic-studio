// $( ".add-master__button" ).click(function() {
//     let master_name = $('.master_name').val().trim();
//     let master_surname = $('.master_surname').val().trim();
//     let master_photo = $('.master_photo').val().trim();
//     let education = $('.education').val().trim();
//     let work_experience = parseInt($('.work_experience').val().trim(), 10);
//     let position = $('.position').val().trim();

//         $.ajax({
//             url: "../handlers/admin-panel-handlers/addMasterHandler.php",
//             method: "POST",
//             data: {
//                 master_name: master_name,
//                 master_surname: master_surname,
//                 master_photo: master_photo,
//                 education: education,
//                 work_experience: work_experience,
//                 position: position,
//             },
//             success: function (data) { // запустится после получения результатов
//                 alert("Мастер добавлен!");
//                 $(".table__to-update-delete").html(data);

//                 $('.master_name').val('');
//                 $('.master_surname').val('');
//                 $('.master_photo').val('');
//                 $('.education').val('');
//                 $('.work_experience').val('');
//                 $('.position').val('');
//             }
//         });
// });

// $( ".delete-master__button" ).click(function() {
//     let id_master_to_delete = $(this).attr("id");

//         $.ajax({
//             url: "../handlers/admin-panel-handlers/deleteMasterHandler.php",
//             method: "POST",
//             data: {
//                 id_master_to_delete: id_master_to_delete,
//             },
//             success: function (data) { // запустится после получения результатов
//                 alert("Мастер удален!");
//                 $(".table__to-update-delete").html(data);
//             }
//         });
// });


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
                newRow.append('<td class="photo-container" id="photo_' + newMaster.id + '"><img src="' + newMaster.master_photo + '"></td>');
                newRow.append('<td><textarea id="' + newMaster.id + '">' + newMaster.education + '</textarea></td>');
                newRow.append('<td><textarea id="' + newMaster.id + '">' + newMaster.work_experience + '</textarea></td>');
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
