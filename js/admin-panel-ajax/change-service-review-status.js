
function changeServiceReviewStatus(){
    var feedBackStatusSelects = document.querySelectorAll('.service-review-status');
    feedBackStatusSelects.forEach(function (select) {
        select.addEventListener('change', function () {
            var feedbackId = this.parentNode.parentNode.id;
            var newStatus = this.value;
            updateStatus(feedbackId, newStatus);
        });
    });

    function updateStatus(feedbackId, newStatus) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Обработка успешного ответа
                } else {
                    console.error('Произошла ошибка при обновлении статуса отзыва');
                }
            }
        };
        xhr.open('POST', '../../handlers/admin-panel-handlers/update_service_review_status_script.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('feedback_id=' + feedbackId + '&new_status=' + newStatus);
    }
}

changeServiceReviewStatus();