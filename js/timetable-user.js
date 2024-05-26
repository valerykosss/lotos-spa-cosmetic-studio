$(document).ready(function() {


   var calendar = $('#calendar').fullCalendar({
    editable: false,
    header:{
     left:'prev,next today',
     center:'title',
     right:'month'
    },
    events: '../handlers/user-calendar/load-user.php',
    defaultView: 'month',
    selectHelper:true,
    locale: 'ru', 
    timeFormat: 'HH:mm',

    eventRender: function(event, element) {
        var title = event.master_name + " - " + event.service_name + " (" + event.start.format('HH:mm') + ")";
        element.find('.fc-content').prepend('<span class="event-title">' + title + ' ' + '</span>');
    },

    eventMouseover: function(event, jsEvent, view) {
        var tooltip = '<div class="tooltipevent">' + event.master_name + " - " + event.service_name + " (" + event.start.format('HH:mm') + ")" + '</div>';
        $("body").append(tooltip);
        $(this).mouseover(function(e) {
            $(this).css('z-index', 10000);
            $('.tooltipevent').fadeIn('500');
            $('.tooltipevent').fadeTo('10', 1.9);
        }).mousemove(function(e) {
            $('.tooltipevent').css('top', e.pageY + 10);
            $('.tooltipevent').css('left', e.pageX + 20);
        });
    },

    eventMouseout: function(event, jsEvent, view) {
        $(this).css('z-index', 8);
        $('.tooltipevent').remove();
    },


    select: function(start, end, allDay)
    {
        // Заполнение полей модального окна значениями
        clearLeaveModal();
        $('#leaveModal').modal('show');  
        $('#leave_start').val($.fullCalendar.formatDate(start, "DD-MM-YYYY HH:mm"));
        $('#leave_end').val($.fullCalendar.formatDate(end, "DD-MM-YYYY HH:mm"));

    },

    //обработчик нажатия
    eventClick:function(event)
    {
        // $('#eventIdInput').val(event.id);
        var id = event.id_record;

            $('#leave_title').text(event.title);
                    $('#eventIdInput').val(event.id_record);
                    $('#master_name').html('<span>Имя мастера:</span> ' + event.master_name);
                    $('#service_name').html('<span>Название услуги:</span> ' + event.service_name);
                    $('#price').html('<span>Стоимость:</span> ' + event.price + ' руб.');
                    $('#duration').html('<span>Длительность:</span> ' + event.duration + ' мин.');
                    $('#leave_start').html('<span>Начало процедуры:</span> ' + event.start.format('DD-MM-YYYY HH:mm'));

                    $('#leaveDeleteBtn').attr('disable', false);
                    $('#leaveDeleteBtn').show();  
                    
                    $('#leaveModal').modal('show');


            // delete по кнопке
            $('#leaveDeleteBtn').click(function(){
                $.ajax({
                    url:'../handlers/user-calendar/changeStatus.php',
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
    

        $('#leave_start').mask("99-99-9999 99:99");

        // format modal buttons
        $('#leaveDeleteBtn').attr('disable', true);
        $('#leaveDeleteBtn').hide();
    };

});