document.addEventListener("DOMContentLoaded", function() {
    // Находим все фотографии и назначаем на них обработчики событий
    var photos = document.querySelectorAll('.photo-container img');
    photos.forEach(function(photo) {
        photo.onclick = function() {
            var input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.onchange = function(event) {
                uploadPhoto(event, photo);
            };
            input.click();
        };
    });

    // Функция для загрузки нового фото
    function uploadPhoto(event, photo) {
        var file = event.target.files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            var image = new Image();
            image.src = e.target.result;

            // Обработчик клика на изображение для выбора нового фото
            image.onclick = function() {
                var input = document.createElement('input');
                input.type = 'file';
                input.accept = 'image/*';
                input.onchange = function(event) {
                    uploadPhoto(event, photo);
                };
                input.click();
            };

            var td = photo.parentNode;
            td.innerHTML = '';
            td.appendChild(image);
        };

        reader.readAsDataURL(file);
    }

});
//одновление мастера
$(document).on('click', '.change-master__button', function () {
    var masterId = $(this).attr('id');
    var master_name = $('tr#' + masterId + ' textarea').eq(0).val();
    var master_surname = $('tr#' + masterId + ' textarea').eq(1).val();
    var master_photo = $('tr#' + masterId + ' .photo-container img').eq(0); // получаем элемент input
    var education = $('tr#' + masterId + ' textarea').eq(2).val();
    var work_experience = $('tr#' + masterId + ' textarea').eq(3).val();
    var position = $('tr#' + masterId + ' textarea').eq(4).val();

    // Получение base64 изображения из тега img
    var master_photo = master_photo.prop('src');

    updateMaster(masterId, master_name, master_surname, master_photo, education, work_experience, position);
});


function updateMaster(masterId, master_name, master_surname, master_photo, education, work_experience, position) {
    $.ajax({
        url: '../handlers/admin-panel-handlers/updateMasterHandler.php',
        type: 'POST',
        dataType: 'json',
        data: {
            masterId: masterId,
            master_name: master_name,
            master_surname: master_surname,
            master_photo: master_photo,
            education: education,
            work_experience: work_experience,
            position: position
        },
        success: function (response) {
            if (response.success) {
                alert("Мастер обновлен!");

                // Обновляем данные в таблице
                $('textarea#'+ masterId).eq(0).val(master_name);
                $('textarea#'+ masterId).eq(1).val(master_surname);
                $('textarea#'+ masterId).eq(2).val(master_photo);
                $('textarea#'+ masterId).eq(3).val(education);
                $('textarea#'+ masterId).eq(4).val(work_experience);
                $('textarea#'+ masterId).eq(5).val(position);
            } else {
                console.error('Произошла ошибка при обновлении мастера');
            }
        },
        error: function () {
            console.error('Произошла ошибка при обновлении мастера');
        }
    });
}