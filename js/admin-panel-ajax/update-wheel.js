// Обработчик нажатия кнопки изменения элемента
$(document).on('click', '.change-wheel__button', function () {
    var rowId = $(this).closest('tr').attr('id'); // Получаем ID строки таблицы
    var discountName = $(this).closest('tr').find('textarea[name=discount_name]').val(); // Получаем значение поля "discount_name"
    var color = $(this).closest('tr').find('input[name=color]').val(); // Получаем значение поля "color"
    var wheelService = $(this).closest('tr').find('select[id=wheel_service]').val(); // Получаем значение поля "wheel_service"
    
    // Отправляем данные на сервер для обновления
    updateWheel(rowId, discountName, color, wheelService);
});


// Функция для обновления элемента
function updateWheel(rowId, discountName, color, wheelService) {
    $.ajax({
        url: '../handlers/admin-panel-handlers/update_wheel_script.php', // Путь к обработчику на сервере для обновления элемента
        type: 'POST',
        data: {
            id: rowId,
            discount_name: discountName,
            color: color,
            wheel_service: wheelService
        },
        success: function (response) {
            // Обработка успешного ответа от сервера
            alert("Сектор обновлен!");
            console.log('Элемент успешно обновлен!');
        },
        error: function () {
            // Обработка ошибки
            console.error('Произошла ошибка при обновлении элемента.');
        }
    });
}


