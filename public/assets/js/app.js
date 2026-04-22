document.addEventListener("DOMContentLoaded", function () {
  const profileBtn = document.getElementById("profileBtn");
  const profileMenu = document.getElementById("profileMenu");

  if (!profileBtn || !profileMenu) return;

  profileBtn.addEventListener("click", function (e) {
    e.stopPropagation();
    profileMenu.classList.toggle("hidden");
  });

  document.addEventListener("click", function () {
    profileMenu.classList.add("hidden");
  });

  profileMenu.addEventListener("click", function (e) {
    e.stopPropagation();
  });

  profileMenu.querySelectorAll("a, button").forEach(function (el) {
    el.addEventListener("click", function () {
      profileMenu.classList.add("hidden");
    });
  });
});
