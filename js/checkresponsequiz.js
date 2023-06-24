const checkResponseBtn = document.querySelector(".checkresponsequizbtn");
const closeResponseBtn = document.querySelector(".close-checkresponsequiz");
const checkResponsePopup = document.querySelector(".check-responsequiz");
checkResponseBtn.addEventListener("click",openCheckResponsePopup);
//event listeners
// addquestionbtn.forEach((quiz) => {
//     quiz.addEventListener("click", openQuiz);
// })
closeResponseBtn.addEventListener("click", closeCheckResponsePopup);


//functions
function openCheckResponsePopup() {
    const popup = checkResponsePopup.children[0];
    checkResponsePopup.classList.add("active");
    popup.classList.add("active");
}
function closeCheckResponsePopup() {
    const popup = checkResponsePopup.children[0];
    checkResponsePopup.classList.remove("active");
    popup.classList.add("remove");
}