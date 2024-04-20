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
            console.error('Произошла ошибка при удалении пользователя');
        }
    });
}