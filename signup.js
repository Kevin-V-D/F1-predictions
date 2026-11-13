const password = document.querySelector("#password");
const confirmPassword = document.querySelector("#confirm-password");
const textContainer = document.querySelector(".passCheck");
const btn = document.querySelector(".btn");

function samePassword() {
    if (password.value === confirmPassword.value) {
        textContainer.style.display = "none";
        btn.disabled = false;
    } else {
        textContainer.style.display = "flex";
        btn.disabled = true;
    }
}

confirmPassword.addEventListener("input", samePassword);