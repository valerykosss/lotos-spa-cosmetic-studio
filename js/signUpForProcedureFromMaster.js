$(document).ready(function() {
    $(".close__form").mousedown(function () {
        clear();
        $("#sign-up-for-procedure__window").css("display", "none");
    })

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

    // Обработчик события клика по кнопке
    $('.specialist-button').click(function() {
        // Отображение блока
        $('#sign-up-for-procedure__window').show();
        
        // Центрирование блока по вертикали
        var windowHeight = $(window).height();
        var formHeight = $('#sign-up-for-procedure__form').outerHeight();
        var topMargin = (windowHeight - formHeight) / 2;
        $('#sign-up-for-procedure__form').css('margin-top', topMargin + 'px');
        // Центрирование блока по горизонтали
        var windowWidth = $(window).width();
        var formWidth = $('#sign-up-for-procedure__form').outerWidth();
        var leftMargin = (windowWidth - formWidth) / 2;
        $('#sign-up-for-procedure__form').css('margin-left', leftMargin + 'px');

         // Заполнение select #masters__data
         $('#masters__data').empty(); // очищаем select
        var id_master = $(this).attr('id');

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
    });
});