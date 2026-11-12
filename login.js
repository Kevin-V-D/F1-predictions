const err = document.querySelector(".error");

const urlParams = new URLSearchParams(window.location.search);
if (urlParams.has('error')) {
    if (err) {
        // Remove Tailwind's hidden utility class to display the error paragraph
        err.style.display = "unset";
    }
}