
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

    $(document).ready(function() {
        $(".close__form").mousedown(function () {
            clear();
            $("#sign-up-for-procedure__window").css("display", "none");
        });
    
        // Обработчик события клика по кнопке
        $('.specialist-button').click(function() {
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
                success: function(master) {
                    var option = $('<option></option>').attr('value', master.id_master).text(master.master_name + ' ' + master.master_surname);
                    $('#masters__data').append(option);
                },
                error: function(error) {
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
                success: function(services) {
                    $.each(services, function(index, service) {
                        var option = $('<option></option>').attr('value', service.id_service).text(service.service_name);
                        $('#services__data').append(option);
                    });
                },
                error: function(error) {
                    console.error('Ошибка при загрузке данных:', error);
                }
            });
    
            // Инициализация FullCalendar
            var calendar = $('#calendar').fullCalendar({
                // Настройки календаря...
                defaultView: 'month',
                editable: true,
                events: function(start, end, timezone, callback) {
                    $.ajax({
                        url: '../handlers/getMasterAvailability.php',
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            id_master: id_master,
                            start: start.unix(),
                            end: end.unix()
                        },
                        success: function(availabilities) {
                            var events = [];
                            $.each(availabilities, function(index, availability) {
                                events.push({
                                    title: 'Свободно',
                                    start: availability.start,
                                    end: availability.end
                                });
                            });
                            callback(events);
                        },
                        error: function(error) {
                            console.error('Ошибка при загрузке доступности:', error);
                        }
                    });
                }
            });
        });
    });
    