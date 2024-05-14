const wheelServiceSelect = document.getElementById("wheel_service");

(async () => {
    try {
        // Отправляем асинхронный запрос на сервер для получения услуг
        const response = await fetch(`../handlers/admin-panel-handlers/get_service_data_script.php`);
        const wheelServices = await response.json();
        // Обновляем список работников в <select>
        wheelServices.forEach(wheelService => {
            const option = document.createElement('option');
            option.value = wheelService[1];
            option.textContent = wheelService[0];
            wheelServiceSelect.appendChild(option);
        });
    } catch (error) {
        console.error('Ошибка при получении данных о работниках:', error);
    }

})()

// добавление скидки
$(".add-wheel__button").click(function () {
    let discount_name = $('.discount_name').val().trim();
    let sector_wheel_color = $('.sector_wheel_color').val();
    let id_service = $('#wheel_service').val();
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
                var newSector = response.wheel_discount;
                
                var tableBody = $('.table__to-update-delete.wheel').find('tbody'); // находим tbody во второй таблице
                console.log(tableBody);
                // Создаем новую строку для мастера
                var newRow = $('<tr id="' + newSector.id + '"></tr>');

                // Создаем ячейки для новой строки
                newRow.append('<td><textarea name="discount_name">' + newSector.discount_name + '</textarea></td>');
                newRow.append('<td><input type="color" class="colorpicker" value="' + newSector.sector_wheel_color + '" name="color"></td>');
                newRow.append('<td><select class="wheel-service" id="wheel_service">' + newSector.options + '</select></td>');
                newRow.append('<td><button class="change-wheel__button" id="' + newSector.id + '"></button>' +
                    '<button class="delete-wheel__button" id="' + newSector.id + '"></button></td>');

                // Добавляем новую строку в таблицу
                tableBody.append(newRow);
                
                $('.discount_name').val('');
                $('.sector_wheel_color').val('#000000');
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