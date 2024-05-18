$( ".add-user__button" ).click(function() {

    let user_name = $('.user_name').val();
    let user_email = $('.user_email').val();
    let user_phone = $('.user_phone').val();
    let user_role = $('.user_role').val();


    $.ajax({
        url: "../handlers/admin-panel-handlers/addUserHandler.php",
        method: "POST",
        dataType: 'json',
        data: {
            user_name: user_name,
            user_email: user_email,
            user_phone: user_phone,
            user_role: user_role,
        },
        success: function (response) { // запустится после получения результатов
            alert("Пользователь добавлен!");
            var newUser = response.user;
            var tableBody = $('.table__to-update-delete.user').find('tbody'); // находим tbody во второй таблице

            // Создаем новую строку для мастера
            var newRow = $('<tr id="' + newUser.id + '"></tr>');

            // Создаем ячейки для новой строки
            newRow.append('<td>'+newUser.id+'</td>');
            newRow.append('<td><textarea name="user-name">'+newUser.user_name+'</textarea></td>');
            newRow.append('<td><textarea name="user-email">'+newUser.user_email+'</textarea></td>');
            newRow.append('<td><textarea name="user-phone">'+newUser.user_phone+'</textarea></td>');
            newRow.append('<td></td>');
            newRow.append('<td><select class="user-role">'+newUser.options+'</select></td>');
            newRow.append('<td><button class="change-user__button" id="' + newUser.id + '"></button><button class="delete-user__button" id="' + newUser.id + '"></button></td>');

            // Добавляем новую строку в таблицу
            tableBody.append(newRow);

            $('.user_name').val('');
            $('.user_email').val('');
            $('.user_phone').val('');
            $('.user_role option:first').prop('selected', true);
        }
    });
});
//удаление user
$(document).on('click', '.delete-user__button', function () {
    let id_user_to_delete = $(this).attr('id');
    deleteMasterService(id_user_to_delete, $(this));
});

function deleteMasterService(id_user_to_delete, button) {
    $.ajax({
        url: '../handlers/admin-panel-handlers/deleteUserHandler.php',
        type: 'POST',
        data: {
            id_user_to_delete: id_user_to_delete
        },
        success: function (response) {
            let recordRow = button.closest('tr'); // Используем closest для поиска ближайшего <tr>
            recordRow.remove();
            alert("Пользователь удалена!");
        },
        error: function () {
            console.error('Произошла ошибка при удалении пользователя');
        }
    });
}

//изменение юзера
$(document).on('click', '.change-user__button', function () {
    var userId = $(this).closest('tr').attr('id'); // Получаем ID строки таблицы
    var user_name = $(this).closest('tr').find('textarea[name=user-name]').val();
    var user_email = $(this).closest('tr').find('textarea[name=user-email]').val();
    var user_phone = $(this).closest('tr').find('textarea[name=user-phone]').val(); 
    var user_role = $(this).closest('tr').find('select[class=user-role]').val();

    updateUser(userId, user_name, user_email, user_phone, user_role);
});


function updateUser(userId, user_name, user_email, user_phone, user_role) {
    $.ajax({
        url: '../handlers/admin-panel-handlers/updateUserHandler.php',
        type: 'POST',
        dataType: 'json',
        data: {
            userId: userId,
            user_name: user_name,
            user_email: user_email,
            user_phone: user_phone,
            user_role: user_role,
        },
        success: function (response) {
            if (response.success) {
                alert("Пользователь обновлен!");

                // Обновляем данные в таблице
                $('textarea#'+ userId).eq(1).val(user_name);
                $('textarea#'+ userId).eq(2).val(user_email);
                $('textarea#'+ userId).eq(3).val(user_phone);
            } else {
                console.error('Произошла ошибка при обновлении пользователя');
            }
        },
        error: function () {
            console.error('Произошла ошибка при обновлении пользователя');
        }
    });
}