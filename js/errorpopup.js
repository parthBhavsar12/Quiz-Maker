history.pushState(null, document.title, location.href);
window.addEventListener('popstate', function ()
{
  history.pushState(null, document.title, location.href);
});
const errorpopupCard = document.querySelector(".authentication-error");
const errorTitle = document.querySelector("h4"); 
const closeBtn = document.querySelector(".close-errorpopup");
let urlPath = document.location.pathname;
if(urlPath === "/quizmaker/signin.php"){
    // let userActive ='<?= $is_active ?>';
    console.log(userActive);
    errorTitle.innerText = "Wrong Username Or Password\nPlease Try again..";
    if(userActive === "No"){
        errorTitle.innerText = "Sorry...We can't let you Log In...\nYou are blocked by Admin\nYou should contact Admin...";
    }
}else if(urlPath === "/quizmaker/signup.php"){
    console.log(userExists);
    if(userExists==1){
        errorTitle.innerText = "User nane already exists\nPlease enter unique User name.";
    }
    errorTitle.innerText = "Password and Confirm Password\n Must be same...";
}
closeBtn.addEventListener("click",function(){
    errorpopupCard.style.opacity = 0;
    errorpopupCard.style.pointerEvents = "none";
    // errorpopupCard.style.display = none;
})