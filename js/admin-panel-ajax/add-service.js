
// добавление service
$(".add-service__button").click(function () {
    // let master_name = $('.master_name').val().trim();
    // let master_surname = $('.master_surname').val().trim();
    // let master_photo = $('.master_photo').val().trim();
    // let education = $('.education').val().trim();
    // let work_experience = parseInt($('.work_experience').val().trim(), 10);
    // let position = $('.position').val().trim();
    // addMaster(master_name, master_surname, master_photo, education, work_experience, position, $(this)); 
});

// function addMaster(master_name, master_surname, master_photo, education, work_experience, position, button) {
//     $.ajax({
//         url: '../handlers/admin-panel-handlers/addMasterHandler.php',
//         type: 'POST',
//         dataType: 'json',
//         data: {
//             master_name: master_name,
//             master_surname: master_surname,
//             master_photo: master_photo,
//             education: education,
//             work_experience: work_experience,
//             position: position
//         },
//         success: function (response) {
//             if (response.success) {
//                 alert("Мастер добавлен!");
//                 var newMaster = response.master;
//                 var tableBody = $('.table__to-update-delete').find('tbody'); // находим tbody во второй таблице

//                 // Создаем новую строку для мастера
//                 var newRow = $('<tr id="' + newMaster.id+'"></tr>');

//                 // Создаем ячейки для новой строки
//                 newRow.append('<td><textarea id="' + newMaster.id + '">' + newMaster.master_name + '</textarea></td>');
//                 newRow.append('<td><textarea id="' + newMaster.id + '">' + newMaster.master_surname + '</textarea></td>');
//                 newRow.append('<td><textarea id="' + newMaster.id + '">' + newMaster.master_photo + '</textarea></td>');
//                 newRow.append('<td><textarea id="' + newMaster.id + '">' + newMaster.education + '</textarea></td>');
//                 newRow.append('<td><textarea id="' + newMaster.id + '">' + newMaster.work_experience + '</textarea></td>');
//                 newRow.append('<td><textarea id="' + newMaster.id + '">' + newMaster.position + '</textarea></td>');
//                 newRow.append('<td><button class="change-master__button" id="' + newMaster.id + '"></button>' +
//                     '<button class="delete-master__button" id="' + newMaster.id + '"></button></td>');

//                 // Добавляем новую строку в таблицу
//                 tableBody.append(newRow);

//                 $('.master_name').val('');
//                 $('.master_surname').val('');
//                 $('.master_photo').val('');
//                 $('.education').val('');
//                 $('.work_experience').val('');
//                 $('.position').val('');

//             } else {
//                 console.error('Произошла ошибка при добавлении мастера');
//             }
//         },
//         error: function () {
//             console.error('Произошла ошибка при добавлении мастера');
//         }
//     });
// }
