const togglePassword = document.getElementById("togglePassword");
const passwordInput = document.getElementById("password");
const toggleIcon = document.getElementById("toggleIcon");

togglePassword.addEventListener("click", function () {
  const isHidden = passwordInput.type === "password";
  passwordInput.type = isHidden ? "text" : "password";
  toggleIcon.className = isHidden ? "fa-solid fa-eye-slash" : "fa-solid fa-eye";
});

const toggleConfirmPassword = document.getElementById("toggleConfirmPassword");
const confirmPasswordInput = document.getElementById("confirm_password");
const toggleConfirmIcon = document.getElementById("toggleConfirmIcon");

toggleConfirmPassword.addEventListener("click", function () {
  const isConfirmHidden = confirmPasswordInput.type === "password";
  confirmPasswordInput.type = isConfirmHidden ? "text" : "password";
  toggleConfirmIcon.className = isConfirmHidden
    ? "fa-solid fa-eye-slash"
    : "fa-solid fa-eye";
});
