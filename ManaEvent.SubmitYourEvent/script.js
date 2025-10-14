const menuBtn = document.getElementById("menuBtn");
const closeSidebar = document.getElementById("closeSidebar");
const sidebar = document.getElementById("sidebar");
const form = document.getElementById("eventForm");
const thankYou = document.getElementById("thankYou");

// Sidebar toggle
menuBtn.addEventListener("click", () => {
  sidebar.style.left = "0";
});

closeSidebar.addEventListener("click", () => {
  sidebar.style.left = "-250px";
});

// Submit form
form.addEventListener("submit", (e) => {
  e.preventDefault();
  form.classList.add("hidden");
  thankYou.classList.remove("hidden");
});

