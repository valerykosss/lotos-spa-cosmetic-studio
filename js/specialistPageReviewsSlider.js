var swiper = new Swiper(".mySwiper", {
    slidesPerView: 2.5,
    spaceBetween: 60,
    navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            1024:{
                slidesPerView: 2.5,
            },
            880: {
              slidesPerView: 2,
              spaceBetween: 20
            },
            727: {
              slidesPerView: 1.6,
              spaceBetween: 20
            },
            524: {
                slidesPerView: 1.2,
                spaceBetween: 20
            },
            320: {
                slidesPerView: 1.1,
                spaceBetween: 10
            },
            0: {
                slidesPerView: 1,
                spaceBetween: 10
            }

          }
    
});


// Получаем ссылку на элемент, значение margin-left которого нужно получить
var sourceElement = document.querySelector('.specialist-profile__body');


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

