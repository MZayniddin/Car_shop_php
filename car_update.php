<?php
require_once 'vendor/autoload.php';
require_once 'database/db.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

$created_by__fullname = $_POST['created_by__fullname'];
$created_by__username = $_POST['created_by__username'];
$created_by__age = $_POST['created_by_age'];

// Sanitize the input data
$created_by__fullname = pg_escape_string($created_by__fullname);
$created_by__username = pg_escape_string($created_by__username);
$created_by__age = (int) $created_by__age;

// Check if the category already exists
$created_by_query = "SELECT id FROM UserAdmin WHERE fullname = '$created_by__fullname'";
$created_by_result = pg_query($dbconn3, $created_by_query);

if (pg_num_rows($created_by_result) > 0) {
    // Image does not exist, create it
    $created_by_update_query = "UPDATE Image (fullname, username, age) SET ('$created_by__fullname', '$created_by__username', '$created_by__age') WHERE id = '$created_by_query'";
    $created_by_update_result = pg_query($dbconn3, $created_by_update_query);

    if ($created_by_update_result) {
        // Image created successfully, get its ID
        $created_by_id = pg_fetch_assoc(pg_query($dbconn3, "SELECT LASTVAL()"))['lastval'];
    } else {
        // Error updating image
        echo "Error updating user: " . pg_last_error($dbconn3);
        exit();
    }
} else {
    // Error updating category
    echo "Error updating Transmission: " . pg_last_error($dbconn3);
    exit();
}

// Sanitize the input data
$brand__name = $_POST['brand__name'];

// Sanitize the input data
$brand__name = pg_escape_string($brand__name);

// Check if the category already exists
$brand_query = "SELECT id FROM Brand WHERE name = '$brand__name'";
$brand_result = pg_query($dbconn3, $brand_query);

if (pg_num_rows($brand_result) > 0) {
    // Category does not exist, create it
    $brand_update_query = "UPDATE Brand (name) SET ('$brand__name') WHERE id = '$brand_id'";
    $brand_update_result = pg_query($dbconn3, $brand_update_query);

    if ($brand_update_result) {
        // Category created successfully, get its ID
        $brand_id = pg_fetch_assoc(pg_query($dbconn3, "SELECT LASTVAL()"))['lastval'];
    } else {
        // Error updating category
        echo "Error updating Brand: " . pg_last_error($dbconn3);
        exit();
    }
} else {
    // Error updating category
    echo "Error updating Transmission: " . pg_last_error($dbconn3);
    exit();
}

// Sanitize the input data
$model = $_POST['model'];

// Sanitize the input data
$model = pg_escape_string($model);

// Check if the category already exists
$model_query = "SELECT id FROM Model WHERE name = '$model'";
$model_result = pg_query($dbconn3, $model_query);

if (pg_num_rows($model_result) > 0) {
    // Category does not exist, create it
    $model_update_query = "UPDATE Model (name, brand_id) SET ('$model', '$brand_id') WHERE id = '$model_id'";
    $model_update_result = pg_query($dbconn3, $model_update_query);

    if ($model_update_result) {
        // Category created successfully, get its ID
        $model_id = pg_fetch_assoc(pg_query($dbconn3, "SELECT LASTVAL()"))['lastval'];
    } else {
        // Error updating category
        echo "Error updating Model: " . pg_last_error($dbconn3);
        exit();
    }
} else {
    // Error updating category
    echo "Error updating Transmission: " . pg_last_error($dbconn3);
    exit();
}

// Sanitize the input data
$color__name = $_POST['color__name'];

// Sanitize the input data
$color__name = pg_escape_string($color__name);

// Check if the category already exists
$color_query = "SELECT id FROM Color WHERE name = '$color__name'";
$color_result = pg_query($dbconn3, $color_query);

