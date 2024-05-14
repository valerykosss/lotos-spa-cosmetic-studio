function changeStatus(){
    var statusSelects = document.querySelectorAll('.record-status');
    statusSelects.forEach(function (select) {
        select.addEventListener('change', function () {
            var recordId = this.parentNode.parentNode.id;
            var newStatus = this.value;
            updateStatus(recordId, newStatus);
        });
    });

    function updateStatus(recordId, newStatus) {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Обработка успешного ответа
                } else {
                    console.error('Произошла ошибка при обновлении статуса записи');
                }
            }
        };
        xhr.open('POST', '../handlers/admin-panel-handlers/update_record_status_script.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('record_id=' + recordId + '&new_status=' + newStatus);
    }
}

changeStatus();
export {changeStatus};