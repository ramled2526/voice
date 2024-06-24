// admin.js

document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");

    form.addEventListener("submit", function(event) {
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;

        if (!validateEmail(email)) {
            event.preventDefault();
            alert("Please enter a valid email address.");
            return false;
        }

        if (password.length < 6) {
            event.preventDefault();
            alert("Password must be at least 6 characters long.");
            return false;
        }
    });

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
});
