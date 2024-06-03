import { changeStatus } from './change_record_status.js';
// Получаем ссылку на элемент <select> для услуги и работника
const serviceSelect = document.getElementById("service");
const masterSelect = document.getElementById("master");
const dateTimeSelect = document.getElementById("dateTime");
const userSelect = document.getElementById("user");
$('#service').on('click', function() {
    var select = $(this);
    $.ajax({
        url: '../handlers/admin-panel-handlers/get_service_data_script.php',
        type: 'POST',
        dataType: 'json',
        success: function(data) {
            select.empty(); // Очистить текущие опции
                select.append('<option selected disabled>Выберите услугу</option>');
                $.each(data, function(index, services) {
                    select.append('<option data-duration="'+services[2]+'" value="' + services[1] + '">' + services[0] + '</option>');
                });
        }
    });
});
(async () => {
    // try {
    //     // Отправляем асинхронный запрос на сервер для получения услуг
    //     const response = await fetch(`../handlers/admin-panel-handlers/get_service_data_script.php`);
    //     const services = await response.json();
    //     // Обновляем список работников в <select>
    //     services.forEach(service => {
    //         const option = document.createElement('option');
    //         option.value = service[1];
    //         option.textContent = service[0];
    //         option.setAttribute('data-duration', service[2]);
    //         serviceSelect.appendChild(option);
    //     });
    // } catch (error) {
    //     console.error('Ошибка при получении данных о работниках:', error);
    // }

    // Загружаем пользователей при загрузке страницы
    try {
        // Отправляем асинхронный запрос на сервер для получения пользователей
        const response = await fetch(`../handlers/admin-panel-handlers/get_user_data_script.php`);
        const users = await response.json();
        // Обновляем список пользователей в <select>
        users.forEach(user => {
            const option = document.createElement('option');
            option.value = user[0];
            option.textContent = `${user[1]} - ${user[2]}`;
            userSelect.appendChild(option);
        });
    } catch (error) {
        console.error('Ошибка при получении данных о пользователях:', error);
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
            const response = await fetch(`../handlers/admin-panel-handlers/get_master_data_script.php?service_id=${selectedServiceId}`);
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


// Обработчик для загрузки данных при выборе даты и времени
dateTimeSelect.addEventListener("focus", async function() {
    // Получаем выбранные значения услуги и мастера
    const selectedServiceId = serviceSelect.value;
    const selectedMasterId = masterSelect.value;

    // Получаем data-duration выбранного элемента в serviceSelect
    const selectedServiceOption = serviceSelect.options[serviceSelect.selectedIndex];
    const serviceDuration = selectedServiceOption.getAttribute('data-duration');
    
    console.log('Selected Service Duration:', serviceDuration);
    
    // Проверяем, что выбраны и услуга, и мастер
    if (selectedServiceId && selectedMasterId) {

        function getMasterTimetable(id_master, start_date, end_date) {
            return $.ajax({
                url: '../handlers/getMasterTimetable.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    id_master: id_master,
                    start_date: start_date,
                    end_date: end_date
                },
                success: function (response) {
                    if (response.error) {
                        console.error('Ошибка при загрузке графика работы мастера:', response.error);
                    }
                },
                error: function (error) {
                    console.error('Ошибка при выполнении запроса на загрузку графика работы мастера:', error);
                }
            });
        }


        // Функция для получения занятых слотов времени ПРАВИЛЬНО++++++++++++++++++++++++++++++++++++++++++++++
        function getBookedSlots(id_master, start_date, end_date) {
            return $.ajax({
                url: '../handlers/getBookedSlots.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    id_master: id_master,
                    start_date: start_date,
                    end_date: end_date
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Ошибка при загрузке занятых слотов:', textStatus, errorThrown);
                    return Promise.reject('Ошибка при загрузке занятых слотов');
                }
            });
        }

        function getAvailableSlots(master_timetable, booked_slots, service_duration) {

            const available_slots = [];
            var slotsCount = Math.ceil(service_duration / 30);

            master_timetable.forEach(function (slot) {

                let masterStart = moment(slot.start);
                console.log('');
                console.log("masterStart");
                console.log(masterStart.format('YYYY-MM-DD HH:mm:ss'));

                const masterEnd = moment(slot.end);
                console.log('');
                console.log("masterEnd");
                console.log(masterEnd.format('YYYY-MM-DD HH:mm:ss'));


                while (masterStart.isBefore(masterEnd)) {
                    const slotEnd = moment(masterStart).add(service_duration, 'minutes');
                    console.log('');
                    console.log("slotEnd");

                    console.log(slotEnd.format('YYYY-MM-DD HH:mm:ss'));

                    if (slotEnd.isAfter(masterEnd)) {
                        break;
                    }

                    let isAvailable = true;

                    // Проверяем тройные слоты
                    for (let j = 0; j < slotsCount; j++) {
                        console.log('');
                        console.log('j:');
                        console.log(j);
                        const currentSlotStart = moment(masterStart).add(j * 30, 'minutes');
                        const currentSlotEnd = moment(currentSlotStart).add(30, 'minutes');
                        console.log('');
                        console.log("currentSlotStart:");
                        console.log(currentSlotStart.format('YYYY-MM-DD HH:mm:ss'));

                        console.log('');
                        console.log("currentSlotEnd:");
                        console.log(currentSlotEnd.format('YYYY-MM-DD HH:mm:ss'));

                        for (let i = 0; i < booked_slots.length; i++) {
                            const bookedSlotStart = moment(booked_slots[i].record_date + ' ' + booked_slots[i].record_time);
                            const bookedSlotEnd = moment(bookedSlotStart).add(booked_slots[i].duration, 'minutes');

                            // (), []
                            if (currentSlotStart.isBetween(bookedSlotStart, bookedSlotEnd, null, '()') ||
                                currentSlotEnd.isBetween(bookedSlotStart, bookedSlotEnd, null, '(]')) {
                                isAvailable = false;
                                break;
                            }
                        }

                        if (!isAvailable) {
                            break;
                        }
                    }

                    if (isAvailable) {
                        available_slots.push({
                            start: masterStart.clone().format('YYYY-MM-DD HH:mm'),
                            end: slotEnd.clone().format('YYYY-MM-DD HH:mm')
                        });
                    }
                    // Переход к следующему слоту
                    masterStart.add(30, 'minutes');
                }
            });

            return available_slots;
        }


        function loadAvailableDates(id_master, duration_service_selected) {
            // console.log(duration_service_selected);
            var service_duration = duration_service_selected;

            getMasterTimetable(id_master, moment().format('YYYY-MM-DD HH:mm'), moment().add(1, 'months').format('YYYY-MM-DD  HH:mm'))
                .then(function (master_timetable) {
                    return getBookedSlots(id_master, moment().format('YYYY-MM-DD'), moment().add(1, 'months').format('YYYY-MM-DD'))
                        .then(function (booked_slots) {
                            var available_slots = getAvailableSlots(master_timetable, booked_slots, service_duration);
                            updateSelectWithAvailableSlots(available_slots);

                        });
                })
                .catch(function (error) {
                    console.error('Ошибка при загрузке доступных дат:', error);
                });
        }

        function updateSelectWithAvailableSlots(available_slots) {
            // Очищаем существующие опции
            dateTimeSelect.innerHTML = '<option selected disabled>Выберите дату и время</option>';
        
            // Функция для форматирования даты
            function formatDate(dateStr) {
                const date = new Date(dateStr);
                const options = { day: 'numeric', month: 'long', hour: '2-digit', minute: '2-digit' };
                return date.toLocaleString('ru-RU', options).replace(',', '');
            }
        
            // Заполняем новыми опциями
            available_slots.forEach(slot => {
                const option = document.createElement('option');
                option.value = slot.start;
                const [date, time] = slot.start.split(' ');
                option.textContent = formatDate(slot.start); // Форматируем отображаемый текст
                option.setAttribute('data-date', date);
                option.setAttribute('data-time', time);
                dateTimeSelect.appendChild(option);
            });
        }

        loadAvailableDates(selectedMasterId, serviceDuration);
    }
});




$( ".add-record__button" ).click(function() {
    let service_name = $('select.service').val();
    let master_name = $('#master').val();
    let client_name = $('#user').val();
    let selectedOption = $('#dateTime option:selected');
    let record_date = selectedOption.data('date');
    let record_time = selectedOption.data('time');

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
                var tableBody = $('.table__to-update-delete.record').find('tbody'); // находим tbody во второй таблице

                // Создаем новую строку для мастера
                var newRow = $('<tr id="' + newRecord.id + '"></tr>');

                // Создаем ячейки для новой строки
                newRow.append('<td>'+newRecord.id+'</td>');
                newRow.append('<td>'+newRecord.master_name+'</td>');
                newRow.append('<td>'+newRecord.service_name+'</td>');
                newRow.append('<td>' + newRecord.client_name + '<br>'+  newRecord.telephone +'</td>');
                newRow.append('<td>'+newRecord.record_date+'</td>');
                newRow.append('<td>'+newRecord.record_time+'</td>');
                newRow.append('<td><select class="record-status"><option value="1" selected>Ожидается</option><option value="2">Проведена</option></select></td>');
                newRow.append('<td><button class="delete-record__button" id="' + newRecord.id + '"></button></td>');

                // Добавляем новую строку в таблицу
                tableBody.append(newRow);
                changeStatus();
                $('#service option:first').prop('selected', true);
                $('#master option:first').prop('selected', true);
                $('#user option:first').prop('selected', true);
                $('#dateTime option:first').prop('selected', true);
            }
        });
});