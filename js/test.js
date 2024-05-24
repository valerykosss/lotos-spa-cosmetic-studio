$(document).ready(function () {
    let currentQuestionIndex = 0;
    let selectedAnswers = {};
    let selectedQueries = {}; // Массив для хранения выбранных select_query

    let data = [
        {
            id: 'id1',
            question: 'Какой тип услуги вы предпочитаете?',
            answers: [
                { text: 'Косметические услуги', select_query: ' where id_service_type=1', next_question: 'id2.1' },
                { text: 'Массаж', select_query: ' where id_service_type=4 or id_service_type=5', next_question: 'id2.2' },
                { text: 'Спа-программы', select_query: ' where id_service_type=2', next_question: 'id2.3' }
            ]
        },
        {
            id: 'id2.1',
            question: 'Вы хотите посетить косметическую услугу для рук или лица?',
            answers: [
                { text: "Для рук", select_query: " and service_name like '% рук%'", next_question: "end" },
                { text: 'Для лица', select_query: '...', next_question: 'id2.1.2' }
            ]
        },
        // Добавьте остальные вопросы
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
