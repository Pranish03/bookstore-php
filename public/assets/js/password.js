const togglePassword = document.getElementById("togglePassword");
const passwordInput = document.getElementById("current_password");
const toggleIcon = document.getElementById("toggleIcon");

togglePassword.addEventListener("click", function () {
  const isHidden = passwordInput.type === "password";
  passwordInput.type = isHidden ? "text" : "password";
  toggleIcon.className = isHidden ? "fa-solid fa-eye-slash" : "fa-solid fa-eye";
});

const toggleNewPassword = document.getElementById("toggleNewPassword");
const newPasswordInput = document.getElementById("new_password");
const toggleNewIcon = document.getElementById("toggleNewIcon");

toggleNewPassword.addEventListener("click", function () {
  const isHidden = newPasswordInput.type === "password";
  newPasswordInput.type = isHidden ? "text" : "password";
  toggleNewIcon.className = isHidden
    ? "fa-solid fa-eye-slash"
    : "fa-solid fa-eye";
});

const toggleConfirmPassword = document.getElementById("toggleConfirmPassword");
const confirmPasswordInput = document.getElementById("confirm_password");
const toggleConfirmIcon = document.getElementById("toggleConfirmIcon");

toggleConfirmPassword.addEventListener("click", function () {
  const isHidden = confirmPasswordInput.type === "password";
  confirmPasswordInput.type = isHidden ? "text" : "password";
  toggleConfirmIcon.className = isHidden
    ? "fa-solid fa-eye-slash"
    : "fa-solid fa-eye";
});
