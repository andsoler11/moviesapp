// this is the code that works for the eye of the password, so i can put it like type password or type text so the user can see what he is typing
const pwrdField = document.querySelector('.form input[type="password"]');
const toggleBtn =  document.querySelector(".form .field i");

toggleBtn.onclick = () => {
    if(pwrdField.type == "password"){
        pwrdField.type = "text";
        toggleBtn.classList.add("active");
    } else {
        pwrdField.type = "password";
        toggleBtn.classList.remove("active");
    }
}