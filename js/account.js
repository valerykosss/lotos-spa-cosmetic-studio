
$(document).ready(function() {
    $('#area3').addClass('active');
    $('div[data-target="area3"]').addClass('active-tab');
    $('div[data-target="area3"]').find('.arrow').addClass('open');
    
    $('.menu-tab').click(function() {
        // Убираем класс active со всех profile__area
        $('.profile__area').removeClass('active');
        $('.menu-tab').removeClass('active-tab');

        $(this).addClass("active-tab");

        
        // Получаем target блока profile__area
        var target = $(this).data('target');
        
        // Показываем нужный блок profile__area
        $('#' + target).addClass('active');
        
        // Убираем класс open со всех стрелок
        $('.arrow').removeClass('open');
        
        // Добавляем класс open к стрелке внутри нажатого menu-tab
        $(this).find('.arrow').addClass('open');

    });
});
