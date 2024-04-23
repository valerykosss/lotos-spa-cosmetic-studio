
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
            },
            error: function (error) {
                console.error('Ошибка при загрузке данных:', error);
            }
        });


        // Функция для получения рабочего графика мастера НАПИСАЛИ
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


        // Функция для получения занятых слотов времени
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

        // Функция для формирования списка доступных слотов
        function getAvailableSlots(master_timetable, booked_slots, service_duration) {
            var available_slots = [];
        
            // Перебираем рабочий график мастера
            master_timetable.forEach(function (slot) {
                var slotStart = moment(slot.start);
                var slotEnd = moment(slot.start).add(service_duration, 'minutes');
        
                // Проверяем, свободен ли текущий слот времени
                var isAvailable = true;
                booked_slots.forEach(function (bookedSlot) {
                    var bookedSlotStart = moment(bookedSlot.record_date + ' ' + bookedSlot.record_time);
                    var bookedSlotEnd = moment(bookedSlot.record_date + ' ' + bookedSlot.record_time).add(bookedSlot.duration, 'minutes');
        
                    if (slotStart.isBetween(bookedSlotStart, bookedSlotEnd) || slotEnd.isBetween(bookedSlotStart, bookedSlotEnd)) {
                        isAvailable = false;
                        return false; // Выходим из цикла, если слот уже занят
                    }
                });
        
                // Проверяем, достаточно ли длительности слота для выбранной услуги
                if (isAvailable) {
                    available_slots.push({
                        start: slotStart.format('YYYY-MM-DD HH:mm'),
                        end: slotEnd.format('YYYY-MM-DD HH:mm')
                    });
                }
            });
            return available_slots;
        }
        

        // function getAvailableDates(master_timetable, booked_slots, service_duration) {
        //     var available_dates = [];

        //     // Преобразуем рабочий график мастера в объекты moment
        //     var workingDays = master_timetable.map(function (slot) {
        //         return {
        //             start: moment(slot.start),
        //             end: moment(slot.end)
        //         };
        //     });

        //     console.log("workingDays со скольки до скольки");
        //     console.log(workingDays); //это получает в формате занятого дня мастера c '2024-04-25 10:00' до '2024-04-25 18:00' 

        //     // Преобразуем занятые слоты в объекты moment ТУТ ОШИБКА !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        //     var busySlots = booked_slots.map(function (bookedSlot) {
        //         return {
        //             start: moment(bookedSlot.record_date + ' ' + bookedSlot.record_time),
        //             end: moment(bookedSlot.record_date + ' ' + bookedSlot.record_time).add(service_duration, 'minutes')
        //         };
        //     });

        //     console.log("busySlots со скольки до скольки");
        //     console.log(busySlots);  //это получает в формате занятых времен в днях мастера '2024-04-25 14:00', '2024-04-25 16:00'

        //     // Перебираем даты в рабочем графике мастера
        //     workingDays.forEach(function (day) {
        //         var currentDate = day.start.clone();
        //         console.log(currentDate);

        //         while (currentDate.isSameOrBefore(day.end)) {
        //             var isAvailable = true;

        //             // Проверяем, свободен ли текущий слот времени
        //             busySlots.forEach(function (busySlot) {
        //                 if (currentDate.isBetween(busySlot.start, busySlot.end)) {
        //                     isAvailable = false;
        //                     return false; // Выходим из цикла, если слот уже занят
        //                 }
        //             });

        //             // Проверяем, достаточно ли длительности слота для выбранной услуги
        //             if (isAvailable && day.end.diff(currentDate, 'minutes') >= service_duration) {
        //                 available_dates.push(currentDate.format('YYYY-MM-DD'));
        //             }

        //             // Переходим к следующему слоту
        //             currentDate.add(30, 'minutes');
        //         }
        //     });
        //     // Возвращаем уникальные даты
        //     return [...new Set(available_dates)];
        // }


        // Функция для обновления календаря с доступными слотами
        function updateCalendarWithAvailableSlots(available_slots) {
            $('#calendar').fullCalendar('destroy'); // Уничтожаем текущий календарь

            $('#calendar').fullCalendar({
                defaultView: 'month',
                editable: true,
                selectable: true,
                select: function (start, end) {
                    // Здесь можно обработать выбор пользователя
                    console.log('Выбранная дата:', start.format());
                },
                events: available_slots.map(function (slot) {
                    return {
                        start: slot.start,
                        end: slot.end,
                        allDay: false
                    };
                })
            });
        }


        // Загрузка и обработка доступных дат
        function loadAvailableDates(id_master) {
            var service_duration = $('#services__data option:selected').data('duration');

            // Загрузка рабочего графика мастера
            getMasterTimetable(id_master, moment().format('YYYY-MM-DD HH:mm'), moment().add(1, 'months').format('YYYY-MM-DD  HH:mm'))
                .then(function (master_timetable) {
                    // Загрузка забронированных слотов
                    return getBookedSlots(id_master, moment().format('YYYY-MM-DD'), moment().add(1, 'months').format('YYYY-MM-DD'))
                        .then(function (booked_slots) {
                            // Получение доступных слотов
                            var available_slots = getAvailableSlots(master_timetable, booked_slots, service_duration);

                            // Обновление календаря с доступными слотами
                            updateCalendarWithAvailableSlots(available_slots);
                        });
                })
                .catch(function (error) {
                    console.error('Ошибка при загрузке доступных дат:', error);
                });
        }

        $('.specialist-button.selected').removeClass('selected');
        $(this).addClass('selected');

        var id_master = $(this).attr('id');
        loadAvailableDates(id_master);
    });
});
