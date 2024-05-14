// Функция для удаления элемента
function deleteWheel(rowId, button) {
    $.ajax({
        url: '../handlers/admin-panel-handlers/delete_wheel_script.php', // Путь к обработчику на сервере для удаления элемента
        type: 'POST',
        data: {
            id: rowId
        },
        success: function (response) {
            alert("Сектор удален!");
            let wheelRow = button.closest('tr'); // Используем closest для поиска ближайшего <tr>
            wheelRow.remove();
            // Обработка успешного ответа от сервера
            console.log('Элемент успешно удален!');
        },
        error: function () {
            // Обработка ошибки
            console.error('Произошла ошибка при удалении элемента.');
        }
    });
}
// Обработчик нажатия кнопки удаления элемента
$(document).on('click', '.delete-wheel__button', function () {
    var rowId = $(this).closest('tr').attr('id'); // Получаем ID строки таблицы
    
    // Отправляем данные на сервер для удаления
    deleteWheel(rowId, $(this));
});
