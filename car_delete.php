<?php
require_once 'vendor/autoload.php';
require_once 'database/db.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

$name_obj = $_GET['name'];

// Get the ID of the record to be deleted from the query string
$name_id = "SELECT id FROM Car WHERE model = '$name_obj'";

// Delete the record from the database
$query = "DELETE FROM Car WHERE id='$name_id'";
$result = pg_query($dbconn3, $query);

// Check if the query was successful
if ($result) {
    echo "Product deleted successfully.";
} else {
    echo "Error deleting product: " . pg_last_error($dbconn3);
}

// Close the database connection
pg_close($dbconn3);

