document.addEventListener("DOMContentLoaded", function () {
  const toggle = document.getElementById("sidebarToggle");
  const icon = document.getElementById("sidebarToggleIcon");
  const sidebar = document.getElementById("sidebar");
  const overlay = document.getElementById("sidebarOverlay");

  function openSidebar() {
    sidebar.classList.remove("-translate-x-full");
    overlay.classList.remove("hidden");
    icon.className = "fa-solid fa-xmark text-zinc-700";
  }

  function closeSidebar() {
    sidebar.classList.add("-translate-x-full");
    overlay.classList.add("hidden");
    icon.className = "fa-solid fa-bars text-zinc-700";
  }

  toggle.addEventListener("click", function () {
    sidebar.classList.contains("-translate-x-full")
      ? openSidebar()
      : closeSidebar();
  });

  overlay.addEventListener("click", closeSidebar);

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
});
