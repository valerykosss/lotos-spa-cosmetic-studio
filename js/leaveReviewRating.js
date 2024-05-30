$(document).ready(function() {
    function setupReviewHandlers(starsSelector, reviewTextSelector, submitButtonSelector, ajaxUrl, idKey, parentContainerSelector) {
        const stars = $(starsSelector + ' .star');
        const reviewText = $(reviewTextSelector);
        const submitButton = $(submitButtonSelector);
        const parentContainer = $(parentContainerSelector);
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
            const recordId = reviewText.data('record-id');
            alert(recordId);


            if (review === '' || rating === 0) {
                $('.popup__bg__error-success').addClass('active');
                $('.popup__error-success').addClass('active');
                $('.popup__error-success .data-title').text('Ошибка отправки!');
                $('.popup__error-success .data-text').text('Заполните поле отзыва и поставьте количество звезд');
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
                        id: id,
                        recordId: recordId
                    },
                    success: function(response) {
                        $('.popup__bg__error-success').addClass('active');
                        $('.popup__error-success').addClass('active');
                        $('.popup__error-success .data-title').text('Успешно!');
                        $('.popup__error-success .data-text').text('Спасибо за ваш отзыв, он отправлен на модерацию!');
                        // Обработка ответа от сервера
                        console.log(response);
                        // Очистка текстового поля и сброс звездочек
                        reviewText.val('');
                        rating = 0;
                        highlightStars(stars, rating);
                        parentContainer.hide();
                    },
                    error: function() {
                        console.error('Ошибка при отправке запроса');
                    }
                });
            }
        });
    }

    setupReviewHandlers('#serviceStars', '#serviceReviewText', '#submitServiceReview', '../handlers/leaveServiceReviewHandler.php', 'service-id', '.leave-review__body:has(#serviceReviewText)');
    setupReviewHandlers('#masterStars', '#masterReviewText', '#submitMasterReview', '../handlers/leaveMasterReviewHandler.php', 'master-id', '.leave-review__body:has(#masterReviewText)');
});
