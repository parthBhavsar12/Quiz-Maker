const attendquizBtn = document.querySelectorAll(".attendquizbtn");
const submitSave = document.querySelector(".submit-attendquiz");
const closeSave = document.querySelector(".close-quiz");
const saveContainer = document.querySelector(".attend-quiz");
const saveInput = document.querySelector(".attendquiz-container input");

//event listeners
attendquizBtn.forEach((quiz) => {
    quiz.addEventListener("click", openQuiz);
})
closeSave.addEventListener("click", closeQuiz);


//functions
function openQuiz() {
    const popup = saveContainer.children[0];
    saveContainer.classList.add("active");
    popup.classList.add("active");
}
function closeQuiz() {
    const popup = saveContainer.children[0];
    saveContainer.classList.remove("active");
    popup.classList.add("remove");
}