<?php
require_once 'vendor/autoload.php';
require_once 'database/db.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

$query = "SELECT model.name AS model_name, description, price, color, transmission, body.name AS body_name, max_speed, 
       is_sold, is_public, engine, year FROM car LEFT JOIN model ON car.id = model.id LEFT JOIN body ON car.id=body.id";
$result = pg_query($dbconn3, $query);

$cars = [];
while ($row = pg_fetch_assoc($result)) {
    if ($row . 'is_public') {
        $cars[] = $row;
    }
}
echo $twig->render('cars_list.html', ['cars' => $cars]);
