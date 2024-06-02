/*--------------------------------------------MAIN SLIDER--------------------------------------------*/

var slideNames = ["Косметические услуги", "Cпа-программы", "Массаж лица", "Массаж тела"]; // Массив названий слайдов

var swiper1 = new Swiper('.swiper1', {
  speed: 900,
  slidesPerView: 1,
  grabCursor: false,
  loop: true,
  effect: "fade",
  centeredSlides: true,
  fadeEffect: { crossFade: true },
  autoplay: {
    delay: 6000,
    disableOnInteraction: true,
  },

  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
    renderBullet: function (index, className) {
      return '<span class="' + className + '">' + slideNames[index] + '</span>'; // Использование названий из массива
    },
  },

  on: {
    slideChange: function () {
      var activeIndex = this.realIndex + 1; // Получаем порядковый номер текущего слайда
      document.querySelector('.slider-counter-current-number').textContent = "0" + activeIndex; // Обновляем текст текущего слайда
    },
  },
});

var swiper2 = new Swiper('.swiper2', {
  speed: 900,
  slidesPerView: 2.5,
  grabCursor: false,
  loop: true,
  centeredSlides: true,
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
  autoplay: {
    delay: 6000,
    disableOnInteraction: true,
  },
  
  effect: "creative",
  creativeEffect: {
    prev: {
      shadow: true,
      translate: ["-250%", 0, -2000],
      rotate: [0, 0, -90],
    },
    next: {
      shadow: true,
      translate: ["250%", 0, -2000],
      rotate: [0, 0, 90],
    },
  },
  allowTouchMove: false,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
    renderBullet: function (index, className) {
      return '<span class="' + className + '" style="text-transform: uppercase; color: #fff">' + slideNames[index] + '</span>'; // Использование названий из массива
    },
  },
  breakpoints: {
    541: {
      slidesPerView: 2.5,
      spaceBetween: 20
    },
    0: {
      slidesPerView: 1,
      spaceBetween: 20
    },
  }
  
});

/*--------------------------------------------TABS--------------------------------------------*/
const tabBtn1 = document.getElementById("tab-btn-1");
const tabBtn2 = document.getElementById("tab-btn-2");
const tabBtn3 = document.getElementById("tab-btn-3");
const tabBtn4 = document.getElementById("tab-btn-4");

const content1 = document.getElementById("content-1");
const content2 = document.getElementById("content-2");
const content3 = document.getElementById("content-3");
const content4 = document.getElementById("content-4");

function showContent1() {
  content1.style.display = "block";
  content2.style.display = "none";
  content3.style.display = "none";
  content4.style.display = "none";
}

showContent1();

// Устанавливаем обработчики события изменения состояния для каждой радио-кнопки
tabBtn1.addEventListener("change", function() {
    content1.style.display = tabBtn1.checked ? "block" : "none";

    content2.style.display = "none";
    content3.style.display = "none";
    content4.style.display = "none";
});

tabBtn2.addEventListener("change", function() {
    content2.style.display = tabBtn2.checked ? "block" : "none";

    content1.style.display = "none";
    content3.style.display = "none";
    content4.style.display = "none";
});

tabBtn3.addEventListener("change", function() {
    content3.style.display = tabBtn3.checked ? "block" : "none";

    content1.style.display = "none";
    content2.style.display = "none";
    content4.style.display = "none";
});

tabBtn4.addEventListener("change", function() {
    content4.style.display = tabBtn4.checked ? "block" : "none";

    content1.style.display = "none";
    content2.style.display = "none";
    content3.style.display = "none";
});


/*--------------------------------------------SPECIALISTS SLIDER--------------------------------------------*/

document.addEventListener('DOMContentLoaded', function () {
  var splide = new Splide('#splide-autoscroll-1', {
    type   : 'loop',
    drag   : 'free',
    focus  : 'center',
    arrows: false, 
    perPage: 3.5,
    autoScroll: {
      speed: -1,
    },
    breakpoints: {
      834: {
        perPage: 3,
      },
      736: {
          perPage: 2.5,
      },
      640: {
        perPage: 2,
      },
      540: {
        perPage: 1.5,
      }
  },
  } );

  splide.mount(window.splide.Extensions);
});

document.addEventListener('DOMContentLoaded', function () {
  var splide = new Splide('#splide-autoscroll-2', {
    type   : 'loop',
    drag   : 'free',
    focus  : 'center',
    arrows: false, 
    perPage: 3.5,
    autoScroll: {
      speed: -1,
    },
    breakpoints: {
      834: {
        perPage: 3,
      },
      736: {
          perPage: 2.5,
      },
      640: {
        perPage: 2,
      },
      540: {
        perPage: 1.5,
      }
  },
  } );

  splide.mount(window.splide.Extensions);
});

document.addEventListener('DOMContentLoaded', function () {
  var splide = new Splide('#splide-autoscroll-3', {
    type   : 'loop',
    drag   : 'free',
    focus  : 'center',
    arrows: false, 
    perPage: 3.5,
    autoScroll: {
      speed: -1,
    },
    breakpoints: {
      834: {
        perPage: 3,
      },
      736: {
          perPage: 2.5,
      },
      640: {
        perPage: 2,
      },
      540: {
        perPage: 1.5,
      }
  },
  } );

  splide.mount(window.splide.Extensions);
});

document.addEventListener('DOMContentLoaded', function () {
  var splide = new Splide('#splide-autoscroll-4', {
    type   : 'loop',
    drag   : 'free',
    focus  : 'center',
    arrows: false, 
    perPage: 3.5,
    autoScroll: {
      speed: -1,
    },
    breakpoints: {
      834: {
        perPage: 3,
      },
      736: {
          perPage: 2.5,
      },
      640: {
        perPage: 2,
      },
      540: {
        perPage: 1.5,
      }
  },
  } );

  splide.mount(window.splide.Extensions);
});

/*--------------------------------------------WHEEL--------------------------------------------*/
