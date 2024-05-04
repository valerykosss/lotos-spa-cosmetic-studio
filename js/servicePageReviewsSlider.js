var swiper = new Swiper(".mySwiper", {
    slidesPerView: 2.5,
    spaceBetween: 60,
    navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
});


// Получаем ссылку на элемент, значение margin-left которого нужно получить
var sourceElement = document.querySelector('.service-page__body');


// Получаем ссылку на элемент, к которому нужно применить значение margin-left
var targetElement = document.querySelector('.review__body');

// Функция для обновления margin-left у целевого элемента
function updateMarginLeft() {
    // Получаем значение margin-left и применяем его к целевому элементу
    var marginLeftValue = window.getComputedStyle(sourceElement).marginLeft;
    targetElement.style.marginLeft = marginLeftValue;
}

// Вызываем функцию обновления margin-left при загрузке страницы
updateMarginLeft();

// Вызываем функцию обновления margin-left при изменении размеров окна браузера
window.addEventListener('resize', updateMarginLeft);

