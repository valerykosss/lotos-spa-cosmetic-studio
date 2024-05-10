// добавление мастера
$(".add-wheel__button").click(function () {
    let discount_name = $('.discount_name').val().trim();
    let sector_wheel_color = $('.sector_wheel_color').val();
    let id_service = $('.id_service').val().trim();
    addWheel(discount_name, sector_wheel_color, id_service, $(this)); 
});

function addWheel(discount_name, sector_wheel_color, id_service, button) {
    $.ajax({
        url: '../handlers/admin-panel-handlers/addWheelHandler.php',
        type: 'POST',
        dataType: 'json',
        data: {
            discount_name: discount_name,
            sector_wheel_color: sector_wheel_color,
            id_service: id_service,
        },
        success: function (response) {
            if (response.success) {
                alert("Сектор добавлен!");
                //тут было response.master
                var newSector = response.wheel_discount;
                var tableBody = $('.table__to-update-delete wheel').find('tbody'); // находим tbody во второй таблице

                // Создаем новую строку для мастера
                var newRow = $('<tr id="' + newSector.id+'"></tr>');

                // Создаем ячейки для новой строки
                newRow.append('<td><textarea>' + newSector.discount_name + '</textarea></td>');
                newRow.append('<td><textarea>' + newSector.sector_wheel_color + '</textarea></td>');
                newRow.append('<td><textarea>' + newSector.id_service + '</textarea></td>');
                newRow.append('<td><button class="change-wheel__button" id="' + newSector.id + '"></button>' +
                    '<button class="delete-wheel__button" id="' + newSector.id + '"></button></td>');

                // Добавляем новую строку в таблицу
                tableBody.append(newRow);

                $('.discount_name').val('');
                $('.sector_wheel_color').val('');
                $('.id_service').val('');

            } else {
                console.error('Произошла ошибка при добавлении сектора');
            }
        },
        error: function () {
            console.error('Произошла ошибка при добавлении сектора');
        }
    });
}
