$(document).ready(function () {

    function enableScroll() {
        document.body.style.overflow = '';
    }

    const popup = $('.popup');
    const popupBg = $('.popup__bg');
    $("#new_user_tel").mask("+375 (99) 999-99-99");


    // popup.animate({ scrollTop: 0 }, {
    //     duration: 400, // Длительность анимации (в миллисекундах)
    //     easing: 'swing', // Эффект анимации
    //     complete: function () { 

    //     }
    // });

    var startDate;
    var endDate;

    var id_master;
    var id_service;

    var service_duration;

    var clickedEvents = []; // Массив для хранения кликнутых событий
    var lastClickedeventFromArray;


    //-------------------------------------ОТ МАСТЕРА К ДАТЕ-------------------------------------
    $('#nextBtnToDateTime').on('click', function () {

        popup.animate({ scrollTop: 0 }, {
            duration: 400, // Длительность анимации (в миллисекундах)
            easing: 'swing', // Эффект анимации
            complete: function () { // Функция завершения

                var selectedMasterId = $('input[name="master"]:checked').val();
                if (!selectedMasterId) {
                    alert('Выберите мастера');
                    return;
                }

                // Загрузка мастеров для выбранной услуги

                $('.master__wrapper').hide();
                $('.date-time__wrapper').show();
                $('.details__wrapper').hide();

                // Добавление класса active-stage к элементу с id master-stage
                $('.stage-title').each(function () {
                    if (this.id === 'date-time-stage') {
                        $(this).addClass('active-stage');
                    } else {
                        $(this).removeClass('active-stage');
                    }
                });
            }
        });

    });

    //-------------------------------------ОТ ДАТЫ К мастерам-------------------------------------
    $('#prevBtnToMaster').on('click', function () {
        popup.animate({ scrollTop: 0 }, {
            duration: 400, // Длительность анимации (в миллисекундах)
            easing: 'swing', // Эффект анимации
            complete: function () {
                $('.date-time__wrapper').hide();
                $('.details__wrapper').hide();
                $('.master__wrapper').show();

                // Добавление класса active-stage к элементу с id master-stage
                $('.stage-title').each(function () {
                    if (this.id === 'master-stage') {
                        $(this).addClass('active-stage');
                    } else {
                        $(this).removeClass('active-stage');
                    }
                });
            }
        });
        // Открытие блока с классом masters__body _container-window
    });


    //-------------------------------------ОТ ДАТЫ К ДЕТАЛЯМ ЗАПИСИ-------------------------------------
    $('#nextBtnToDetails').on('click', function () {

        popup.animate({ scrollTop: 0 }, {
            duration: 400, // Длительность анимации (в миллисекундах)
            easing: 'swing', // Эффект анимации
            complete: function () {
                console.log("массив кликнутых событий");
                console.log(clickedEvents);
                if (clickedEvents.length == 0) { // проверяем, выбрана ли дата
                    alert("Вы не выбрали дату!");
                    return;
                }
                // Открытие блока с классом masters__body _container-window
                $('.date-time__wrapper').hide();
                $('.master__wrapper').hide();
                $('.details__wrapper').show();

                // Добавление класса active-stage к элементу с id master-stage
                $('.stage-title').each(function () {
                    if (this.id === 'details-stage') {
                        $(this).addClass('active-stage');
                    } else {
                        $(this).removeClass('active-stage');
                    }
                });

                lastClickedeventFromArray = clickedEvents.slice(-1)[0];
                console.log("lastClickedeventFromArray");
                console.log(lastClickedeventFromArray);

                console.log("id_master");
                console.log(id_master);

                console.log("id_service");
                console.log(id_service);

                $.ajax({
                    url: '../handlers/getBookingDetails.php',
                    method: 'GET',
                    data: {
                        id_service: id_service,
                        id_master: id_master,
                    },
                    success: function (data) {
                        let response = JSON.parse(data);
                        let service = response.service;
                        let master = response.master;

                        // Форматирование даты и времени
                        let startDate = new Date(lastClickedeventFromArray.start);
                        let endDate = new Date(lastClickedeventFromArray.end);

                        let options = { day: 'numeric', month: 'long', year: 'numeric' };
                        let dateMonthYear = startDate.toLocaleDateString('ru-RU', options);
                        let dayOfWeek = startDate.toLocaleDateString('ru-RU', { weekday: 'long' });

                        let startEnd = startDate.toLocaleTimeString('ru-RU', { hour: '2-digit', minute: '2-digit' }) +
                            '-' + endDate.toLocaleTimeString('ru-RU', { hour: '2-digit', minute: '2-digit' });

                        // Создание разметки
                        let detailsMarkup = `
    
                                <div class="service__item">
                                    <div class="service-item__img">
                                        <img src="../images/procedure-icon-booking.svg">
                                    </div>
                                    <div class="service-item__info">
                                        <p class="service-name">${service.service_name}</p>
                                        <p class="service-description">${service.service_description}</p>
                                        <p class="service-price">${service.price} byn</p>
                                    </div>
                                </div>
    
                                <div class="master__item">
                                    <div class="master-item__img">
                                        <img src="../images/master-icon-booking.svg">
                                    </div>
                                    <div class="master-item__info">
                                        <p class="master-name">${master.master_name} ${master.master_surname}</p>
                                        <p class="master-position">${master.position}</p>
                                        <div class="master-rating-stars">
                                            <p class="master-rating">${master.average_rating}</p>
                                            <div class="master-block-star"></div>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="date-time__item">
                                    <div class="date-time__img">
                                        <img src="../images/date-time-icon-booking.svg">
                                    </div>
                                    <div class="date-time__info">
                                        <p class="date-month-year">${dateMonthYear}</p>
                                        <p class="day-of-week">${dayOfWeek}</p>
                                        <p class="start-end">${startEnd}</p>
                                    </div>
                                </div>
                        `;

                        $('.details__body').html(detailsMarkup);
                    }
                });

            }
        });
    });

    //-------------------------------------ОТ ДЕТАЛЕЙ К ДАТЕ-------------------------------------
    $('#prevBtnToDateTime').on('click', function () {
        popup.animate({ scrollTop: 0 }, {
            duration: 400, // Длительность анимации (в миллисекундах)
            easing: 'swing', // Эффект анимации
            complete: function () {
                // Открытие блока с классом masters__body _container-window
                $('.master__wrapper').hide();
                $('.date-time__wrapper').show();
                $('.details__wrapper').hide();

                // Добавление класса active-stage к элементу с id master-stage
                $('.stage-title').each(function () {
                    if (this.id === 'date-time-stage') {
                        $(this).addClass('active-stage');
                    } else {
                        $(this).removeClass('active-stage');
                    }
                });
            }
        });
    });

    //-------------------------------------ОТ ДЕТАЛЕЙ К ЗАПИСИ В БД (ТУТ ЕЩЕ ПО ИДЕЕ К КОНЕЧНОМУ ДРУГОМУ ОКНУ БАЗОВОМУ)-------------------------------------
    $('#book').on('click', function () {
        popup.animate({ scrollTop: 0 }, {
            duration: 400, // Длительность анимации (в миллисекундах)
            easing: 'swing', // Эффект анимации
            complete: function () {
                // Открытие блока с классом masters__body _container-window

                // $('.master__wrapper').hide();
                // $('.date-time__wrapper').hide();
                // $('.service__wrapper').hide();
                // $('.details__wrapper').hide();

                popupBg.removeClass('active');
                popup.removeClass('active');


                if (startDate) { // проверяем, выбрана ли дата
                    console.log('Выбранная дата для записи:', startDate);

                    var new_user = false;

                    if ($('#new_user_tel') && $('#new_user_email') && $('#new_user_name')) {
                        var new_user_tel = $('#new_user_tel').val();
                        var new_user_email = $('#new_user_email').val();
                        var new_user_name = $('#new_user_name').val();

                        new_user = true;
                        if (new_user_email == "" || new_user_name == "" || new_user_tel == "") {
                            alert("Заполните все поля");
                            return 0;
                        }
                    }

                    if (new_user == false) {
                        // Отправка данных на сервер
                        $.ajax({
                            url: '../handlers/recordAppointment.php', // Замените на путь к вашему PHP-обработчику
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                id_master: id_master,
                                id_service: id_service,
                                startDate: startDate,
                                endDate: endDate
                            },
                            success: function (response) {
                                if (response.success) {
                                    console.log('Запись успешно добавлена');

                                    // popupBg.removeClass('active'); //
                                    // popup.removeClass('active'); // И 

                                    enableScroll();

                                    // Открытие нового окна popupES и установка текста
                                    $('.popup__bg__error-success').addClass('active');
                                    $('.popup__error-success').addClass('active');
                                    $('.popup__error-success .data-title').text('Будем рады вас видеть');
                                    $('.popup__error-success .data-text').text('Мы рекомендуем приходить на 5-10 минут заранее, чтобы расслабиться и настроиться! В случае отмены записи, позвоните администратору или отмените запись самостоятельно в личном кабинете');

                                } else {
                                    console.error('Ошибка при добавлении записи:', response.error);
                                    alert('Ошибка при добавлении записи: ' + response.error);
                                }
                            },
                            error: function (error) {
                                console.error('Ошибка при выполнении AJAX-запроса:', error);
                                alert('Ошибка при выполнении AJAX-запроса');
                            }
                        });
                    } else if (new_user == true) {
                        // Отправка данных на сервер
                        $.ajax({
                            url: '../handlers/recordAppointment.php', // Замените на путь к вашему PHP-обработчику
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                id_master: id_master,
                                id_service: id_service,
                                startDate: startDate,
                                endDate: endDate,
                                new_user_tel: new_user_tel,
                                new_user_email: new_user_email,
                                new_user_name: new_user_name
                            },
                            success: function (response) {
                                if (response.success) {
                                    console.log('Запись успешно добавлена');

                                    // popupBg.removeClass('active');
                                    // popup.removeClass('active');

                                    enableScroll();

                                    // Открытие нового окна popupES и установка текста
                                    $('.popup__bg__error-success').addClass('active');
                                    $('.popup__error-success').addClass('active');
                                    $('.popup__error-success .data-title').text('Будем рады вас видеть');
                                    $('.popup__error-success .data-text').text('Мы рекомендуем приходить на 5-10 минут заранее, чтобы расслабиться и настроиться! В случае отмены записи, позвоните администратору или отмените запись самостоятельно в личном кабинете');


                                    // alert('Запись успешно добавлена');

                                } else {
                                    console.error('Ошибка при добавлении записи:', response.error);
                                    alert('Ошибка при добавлении записи: ' + response.error);
                                }
                            },
                            error: function (error) {
                                console.error('Ошибка при выполнении AJAX-запроса:', error);
                                alert('Ошибка при выполнении AJAX-запроса');
                            }
                        });
                    }
                }
                else {
                    alert('Дата не выбрана');
                }
            }
        });
    });


    $(".service-button").on('click', function () {
        id_service = $(this).attr('id');
        service_duration = $(this).data('duration');

        popup.animate({ scrollTop: 0 }, {
            duration: 400, // Длительность анимации (в миллисекундах)
            easing: 'swing', // Эффект анимации
            complete: function () { // Функция завершения

                // Загрузка мастеров для выбранной услуги
                $.ajax({
                    url: '../handlers/getMastersByService.php',
                    method: 'GET',
                    data: { id_service: id_service },
                    success: function (data) {
                        var masterItems = '';
                        data.forEach(function (master) {

                            var masterRatingStars = '';

                            // Проверяем, есть ли средний рейтинг
                            if (master.average_rating !== null) {
                                // Если есть средний рейтинг, то добавляем блок с рейтингом и звездами
                                masterRatingStars = `
                            <div class="master-rating-stars">
                                <p class="master-rating">${parseFloat(master.average_rating).toFixed(2)}</p>
                                <div class="master-block-star"></div>
                            </div>
                        `;
                            }

                            // Формируем HTML-шаблон для каждого мастера
                            var masterItem = `
                        <div class="master__item">
                            <div class="master-item__img">
                                <img src="${master.master_photo}">
                            </div>
                            <div class="master-item__info">
                                <p class="master-name">${master.master_name} ${master.master_surname}</p>
                                <p class="master-position">${master.position}</p>
                                ${masterRatingStars}
                            </div>
                            <div class="master-item__radio">
                                <input type="radio" name="master" value="${master.id_master}">
                            </div>
                        </div>
                    `;

                            // Добавляем сформированный HTML-шаблон мастера к общей строке masterItems
                            masterItems += masterItem;
                        });

                        // Вставляем сформированные HTML-шаблоны мастеров в соответствующий контейнер
                        $('#masters-items-container').html(masterItems);

                        $('.master__item').on('click', function () {
                            // Сделать соответствующий master-item__radio выбранным
                            $(this).find('input[type="radio"]').prop('checked', true);

                        });


                        //все гуд вроде
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

                        //все гуд вроде
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


                        //все гуд вроде
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

                        function updateCalendarWithAvailableSlots(available_slots) {
                            function setCalendarView() {
                                // Изменяет вид календаря в зависимости от ширины окна
                                if (window.innerWidth < 736) {
                                    $('#calendar').fullCalendar('changeView', 'listWeek'); // Меняет вид на список при ширине окна меньше 736px
                                } else {
                                    $('#calendar').fullCalendar('changeView', 'month'); // Меняет вид на месяц при ширине окна больше 736px
                                }
                            }
        
                            $('#calendar').fullCalendar('destroy');

                            $('#calendar').fullCalendar({
                                defaultView: 'month',
                                editable: true,
                                // eventLimit: true,
                                events: available_slots.map(function (slot) {
                                    return {
                                        start: slot.start,
                                        end: slot.end,
                                        allDay: false,
                                    };
                                }),

                                eventClick: function (event) {

                                    startDate = event.start.format('YYYY-MM-DD HH:mm');
                                    endDate = event.end ? event.end.format('YYYY-MM-DD HH:mm') : '';
                                    console.log('Выбранное событие:');
                                    console.log('Начало:', startDate);
                                    console.log('Окончание:', endDate);

                                    // Добавляем кликнутое событие в массив
                                    clickedEvents.push({ start: startDate, end: endDate });
                                    console.log('Массив кликнутых событий:', clickedEvents);

                                },
                                windowResize: function(view) {
                                    setCalendarView(); // Изменяет вид календаря при изменении размера окна
                                }

                            });
                            setCalendarView();

                            // Обработчик клика по документу
                            $(document).on('click', function (event) {
                                // Проверяем, является ли элемент, по которому кликнули, частью календаря
                                if (!$(event.target).closest('.fc-content').length && !$(event.target).is('.fc-more') && !$(event.target).is('#nextBtnToDetails') && !$(event.target).is('#prevBtnToMaster') && !$(event.target).is('#nextBtnToDateTime') && !$(event.target).is('#prevBtnToDateTime') && !$(event.target).is('.fc-list-item-title') && !$(event.target).is('.fc-list-item-marker') && !$(event.target).is('.fc-list-item-time')) {
                                    // Если клик был вне календаря, обнуляем массив кликнутых событий
                                    clickedEvents = [];
                                    console.log('Массив кликнутых событий обнулен');
                                    resetStyles();
                                }
                            });

                            eventClickStyles();

                        }


                        function loadAvailableDates(id_master, duration_service_selected) {
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

                        // Обработчик нажатия на input или блок .master__item
                        $('input[name="master"], .master__item').on('click', function () {
                            id_master = $('.master__item input[type="radio"]:checked').val();

                            loadAvailableDates(id_master, service_duration);
                        });

                        // Переход к блоку мастеров
                        $('.master__wrapper').show();
                        $('.date-time__wrapper').hide();
                        $('.details__wrapper').hide();

                        // Добавление класса active-stage к элементу с id master-stage
                        $('.stage-title').each(function () {
                            if (this.id === 'master-stage') {
                                $(this).addClass('active-stage');
                            } else {
                                $(this).removeClass('active-stage');
                            }
                        });
                    }
                });
            }
        });
    });
});

