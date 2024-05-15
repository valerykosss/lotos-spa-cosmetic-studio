/*--------------------------------------------TABS--------------------------------------------*/
const tabBtn1 = document.getElementById("tab-btn-1");
const tabBtn2 = document.getElementById("tab-btn-2");
const tabBtn3 = document.getElementById("tab-btn-3");
const tabBtn4 = document.getElementById("tab-btn-4");
const tabBtn5 = document.getElementById("tab-btn-5");
const tabBtn6 = document.getElementById("tab-btn-6");
const tabBtn7 = document.getElementById("tab-btn-7");
const tabBtn8 = document.getElementById("tab-btn-8");
const tabBtn9 = document.getElementById("tab-btn-9");

const content1 = document.getElementById("content-1");
const content2 = document.getElementById("content-2");
const content3 = document.getElementById("content-3");
const content4 = document.getElementById("content-4");
const content5 = document.getElementById("content-5");
const content6 = document.getElementById("content-6");
const content7 = document.getElementById("content-7");
const content8 = document.getElementById("content-8");
const content9 = document.getElementById("content-9");

function showContent1() {
  content1.style.display = "block";
  content2.style.display = "none";
  content3.style.display = "none";
  content4.style.display = "none";
  content5.style.display = "none";
  content6.style.display = "none";
  content7.style.display = "none";
  content8.style.display = "none";
  content9.style.display = "none";
}

showContent1();

// Устанавливаем обработчики события изменения состояния для каждой радио-кнопки
tabBtn1.addEventListener("change", function() {
    content1.style.display = tabBtn1.checked ? "block" : "none";

    content2.style.display = "none";
    content3.style.display = "none";
    content4.style.display = "none";
    content5.style.display = "none";
    content6.style.display = "none";
    content7.style.display = "none";
    content8.style.display = "none";
    content9.style.display = "none";
});

tabBtn2.addEventListener("change", function() {
    content2.style.display = tabBtn2.checked ? "block" : "none";

    content1.style.display = "none";
    content3.style.display = "none";
    content4.style.display = "none";
    content5.style.display = "none";
    content6.style.display = "none";
    content7.style.display = "none";
    content8.style.display = "none";
    content9.style.display = "none";
});

tabBtn3.addEventListener("change", function() {
    content3.style.display = tabBtn3.checked ? "block" : "none";

    content1.style.display = "none";
    content2.style.display = "none";
    content4.style.display = "none";
    content5.style.display = "none";
    content6.style.display = "none";
    content7.style.display = "none";
    content8.style.display = "none";
    content9.style.display = "none";
});

tabBtn4.addEventListener("change", function() {
    content4.style.display = tabBtn4.checked ? "block" : "none";

    content1.style.display = "none";
    content2.style.display = "none";
    content3.style.display = "none";
    content5.style.display = "none";
    content6.style.display = "none";
    content7.style.display = "none";
    content8.style.display = "none";
    content9.style.display = "none";
});

tabBtn5.addEventListener("change", function() {
    content5.style.display = tabBtn5.checked ? "block" : "none";

    content1.style.display = "none";
    content2.style.display = "none";
    content3.style.display = "none";
    content4.style.display = "none";
    content6.style.display = "none";
    content7.style.display = "none";
    content8.style.display = "none";
    content9.style.display = "none";
});

tabBtn6.addEventListener("change", function() {
    content6.style.display = tabBtn6.checked ? "block" : "none";

    content1.style.display = "none";
    content2.style.display = "none";
    content3.style.display = "none";
    content4.style.display = "none";
    content5.style.display = "none";
    content7.style.display = "none";
    content8.style.display = "none";
    content9.style.display = "none";
});

tabBtn7.addEventListener("change", function() {
    content7.style.display = tabBtn7.checked ? "block" : "none";

    content1.style.display = "none";
    content2.style.display = "none";
    content3.style.display = "none";
    content4.style.display = "none";
    content5.style.display = "none";
    content6.style.display = "none";
    content8.style.display = "none";
    content9.style.display = "none";
});

tabBtn8.addEventListener("change", function() {
    content8.style.display = tabBtn8.checked ? "block" : "none";

    content1.style.display = "none";
    content2.style.display = "none";
    content3.style.display = "none";
    content4.style.display = "none";
    content5.style.display = "none";
    content6.style.display = "none";
    content7.style.display = "none";
    content9.style.display = "none";
});

tabBtn9.addEventListener("change", function() {
    content9.style.display = tabBtn9.checked ? "block" : "none";

    content1.style.display = "none";
    content2.style.display = "none";
    content3.style.display = "none";
    content4.style.display = "none";
    content5.style.display = "none";
    content6.style.display = "none";
    content7.style.display = "none";
    content8.style.display = "none";
});