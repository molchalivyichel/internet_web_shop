<?php
/**
 * @param string 
 * @param float  
 * @param string 
 */
function card($name, $price, $img) {
    ?>
    <div class="col">
        <div class="card product-card h-100">
            <div class="product-image-wrapper">
                <img src="/<?= htmlspecialchars($img) ?>" class="card-img-top product-img" alt="<?= htmlspecialchars($name) ?>">
            </div>
            <div class="card-body d-flex flex-column">
                <h5 class="card-title product-name"><?= htmlspecialchars($name) ?></h5>
                <div class="mt-auto d-flex justify-content-between align-items-center">
                    <span class="product-price"><?= number_format($price, 0, '.', ' ') ?> ₽</span>
                    <div class="product-actions">
                        <a href="cart" class="btn-icon" title="В корзину">
                            <img src="/upload/bucket_white.png" alt="basket">
                        </a>
                        <a href="favorite" class="btn-icon" title="В избранное">
                            <img src="/upload/favorite_white.png" alt="favorite">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}

/**
 
 * @param array $items Массив товаров маproducts_name, products_price, products_image
 */
function card_view($items) {
    if (empty($items)) {
        echo '<div class="col-12 text-center">Товары не найдены</div>';
        return;
    }
    ?>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        <?php foreach ($items as $item): ?>
            <?php card($item['products_name'], $item['products_price'], $item['products_image']); ?>
        <?php endforeach; ?>
    </div>
    <?php
}
?>