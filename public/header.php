<nav class="navbar fixed-top">
        <button class="navbar-toggler accordion-button-after" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <img src="/upload/menu.png" id="menu-icon" alt="menu">
        </button>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="flex-container">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                  <div class="item auto">
                    <div class="accordion-item">
                      <h2 class="accordion-header">
                        <div>
                          <a href="/categories/all/">Все категории</a>
                        </div>
                      </h2>
                    </div>
                  </div>
                    <div class="item auto">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button id="exslusive-hover" class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Мужская
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <a href="/categories/man/">Вся категория</a>
                                    <a href="/categories/man/man_clothing">Одежда</a>
                                    <a href="/categories/man/man_shoes">Обувь</a>
                                    <a href="/categories/man/man_accessory">Аксессуары</a>
                                    <a href="/categories/man/man_underwear">Нижнее бельё</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item auto">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button id="exslusive-hover" class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    Женская
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <a href="/categories/woman">Вся категория</a>
                                    <a href="/categories/woman/woman_clothing">Одежда</a>
                                    <a href="/categories/woman/woman_shoes">Обувь</a>
                                    <a href="/categories/woman/woman_accessory">Аксессуары</a>
                                    <a href="/categories/woman/woman_underwear">Нижнее бельё</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
          <a href="/home" id="logo" class="mx-auto p-2 ">Магазин-одежды</a>
        </div>
<div class="flex-container ">
    <button>
        <a href="cart">
            <img id="menu-icon" src="/upload/backet.png" alt="basket">
        </a>
    </button>
    <button>
        <a href="favorite">
            <img id="menu-icon" src="/upload/favorite.png" alt="favorite">
        </a>
    </button>
    <?php if (isset($_SESSION['user_id'])): ?>
        <!-- Кнопка выхода – ссылка на logout.php -->
        <a href="logout.php?redirect=<?= urlencode($_SERVER['REQUEST_URI']) ?>">
            <button type="button">
                <img id="menu-icon-user" src="/upload/exit.png" alt="exit">
            </button>
        </a>
    <?php else: ?>
        <!-- Кнопка входа (открывает модальное окно) -->
        <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#authModal">
            <img id="menu-icon-user" src="/upload/user.png" alt="user">
        </button>
    <?php endif; ?>
</div>
</nav>

<div class="modal fade" id="authModal" tabindex="-1" aria-labelledby="authModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="authModalLabel">Добро пожаловать</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
      </div>
      <div class="modal-body">
        <!-- Форма входа (авторизация) -->
        <div id="loginForm" style="display: none;">
          <form action="login.php" method="POST">
            <div class="mb-3">
              <label for="login_email" class="form-label">Email</label>
              <input type="email" class="form-control" id="login_email" name="email" required>
            </div>
            <div class="mb-3">
              <label for="login_password" class="form-label">Пароль</label>
              <input type="password" class="form-control" id="login_password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Войти</button>
            <p class="mt-3 text-center">
              Нет аккаунта? <a href="#" id="showRegisterLink">Зарегистрироваться</a>
            </p>
          </form>
        </div>

        <!-- Форма регистрации -->
        <div id="registerForm">
          <form action="register.php" method="POST">
            <div class="mb-3">
              <label for="reg_email" class="form-label">Email</label>
              <input type="email" class="form-control" id="reg_email" name="email" required>
            </div>
            <div class="mb-3">
              <label for="reg_password" class="form-label">Пароль</label>
              <input type="password" class="form-control" id="reg_password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Зарегистрироваться</button>
            <p class="mt-3 text-center">
              Уже есть аккаунт? <a href="#" id="showLoginLink">Войти</a>
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>