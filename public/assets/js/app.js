document.addEventListener("DOMContentLoaded", function () {
  const profileBtn = document.getElementById("profileBtn");
  const profileMenu = document.getElementById("profileMenu");

  if (profileBtn && profileMenu) {
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
  }

  const mobileMenuBtn = document.getElementById("mobileMenuBtn");
  const mobileNavDrawer = document.getElementById("mobileNavDrawer");
  const mobileMenuIcon = document.getElementById("mobileMenuIcon");

  if (mobileMenuBtn && mobileNavDrawer) {
    mobileMenuBtn.addEventListener("click", function () {
      const isOpen = mobileNavDrawer.classList.toggle("hidden");
      mobileMenuBtn.setAttribute("aria-expanded", !isOpen);
      mobileMenuIcon.className = isOpen
        ? "fa-solid fa-bars"
        : "fa-solid fa-xmark";
    });
  }

  const desktopBtn = document.getElementById("desktopCheckoutBtn");
  const checkoutForm = document.querySelector('form[action="/checkout"]');
  if (desktopBtn && checkoutForm) {
    desktopBtn.addEventListener("click", function () {
      checkoutForm.submit();
    });
  }
});
