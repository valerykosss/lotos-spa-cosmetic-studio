
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



        function getAvailableSlots(master_timetable, booked_slots, service_duratio) {
            var available_slots = [];

            // master_timetable.forEach(function (slot) {
            //     //видимо тут нужно брать слот не глобальный, а локальный по длительности процедуры 
            //     var slotStart = moment(slot.start);
            //     var slotEnd = moment(slot.end);

            //     // console.log(slotStart); 
            //     //console.log(slotEnd); //ПРАВИЛЬНО. ПОЛУЧАЕТ НАЧАЛА И КОНЦЫ ВРЕМЕНИ РАБОТЫ МАСТЕРА++++++++++++++++++++++++++++++++++++++++++++++


            //     var isAvailable = true;

            //     booked_slots.forEach(function (bookedSlot) {

            //         var bookedSlotStart = moment(bookedSlot.record_date + ' ' + bookedSlot.record_time);
            //         var bookedSlotEnd = moment(bookedSlotStart).add(parseInt(bookedSlot.duration), 'minutes');

            //         console.log("bookedSlotStart");
            //         console.log(bookedSlotStart.format('YYYY-MM-DD HH:mm:ss'));

            //         console.log("bookedSlotEnd");
            //         console.log(bookedSlotEnd.format('YYYY-MM-DD HH:mm:ss')); //ПРАВИЛЬНО. ПРИБАВЛЯЕТ ТЕПЕРЬ КОРРЕКТНО ДЛИТЕЛЬНОСТЬ++++++++++++++++++++++++++++++++++++++++++++++


            //         if (slotStart.isBetween(bookedSlotStart, bookedSlotEnd) || slotEnd.isBetween(bookedSlotStart, bookedSlotEnd)) {
            //             isAvailable = false;
            //             return false;
            //         }
            //     });

            //     if (isAvailable) {
            //         available_slots.push({
            //             start: slotStart.format('YYYY-MM-DD HH:mm'),
            //             end: slotEnd.format('YYYY-MM-DD HH:mm')
            //         });
            //     }
            // });

            // return available_slots;

            var available_slots = [];

            // Преобразование времени работы мастера в объекты Moment
            var masterStart = moment(master_timetable.start);
            var masterEnd = moment(master_timetable.end);

            // Проход по рабочему графику мастера
            while (masterStart.isBefore(masterEnd)) {
                var slotEnd = moment(masterStart).add(service_duration, 'minutes');

                var isAvailable = true;

                // Проверка пересечения со забронированными слотами
                for (var i = 0; i < booked_slots.length; i++) {
                    var bookedSlotStart = moment(booked_slots[i].record_date + ' ' + booked_slots[i].record_time);
                    var bookedSlotEnd = moment(bookedSlotStart).add(booked_slots[i].duration, 'minutes');

                    if (masterStart.isBetween(bookedSlotStart, bookedSlotEnd) || slotEnd.isBetween(bookedSlotStart, bookedSlotEnd)) {
                        isAvailable = false;
                        break;
                    }
                }

                // Если слот доступен, добавляем его в список доступных слотов
                if (isAvailable) {
                    available_slots.push({
                        start: masterStart.format('YYYY-MM-DD HH:mm'),
                        end: slotEnd.format('YYYY-MM-DD HH:mm')
                    });
                }

                // Переход к следующему слоту
                masterStart.add(1, 'minutes');
            }

            return available_slots;
        }

        function loadAvailableDates(id_master) {
            var service_duration = $('#services__data option:selected').data('duration');

            getMasterTimetable(id_master, moment().format('YYYY-MM-DD HH:mm'), moment().add(1, 'months').format('YYYY-MM-DD  HH:mm'))
                .then(function (master_timetable) {
                    return getBookedSlots(id_master, moment().format('YYYY-MM-DD'), moment().add(1, 'months').format('YYYY-MM-DD'))
                        .then(function (booked_slots) {
                            var available_slots = getAvailableSlots(master_timetable, booked_slots, service_duration);
                            // console.log(available_slots);
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
                selectable: true,
                select: function (start, end) {
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

        loadAvailableDates(id_master);
    });
});