$(document).ready(function () {
    let search = "";
    
    // $('#sort-selector-first').change(function () {
    //     let value = $(this).val();
    //     $.ajax({
    //         url: '../handlers/specialistsFilterHandler.php',
    //         type: 'POST',
    //         data: { 
    //             sort: value 
    //         },
    //         success: function (data) {
    //             $('.specialists-catalog__body').html(data);
    //         },
    //         // error: function (xhr, status, error) {
    //         //     console.error('Ошибка: ' + status);
    //         // }
    //     });
    // });

    // $("#search_box").on('input', function(){
    //     search = $("#search_box").val();
    //     // $("#search_box").val('');
    //         $.ajax({
    //             url: "../handlers/specialistsFilterHandler.php",
    //             method: "POST",
    //             data: {
    //                 search: search,
    //             },
    //             success: function (data) { // запустится после получения результатов
    //                 $(".specialists-catalog__body").html(data);
    //             }
    //         });
    //     return true;
    // });

    $('#sort-selector-first, #sort-selector-second, #search_box').on('change input', function () {
        let sort1Value = $('#sort-selector-first').val();
        let sort2Value = $('#sort-selector-second').val();
        let searchValue = $('#search_box').val();
    
        $.ajax({
            url: '../handlers/specialistsFilterHandler.php',
            type: 'POST',
            data: {
                sort1: sort1Value,
                sort2: sort2Value,
                search: searchValue
            },
            success: function (data) {
                $('.specialists-catalog__body').html(data);
            },
            // error: function (xhr, status, error) {
            //     console.error('Ошибка: ' + status);
            // }
        });
    });
    

});