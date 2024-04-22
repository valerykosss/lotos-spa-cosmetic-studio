$(document).ready(function() {
    // Загрузка списка типов услуг при загрузке страницы
    loadServiceTypes();

    function loadServiceTypes() {
        $.ajax({
            url: '../handlers/admin-panel-handlers/getServiceTypeNames.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Очищаем выпадающий список

                // Заполняем выпадающий список
                $.each(response, function(index, serviceType) {
                    $('.id_service_type').append($('<option>', {
                        value: serviceType.id_service_type, // предполагается, что у вас есть поле id
                        text: serviceType.service_type_name // предполагается, что у вас есть поле name
                    }));
                });
            },
            error: function(error) {
                console.error('Ошибка при загрузке типов услуг:', error);
            }
        });
    }
});
