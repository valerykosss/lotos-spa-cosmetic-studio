//удаление записи
$(document).on('click', '.delete-record__button', function () {
    let id_record_to_delete = $(this).attr('id');
    deleteService(id_record_to_delete, $(this));
});

function deleteService(id_record_to_delete, button) {
    $.ajax({
        url: '../handlers/admin-panel-handlers/deleteRecordHandler.php',
        type: 'POST',
        data: {
            id_record_to_delete: id_record_to_delete
        },
        success: function (response) {
            let recordRow = button.closest('tr'); // Используем closest для поиска ближайшего <tr>
            recordRow.remove();
            alert("Запись удалена!");
        },
        error: function () {
            console.error('Произошла ошибка при удалении записи');
        }
    });
}