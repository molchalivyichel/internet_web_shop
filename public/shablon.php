<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
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
                                    <a href="">Коллекция к лету</a>
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
                                    <a href="">Коллекция к лету</a>
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
                <img id="menu-icon" src="upload/backet.png" alt="basket">
            </button>
            <button>
                <img id="menu-icon" src="upload/favorite.png" alt="favorite">
            </button>
            <button>
                <img id="menu-icon-user" src="upload/user.png" alt="user">
            </button>
        </div>
    </div>
</nav>

<div id="footer" class="flex-container-footer">
    <div class="footer-group">
        <p class="main_text_footer">Покупателям</p>
        <div><a href="faq.php">Оплата</a></div>
        <div><a href="faq.php">Возврат и обмен</a></div>
    </div>
    <div class="footer-group">
        <p class="main_text_footer">Компания</p>
        <div><a href="faq.php">О компании</a></div>
        <div><a href="faq.php">Служба поддержки</a></div>
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
            <img id="menu-icon" src="upload/tg.png" alt="social1">
            <img id="menu-icon" src="upload/vk.png" alt="social2">
        </div>
        <p>ул. Советская, д.89</p>
        <p>+7 934 657 82 90</p>
        <p>Shop@mail.com</p>
    </div>
</div>

</body>
</html>