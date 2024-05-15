// import { changeStatus } from './change_record_status.js';

// Получаем ссылку на элемент <select> для услуги и работника
const serviceMSSelect = document.getElementById("service_ms");
const masterMSSelect = document.getElementById("master_ms");

(async () => {
    try {
        // Отправляем асинхронный запрос на сервер для получения услуг
        const response = await fetch(`../handlers/admin-panel-handlers/get_service_data_script.php`);
        const services = await response.json();
        // Обновляем список работников в <select>
        services.forEach(service => {
            const option = document.createElement('option');
            option.value = service[1];
            option.textContent = service[0];
            serviceMSSelect.appendChild(option);
        });
    } catch (error) {
        console.error('Ошибка при получении данных о работниках:', error);
    }
    
  })()

// Слушаем изменения в выборе услуги
serviceMSSelect.addEventListener("change", async function() {
    // Получаем выбранное значение услуги
    const selectedServiceId = serviceMSSelect.value;
    
    // Очищаем список работников
    masterMSSelect.innerHTML = '<option selected disabled>Выберите мастера</option>';
    
    if (selectedServiceId) {
        try {
            // Отправляем асинхронный запрос на сервер для получения работников, предоставляющих выбранную услугу
            const response = await fetch(`../handlers/admin-panel-handlers/get_new_master_data_script.php?service_id=${selectedServiceId}`);
            const masters = await response.json();
            // Обновляем список работников в <select>
            masters.forEach(master => {
                const option = document.createElement('option');
                option.value = master[1];
                option.textContent = master[0];
                masterMSSelect.appendChild(option);
            });
        } catch (error) {
            console.error('Ошибка при получении данных о работниках:', error);
        }
    }
});

$( ".add-master-service__button" ).click(function() {
    let service_id = $('select.service_ms').val();
    let master_id = $('select.master_ms').val();

        $.ajax({
            url: "../handlers/admin-panel-handlers/addMasterServiceHandler.php",
            method: "POST",
            dataType: 'json',
            data: {
                service_id: service_id,
                master_id: master_id,
            },
            success: function (response) { // запустится после получения результатов
                alert("Запись добавлена!");
                var newMasterService = response.master_service;
                var tableBody = $('.table__to-delete.master-service').find('tbody'); // находим tbody во второй таблице

                // Создаем новую строку для мастера
                var newRow = $('<tr id="' + newMasterService.id + '"></tr>');

                // Создаем ячейки для новой строки
                newRow.append('<td>'+newMasterService.id+'</td>');
                newRow.append('<td>'+newMasterService.service_name+'</td>');
                newRow.append('<td>'+newMasterService.master_name+'</td>');
                newRow.append('<td><button class="delete-ms__button" id="' + newMasterService.id + '"></button></td>');

                // Добавляем новую строку в таблицу
                tableBody.append(newRow);
                $('.service_ms option:first').prop('selected', true);
                $('.master_ms option:first').prop('selected', true);
            }
        });
});

//удаление записи
$(document).on('click', '.delete-ms__button', function () {
    let id_ms_to_delete = $(this).attr('id');
    deleteMasterService(id_ms_to_delete, $(this));
});

function deleteMasterService(id_ms_to_delete, button) {
    $.ajax({
        url: '../handlers/admin-panel-handlers/deleteMasterServiceHandler.php',
        type: 'POST',
        data: {
            id_ms_to_delete: id_ms_to_delete
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