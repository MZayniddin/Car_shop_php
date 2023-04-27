<?php
// Connection parameters
require_once 'vendor/autoload.php';
require_once 'database/db.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

// Product information
$id = $_POST['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];

// Category information
$category_name = $_POST['category_name'];

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

// SQL query to update the product with the related category
$query = "UPDATE products SET name='$name', description='$description', price=$price, category_id=$category_id WHERE id=$id";

// Execute the query
$result = pg_query($dbconn3, $query);

// Check if the query was successful
if ($result) {
    echo "Product updated successfully.";
}