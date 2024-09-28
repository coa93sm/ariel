import "./module/navbarResponsive.js";
import ArticleList from "./module/articleList.js";
import Cart from "./module/cart.js";

class Shop {
  #cart = new Cart();
  static language = "sr-RS";

  constructor() {
    this.#updateUI();
    this.#wireEvents();
  }

  #updateUI() {
    document.querySelector(".shop__articles").innerHTML =
      ArticleList.getAllArticles();
    this.#cart.updateCart();
  }

  #sort(direction, criteria) {
    ArticleList.sortArticles(direction, criteria);
    this.#updateUI();
  }

  #wireEvents() {
    document.querySelector(".shop").addEventListener("click", (e) => {
      if (!e.target.classList.contains("btn")) return;
      let id = e.target.closest("article").dataset.id;
      this.#cart.addToCart(id);
    });

    document.querySelector(".shop__sort").addEventListener("click", (e) => {
      if (e.target.classList.contains("control")) {
        document.querySelector(".shop__criteria").innerHTML =
          e.target.innerHTML;
        this.#sort(e.target.dataset.direction, e.target.dataset.criteria);
      }
      document.querySelector(".shop__menu").classList.toggle("show");
    });

    window.addEventListener("beforeunload", () => {
      localStorage.setItem("cart", JSON.stringify(this.#cart));
    });
  }
}

const shop = new Shop();
