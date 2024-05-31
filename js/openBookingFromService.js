let popupBg = document.querySelector('.popup__bg'); // Фон попап окна
let popup = document.querySelector('.popup'); // Само окно
let openPopupButtons = document.querySelectorAll('.service-button'); // Кнопки для показа окна
let closePopupButton = document.querySelector('.close-popup'); // Кнопка для скрытия окна
openPopupButtons.forEach((button) => { // Перебираем все кнопки
    button.addEventListener('click', (e) => { // Для каждой вешаем обработчик событий на клик
        e.preventDefault(); // Предотвращаем дефолтное поведение браузера
        popupBg.classList.add('active'); // Добавляем класс 'active' для фона
        popup.classList.add('active'); // И для самого окна
        RadioResetAndShowFirstBlock();   
    })
});
closePopupButton.addEventListener('click',() => { // Вешаем обработчик на крестик
    popupBg.classList.remove('active'); // Убираем активный класс с фона
    popup.classList.remove('active'); // И с окна
    enableScroll();
    RadioResetAndShowFirstBlock();

});

document.addEventListener('click', (e) => { // Вешаем обработчик на весь документ
    if(e.target === popupBg) { // Если цель клика - фот, то:
        popupBg.classList.remove('active'); // Убираем активный класс с фона
        popup.classList.remove('active'); // И с окна
        enableScroll();
        RadioResetAndShowFirstBlock();   
    }
});

function disableScroll() {
    document.body.style.overflow = 'hidden';
}

function enableScroll() {
    document.body.style.overflow = '';
}

function RadioResetAndShowFirstBlock(){
    const radioButtons = document.querySelectorAll('input[type="radio"]');
    
    // Сбросить состояние всех найденных радиокнопок
    radioButtons.forEach(radioButton => {
        radioButton.checked = false;
    });


    // Скрыть элементы с классами master__wrapper, date-time__wrapper и details__wrapper
    document.querySelectorAll('.master__wrapper, .date-time__wrapper, .details__wrapper').forEach(function(element) {
        element.style.display = 'none';
    });

    // Показать элемент с классом service__wrapper
    document.querySelector('.service__wrapper').style.display = 'block';

    // Добавление класса active-stage к элементу с id service-stage и удаление этого класса у других элементов с классом stage-title
    document.querySelectorAll('.stage-title').forEach(function(element) {
        if (element.id === 'service-stage') {
            element.classList.add('active-stage');
        } else {
            element.classList.remove('active-stage');
        }
    });
}