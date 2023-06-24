
const addquestionbtn = document.querySelector(".addquestionbtn");
const closeaddQuestionBtn = document.querySelector(".close-addquestion");
const saveAddQuestions = document.querySelector(".add-questions");
addquestionbtn.addEventListener("click",openAddQuestionPopup);
//event listeners
// addquestionbtn.forEach((quiz) => {
//     quiz.addEventListener("click", openQuiz);
// })
closeaddQuestionBtn.addEventListener("click", closeAddQuestionPopup);


//functions
function openAddQuestionPopup() {
    const popup = saveAddQuestions.children[0];
    saveAddQuestions.classList.add("active");
    popup.classList.add("active");
}
function closeAddQuestionPopup() {
    const popup = saveAddQuestions.children[0];
    saveAddQuestions.classList.remove("active");
    popup.classList.add("remove");
}