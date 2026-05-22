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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/faq.css">
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
                <img id="menu-icon" src="upload/backet.png" alt="basket">
            </button>
            <button>
                <img id="menu-icon" src="upload/favorite.png" alt="favorite">
            </button>
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#authModal">
    <img id="menu-icon-user" src="upload/user.png" alt="user">
            <input type="hidden" name="redirect" value="<?= $_SERVER['REQUEST_URI'] ?>">
            </button>
        </div>
    </div>
</nav>

<div style="max-width: 1000px; margin: 0 auto;">
    <img class="img-fluid" src="upload/backgroundfaq.jpg" style="margin-top: 100px;">
</div>
<!-- Accordion -->
<div class="mt-5 mb-5">
        <div class="accordion" id="routeAccordion">

          <!-- Ячейка 1-->
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading1">
              <button class="accordion-button collapsed text-button" type="button" data-bs-toggle="collapse" 
                      data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                Оплата
              </button>
            </h2>
            <div id="collapse1" class="accordion-collapse collapse" aria-labelledby="heading1" data-bs-parent="#routeAccordion">
              <div class="accordion-body">
              <div class="d-flex">
  <div id="payment" class="p-2 w-100"><p class="text-faq-p">СБП (Система быстрых платежей)</p></div>
  <div class="p-2 flex-shrink-1"><img src="upload/sbp.png"></div>
</div>
              <div>
              <p class="text-faq-p">Быстрая и удобная оплата заказов с помощью QR-кода через новый сервис Банка России — Система быстрых платежей. Для оплаты по QR-коду не требуется банковская карта. Нужен лишь телефон, на котором установлено мобильное приложение банка. </p>
              </div>
              </div>
            </div>
          </div>
          
          <!-- Ячейка 2 -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading2">
              <button class="accordion-button collapsed text-button" type="button" data-bs-toggle="collapse" 
                      data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                Возврат и обмен
              </button>
            </h2>
            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#routeAccordion">
              <div class="accordion-body">
                <p class="text-faq-p">
                Вы можете вернуть товар, не подошедший по форме, фасону, расцветке, размеру (в случае, если он не был в употреблении, сохранены фабричные ярлыки, товарный вид, потребительские свойства и т.д.) в течение 14 календарных дней, не считая дня покупки.
<br>
Обращаем ваше внимание, что согласно Перечню, утверждённому Постановлением Правительства РФ от 31.12.2020 N 2463 не подлежат обмену, возврату товары:
<br>
</p>
    <li class="text-faq-li">предметы личной гигиены (расчески, заколки, бигуди для волос и другие аналогичные товары);</li>
    <li class="text-faq-li">парфюмерно-косметические товары (туалетная вода, косметика и т.д.);</li>
    <li class="text-faq-li">изделия швейные и трикотажные бельевые;</li>
    <li class="text-faq-li">изделия чулочно-носочные (купальники, пижамы, домашние халаты, ночные рубашки, колготки, носки, трусы, бюстгалтеры и т.д.)</li>
    <p class="text-faq-p">
    <br>
При возврате товара с браком на время проверки качества изделия и оформления процедуры возврата денежных средств магазин имеет право взять на хранение товар под расписку уполномоченного сотрудника.

При отказе от оформления возврата после визуального осмотра клиент имеет право оформить претензию в магазине, срок рассмотрения претензии 10 дней.
              </p>
              </div>
            </div>
          </div>
        
          
          <!-- Ячейка 3 -->
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading3">
              <button class="accordion-button collapsed text-button" type="button" data-bs-toggle="collapse" 
                      data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                О компании
              </button>
            </h2>
            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#routeAccordion">
              <div class="accordion-body">
                <p class="text-faq-p">
                Мы — молодой интернет-магазин одежды, созданный для тех, кто ценит комфорт, качество и свой стиль. Наша цель — сделать процесс выбора и покупки одежды максимально приятным и удобным.
<br>
<br>
В нашем ассортименте — базовая и стильная повседневная одежда для женщин и мужчин. Мы тщательно отбираем ткани и фурнитуру, сотрудничаем с проверенными фабриками, чтобы вы носили вещи долго и с удовольствием.
<br>
Почему выбирают нас:
<br>
    <li class="text-faq-li">Качество: все вещи проходят контроль перед отправкой.</li>
    <br>
    <li class="text-faq-li">Честные условия обмена и возврата.</li>
    <br>
    <li class="text-faq-li">Поддержка помогает в выборе размера и отвечает на вопросы.</li>
    <br>
    <p class="text-faq-p">Мы постоянно развиваемся, добавляем новые коллекции и следим за трендами, чтобы вы всегда выглядели актуально и чувствовали себя уверенно.</p>
<p class="text-faq-p">Благодарим, что вы с нами. Если у вас есть вопросы или предложения — напишите нам, мы всегда рады обратной связи. </p>
                </p>
              </div>
            </div>
          </div>
          
          <!-- Ячейка 4-->
          <div class="accordion-item">
            <h2 class="accordion-header" id="heading4">
              <button class="accordion-button collapsed text-button" type="button" data-bs-toggle="collapse" 
                      data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                Служба поддержки
              </button>
            </h2>
            <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#routeAccordion">
              <div class="accordion-body">
              <p class="text-faq-p">
              Мы всегда рады помочь вам с выбором, ответить на вопросы о заказе, доставке или возврате. Наша служба поддержки работает оперативно и заботится о вашем комфорте.
              <br>
              Как с нами связаться?
<br>
Вы можете выбрать самый удобный для вас способ:
<br>
    <li class="text-faq-li">По телефону: +7 934 657 82 90
    Звоните в будние дни с 10:00 до 19:00. Мы поможем решить ваш вопрос быстро и по существу.</li>

    <li class="text-faq-li">Электронная почта: Shop@mail.com
    Отправьте письмо в любое время – мы ответим в течение 24 часов. Укажите в теме письма суть вопроса (например, «Возврат», «Статус заказа», «Подбор размера»), чтобы мы могли помочь ещё быстрее.</li>
    <br>
<p class="text-faq-p">Когда обращаться?</p>

    <li class="text-faq-li">Если нужно уточнить наличие товара или размерную сетку.</li>

    <li class="text-faq-li">Если возникла проблема с оплатой или доставкой.</li>

    <li class="text-faq-li">Если хотите оформить возврат или обмен.</li>

    <li class="text-faq-li">По любым другим вопросам, связанным с работой магазина.</li>
    <br>
<p class="text-faq-p">Мы ценим каждого клиента и стремимся сделать ваше обслуживание приятным и понятным. Не стесняйтесь обращаться – мы на связи!</p>
                </p>
            </div>
              </div>
            </div>
          </div>

        </div>

          
    </div>

    </div>

  </div>



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