<?php
require_once 'vendor/autoload.php';
require_once 'database/db.php';
include 'search_method.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

$query = "SELECT model.name AS model_name, description, price, color, transmission, body.name AS body_name, max_speed, 
       is_sold, is_public, engine, year FROM car LEFT JOIN model ON car.id = model.id LEFT JOIN body ON car.id=body.id";
$result = pg_query($dbconn3, $query);

$search_term = $_GET['search_term'];

// SQL query to search for products
$query = "SELECT * FROM Car WHERE model ILIKE '%$search_term%' OR year ILIKE '%$search_term%'";

// Execute the query
$result = pg_query($conn, $query);

// Check if any results were found
if (pg_num_rows($result) > 0) {
    // Loop through the results and output them as a string
    while ($row = pg_fetch_assoc($result)) {
        echo "Name: " . $row['name'] . "<br>";
        echo "Description: " . $row['description'] . "<br>";
        echo "Price: " . $row['price'] . "<br>";
        echo "Category ID: " . $row['category_id'] . "<br><br>";
    }
} else {
    // No results found
    echo "No products found.";
}
$cars = [];
while ($row = pg_fetch_assoc($result)) {
    if ($row . 'is_public') {
        $cars[] = $row;
    }
}
echo $twig->render('cars_list.html', ['cars' => $cars]);
