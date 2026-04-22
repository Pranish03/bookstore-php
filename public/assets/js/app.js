document.addEventListener("DOMContentLoaded", function () {
  const profileBtn = document.getElementById("profileBtn");
  const profileMenu = document.getElementById("profileMenu");

  profileBtn.addEventListener("click", function (e) {
    e.stopPropagation();
    profileMenu.classList.toggle("open");
  });

  document.addEventListener("click", function () {
    profileMenu.classList.remove("open");
  });

  profileMenu.addEventListener("click", function (e) {
    e.stopPropagation();
  });

  profileMenu.querySelectorAll("a, button").forEach(function (el) {
    el.addEventListener("click", function () {
      profileMenu.classList.remove("open");
    });
  });
});
