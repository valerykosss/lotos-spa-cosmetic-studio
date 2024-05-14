$(document).ready(function() {
    const stars = $('.star');
    const reviewText = $('#reviewText');
    const submitButton = $('#submitReview');
    const idService = 1; // Получение id_service

    let rating = 0;

    stars.click(function() {
        rating = parseInt($(this).attr('data-rating'));
        highlightStars(rating);
    });

    function highlightStars(rating) {
        stars.each(function() {
            if (parseInt($(this).attr('data-rating')) <= rating) {
                $(this).html('&#9733;'); // Закрашенная звезда
            } else {
                $(this).html('&#9734;'); // Незакрашенная звезда
            }
        });
    }

    submitButton.click(function(e) {
        e.preventDefault(); // Отмена действия по умолчанию (переход по ссылке)

        const review = reviewText.val();

        if (review === '' || rating === 0) {
            alert('Заполните поле отзыва и поставьте количество звезд');
            return;
        }

        const currentDate = new Date().toISOString().slice(0, 10); // Получение текущей даты в формате YYYY-MM-DD

        if (review && rating) {
             // Отправка данных на сервер через AJAX
        $.ajax({
            type: 'POST',
            url: '../handlers/leaveReviewRatingHandler.php',
            data: { 
                review: review, 
                rating: rating,
                currentDate: currentDate,
                idService: idService 
            },
            success: function(response) {
                // Обработка ответа от сервера
                console.log(response);
                // Очистка текстового поля и сброс звездочек
                reviewText.val('');
                rating = 0;
                highlightStars(rating);
            },
            error: function() {
                console.error('Ошибка при отправке запроса');
            }
        });
        }
    });
});
