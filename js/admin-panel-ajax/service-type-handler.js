$( ".add-service-type__button" ).click(function() {

    let service_type_name = $('.service-type_name').val();

    $.ajax({
        url: "../handlers/admin-panel-handlers/addServiceTypeHandler.php",
        method: "POST",
        dataType: 'json',
        data: {
            service_type_name: service_type_name,
        },
        success: function (response) { // запустится после получения результатов
            alert("Запись добавлена!");
            var newServiceType = response.service_type;
            var tableBody = $('.table__to-update-delete.service-type').find('tbody'); // находим tbody во второй таблице

            // Создаем новую строку для мастера
            var newRow = $('<tr id="' + newServiceType.id + '"></tr>');

            // Создаем ячейки для новой строки
            newRow.append('<td>'+newServiceType.service_type_name+'</td>');
            newRow.append('<td><button class="change-type-service__button" id="' + newServiceType.id + '"></button><button class="delete-type-service__button" id="' + newServiceType.id + '"></button></td>');

            // Добавляем новую строку в таблицу
            tableBody.append(newRow);
            $('.service-type_name').val('');
        }
    });
});

//удаление типа сервиса
$(document).on('click', '.delete-type-service__button', function () {
    let id_service_type_to_delete = $(this).attr('id');
    deleteServiceType(id_service_type_to_delete, $(this));
});

function deleteServiceType(id_service_type_to_delete, button) {
    $.ajax({
        url: '../handlers/admin-panel-handlers/deleteServiceTypeHandler.php',
        type: 'POST',
        data: {
            id_service_type_to_delete: id_service_type_to_delete
        },
        success: function (response) {
            let serviceTypeRow = button.closest('tr'); // Используем closest для поиска ближайшего <tr>
            serviceTypeRow.remove();
            alert("Тип услуги удален!");
        },
        error: function () {
            console.error('Произошла ошибка при удалении типа услуги');
        }
    });
}

//обновление типа сервиса
$(document).on('click', '.change-type-service__button', function () {
    var serviceTypeId = $(this).closest('tr').attr('id'); // Получаем ID строки таблицы
    var service_type_name = $(this).closest('tr').find('textarea[name=service-type-name]').val(); // Получаем значение поля "discount_name"

    updateServiceType(serviceTypeId, service_type_name);
});


function updateServiceType(serviceTypeId, service_type_name) {
    $.ajax({
        url: '../handlers/admin-panel-handlers/updateServiceTypeHandler.php',
        type: 'POST',
        dataType: 'json',
        data: {
            serviceTypeId: serviceTypeId,
            service_type_name: service_type_name
        },
        success: function (response) {
            if (response.success) {
                alert("Тип сервиса обновлен!");

                // Обновляем данные в таблице
                $('textarea#'+ serviceTypeId).eq(0).val(service_type_name);
            } else {
                console.error('Произошла ошибка при обновлении типа услуги');
            }
        },
        error: function () {
            console.error('Произошла ошибка при обновлении типа услуги');
        }
    });
}