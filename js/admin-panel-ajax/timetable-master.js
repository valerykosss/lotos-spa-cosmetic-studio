
$(document).ready(function () {

    var calendar = $('#calendar').fullCalendar({
        editable: false,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'agendaWeek, month'
        },
        events: '../handlers/admin-panel-handlers/calendar/load-master-panel.php',
        // selectable:true,
        defaultView: 'agendaWeek',
        selectHelper: true,
        locale: 'ru', // Устанавливаем русский язык
        timeFormat: 'HH:mm',

        viewRender: function (view) {
            // Обновление времени внутри span для строк без класса "fc-minor"
            $('span').each(function () {
                var time = $(this).text();
                if ($(this).closest('td').hasClass('fc-time')) {
                    $(this).text(time + ':00');
                }
            });
        },

        eventRender: function (event, element) {
            // Отправка AJAX-запроса для получения master_name
            $.ajax({
                url: '../handlers/admin-panel-handlers/calendar/getMasterName.php',
                type: 'POST',
                data: { id_master: event.id_master },
                dataType: 'json',
                success: function (response) {
                    // Вставка полученного master_name в <span class="event-title">
                    element.find('.fc-content').prepend('<span class="event-title">' + response.master_name + ' ' + '</span>');
                },
                error: function (error) {
                    console.error('Ошибка при получении master_name:', error);
                }
            });
        },

    });

});