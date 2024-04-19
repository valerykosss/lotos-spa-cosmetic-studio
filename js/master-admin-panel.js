$( ".add-master__button" ).click(function() {
    let master_name = $('.master_name').val().trim();
    let master_surname = $('.master_surname').val().trim();
    let master_photo = $('.master_photo').val().trim();
    let education = $('.education').val().trim();
    let work_experience = parseInt($('.work_experience').val().trim(), 10);
    let position = $('.position').val().trim();

        $.ajax({
            url: "../handlers/admin-panel-handlers/addMasterHandler.php",
            method: "POST",
            data: {
                master_name: master_name,
                master_surname: master_surname,
                master_photo: master_photo,
                education: education,
                work_experience: work_experience,
                position: position,
            },
            success: function (data) { // запустится после получения результатов
                alert("Мастер добавлен!");
                $(".table__to-update-delete").html(data);

                $('.master_name').val('');
                $('.master_surname').val('');
                $('.master_photo').val('');
                $('.education').val('');
                $('.work_experience').val('');
                $('.position').val('');
            }
        });
});

$( ".delete-master__button" ).click(function() {
    let id_master_to_delete = $(this).attr("id");

        $.ajax({
            url: "../handlers/admin-panel-handlers/deleteMasterHandler.php",
            method: "POST",
            data: {
                id_master_to_delete: id_master_to_delete,
            },
            success: function (data) { // запустится после получения результатов
                alert("Мастер удален!");
                $(".table__to-update-delete").html(data);
            }
        });
});
