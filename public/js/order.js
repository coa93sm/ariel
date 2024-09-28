import "./module/navbarResponsive.js";
import Cart from "./module/cart.js";

class Order {
  cart = new Cart();

  constructor() {
    this.#updateUI();
    this.#wireEvents();
  }

  #updateUI() {
    document.querySelector(".cart__body").innerHTML = this.cart.getAllOrders();
    document
      .querySelector(".cart__body")
      .insertAdjacentHTML("beforeend", this.cart.getTotalPrice());
  }

  #wireEvents() {
    document.querySelector(".container").addEventListener("click", (e) => {
      if (e.target.classList.contains("btn")) {
        let element = e.target.closest("tr");
        this.cart.removeCartArticle(element.dataset.id);
        this.#updateUI();
      }
      const control = e.target.closest(".cart__control");
      if (!control) return;
      const element = e.target.closest("tr");
      this.cart.changeAmount(element.dataset.id, control.dataset.action);
      this.#updateUI();
    });

    window.addEventListener("beforeunload", () => {
      localStorage.setItem("cart", JSON.stringify(this.cart));
    });
  }
}

const order = new Order();
