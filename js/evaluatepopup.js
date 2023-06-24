let evaluateContainer = document.querySelector(".evaluatequestion");
let evaluateBtn = document.getElementById("evaluateBtn");
let evaluateCloseBtn = document.querySelector(".close-evaluatepopup");
let evaluateSubmitBtn = document.querySelector(".submit-evaluatepopup");
evaluateBtn.addEventListener("click",openEvaluatePopup);
evaluateCloseBtn.addEventListener("click",closeEvaluatePopup);
evaluateSubmitBtn.addEventListener("click",redirectEvalutePopup);
//functions
function openEvaluatePopup() {
    const popup = evaluateContainer.children[0];
    evaluateContainer.classList.add("active");
    popup.classList.add("active");
}
function closeEvaluatePopup() {
    const popup = evaluateContainer.children[0];
    evaluateContainer.classList.remove("active");
    popup.classList.remove("remove");
}
function redirectEvalutePopup(){
    window.location.href = "check_responses.php";
}