<?php
/**
 * @param string $name
 * @param float $price
 * @param string $img
 * @param int $id_product
 * @param bool $is_favorite
 */
function card($name, $price, $img, $id_product, $is_favorite = false) {
    $favorite_img = $is_favorite ? '/upload/favorite_active.png' : '/upload/favorite_white.png';
    $favorite_link = $is_favorite ? "/favorite/remove?product_id=$id_product" : "/favorite/add?product_id=$id_product";
    $favorite_title = $is_favorite ? 'Удалить из избранного' : 'В избранное';
    ?>
    <div class="col">
        <a href="/product/<?= $id_product ?>">
            <div class="card product-card h-100">
                <div class="product-image-wrapper">
                    <img src="/<?= htmlspecialchars($img) ?>" class="card-img-top product-img" alt="<?= htmlspecialchars($name) ?>">
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title product-name"><?= htmlspecialchars($name) ?></h5>
                    <div class="mt-auto d-flex justify-content-between align-items-center">
                        <span class="product-price"><?= number_format($price, 0, '.', ' ') ?> ₽</span>
                        <div class="product-actions">
                            <a href="<?= $favorite_link ?>" class="btn-icon" title="<?= $favorite_title ?>" onclick="event.stopPropagation();">
                                <img src="<?= $favorite_img ?>" alt="favorite">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <?php
}

/**
 * @param array $items Массив товаров (products_name, products_price, products_image, products_id)
 * @param array $favorite_ids Список ID товаров, добавленных в избранное
 */
function card_view($items, $favorite_ids = []) {
    if (empty($items)) {
        echo '<div class="col-12 text-center">Товары не найдены</div>';
        return;
    }
    ?>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        <?php foreach ($items as $item): ?>
            <?php 
            $is_favorite = in_array($item['products_id'], $favorite_ids);
            card($item['products_name'], $item['products_price'], $item['products_image'], $item['products_id'], $is_favorite); 
            ?>
        <?php endforeach; ?>
    </div>
    <?php
}
?>