const sectors = [
    "1", "2", "Скидка 20% на массаж для двоих", "4", "5"
  ];
  
  // Генерация случайного числа в диапазоне от min до max:
  const rand = (m, M) => Math.random() * (M - m) + m;
  const tot = sectors.length;
  const elWheel = document.querySelector("#wheel");
  const elRotateBtn = document.querySelector("#center-button");
  const PI = Math.PI;
  const TAU = 2 * PI;
  const arc = TAU / tot;
  let ang = 0; // Угол поворота в радианах
  let isSpinning = false;
  const imageAngOffsets = [-0.1, 0.3, 0.7, 1.1, 1.5]; // Смещения углов для каждого сектора
  
  // Получение индекса текущего сектора
  const getIndex = () => {
    // Перевод угла в градусы
    let degrees = ang * (180 / PI);
    // Корректировка отрицательных углов
    if (degrees < 0) degrees += 360;
    // Определение индекса сектора на основе угла
    return Math.floor(degrees / (360 / tot)) % tot;
  };
  
  const spin = () => {
    
    if (isSpinning) return; // Ничего не делать
    isSpinning = true;
    ang += rand(20, 30); // Генерация случайного угла
  
    const anim = elWheel.animate([{rotate: `${ang}rad`}], {
      duration: rand(4000, 5000),
      easing: "cubic-bezier(0.23, -0.16, 0.2, 1)",
      fill: "both"
    });
  
    anim.addEventListener("finish", (event) => {
      isSpinning = false;
      const index = getIndex();
      const value = sectors[index];
      console.clear();
      console.log(value);
    });
  };
  
  elRotateBtn.addEventListener("pointerdown", spin);
  