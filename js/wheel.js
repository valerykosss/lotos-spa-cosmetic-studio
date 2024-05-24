let prizes = [];

// Функция загрузки призов из базы данных
const loadPrizesFromDatabase = () => {
    $.ajax({
        url: '../handlers/wheelDiscountsIndexHandler.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data && data.length > 0) {
                prizes = data; // Заполнение массива prizes новыми данными
                setupWheel(); // Инициализация колеса с новыми данными
            } else {
                console.error('No data received from the server.');
            }
        },
        error: function(error) {
            console.error('Error fetching data:', error);
        }
    });
};

// Вызов функции загрузки призов при загрузке страницы
loadPrizesFromDatabase();

// создаём переменные для быстрого доступа ко всем объектам на странице — блоку в целом, колесу, кнопке и язычку
const wheel = document.querySelector(".deal-wheel");
const spinner = wheel.querySelector(".spinner");
const trigger = document.querySelector(".btn-spin");
const ticker = wheel.querySelector(".ticker");

// на сколько секторов нарезаем круг
let prizeSlice;
// на какое расстояние смещаем сектора друг относительно друга
let prizeOffset;
// прописываем CSS-классы, которые будем добавлять и убирать из стилей
const spinClass = "is-spinning";
const selectedClass = "selected";
// получаем все значения параметров стилей у секторов
const spinnerStyles = window.getComputedStyle(spinner);

// переменная для анимации
let tickerAnim;
// угол вращения
let rotation = 0;
// текущий сектор
let currentSlice = 0;
// переменная для текстовых подписей
let prizeNodes;

// функция расчёта размеров секторов и смещения
const calculateSizes = () => {
    prizeSlice = 360 / prizes.length;
    prizeOffset = Math.floor(180 / prizes.length);
};

// расставляем текст по секторам
const createPrizeNodes = () => {
    calculateSizes();
    // обрабатываем каждую подпись
    prizes.forEach(({ text, color, reaction, id }, i) => {
        // каждой из них назначаем свой угол поворота
        const rotation = ((prizeSlice * i) * -1) - prizeOffset;
        // добавляем код с размещением текста на страницу в конец блока spinner
        spinner.insertAdjacentHTML(
            "beforeend",
            // текст при этом уже оформлен нужными стилями
            `<li class="prize" data-reaction=${reaction} data-id=${id} style="--rotate: ${rotation}deg">
              <span class="text">${text}</span>
            </li>`
        );
    });
};

// рисуем разноцветные секторы
const createConicGradient = () => {
    // устанавливаем нужное значение стиля у элемента spinner
    spinner.setAttribute(
        "style",
        `background: conic-gradient(
          from -90deg,
          ${prizes
              // получаем цвет текущего сектора
              .map(({ color }, i) => `${color} 0 ${(100 / prizes.length) * (prizes.length - i)}%`)
              .reverse()
          }
        );`
    );
};

// создаём функцию, которая нарисует колесо в сборе
const setupWheel = () => {
    // сначала секторы
    createConicGradient();
    // потом текст
    createPrizeNodes();
    // а потом мы получим список всех призов на странице, чтобы работать с ними как с объектами
    prizeNodes = wheel.querySelectorAll(".prize");
};

// определяем количество оборотов, которое сделает наше колесо
const spinertia = (min, max) => {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min;
};

// функция запуска вращения с плавной остановкой
const runTickerAnimation = () => {
    // взяли код анимации отсюда: https://css-tricks.com/get-value-of-css-rotation-through-javascript/
    const values = spinnerStyles.transform.split("(")[1].split(")")[0].split(",");
    const a = values[0];
    const b = values[1];  
    let rad = Math.atan2(b, a);
    
    if (rad < 0) rad += (2 * Math.PI);
    
    const angle = Math.round(rad * (180 / Math.PI));
    const slice = Math.floor(angle / prizeSlice);

    // анимация язычка, когда его задевает колесо при вращении
    // если появился новый сектор
    if (currentSlice !== slice) {
        // убираем анимацию язычка
        ticker.style.animation = "none";
        // и через 10 миллисекунд отменяем это, чтобы он вернулся в первоначальное положение
        setTimeout(() => ticker.style.animation = null, 10);
        // после того, как язычок прошёл сектор - делаем его текущим 
        currentSlice = slice;
    }
    // запускаем анимацию
    tickerAnim = requestAnimationFrame(runTickerAnimation);
};

// функция выбора призового сектора
const selectPrize = () => {
    const selected = Math.floor(rotation / prizeSlice);
    const selectedId = prizeNodes[selected].getAttribute('data-id');

    $(".btn-spin").prop('disabled', true);

    $.ajax({
        url: '../handlers/addDiscountIntoUserTable.php',
        type: 'POST',
        dataType: 'json',
        data: { 
            selectedId: selectedId
        },
        success: function(response) {
            if (response.success) {
                // Выводим сообщение об успешном сохранении
                prizeNodes[selected].classList.add(selectedClass);
            } else {
                // Выводим сообщение об ошибке
                alert('Ошибка при сохранении ID в базе данных.');

            }
        },
        error: function(error) {
            console.error('Error saving data:', error);
        }
    });
    
    // Выводим ID сектора в alert
    // alert(`Колесо остановилось на секторе с ID: ${selectedId}`);
    
};

// отслеживаем нажатие на кнопку
trigger.addEventListener("click", () => {
    // делаем её недоступной для нажатия
    trigger.disabled = true;
    // задаём начальное вращение колеса
    rotation = Math.floor(Math.random() * 360 + spinertia(2000, 5000));
    // убираем прошлый приз
    prizeNodes.forEach((prize) => prize.classList.remove(selectedClass));
    // добавляем колесу класс is-spinning, с помощью которого реализуем нужную отрисовку
    wheel.classList.add(spinClass);
    // через CSS говорим секторам, как им повернуться
    spinner.style.setProperty("--rotate", rotation);
    // возвращаем язычок в горизонтальную позицию
    ticker.style.animation = "none";
    // запускаем анимацию вращение
    runTickerAnimation();
});

// отслеживаем, когда закончилась анимация вращения колеса
spinner.addEventListener("transitionend", () => {
    // останавливаем отрисовку вращения
    cancelAnimationFrame(tickerAnim);
    // получаем текущее значение поворота колеса
    rotation %= 360;
    // выбираем приз
    selectPrize();
    // убираем класс, который отвечает за вращение
    wheel.classList.remove(spinClass);
    // отправляем в CSS новое положение поворота колеса
    spinner.style.setProperty("--rotate", rotation);
});
