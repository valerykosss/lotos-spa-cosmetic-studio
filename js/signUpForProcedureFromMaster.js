
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

        // Функция для получения рабочего графика мастера
        function getMasterTimetable(id_master, start, end) {
            return $.ajax({
                url: '../handlers/getMasterTimetable.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    id_master: id_master,
                    start: start,
                    end: end
                }
            });
        }

        // Функция для получения занятых слотов времени
        function getBookedSlots(id_master, start, end) {
            return $.ajax({
                url: '../handlers/getBookedSlots.php',
                type: 'GET',
                dataType: 'json',
                data: {
                    id_master: id_master,
                    start: start,
                    end: end
                }
            });
        }

        // Функция для формирования списка доступных слотов
        function getAvailableSlots(master_timetable, booked_slots, service_duration) {
            // Здесь реализуем ваш алгоритм для поиска доступных слотов
            // Вернем список доступных слотов
        }

        // Функция для обновления календаря с доступными датами
        function updateCalendarWithAvailableDates(master_timetable, booked_slots, service_duration) {
            var available_dates = getAvailableDates(master_timetable, booked_slots, service_duration);

            $('#calendar').fullCalendar('destroy'); // Уничтожаем текущий календарь
            $('#calendar').fullCalendar({
                defaultView: 'month',
                editable: true,
                selectable: true,
                select: function (start, end) {
                    // Здесь можно обработать выбор пользователя
                    console.log('Выбранная дата:', start.format());
                },
                dayRender: function (date, cell) {
                    if (available_dates.includes(date.format('YYYY-MM-DD'))) {
                        cell.addClass('available-date'); // Подсвечиваем доступные даты
                    } else {
                        cell.addClass('unavailable-date'); // Делаем недоступные даты некликабельными
                    }
                }
            });
        }

        // Загрузка и обработка доступных дат
        function loadAvailableDates(id_master) {
            var service_duration = $('#services__data option:selected').data('duration');
            getMasterTimetable(id_master, moment().format('YYYY-MM-DD'), moment().add(1, 'months').format('YYYY-MM-DD'))
                .then(function (master_timetable) {
                    return getBookedSlots(id_master, moment().format('YYYY-MM-DD'), moment().add(1, 'months').format('YYYY-MM-DD'))
                        .then(function (booked_slots) {
                            updateCalendarWithAvailableDates(master_timetable, booked_slots, service_duration);
                        });
                })
                .catch(function (error) {
                    console.error('Ошибка при загрузке данных:', error);
                });
        }

        $('.specialist-button.selected').removeClass('selected');
        $(this).addClass('selected');

        var id_master = $(this).attr('id');
        loadAvailableDates(id_master);
    });
});