if (pg_num_rows($color_result) > 0) {
    // Category does not exist, create it
    $color_update_query = "UPDATE Color (name) SET ('$color__name') WHERE id = '$color_id'";
    $color_update_result = pg_query($dbconn3, $color_update_query);

    if ($color_update_result) {
        // Category created successfully, get its ID
        $color_id = pg_fetch_assoc(pg_query($dbconn3, "SELECT LASTVAL()"))['lastval'];
    } else {
        // Error updating category
        echo "Error updating Color: " . pg_last_error($dbconn3);
        exit();
    }
} else {
    // Error updating category
    echo "Error updating Transmission: " . pg_last_error($dbconn3);
    exit();
}

// Sanitize the input data
$body__name = $_POST['body__name'];

// Sanitize the input data
$body__name = pg_escape_string($body__name);

// Check if the category already exists
$body_query = "SELECT id FROM Body WHERE name = '$body__name'";
$body_result = pg_query($dbconn3, $color_query);

if (pg_num_rows($body_result) > 0) {
    // Category does not exist, create it
    $body_update_query = "UPDATE Body (name) SET ('$body__name') WHERE id = '$body_id'";
    $body_update_result = pg_query($dbconn3, $body_update_query);

    if ($body_update_result) {
        // Category created successfully, get its ID
        $body_id = pg_fetch_assoc(pg_query($dbconn3, "SELECT LASTVAL()"))['lastval'];
    } else {
        // Error updating body
        echo "Error updating Body: " . pg_last_error($dbconn3);
        exit();
    }
} else {
    // Error updating category
    echo "Error updating Transmission: " . pg_last_error($dbconn3);
    exit();
}


// Sanitize the input data
$transmission__type = $_POST['transmission__type'];

// Sanitize the input data
$transmission__type = pg_escape_string($transmission__type);

// Check if the category already exists
$transmission_query = "SELECT id FROM Transmission WHERE name = '$transmission__type'";
$transmission_result = pg_query($dbconn3, $transmission_query);

if (pg_num_rows($transmission_result) > 0) {
    // Category does not exist, create it
    $transmission_update_query = "UPDATE Transmission (type) SET ('$transmission__type') WHERE id = '$transmission_id'";
    $transmission_update_result = pg_query($dbconn3, $brand_update_query);

    if ($transmission_update_result) {
        // Category created successfully, get its ID
        $transmission_id = pg_fetch_assoc(pg_query($dbconn3, "SELECT LASTVAL()"))['lastval'];
    } else {
        // Error updating category
        echo "Error updating Transmission: " . pg_last_error($dbconn3);
        exit();
    }
} else {
        // Error updating category
        echo "Error updating Transmission: " . pg_last_error($dbconn3);
        exit();
}

// Get the product information from the form data
$description = $_POST['description'];
$price = $_POST['price'];
$max_speed = $_POST['max_speed'];
$is_sold = $_POST['is_sold'];
$is_public = $_POST['is_public'];
$engine = $_POST['engine'];
$year = $_POST['year'];

$description = pg_escape_string($description);
$price = (float) $price;
$max_speed = (int) $max_speed;
$is_sold = (boolean) $is_sold;
$is_public = (boolean) $is_public;
$engine = (float) $engine;
$year = (int) $year;

// Check if the car already exists
$car_query = "SELECT id FROM Car WHERE model = '$model'";
$car_result = pg_query($dbconn3, $created_by_query);

if (pg_num_rows($car_result) > 0) {
    // Image exists, get its ID
    $car_id = pg_fetch_assoc($car_result)['id'];
}

// SQL query to update a new product with the related category
$query = "UPDATE Car (model, description, price, color, transmission, body, max_speed, is_sold, is_public, engine, year, created_by) 
SET ('$model_id', '$description', '$price', '$color_id', '$transmission_id', '$body_id', '$max_speed', '$is_sold', '$is_public', '$engine', '$year', '$created_by_id') WHERE id = '$car_id'";

// Execute the query
$result = pg_query($dbconn3, $query);

// Check if the query was successful
if ($result) {
    echo "Product created successfully.";
} else {
    echo "Error updating product: " . pg_last_error($dbconn3);
}

// Close the connection
pg_close($dbconn3);
