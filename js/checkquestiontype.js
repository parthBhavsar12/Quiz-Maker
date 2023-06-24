const selecteTypeOfQuestion = document.querySelector(".questiontype");
const mcqFields = document.querySelectorAll(".make-quiz");
const selectRightAnswer = document.querySelector(".selectRightAnswer");
const selectRightAnswerOption = document.querySelector(".selectRightAnswerOption");
selecteTypeOfQuestion.addEventListener("change",function(){
    if(selecteTypeOfQuestion.value == "short" || selecteTypeOfQuestion.value == "long"){
        mcqFields.forEach(m=>{
            m.style.display = "none";
            m.style.opacity = 0;
            m.style.pointerEvents = "none";
        })
        selectRightAnswer.style.display = "none";
        selectRightAnswer.style.opacity = 0;
        selectRightAnswer.style.pointerEvents = "none";
        selectRightAnswerOption.style.display = "none";
        selectRightAnswerOption.style.opacity = 0;
        selectRightAnswerOption.style.pointerEvents = "none";

    }else{
        mcqFields.forEach(m=>{
            m.style.display = "block";
            m.style.opacity = 1;
            m.style.pointerEvents = "all";
        })
        selectRightAnswer.style.display = "block";
        selectRightAnswer.style.opacity = 1;
        selectRightAnswer.style.pointerEvents = "all";
        selectRightAnswerOption.style.display = "block";
        selectRightAnswerOption.style.opacity = 1;
        selectRightAnswerOption.style.pointerEvents = "all";
    }
})