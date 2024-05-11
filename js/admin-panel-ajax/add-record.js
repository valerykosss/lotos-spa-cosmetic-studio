import { changeStatus } from './change_record_status.js';
// Получаем ссылку на элемент <select> для услуги и работника
const serviceSelect = document.getElementById("service");
const masterSelect = document.getElementById("master");

(async () => {
    try {
        // Отправляем асинхронный запрос на сервер для получения услуг
        const response = await fetch(`../../handlers/admin-panel-handlers/get_service_data_script.php`);
        const services = await response.json();
        // Обновляем список работников в <select>
        services.forEach(service => {
            const option = document.createElement('option');
            option.value = service[1];
            option.textContent = service[0];
            serviceSelect.appendChild(option);
        });
    } catch (error) {
        console.error('Ошибка при получении данных о работниках:', error);
    }
    
  })()

// Слушаем изменения в выборе услуги
serviceSelect.addEventListener("change", async function() {
    // Получаем выбранное значение услуги
    const selectedServiceId = serviceSelect.value;
    
    // Очищаем список работников
    masterSelect.innerHTML = '<option selected disabled>Выберите мастера</option>';
    
    if (selectedServiceId) {
        try {
            // Отправляем асинхронный запрос на сервер для получения работников, предоставляющих выбранную услугу
            const response = await fetch(`../../handlers/admin-panel-handlers/get_master_data_script.php?service_id=${selectedServiceId}`);
            const masters = await response.json();
            // Обновляем список работников в <select>
            masters.forEach(master => {
                const option = document.createElement('option');
                option.value = master[1];
                option.textContent = master[0];
                masterSelect.appendChild(option);
            });
        } catch (error) {
            console.error('Ошибка при получении данных о работниках:', error);
        }
    }
});

$( ".add-record__button" ).click(function() {
    let service_name = $('.service').val();
    let master_name = $('#master').val();
    let client_name = $('.client_name').val();
    let record_date = $('.new-record_date').val().trim();
    let record_time = $('.new-record_time').val();

        $.ajax({
            url: "../handlers/admin-panel-handlers/addRecordHandler.php",
            method: "POST",
            dataType: 'json',
            data: {
                service_name: service_name,
                master_name: master_name,
                client_name: client_name,
                record_date: record_date,
                record_time: record_time
            },
            success: function (response) { // запустится после получения результатов
                alert("Запись добавлена!");
                var newRecord = response.record;
                var tableBody = $('.table__to-update-delete').find('tbody'); // находим tbody во второй таблице

                // Создаем новую строку для мастера
                var newRow = $('<tr id="' + newRecord.id + '"></tr>');

                // Создаем ячейки для новой строки
                newRow.append('<td>'+newRecord.id+'</td>');
                newRow.append('<td>'+newRecord.service_name+'</td>');
                newRow.append('<td>'+newRecord.master_name+'</td>');
                newRow.append('<td>' + newRecord.client_name + '</td>');
                newRow.append('<td>'+newRecord.record_date+'</td>');
                newRow.append('<td>'+newRecord.record_time+':00</td>');
                newRow.append('<td><select class="record-status"><option value="1" selected>Ожидается</option><option value="2">Проведена</option></select></td>');
                newRow.append('<td><button class="delete-record__button" id="' + newRecord.id + '">удалить</button></td>');

                // Добавляем новую строку в таблицу
                tableBody.append(newRow);
                changeStatus();
                $('.service').val('');
                $('.master_name').val('');
                $('.client_name').val('');
                $('.new-record_date').val('');
                $('.new-record_time').val('');
            }
        });
});