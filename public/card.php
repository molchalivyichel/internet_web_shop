<?php
function card($card_name, $card_price, $card_img) {
    echo "
    <div class='p-2 card'>
        <div class='container'>
            <img class='card-img' src='$card_img' alt='product'>
            <div class='card-price p-2'>{$card_price}</div>
        </div>

        <div class='d-flex'>
            <div class='p-2 flex-grow-1 card-name'>
                {$card_name}
            </div>
            <div class='p-2'>
                <a href='cart'>
                    <img class='card-icon' src='upload/bucket_white.png' alt='basket'>
                </a>
            </div>
            <div class='p-2'>
                <a href='favorite'>
                    <img class='card-icon' src='upload/favorite_white.png' alt='favorite'>
                </a>
            </div>
        </div>
    </div>
    ";
}

function card_view($array, $count=0) {
    foreach ($array as $values) {
        if($count % 3 == 0 && $count > 0) {
            echo '</div>';
        }
        if($count % 3 == 0) {
            echo '<div class="d-flex justify-content-evenly margin">';
        }
        card($values['products_name'], $values['products_price'], $values['products_image']); 
        $count++;
    }
    if($count % 3 != 0) { 
        echo '</div>';
    }
}
?>