<?php
setcookie('name-test1', 'password',time() + 86400 * 3,'/cookie.php', "", false, true); 
    echo "<p>d: </p>".print_r($_COOKIE);