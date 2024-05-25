$(document).ready(function () {
    let currentQuestionIndex = 0;
    let selectedAnswers = {};
    let selectedQueries = {}; // Массив для хранения выбранных select_query

    let data = [
        {
            id: 'id1',
            question: 'Какой тип услуги вы предпочитаете?',
            answers: [
                { text: "Косметические услуги", select_query: " where id_service_type=1", next_question: "id2.1" },
                { text: "Спа-программы", select_query: " where id_service_type=2", next_question: "id2.2" },
                { text: "Массаж", select_query: "", next_question: "id2.3" }
            ]
        },
        //-----------------------------------------------------------КОСМЕТИЧЕСКИЕ-----------------------------------------------------------
        //косметичнские-руки или лицо-руки(сразу ответ руки)
        {
            id: 'id2.1',
            question: 'Вы хотите посетить косметическую услугу для рук или лица?',
            answers: [
                { text: "Для рук", select_query: " and service_name like '% рук%'", next_question: "end" },
                { text: "Для лица", select_query: "", next_question: "id2.1.2" }
            ]
        },
        //косметичнские-руки или лицо-лицо-не знаю(сразу ответ консультация)
        {
            id: 'id2.1.2',
            question: 'Вы впервые хотите впервые посетить косметологическую процедуру в нашем центре?',
            answers: [
                { text: "Да, я впервые хочу попасть и понять, какая процедура подходит именно мне", select_query: " and lower(service_name) like lower('%консультация%')", next_question: "end" },
                { text: "Нет, я постоянный клиент вашего центра и уже знаю, какая консультация подходит именно мне!", select_query: "", next_question: "id2.1.2.1" }
            ]
        },

         //косметичнские-руки или лицо-лицо-знаю(сразу ответ карбо и пилинг)
         {
            id: 'id2.1.2.1',
            question: 'Мы рады, что вы уже знаете какой тип косметической процедуры подходит именно вам! Теперь выберите его!',
            answers: [
                { text: "Мне подходит глубокое очищение кожи лица!", select_query: " and lower(service_name) like lower('%чистк%')", next_question: "id2.1.2.1.1" },
                { text: "Самый подходящий для меня тип процедуры - это процедуры, связанные с очищением верхнего слоя эпидермиса!", select_query: " and lower(service_name) like lower('%пилинг%')", next_question: "end" },
                { text: "Карбокситерация-вот тип процедуры, который подходит моей коже!", select_query: " and lower(service_name) like lower('%карбокситерапия%')", next_question: "end" }
            ]
        },

         //косметичнские-руки или лицо-лицо-знаю-чиста-(ответы)
        {
            id: 'id2.1.2.1.1',
            question: 'Выберите тип чистки, который вам рекомендован',
            answers: [
                { text: "Специалист рекоменндовал мне комбинированную чистку", select_query: " and lower(service_name) like lower('%комб%')", next_question: "end" },
                { text: "Мне нужно посетить механическую чистку", select_query: " and lower(service_name) like lower('%механич%')", next_question: "end" },
                { text: "Мне осталось еще несколько сеансов по ультразвуковой чистке!", select_query: " and lower(service_name) like lower('%уз%') or lower(service_name) like lower('%ультразвук%')", next_question: "end" }
            ]
        },

         //-----------------------------------------------------------СПА-ПРОЦЕДУРЫ-----------------------------------------------------------
         //спа-скрабирование или без скрабирования
        {
            id: 'id2.2',
            question: 'Любите ли вы этап скрабирования в проведении спа-процедуры?',
            answers: [
                { text: "Да, люблю различные скрабы, предпочту процедуру с наличием этого этапа", select_query: " and service_description like '%скраб%'", next_question: "id2.2.1" },
                { text: "Не люблю этот процесс, мне будет ближе процедура без этого этапа", select_query: "", next_question: "id2.2.2" }
            ]
        },
        //спа-скрабирование или без скрабирования-скпабирование(ответы)
        {
            id: 'id2.2.1',
            question: 'Какое скрабирование предпочитаете?',
            answers: [
                { text: "Шоколадное или кофейное", select_query: " and service_description like '%шоко%'", next_question: "end" },
                { text: "Детокс-скрабирование", select_query: "and service_description like '%детокс%'", next_question: "end" },
                { text: "Разогревающее", select_query: "and service_description like '%разогрев%'", next_question: "end" },
            ]
        },
         //спа-скрабирование или без скрабирования-без скрабирования-камни
         {
            id: 'id2.2.2',
            question: 'Как относитесь к массажу с использованием камней?',
            answers: [
                { text: "Только за!", select_query: " and service_description like '%камень%' or service_description like '%камн%'", next_question: "end" },
                { text: "Предпочту другой вид массажа", select_query: "", next_question: "id2.2.2.1" },
            ]
        },
        //спа-скрабирование или без скрабирования-без скрабирования-в 4 руки
        {
            id: 'id2.2.2.1',
            question: 'Пробовали ли вы когда-нибудь массаж в 4 руки?',
            answers: [
                { text: "Нет, но хочу попробовать!", select_query: " and service_description like '%4%' and service_description like '%рук%'", next_question: "end" },
                { text: "Да, с удовольствием бы повторил(а)!", select_query: " and service_description like '%4%' and service_description like '%рук%'", next_question: "end" },
                { text: "Нет, предпочитаю классический вид массажа", select_query: " and service_name like '%перезагрузка%'", next_question: "end" },
            ]
        },

        //-----------------------------------------------------------МАССАЖ ТЕЛА-----------------------------------------------------------
         //массаж тела или массаж лица
         {
            id: 'id2.3',
            question: 'Какой массаж вы хотите посетить?',
            answers: [
                { text: "Массаж тела", select_query: " where id_service_type=5", next_question: "id2.3.1" },
                { text: "Массаж лица", select_query: " where id_service_type=4", next_question: "id2.3.2" }
            ]
        },

        //массаж тела- (сразу выбран массаж головы+шеи и массаж ног)
        {
            id: 'id2.3.1',
            question: 'Отлично, у нас есть следующие виды массажа тела, выберите подходящий',
            answers: [
                { text: "Массаж головы и шеи", select_query: " and service_description like '%голов%' and service_description like '%ше%'", next_question: "end" },
                { text: "Массаж ног", select_query: " and service_description like '%ног%'", next_question: "end" },
                { text: "Массаж всего тела", select_query: "", next_question: "id2.3.1.1" }
            ]
        },

        //массаж тела- массаж всего тела-кореекция фигуры да/нет
        {
            id: 'id2.3.1.1',
            question: 'Нацелены ли вы на процедуры по коррекции фигуры?',
            answers: [
                { text: "Да, это то, что я ищу!", select_query: " and service_name like '%фигур%' or service_name like '%коррек%'", next_question: "end" },
                { text: "Нет, я не приследую эту цель, предпочитаю традиционный массаж", select_query: "", next_question: "id2.3.1.1.1" },
            ]
        },

         //массаж тела- массаж всего тела-кореекция фигуры нет-интесивна сразу ответ
         {
            id: 'id2.3.1.1.1',
            question: 'Какую технику массажа предпочитаете?',
            answers: [
                { text: "Интенсивную", select_query: " and service_name like '%восстанав%'", next_question: "end" },
                { text: "Мягкую", select_query: "", next_question: "id2.3.1.1.1.1" },
            ]
        },

        //массаж тела- массаж всего тела-кореекция фигуры нет-мягкая техника ответы
        {
            id: 'id2.3.1.1.1.1',
            question: 'Какую цель приследуете?',
            answers: [
                { text: "Усилить обмен веществ и кровообращение", select_query: " and service_name like '%лимф%'", next_question: "end" },
                { text: "Полностью расслабиться и перенестись в мир гармонии и спокойствия", select_query: " and service_name like '%рассл%'", next_question: "end" },
            ]
        },

       //-----------------------------------------------------------МАССАЖ ЛИЦА-----------------------------------------------------------
       ///массаж лица - поверхнотстные или моделир/глубокие
         {
            id: 'id2.3.2',
            question: 'Какие техники массажа лица вы предпочитаете?',
            answers: [
                { text: "Поверхностные", select_query: " and service_description like '%поверхност%'", next_question: "id2.3.2.1" },
                { text: "Глубокие(моделирующие)", select_query: " and service_description like '%глуб%' and service_description like '%моделир%'", next_question: "id2.3.2.2" },
            ]
        },

        //поверхностные
        {
            id: 'id2.3.2.1',
            question: 'Что вас интересует больше?',
            answers: [
                { text: "Расслабление мыщц", select_query: "", next_question: "id2.3.2.1.1" },
                { text: "Уменьшение отеков", select_query: " and results like '%отек%' and service_name like '%лимф%'", next_question: "end" },
            ]
        },

         {
            id: 'id2.3.2.1.1',
            question: 'Предпочитаете маску с эффектом экспресс-лифтинг после массажа?',
            answers: [
                { text: "Да", select_query: " and service_name like '%маск%' and service_name like '%альгин%'", next_question: "end" },
                { text: "Нет", select_query: " and service_name like '%класс%'", next_question: "end" },
            ]
        },

        //глубокие
        {
            id: 'id2.3.2.2',
            question: 'Какую цель вы приследуете?',
            answers: [
                { text: "Улучшение эластичности кожи", select_query: " and results like '%эласт%' and results like '%кож%'", next_question: "end" },
                { text: "Улучшение контуров лица", select_query: " and results like '%контур%' and results like '%лиц%'", next_question: "id2.3.2.2.1" },
            ]
        },

        {
            id: 'id2.3.2.2.1',
            question: 'Есть ли у вас морщины?',
            answers: [
                { text: "Да", select_query: " and insication like '%морщ%'", next_question: "end" },
                { text: "Нет", select_query: " and service_name like '%модел%'", next_question: "end" },
            ]
        },




    ];

    // Функция для отображения текущего вопроса
    function showQuestion(index) {
        let question = data[index];
        let html = '<h2>' + question.question + '</h2>';
        for (let i = 0; i < question.answers.length; i++) {
            let checked = selectedAnswers[index] == i ? 'checked' : '';
            let answer = question.answers[i];
            html += '<input type="radio" name="answer" value="' + i + '" data-id="' + question.id + '" data-next-question="' + answer.next_question + '" data-select-query="' + answer.select_query + '" ' + checked + '> ' + answer.text + '<br>';
        }
        $('#questionContainer').html(html);

        // Показывать или скрывать кнопку "Назад"
        if (index > 0) {
            let prevQuestion = data[index - 1];
            let hasMatchingAnswer = prevQuestion.answers.some(answer => answer.next_question === data[index].id);
            if (hasMatchingAnswer) {
                $('#prevBtn').show();
            } else {
                $('#prevBtn').hide();
            }
        } else {
            $('#prevBtn').hide();
        }

        // Скрыть кнопки "Далее" и "Показать результаты" до выбора ответа
        $('#nextBtn').hide();
        $('#showResults').hide();

        // Показать кнопку "Далее" или "Показать результаты" если уже был выбран ответ
        if (selectedAnswers[index] !== undefined) {
            let answerIndex = selectedAnswers[index];
            let nextQuestionId = data[index].answers[answerIndex].next_question;
            if (nextQuestionId === 'end') {
                $('#nextBtn').hide();
                $('#showResults').show();
            } else {
                $('#nextBtn').show();
                $('#showResults').hide();
            }
        }
    }

    // Начать тест с первого вопроса
    showQuestion(currentQuestionIndex);
    console.log("showQuestion");

    // Обработчик для выбора ответа
    $(document).on('change', 'input[name="answer"]', function () {
        let id = $(this).data('id');
        let selectQuery = $(this).data('select-query'); // Получаем select_query текущего ответа
        let answerIndex = $('input[name="answer"]:checked').val();
        selectedAnswers[currentQuestionIndex] = answerIndex;
        selectedQueries[id] = selectQuery; // Сохраняем select_query для текущего вопроса

        // Очистить ответы, которые следуют за текущим вопросом
        for (let i = currentQuestionIndex + 1; i < data.length; i++) {
            delete selectedAnswers[i];
            delete selectedQueries[data[i].id];
        }

        // let nextQuestionId = data[currentQuestionIndex].answers[answerIndex].next_question;
        let nextQuestionId = $(this).data('next-question'); // Получаем id следующего вопроса
        if (nextQuestionId === 'end') {
            $('#nextBtn').hide();
            $('#showResults').show();
        } else {
            $('#nextBtn').show();
            $('#showResults').hide();
        }

        console.log('Selected Answers:', selectedAnswers);
        console.log('Selected Queries:', selectedQueries);
    });

    // Обработчик для кнопки "Далее"
    $('#nextBtn').click(function () {
        let answerIndex = $('input[name="answer"]:checked').val();
        if (answerIndex !== undefined) {
            let nextQuestionId = data[currentQuestionIndex].answers[answerIndex].next_question;
            let nextQuestionIndex = data.findIndex(question => question.id === nextQuestionId);
            if (nextQuestionIndex !== -1) {
                currentQuestionIndex = nextQuestionIndex;
                showQuestion(currentQuestionIndex);
                console.log('Selected Answers:', selectedAnswers);
                console.log('Selected Queries:', selectedQueries);

            } else {
                alert('Нет последующего ответа!');
            }
        } else {
            alert('Выберите ответ!');
        }
    });

    // Обработчик для кнопки "Назад"
    $('#prevBtn').click(function () {
        let prevQuestionIndex = -1;

        for (let i = 0; i < currentQuestionIndex; i++) {
            let question = data[i];
            let hasMatchingAnswer = question.answers.some(answer => answer.next_question === data[currentQuestionIndex].id);
            if (hasMatchingAnswer) {
                prevQuestionIndex = i;
                break;
            }
        }

        if (prevQuestionIndex !== -1) {
            currentQuestionIndex = prevQuestionIndex;
            showQuestion(currentQuestionIndex);
            console.log('Selected Answers:', selectedAnswers);
            console.log('Selected Queries:', selectedQueries);
        }
    });
    $('#showResults').click(function () {
        $('#resultsContainer').show();
        // Формирование запроса на сервер
        let resultQuery = Object.values(selectedQueries).join('');
        alert(resultQuery);
        let requestData = {
            query: resultQuery
        };

        // Отправка запроса на сервер
        $.ajax({
            url: '../handlers/testHandler.php', // Укажите URL вашего PHP-скрипта для обработки запроса
            type: 'POST',
            data: requestData,
            success: function (response) {
                // Обработка успешного ответа от сервера
                $('#resultsContainer').html(response);
                $('#testForm').hide();
            },
            error: function () {
                // Обработка ошибки запроса
                $('#resultsContainer').html('<p>Произошла ошибка при загрузке результатов.</p>');
            }
        });
    });

    function restartTest() {
        // Очистка переменных
        selectedAnswers = {};
        selectedQueries = {};
    
        $('#resultsContainer').hide();
        // Показываем контейнер с вопросами и кнопки
        $('#questionContainer').show();
        $('#testForm').show();
        // Очистка полей формы
        $('#testForm').trigger('reset');
    
        // Очистка HTML-ответа с результатами
    
        // Показываем начальный вопрос
        currentQuestionIndex = 0;
        showQuestion(currentQuestionIndex);
    }
    
    
    $(document).on('click', '#restartTest', function() {
        restartTest();
        console.log("restart click");
    });
});
