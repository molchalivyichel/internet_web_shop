<?php
session_start();
$error = $_SESSION['flash_error'] ?? '';
unset($_SESSION['flash_error']);
if ($error) {
    echo '<script>alert("' . htmlspecialchars($error, ENT_QUOTES) . '");</script>';
}
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="js/entrance.js" defer></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Магазин</title>
</head>
<body>

<nav class="navbar fixed-top">
        <button class="navbar-toggler accordion-button-after" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <img src="upload/menu.png" id="menu-icon" alt="menu">
        </button>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="flex-container">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="item auto">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button id="exslusive-hover" class="collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    Мужская
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <a href="">Одежда</a>
                                    <a href="">Обувь</a>
                                    <a href="">Аксессуары</a>
                                    <a href="">Нижнее бельё</a>
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
                                    <a href="">Одежда</a>
                                    <a href="">Обувь</a>
                                    <a href="">Аксессуары</a>
                                    <a href="">Нижнее бельё</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
          <a href="home.php" id="logo" class="mx-auto p-2 ">Магазин-одежды</a>
</div>
        <div class="flex-container ">
            <button>
                <a href="cart">
                <img id="menu-icon" src="upload/backet.png" alt="basket">
                </a>
            </button>
            <button>
                <a href="favorite">
                <img id="menu-icon" src="upload/favorite.png" alt="favorite">
                </a>
            </button>
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#authModal">
    <img id="menu-icon-user" src="upload/user.png" alt="user">
            <input type="hidden" name="redirect" value="<?= $_SERVER['REQUEST_URI'] ?>">
            </button>
        </div>
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



<div class="flex-container-global">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="5" aria-label="Slide 6"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="upload/slide (2).png" class="d-block w-100 img-fluid" alt="slide1">
            </div>
            <div class="carousel-item">
                <img src="upload/slide (1).png" class="d-block w-100 img-fluid" alt="slide2">
            </div>
            <div class="carousel-item">
                <img src="upload/slide (3).png" class="d-block w-100 img-fluid" alt="slide3">
            </div>
            <div class="carousel-item">
                <img src="upload/slide (4).png" class="d-block w-100 img-fluid" alt="slide4">
            </div>
            <div class="carousel-item">
                <img src="upload/slide (5).png" class="d-block w-100 img-fluid" alt="slide5">
            </div>
            <div class="carousel-item">
                <img src="upload/slide (6).png" class="d-block w-100 img-fluid" alt="slide6">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<div class="flex-container-global">
    <img id="image2" src="upload/slide2.png" alt="slide2">
</div>

<div id="footer" class="flex-container-footer">
    <div class="footer-group">
        <p class="main_text_footer">Покупателям</p>
        <div><a href="faq">Оплата</a></div>
        <div><a href="faq">Возврат и обмен</a></div>
    </div>
    <div class="footer-group">
        <p class="main_text_footer">Компания</p>
        <div><a href="faq">О компании</a></div>
        <div><a href="faq">Служба поддержки</a></div>
    </div>
    <div class="footer-group">
        <p class="main_text_footer">Магазин</p>
        <div><a href="">Одежда</a></div>
        <div><a href="">Обувь</a></div>
        <div><a href="">Аксессуары</a></div>
        <div><a href="">Нижнее бельё</a></div>
        <div><a href="">Коллекция к лету</a></div>
    </div>
    <div class="footer-group">
        <p class="main_text_footer">Мы в сети</p>
        <div>
        <a href=""><img id="menu-icon" src="upload/tg.png" alt="social1"></a>
        <a href=""><img id="menu-icon" src="upload/vk.png" alt="social2"></a>
        </div>
        <p>ул. Советская, д.89</p>
        <p>+7 934 657 82 90</p>
        <p>Shop@mail.com</p>
    </div>
</div>

</body>
</html>