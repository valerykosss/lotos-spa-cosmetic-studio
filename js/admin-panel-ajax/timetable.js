$(document).ready(function() {

    // Загрузка списка мастеров при загрузке страницы
    loadMasters();

    function loadMasters() {
        $.ajax({
            url: '../handlers/admin-panel-handlers/calendar/getMasters.php',  // PHP-скрипт для загрузки мастеров
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // $('#master_select').empty();  // Очищаем выпадающий список

                $.each(response, function(index, master) {
                    $('#master_select').append($('<option>', {
                        value: master.id,
                        text: master.name
                    }));
                });
            },
            error: function(error) {
                console.error('Ошибка при загрузке мастеров:', error);
            }
        });
    }

   var calendar = $('#calendar').fullCalendar({
    editable:true,
    header:{
     left:'prev,next today',
     center:'title',
     right:'agendaWeek, month'
    },
    events: '../handlers/admin-panel-handlers/calendar/load.php',
    selectable:true,
    defaultView: 'agendaWeek',
    selectHelper:true,
    locale: 'ru', // Устанавливаем русский язык
    timeFormat: 'HH:mm',

    viewRender: function(view) {
        // Обновление времени внутри span для строк без класса "fc-minor"
        $('span').each(function() {
            var time = $(this).text();
            if ($(this).closest('td').hasClass('fc-time')) {
                $(this).text(time + ':00');
            }
        });
    },

    eventRender: function(event, element) {
    // Отправка AJAX-запроса для получения master_name
    $.ajax({
        url: '../handlers/admin-panel-handlers/calendar/getMasterName.php',
        type: 'POST',
        data: { id_master: event.id_master },
        dataType: 'json',
        success: function(response) {
            // Вставка полученного master_name в <span class="event-title">
            element.find('.fc-content').prepend('<span class="event-title">' + response.master_name + ' ' + '</span>');
        },
        error: function(error) {
            console.error('Ошибка при получении master_name:', error);
        }
    });
},

    select: function(start, end, allDay)
    {
         // Заполнение полей модального окна значениями
        clearLeaveModal();
        $('#leaveModal').modal('show');  
        $('#leave_start').val($.fullCalendar.formatDate(start, "YYYY-MM-DD HH:mm"));
        $('#leave_end').val($.fullCalendar.formatDate(end, "YYYY-MM-DD HH:mm"));

    },
    editable:true,

    //растягивание события вниз
    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "YYYY-MM-DD HH:mm");
     var end = $.fullCalendar.formatDate(event.end, "YYYY-MM-DD HH:mm");
     var id_master = event.id_master;
     var id = event.id;

     $.ajax({
      url:"../handlers/admin-panel-handlers/calendar/update.php",
      type:"POST",
      data:{ id_master:id_master, start:start, end:end, id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       $("#msgUpdatedModal").modal();
      }
     })
    },


    //изменение границ события - перетаскивание события
    eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "YYYY-MM-DD HH:mm");
     var end = $.fullCalendar.formatDate(event.end, "YYYY-MM-DD HH:mm");
     var id_master = event.id_master;
     var id = event.id;
     $.ajax({
      url:"../handlers/admin-panel-handlers/calendar/update.php",
      type:"POST",
      data:{id_master:id_master, start:start, end:end, id:id},
      error: function(error){
            alert('Something went wrong: ', error);
        },
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       $("#msgUpdatedModal").modal();
      }
     });
    },

    //обработчик нажатия
    eventClick:function(event)
    {
        // $('#eventIdInput').val(event.id);
        var id = event.id;

            $.ajax ({
                //вывод
                url:"../handlers/admin-panel-handlers/calendar/fetch.php",
                type:"POST",
                data:{id:id},
                error: function(error){
                    alert('Something went wrong: ', error);
                },
                success:function() {
                    calendar.fullCalendar('refetchEvents');
                    
                    $('#master_select').val(event.id_master);

                    $('#leave_start').val($.fullCalendar.formatDate(event.start, "YYYY-MM-DD HH:mm"));
                    $('#leave_end').val($.fullCalendar.formatDate(event.end, "YYYY-MM-DD HH:mm"));

                    $('#leaveAddBtn').attr('disabled', true);
                    $('#leaveAddBtn').hide();
                    $('#leaveUpdateBtn').attr('disabled', false);
                    $('#leaveUpdateBtn').show();
                    $('#leaveDeleteBtn').attr('disable', false);
                    $('#leaveDeleteBtn').show();                    

                    $('#leaveModal').modal('show');

                }
            });

              // update по кнопке
            $('#leaveUpdateBtn').click(function(){
                // var id = $('#eventIdInput').val(); // Получение id события из скрытого поля ввода

                // $('#master_select').val(event.id_master);

                id_master=$('#master_select').val();
                alert("АЙДИ МАСТЕРА ". id_master);

                start = moment($('#leave_start').val()).format('YYYY-MM-DD HH:mm');
                end = moment($('#leave_end').val()).format('YYYY-MM-DD HH:mm');
                
                // alert("АЙДИ ". id);
                
                // var id = $('#eventIdInput').val();

                $.ajax({
                    url:"../handlers/admin-panel-handlers/calendar/update.php",
                    type:"POST",
                    data: {id_master:id_master, start:start, end:end, id:id },
                    error: function(error){
                            alert('Something went wrong: ', error);
                        },
                    success:function() {
                    calendar.fullCalendar('refetchEvents');
                    $("#msgUpdatedModal").modal();
                    }
                })
            }); 

            // delete по кнопке
            $('#leaveDeleteBtn').click(function(){
                $.ajax({
                    url:'../handlers/admin-panel-handlers/calendar/delete.php',
                    type:'POST',
                    data:{id:id},
                    error: function(error){
                        alert('Something went wrong: ', error);
                    },
                    success:function() {
                        calendar.fullCalendar('refetchEvents');
                        $('#msgDeletedModal').modal();  
                    }
                })
            });

            // clear modal on hide
            $('#leaveModal').hide(function(){
                clearLeaveModal();
            });

    },

   });
   // clear the event modal
   function clearLeaveModal() {
        $('#leaveModal').find('input').val("");
    
        $("#leave_title").text("Расписание");

        // format modal buttons
        $('#leaveAddBtn').attr('disabled', false);
        $('#leaveAddBtn').show();
        $('#leaveUpdateBtn').attr('disabled', true);
        $('#leaveUpdateBtn').hide();
        $('#leaveDeleteBtn').attr('disable', true);
        $('#leaveDeleteBtn').hide();
    };
    // add button function
    $('#leaveAddBtn').click(function(){
        id_master=$('#master_select').val();
        start = $('#leave_start').val();
        end = $('#leave_end').val();

   
       $.ajax({
           url:'../handlers/admin-panel-handlers/calendar/insert.php',
           type:'POST',
           data:{
            id_master: id_master,
            start: start,
            end: end
           },
           error: function(error){
               alert('Something went wrong: ', error);
           },
           success:function(data){
               calendar.fullCalendar('refetchEvents');
               $("#msgSuccessModal").modal('show');
               clearLeaveModal();
           }
       });
   });

});