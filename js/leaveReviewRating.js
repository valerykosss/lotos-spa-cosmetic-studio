$(document).ready(function() {
    function setupReviewHandlers(starsSelector, reviewTextSelector, submitButtonSelector, ajaxUrl, idKey) {
        const stars = $(starsSelector + ' .star');
        const reviewText = $(reviewTextSelector);
        const submitButton = $(submitButtonSelector);
        let rating = 0;

        stars.click(function() {
            rating = parseInt($(this).attr('data-rating'));
            highlightStars(stars, rating);
        });

        function highlightStars(stars, rating) {
            stars.each(function() {
                const starImg = $(this).find('.star-img');
                if (parseInt($(this).attr('data-rating')) <= rating) {
                    starImg.attr('src', '../images/icons/review-star-new.svg'); // Заполненная звезда
                } else {
                    starImg.attr('src', '../images/icons/review-star-empty-new.svg'); // Незаполненная звезда
                }
            });
        }

        submitButton.click(function(e) {
            e.preventDefault(); // Отмена действия по умолчанию (переход по ссылке)

            const review = reviewText.val();
            const id = reviewText.data(idKey);

            if (review === '' || rating === 0) {
                alert('Заполните поле отзыва и поставьте количество звезд');
                return;
            }

            const currentDate = new Date().toISOString().slice(0, 10); // Получение текущей даты в формате YYYY-MM-DD

            if (review && rating) {
                // Отправка данных на сервер через AJAX
                $.ajax({
                    type: 'POST',
                    url: ajaxUrl,
                    data: { 
                        review: review, 
                        rating: rating,
                        currentDate: currentDate,
                        id: id
                    },
                    success: function(response) {
                        // Обработка ответа от сервера
                        console.log(response);
                        // Очистка текстового поля и сброс звездочек
                        reviewText.val('');
                        rating = 0;
                        highlightStars(stars, rating);
                    },
                    error: function() {
                        console.error('Ошибка при отправке запроса');
                    }
                });
            }
        });
    }

    setupReviewHandlers('#serviceStars', '#serviceReviewText', '#submitServiceReview', '../handlers/leaveServiceReviewHandler.php', 'service-id');
    setupReviewHandlers('#masterStars', '#masterReviewText', '#submitMasterReview', '../handlers/leaveMasterReviewHandler.php', 'master-id');
});
