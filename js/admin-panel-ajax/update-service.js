
//одновление мастера
$(document).on('click', '.change-service__button', function () {
    // var masterId = $(this).attr('id');
    // var master_name = $('tr#' + masterId + ' textarea').eq(0).val();
    // var master_surname = $('tr#' + masterId + ' textarea').eq(1).val();
    // var master_photo = $('tr#' + masterId + ' textarea').eq(2).val();
    // var education = $('tr#' + masterId + ' textarea').eq(3).val();
    // var work_experience = $('tr#' + masterId + ' textarea').eq(4).val();
    // var position = $('tr#' + masterId + ' textarea').eq(5).val();

    //updateMaster(masterId, master_name, master_surname, master_photo, education, work_experience, position);
});


function updateMaster(masterId, master_name, master_surname, master_photo, education, work_experience, position) {
    // $.ajax({
    //     url: '../handlers/admin-panel-handlers/updateMasterHandler.php',
    //     type: 'POST',
    //     dataType: 'json',
    //     data: {
    //         masterId: masterId,
    //         master_name: master_name,
    //         master_surname: master_surname,
    //         master_photo: master_photo,
    //         education: education,
    //         work_experience: work_experience,
    //         position: position
    //     },
    //     success: function (response) {
    //         if (response.success) {
    //             alert("Мастер обновлен!");

    //             // Обновляем данные в таблице
    //             $('textarea#'+ masterId).eq(0).val(master_name);
    //             $('textarea#'+ masterId).eq(1).val(master_surname);
    //             $('textarea#'+ masterId).eq(2).val(master_photo);
    //             $('textarea#'+ masterId).eq(3).val(education);
    //             $('textarea#'+ masterId).eq(4).val(work_experience);
    //             $('textarea#'+ masterId).eq(5).val(position);
    //         } else {
    //             console.error('Произошла ошибка при обновлении мастера');
    //         }
    //     },
    //     error: function () {
    //         console.error('Произошла ошибка при обновлении мастера');
    //     }
    // });
}