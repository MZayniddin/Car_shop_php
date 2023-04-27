<?php
require_once 'vendor/autoload.php';
require_once 'database/db.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

// Get the product information from the form data
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];

// Sanitize the input data
$name = pg_escape_string($name);
$description = pg_escape_string($description);
$price = (float) $price;

// Check if the category already exists
$category_query = "SELECT id FROM categories WHERE name = '$category_name'";
$category_result = pg_query($dbconn3, $category_query);

if (pg_num_rows($category_result) > 0) {
    // Category exists, get its ID
    $category_id = pg_fetch_assoc($category_result)['id'];
} else {
    // Category does not exist, create it
    $category_insert_query = "INSERT INTO categories (name) VALUES ('$category_name')";
    $category_insert_result = pg_query($dbconn3, $category_insert_query);

    if ($category_insert_result) {
        // Category created successfully, get its ID
        $category_id = pg_fetch_assoc(pg_query($dbconn3, "SELECT LASTVAL()"))['lastval'];
    } else {
        // Error creating category
        echo "Error creating category: " . pg_last_error($dbconn3);
        exit();
    }
}

// SQL query to insert a new product with the related category
$query = "INSERT INTO products (name, description, price, category_id) VALUES ('$name', '$description', $price, $category_id)";

// Execute the query
$result = pg_query($dbconn3, $query);

// Check if the query was successful
if ($result) {
    echo "Product created successfully.";
} else {
    echo "Error creating product: " . pg_last_error($dbconn3);
}

// Close the connection
pg_close($dbconn3);
