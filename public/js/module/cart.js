import { Article, CartArticle } from "./cartArticle.js";
import ArticleList from "./articleList.js";

export default class Cart {
  cartArticles;

  constructor() {
    const localCart = JSON.parse(localStorage.getItem("cart"));

    this.cartArticles =
      (localCart &&
        localCart.cartArticles.map((article) => new CartArticle(article))) ||
      [];
  }

  addToCart(id) {
    const article = ArticleList.getArticle(id);
    const articleInCart = this.cartArticles.find(
      (cartArticle) => cartArticle.article.id == article.id
    );
    articleInCart
      ? articleInCart.addOne()
      : this.cartArticles.push(new CartArticle(article));
    this.updateCart();
  }

  #getTotalArticles() {
    return this.cartArticles.reduce((sum, curr) => (sum += curr.amount), 0);
  }

  updateCart() {
    document.querySelector(".cart").innerHTML = `(${this.#getTotalArticles()})`;
  }

  getAllOrders() {
    return this.cartArticles.reduce((sum, curr) => {
      if (curr.amount == 0) return (sum += "");
      else return (sum += curr.displayCartArticle());
    }, "");
  }

  #getCartArticle(id) {
    return this.cartArticles.find((cartAricle) => cartAricle.article.id == id);
  }

  changeAmount(id, action) {
    const article = this.#getCartArticle(id);
    action == "add" ? article.addOne() : article.removeOne();
    if (article.amount == 0) this.removeCartArticle(id);
  }

  removeCartArticle(id) {
    const index = this.cartArticles.findIndex(
      (cartAricle) => cartAricle.article.id == id
    );
    this.cartArticles.splice(index, 1);
  }

  getTotalPrice() {
    const total = this.cartArticles.reduce(
      (sum, curr) => (sum += curr.amount * curr.article.price),
      0
    );
    return `<tr>
            <td></td>
            <td></td>
            <td class="cart__total">${Article.formatPrice(total)}</td>
            </tr>`;
  }

  // toJSON() {
  //   return {
  //     cartArticles: this.#cartArticles,
  //   };
  // }
}
