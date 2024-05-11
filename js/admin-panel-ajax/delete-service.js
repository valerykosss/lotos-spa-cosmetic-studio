//удаление мастера
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