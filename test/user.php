<?php
$name = "не определено";
$age = "не определен";
$remember = false;
$course = 0;
$penis = " ";
if(isset($_POST["name"])){
  
    $name = htmlspecialchars($_POST["name"]);
}
if(isset($_POST["age"])){
  
    $age = htmlspecialchars($_POST["age"]);
}
if(isset($_POST["remember"])){
  
    $remember = htmlspecialchars($_POST["remember"]);
}
if(isset($_POST["course"])){
  
    $course = htmlspecialchars($_POST["course"]);
}
if(isset($_POST["penis"])){
  
    $course = htmlspecialchars($_POST["penis"]);
}
echo "Имя: $name <br> Возраст: $age . $remember . $course . $penis" ;
?>