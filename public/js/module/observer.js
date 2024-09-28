const observer = new IntersectionObserver(slide, {
  root: null,
  threshold: 0.1,
});

function slide(entries, observer) {
  if (!entries[0].isIntersecting) return;
  entries.forEach((el) => {
    el.target.classList.add("testimonial__slide");
    observer.unobserve(el.target);
  });
}

const elements = document.querySelectorAll(".testimonial");
elements.forEach((el) => observer.observe(el));
