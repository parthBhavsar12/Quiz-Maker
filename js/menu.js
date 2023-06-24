const menu = document.querySelector(".mobile-nav")
const close = document.querySelector(".close")
const nav = document.querySelector(".mobile-navigation")
const attendquiz = document.querySelector("#mobileattendquiz");
const mobileviewAttendQuiz = document.querySelector(".attend-quiz");

menu.addEventListener("click",() => {
  nav.classList.add("open-nav")
})
close.addEventListener("click",() => {
  nav.classList.remove("open-nav")
})
attendquiz.addEventListener("click",() => {
    nav.classList.remove("open-nav");
})