
let login = document.querySelector(".login-form-cont");
let signup = document.querySelector(".signup-form-cont");

login.style.display = `block`;
signup.style.display = `none`;
function logIn(){
    signup.style.display = `none`;
    login.style.display = `block`;
}
function signUp(){
    signup.style.display = `block`;
    login.style.display = `none`;
}
    //windows  onload (execute when window loads)
window.onload = function(){
    const params = new URLSearchParams(window.location.search); 
    if(params.get("form") === 'signup'){
        signUp();
    }
    else{
        logIn();
    }
}
    //URLSearchParams = convert query to string 
    // if pr= URLSearchParams(?form= log){const pr.get('form') }and then o/p - log

    //const(window,loctionhref) = {href ="", pathname="", search=""}   
// href - http://localhost/project/login_signup.php?form=signup
// pathname - /project/login_signup.php
// search  - ?form=signup