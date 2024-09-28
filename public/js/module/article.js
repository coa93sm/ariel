export class Article {
  id;
  name;
  price;
  category;
  url;
  trending;
  rating;
  constructor(obj) {
    this.id = obj?.id || 0;
    this.name = obj?.name || "";
    this.price = obj?.price || 0;
    this.category = obj?.category || "";
    this.url = obj?.url || "";
    this.trending = obj?.trending || false;
    this.rating = obj?.rating || 0;
  }

  static displayArticle(obj) {
    return `<article class="article" data-id="${obj.id}">
              <figure class="article__head">
                <img src='./css/img/${obj.url}' alt="" class="article__img" />
              </figure>
              <div class="article__body">
                <h3 class="heading heading--tertiary">${obj.name}</h3>
                <div class="article__rating">
                  ${Article.displayRating(obj.rating)}
                </div>
                <p class="article__price">${Article.formatPrice(obj.price)}</p>
                <button class="btn btn--shop">Dodaj u korpu</button>
              </div>
            </article>`;
  }

  static displayRating(rating) {
    let html = "";
    for (let i = 0; i < rating; i++) html += `<i class="fa-solid fa-star"></i>`;
    return html;
  }

  static formatPrice(price) {
    return new Intl.NumberFormat("sr-RS", {
      style: "currency",
      currency: "EUR",
      currencyDisplay: "code",
    }).format(price);
  }
}
