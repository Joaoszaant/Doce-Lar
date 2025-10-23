document.getElementById("switchToSignup").addEventListener("click", function() {
    document.getElementById("login").style.display = "none";
    document.getElementById("signup").style.display = "block";
});

document.getElementById("switchToLogin").addEventListener("click", function() {
    document.getElementById("signup").style.display = "none";
    document.getElementById("login").style.display = "block";
});
