import { Article } from "./article.js";

class CartArticle {
  article;
  amount;

  constructor(article) {
    this.article =
      (article?.article && new Article(article.article)) ||
      new Article(article);
    this.amount = article?.amount || 1;
  }

  addOne() {
    this.amount++;
  }

  removeOne() {
    if (this.amount == 0) {
    }
    this.amount--;
  }

  displayCartArticle() {
    return `<tr data-id=${this.article.id}>
                <td>
                  <img class="cart__img" src="css/img/${
                    this.article.url
                  }" alt="" />
                  <div class="cart__details">
                    <p class="cart__name">${this.article.name}</p>
                    <p class="cart__price">${Article.formatPrice(
                      this.article.price
                    )}</p>
                    <button class="btn btn--shop" data-id=${
                      this.article.id
                    }>Ukloni</button>
                  </div>
                </td>
              <td>
                <div class="cart__controls">
                  <button class="cart__control">
                   <i class="fa-solid fa-chevron-left"></i>
                  </button>
                  <input class="cart__input" type="number" value=${this.amount}>
                  <button data-action="add" class="cart__control ">
                    <i class="fa-solid fa-chevron-right"></i>
                  </button>
                </div>
              </td>
              <td class="cart__totalArticle">${this.#getTotalPrice()}</td>
            </tr>
          `;
  }

  #getTotalPrice() {
    let total = this.article.price * this.amount;
    return Article.formatPrice(total);
  }

  //   toJSON() {
  //     return {
  //       article: this.#article,
  //       amount: this.#amount,
  //     };
  //   }
}

export { Article, CartArticle };
