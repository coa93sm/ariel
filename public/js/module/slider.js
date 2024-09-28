const sliderOuter = document.querySelector(".slider");
const slider = document.querySelector(".slider__wrapper");
const btnRight = document.querySelector(".slider__control--right");
const btnLeft = document.querySelector(".slider__control--left");

class Slider {
  #timer;
  constructor() {
    this.#startTimer();
    this.#wireEvents();
  }

  #startTimer(sec = 3000) {
    if (this.#checkIfMobile()) return;
    else this.#timer = setInterval(this.#moveSlide, sec);
  }
  #moveSlide(direction = true) {
    direction
      ? (slider.scrollLeft += slider.clientWidth)
      : (slider.scrollLeft -= slider.clientWidth);
    if (
      slider.scrollLeft == slider.scrollWidth - slider.clientWidth &&
      direction
    ) {
      slider.scrollLeft = 0;
    }

    if (slider.scrollLeft == 0 && !direction) {
      slider.scrollLeft = slider.scrollWidth - slider.clientWidth;
    }
  }

  #stopTimer() {
    if (this.#timer) clearInterval(this.#timer);
  }
  #activateTimer() {
    this.#startTimer();
  }

  #checkIfMobile() {
    return window.innerWidth <= 640;
  }

  #wireEvents() {
    window.addEventListener("resize", this.#checkIfMobile);
    btnRight.addEventListener("click", this.#moveSlide.bind(this, true));
    btnLeft.addEventListener("click", this.#moveSlide.bind(this, false));
    sliderOuter.addEventListener("mouseenter", this.#stopTimer.bind(this));
    sliderOuter.addEventListener("mouseleave", this.#activateTimer.bind(this));
  }
}

const x = new Slider();
