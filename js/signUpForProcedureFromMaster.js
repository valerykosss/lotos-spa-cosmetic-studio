
// Обработчик изменения значения первого select (мастера) ЭТО ДЛЯ РАСШИРЕННОЙ ЗАПИСИ
// $('#masters__data').change(function() {
//     var id_master = $(this).val(); // Получаем выбранный id_master

//     // Заполнение select #services__data
//     $('#services__data').empty(); // очищаем select

//     $.ajax({
//         url: '../handlers/getServicesByMaster.php',
//         type: 'GET',
//         dataType: 'json',
//         data: { id_master: id_master },
//         success: function(data) {
//             $.each(data, function(index, service) {
//                 // Создаем option для каждой услуги
//                 var option = $('<option></option>').attr('value', service.id_service).text(service.service_name);

//                 // Добавляем option в select
//                 $('#services__data').append(option);
//             });
//         },
//         error: function(error) {
//             console.error('Ошибка при загрузке данных:', error);
//         }
//     });
// });

$(document).ready(function () {

    $(".close__form").mousedown(function () {
        clear();
        $("#sign-up-for-procedure__window").css("display", "none");
    });
    // Обработчик события клика по кнопке
    $('.specialist-button').click(function () {
        
        // Отображение блока
        $('#sign-up-for-procedure__window').show();

        // Центрирование блока по вертикали и горизонтали
        var windowHeight = $(window).height();
        var windowWidth = $(window).width();
        var formHeight = $('#sign-up-for-procedure__form').outerHeight();
        var formWidth = $('#sign-up-for-procedure__form').outerWidth();

        var topMargin = (windowHeight - formHeight) / 2;
        var leftMargin = (windowWidth - formWidth) / 2;

        $('#sign-up-for-procedure__form').css({
            'margin-top': topMargin + 'px',
            'margin-left': leftMargin + 'px'
        });

        // Получение ID мастера из кнопки
        var id_master = $(this).attr('id');

        // Заполнение select #masters__data
        $('#masters__data').empty(); // Очищаем select

        $.ajax({
            url: '../handlers/getMasterById.php',
            type: 'GET',
            dataType: 'json',
            data: { id_master: id_master },
            success: function (master) {
                var option = $('<option></option>').attr('value', master.id_master).text(master.master_name + ' ' + master.master_surname);
                $('#masters__data').append(option);
            },
            error: function (error) {
                console.error('Ошибка при загрузке данных:', error);
            }
        });

        // Заполнение select #services__data
        $('#services__data').empty(); // Очищаем select

        $.ajax({
            url: '../handlers/getServicesByMaster.php',
            type: 'GET',
            dataType: 'json',
            data: { id_master: id_master },
            success: function (services) {
                $.each(services, function (index, service) {
                    var option = $('<option></option>').attr({
                        'value': service.id_service,
                        'data-duration': service.duration,
                        'data-price': service.price
                    }).text(service.service_name);
                    $('#services__data').append(option);
                });

                 // Проверка атрибутов после добавления option
                $('#services__data option').each(function() {
                    console.log('Value:', $(this).val());
                    console.log('Data duration:', $(this).data('duration'));
                    console.log('Data price:', $(this).data('price'));
                });

                var id_service_selected = $('#services__data').val(services[0].id_service).trigger('change');
                duration_service_selected = $(this).find(':selected').data('duration');


            },
            error: function (error) {
                console.error('Ошибка при загрузке данных:', error);
            }

        });


        // Функция для получения рабочего графика мастера ПРАВИЛЬНО++++++++++++++++++++++++++++++++++++++++++++++
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

            // var masterStart = moment(slot.start);
            //     var masterEnd = moment(slot.end);

            const available_slots = [];
            var slotsCount = Math.ceil(service_duration / 30);

            master_timetable.forEach(function (slot) {

                let masterStart = moment(slot.start);
                // console.log('');
                // console.log("masterStart");
                // console.log(masterStart.format('YYYY-MM-DD HH:mm:ss'));

                const masterEnd = moment(slot.end);
                // console.log('');
                // console.log("masterEnd");
                // console.log(masterEnd.format('YYYY-MM-DD HH:mm:ss'));


                while (masterStart.isBefore(masterEnd)) {
                    const slotEnd = moment(masterStart).add(service_duration, 'minutes');
                    // console.log('');
                    // console.log("slotEnd");

                    // console.log(slotEnd.format('YYYY-MM-DD HH:mm:ss'));

                    if (slotEnd.isAfter(masterEnd)) {
                        break;
                    }

                    let isAvailable = true;

                    // Проверяем тройные слоты
                    for (let j = 0; j < slotsCount; j++) {
                        // console.log('');
                        // console.log('j:');
                        // console.log(j);
                        const currentSlotStart = moment(masterStart).add(j * 30, 'minutes');
                        const currentSlotEnd = moment(currentSlotStart).add(30, 'minutes');
                        // console.log('');
                        // console.log("currentSlotStart:");
                        // console.log(currentSlotStart.format('YYYY-MM-DD HH:mm:ss'));

                        // console.log('');
                        // console.log("currentSlotEnd:");
                        // console.log(currentSlotEnd.format('YYYY-MM-DD HH:mm:ss'));

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
                            updateCalendarWithAvailableSlots(available_slots);
                        });
                })
                .catch(function (error) {
                    console.error('Ошибка при загрузке доступных дат:', error);
                });
        }

        function updateCalendarWithAvailableSlots(available_slots) {
            $('#calendar').fullCalendar('destroy');

            $('#calendar').fullCalendar({
                defaultView: 'month',
                editable: true,
                events: available_slots.map(function (slot) {
                    return {
                        start: slot.start,
                        end: slot.end,
                        allDay: false,
                    };
                }),

                eventClick: function(event) {
                    
                    var startDate = event.start.format('YYYY-MM-DD HH:mm');
            
                    var endDate = event.end ? event.end.format('YYYY-MM-DD HH:mm') : '';
            
                    console.log('Выбранное событие:');
                    console.log('Начало:', startDate);
                    console.log('Окончание:', endDate);
            
                    // Здесь вы можете выполнить дополнительные действия с выбранным событием


                },
                
            });
            // Функция для сброса стилей у всех кнопок
            function resetStyles() {
                const buttons = document.querySelectorAll('.fc-day-grid-event');
                buttons.forEach(button => {
                    button.style.backgroundColor = '';
                });
            }

            // Функция для применения стилей к нажатой кнопке
            function applyStylesToClickedButton(button) {
                button.style.backgroundColor = 'gray';
            }

            // Получаем все кнопки с классом 'fc-day-grid-event'
            const buttons = document.querySelectorAll('.fc-day-grid-event');

            // Добавляем обработчик клика для каждой кнопки
            buttons.forEach(button => {
                button.addEventListener('click', function() {
                    // Сбрасываем стили у всех кнопок
                    resetStyles();
                    // Применяем стили к нажатой кнопке
                    applyStylesToClickedButton(button);
                });
            });
            
        }

        loadAvailableDates(id_master, duration_service_selected);
        var duration_service_selected;
        $('#services__data').change(function() {
            var id_service = $(this).val(); // Получаем выбранный id_service
            duration_service_selected = $(this).find(':selected').data('duration');
            console.log('Выбранный ID услуги:', id_service);
            console.log('Продолжительность выбранной услуги:', duration_service_selected);

            loadAvailableDates(id_master, duration_service_selected); // Передаем id_service в функцию
            console.log(duration_service_selected);
        });
        
    });

    $('#sign-up-for-procedure__button').click(function() {
        // Получаем выбранную дату из календаря

        if (selectedDate) { // проверяем, выбрана ли дата
            console.log('Выбранная дата для записи:', selectedDate.format());

            try {
                const response = $.ajax({
                    url: '../handlers/recordAppointment.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        selectedDate: selectedDate.format(),
                        // другие данные для отправки на сервер
                    }
                });

                if (response.success) {
                    console.log('Запись успешно сохранена');
                    // здесь вы можете выполнить дополнительные действия после успешного сохранения записи
                    alert('Запись успешно сохранена');
                    $("#sign-up-for-procedure__window").css("display", "none"); // закрываем окно после успешной записи
                } else {
                    console.error('Ошибка при сохранении записи:', response.error);
                    alert('Ошибка при сохранении записи: ' + response.error);
                }
            } catch (error) {
                console.error('Ошибка при выполнении AJAX-запроса:', error);
                alert('Ошибка при выполнении AJAX-запроса');
            }
        } else {
            console.warn('Дата не выбрана');
            alert('Дата не выбрана');
        }
    });
});