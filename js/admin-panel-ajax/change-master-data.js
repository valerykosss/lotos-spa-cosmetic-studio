document.addEventListener('DOMContentLoaded', function() {
    const textareas = document.querySelectorAll('.table__to-update-delete textarea');
    const selects = document.querySelectorAll('.table__to-update-delete .status-select');

    // Обработчик изменения выпадающего списка
    selects.forEach(select => {
        select.addEventListener('change', function() {
            updateRecord(this.getAttribute('data-record-id'), this.value, 'id_record_status');
        });
    });

    // Функция для отправки AJAX запроса
    function updateRecord(id, value, field) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../handlers/update_record_data_script.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Обработка ответа от сервера (если необходимо)
                console.log(xhr.responseText);
            }
        };

        const data = `id=${id}&value=${encodeURIComponent(value)}&field=${field}`;
        console.log(data);
        xhr.send(data);
    }
});
