<?php
require_once '/vendor/autoload.php';
require_once '/database/db.php';

// echo "ASD";


$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

$query = "select * from Car";
$result = $mysqli->query($query);

$cars = [];
while ($row = $result->fetch_assoc()) {
    $cars[] = $row;
}
echo $twig->render('cars_list.html', ['cars' => $cars]);