<?php
require_once 'vendor/autoload.php';
require_once 'database/db.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

$id = 1;

$query = "SELECT model.id, model.name AS model_name, description, price, color, transmission, body.name AS body_name, max_speed, 
       is_sold, is_public, engine, year FROM car LEFT JOIN model ON car.id = model.id LEFT JOIN body ON car.id=body.id WHERE car.id = $id";

$result = pg_query($dbconn3, $query);

$car = [];
while ($row = pg_fetch_assoc($result)) {
    $car[] = $row;
}
echo $twig->render('car_detail.html', ['car' => $car]);

