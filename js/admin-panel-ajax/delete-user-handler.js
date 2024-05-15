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