<?php
$name = 0;
$surname = 0;
$freename = "";
$otvet = 0;
$butty = false;

$name = $_POST["firstname"];
$surname = $_POST["lastname"];
$freename = $_POST["freename"];

if (is_numeric($name) == true && is_numeric($surname) == true) {
    if ($freename == "+") {
    $otvet = $name+$surname;
}
    elseif ($freename == "-") {
    $otvet = $name-$surname;
}
    elseif ($freename == "*") {
    $otvet = $name*$surname;
}
    elseif($freename == "/") {
    $otvet = $name / $surname;
}
    else {
    $otvet = "Некорректный выбор" ;
    }
}


echo "Приветствую, ". $name . " " . $surname . ". Тест: " . $otvet;
echo "<p></p>" ;
for ($i = 1; $i < 100; $i++)
{
    if ($i % 10 == 0) {
        echo "d" ;
    }
    echo "Квадрат числа $i равен " . $i * $i . "<br/>";
    echo '<image src="image.png">' ;
}
?>

