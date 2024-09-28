 <?php
require_once 'inc/header.php';
?> 

    <header class="header">
      <div class="header__container">
        <h1 class="heading heading--primary">
          LEPOTA<span class="heading--sub"> koja inspiriše </span>
        </h1>
        <p class="header__text">
          Dobrodošli na naš WEB shop kliknite na LOGOVANJE kako biste započeli kupovinu
        </p>
        <a href="login.php"><button class="btn btn--accent">Logovanje</button></a>
        <p class="header__text">
          Ukoliko nemate nalog klknite na REGISTRACIJA
        </p>
        <a href="register.php"><button class="btn btn--accent">REGISTRACIJA</button></a>
        <p>Ukoliko imate primedbe i sugestije na rad naše stranice molimo Vas popunite obrazac ispod</p>
        <p>Odgovorićemo Vam u što kraćem roku, Hvala</p>
      </div>
    </header>
    <main class="main">
    
    <section id="contact" class="section">
        <h2 class="heading heading--secondary">Kontaktirajte nas</h2>

        <div class="contact__form">
          <form class="form" action="#" method="POST">
            <div class="form__group">
              <label for="name" class="form__label">Ime <span>*</span></label>
              <input
                class="form__input"
                type="text"
                name="name"
                id="name"
                required
              />
            </div>

            <div class="form__group">
              <label for="lastName" class="form__label"
                >Prezime <span>*</span></label
              >
              <input
                class="form__input"
                type="text"
                name="lastName"
                id="lastName"
                required
              />
            </div>

            <div class="form__group">
              <label for="message" class="form__label"
                >Poruka <span>*</span></label
              >
              <textarea
                class="form__text-area form__input"
                name="message"
                id="message"
                required
              ></textarea>
            </div>

            <button class="btn btn--shop">Pošalji</button>
          </form>
        </div>
      </section>
      </main>
<?php require_once 'inc/footer.php';?>
