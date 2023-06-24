//                                    theme style selectors
const body = document.querySelector("body");
const selectedTheme = document.querySelector("#theme");
const btn = document.querySelector(".theme-button");
const createdQuiz = document.querySelector(".created-quiz");
const attendedQuiz = document.querySelector(".attended-quiz");
const p = document.querySelectorAll("p");
const h2 = document.querySelectorAll("h2");
const h3 = document.querySelectorAll("h3");
const username = document.querySelector(".username");
const mobileNav = document.querySelector(".mobile-nav");
const mobileNavigationMenu = document.querySelector(".mobile-navigation"); 
const themeCard = document.querySelector(".theme");
const makeQuizMain = document.querySelector(".make-quiz");
const attendQuiz = document.querySelector(".attendquiz-popup");
const addQuestionPopup = document.querySelector(".addquestions-popup");
const checkResponseQuiz = document.querySelector(".checkresponsequiz-popup");
const tandc = document.querySelector(".tandc");
const feedbackForm = document.getElementById("feedback-form");
const themeBtn = document.querySelector(".theme-button");

//font style selector 
const selectedFont = document.querySelector("#font");

//theme style event listener
document.addEventListener("DOMContentLoaded",function(){
  const currentTheme = localStorage.getItem("theme");
  const currentFonts = localStorage.getItem("fontstyle");
  if(currentTheme !== null && selectedTheme !== null){
    selectedTheme.value = currentTheme;
  }
  if(currentTheme == "dark"){
    darkTheme();
  }else {
    lightTheme();
  }
  switch (currentFonts) {
    case "Poppins":
      body.style.fontFamily = "Poppins";
      selectedFont.value = currentFonts;
      break;
    case "Roboto":
      body.style.fontFamily = "Roboto";
      selectedFont.value = currentFonts;
      break;
    case "Open Sans":
      body.style.fontFamily = "Open Sans";
      selectedFont.value = currentFonts;
      break;
    case "Lato":
      body.style.fontFamily = "Lato";
      selectedFont.value = currentFonts;
      break;
    case "Montserrat":
      body.style.fontFamily = "Montserrat";
      selectedFont.value = currentFonts;
      break;
    case "Raleway":
      body.style.fontFamily = "Raleway";
      selectedFont.value = currentFonts;
      break;
    case "Default":
      body.style.fontFamily = "sans-serif";
      selectedFont.value = currentFonts;
      break;
  }
  
})
//theme style event listener
selectedTheme.addEventListener("change",function(){
  console.log(selectedTheme.value);
  if (selectedTheme.value == "dark") {
    darkTheme();
  }else if (selectedTheme.value == "light") {
    lightTheme();
  }
})
themeBtn.addEventListener("click",function(){
  let theme = document.body.classList.contains("dark-theme") ? "dark": "light";
  localStorage.setItem("theme", theme);
  localStorage.setItem("fontstyle",body.style.fontFamily.replace(/^"(.+(?="$))"$/, '$1'))
})
//theme style functions
function darkTheme(){
  document.body.classList.add("dark-theme");
   
    if(createdQuiz !== null){
      createdQuiz.classList.add("dark-theme");
    }
    if(attendedQuiz !== null){
      attendedQuiz.classList.add("dark-theme");
    }
    p.forEach(text => {
      text.classList.add("dark-theme");
    })
    h2.forEach(text => {
      text.classList.add("dark-theme");
    })
    h3.forEach(text => {
      text.classList.add("dark-theme");
    })
    if(username !== null){
      username.classList.add("dark-theme");
    }
    if(themeCard !== null){
      themeCard.classList.add("dark-theme");
    }
    mobileNav.classList.add("dark-theme");
    mobileNavigationMenu.classList.add("dark-theme");
    if(makeQuizMain !== null){
      makeQuizMain.classList.add("dark-theme");
    }
    if(attendQuiz !== null){
      attendQuiz.classList.add("dark-theme");
    }
    if(addQuestionPopup !== null){
      addQuestionPopup.classList.add("dark-theme");
    }
    if(checkResponseQuiz !== null){
      checkResponseQuiz.classList.add("dark-theme");
    }
    if(tandc !== null){
      tandc.classList.add("dark-theme");
    }
    if(feedbackForm != null){
      feedbackForm.classList.add("dark-theme");
    }
}
function lightTheme(){
  document.body.classList.remove("dark-theme");
  if(createdQuiz !== null){
    createdQuiz.classList.remove("dark-theme");
  }
  if(attendedQuiz !== null){
    attendedQuiz.classList.remove("dark-theme");
  }
  if(addQuestionPopup !== null){
    addQuestionPopup.classList.remove("dark-theme");
  }
  if(checkResponseQuiz !== null){
    checkResponseQuiz.classList.remove("dark-theme");
  }
  p.forEach(text => {
    text.classList.remove("dark-theme");
  })
  h2.forEach(text => {
    text.classList.remove("dark-theme");
  })
  h3.forEach(text => {
    text.classList.remove("dark-theme");
  })
  if(themeCard !== null){
    themeCard.classList.remove("dark-theme");
  }
  mobileNav.classList.remove("dark-theme");
  mobileNavigationMenu.classList.remove("dark-theme");
  if(makeQuizMain !== null){
    makeQuizMain.classList.remove("dark-theme");
  }
  if(tandc !== null){
    tandc.classList.remove("dark-theme");
  }
  if(feedbackForm != null){
    feedbackForm.classList.remove("dark-theme");
  }
}

//font style event listener
selectedFont.addEventListener("change",function(){
  console.log(selectedFont.value);
  changeFont();
})
function changeFont(){
  switch (selectedFont.value) {
    case "Poppins":
      body.style.fontFamily = "Poppins";
      break;
    case "Roboto":
      body.style.fontFamily = "Roboto";
      break;
    case "Open Sans":
      body.style.fontFamily = "Open Sans".replace("/^$/g",);
      break;
    case "Lato":
      body.style.fontFamily = "Lato";
      break;
    case "Montserrat":
      body.style.fontFamily = "Montserrat";
      break;
    case "Raleway":
      body.style.fontFamily = "Raleway";
      break;
    case "Default":
      body.style.fontFamily = "sans-serif";
      break;
  }
}
