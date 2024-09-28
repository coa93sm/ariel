const navToggle = document.querySelector(".navbar__hamburger--open");
const navMob = document.querySelector(".navbar--mob");

navToggle.addEventListener("click", () => navMob.classList.toggle("active"));