//открывающееся окно по середине
document.addEventListener('click', function (event) {
    if (event.target.classList.contains('fc-more')) { // Если кликнули на элемент fc-more
        const moreLink = event.target;
        const popover = document.querySelector('.fc-popover.fc-more-popover');

        // Получаем координаты клика относительно окна
        const left = event.clientX * 0.5;
        const top = event.clientY * 0;

        // Устанавливаем значение top и left для попапа
        // popover.style.top = top + 'px';
        // popover.style.left = left + 'px';

        popover.style.top = '30%';
        popover.style.left = '38%';
    }

});

function resetStyles() {
    const buttons = document.querySelectorAll('.fc-day-grid-event');
    buttons.forEach(button => {
        button.style.backgroundColor = '#355D48';
        button.style.color = 'white';
    });
}

// Функция для применения стилей к нажатой кнопке
function applyStylesToClickedButton(button) {
    button.style.backgroundColor = 'white';
    button.style.color = '#355D48';
}

function eventClickStyles() {
    //Получаем все кнопки с классом 'fc-day-grid-event'
    const buttons = document.querySelectorAll('.fc-day-grid-event');

    // Добавляем обработчик клика для каждой кнопки
    buttons.forEach(button => {
        button.addEventListener('click', function () {
            // Сбрасываем стили у всех кнопок
            resetStyles();
            // Применяем стили к нажатой кнопке
            applyStylesToClickedButton(button);
        });
    });
}

$(document).click(function () {
    eventClickStyles();
})