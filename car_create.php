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
    // Image exists, get its ID
    $created_by_id = pg_fetch_assoc($created_by_result)['id'];
} else {
    // Image does not exist, create it
    $created_by_insert_query = "INSERT INTO Image (fullname, username, age) VALUES ('$created_by__fullname', '$created_by__username', '$created_by__age')";
    $created_by_insert_result = pg_query($dbconn3, $created_by_query);

    if ($created_by_insert_result) {
        // Image created successfully, get its ID
        $created_by_id = pg_fetch_assoc(pg_query($dbconn3, "SELECT LASTVAL()"))['lastval'];
    } else {
        // Error creating image
        echo "Error creating user: " . pg_last_error($dbconn3);
        exit();
    }
}

// Sanitize the input data
$brand__name = $_POST['brand__name'];

// Sanitize the input data
$brand__name = pg_escape_string($brand__name);

// Check if the category already exists
$brand_query = "SELECT id FROM Brand WHERE name = '$brand__name'";
$brand_result = pg_query($dbconn3, $brand_query);

if (pg_num_rows($brand_result) > 0) {
    // Category exists, get its ID
    $brand_id = pg_fetch_assoc($brand_result)['id'];
} else {
    // Category does not exist, create it
    $brand_insert_query = "INSERT INTO Brand (name) VALUES ('$brand__name')";
    $brand_insert_result = pg_query($dbconn3, $brand_insert_query);

    if ($brand_insert_result) {
        // Category created successfully, get its ID
        $brand_id = pg_fetch_assoc(pg_query($dbconn3, "SELECT LASTVAL()"))['lastval'];
    } else {
        // Error creating category
        echo "Error creating Brand: " . pg_last_error($dbconn3);
        exit();
    }
}

// Sanitize the input data
$model = $_POST['model'];

// Sanitize the input data
$model = pg_escape_string($model);

// Check if the category already exists
$model_query = "SELECT id FROM Model WHERE name = '$model'";
$model_result = pg_query($dbconn3, $model_query);

if (pg_num_rows($model_result) > 0) {
    // Category exists, get its ID
    $model_id = pg_fetch_assoc($model_result)['id'];
} else {
    // Category does not exist, create it
    $model_insert_query = "INSERT INTO Model (name, brand_id) VALUES ('$model', '$brand_id')";
    $model_insert_result = pg_query($dbconn3, $model_insert_query);

    if ($model_insert_result) {
        // Category created successfully, get its ID
        $model_id = pg_fetch_assoc(pg_query($dbconn3, "SELECT LASTVAL()"))['lastval'];
    } else {
        // Error creating category
        echo "Error creating Model: " . pg_last_error($dbconn3);
        exit();
    }
}

// Sanitize the input data
$color__name = $_POST['color__name'];

// Sanitize the input data
$color__name = pg_escape_string($color__name);

// Check if the category already exists
$color_query = "SELECT id FROM Color WHERE name = '$color__name'";
$color_result = pg_query($dbconn3, $color_query);

if (pg_num_rows($color_result) > 0) {
    // Category exists, get its ID
    $color_id = pg_fetch_assoc($color_result)['id'];
} else {
    // Category does not exist, create it
    $color_insert_query = "INSERT INTO Color (name) VALUES ('$color__name')";
    $color_insert_result = pg_query($dbconn3, $color_insert_query);

    if ($transmission_insert_result) {
        // Category created successfully, get its ID
        $color_id = pg_fetch_assoc(pg_query($dbconn3, "SELECT LASTVAL()"))['lastval'];
    } else {
        // Error creating category
        echo "Error creating Color: " . pg_last_error($dbconn3);
        exit();
    }
}

// Sanitize the input data
$body__name = $_POST['body__name'];

// Sanitize the input data
$body__name = pg_escape_string($body__name);

// Check if the category already exists
$body_query = "SELECT id FROM Body WHERE name = '$body__name'";
$body_result = pg_query($dbconn3, $color_query);

if (pg_num_rows($body_result) > 0) {
    // Category exists, get its ID
    $body_id = pg_fetch_assoc($body_result)['id'];
} else {
    // Category does not exist, create it
    $body_insert_query = "INSERT INTO Body (name) VALUES ('$body__name')";
    $body_insert_result = pg_query($dbconn3, $body_insert_query);

    if ($body_insert_result) {
        // Category created successfully, get its ID
        $body_id = pg_fetch_assoc(pg_query($dbconn3, "SELECT LASTVAL()"))['lastval'];
    } else {
        // Error creating category
        echo "Error creating BOdy: " . pg_last_error($dbconn3);
        exit();
    }
}


// Sanitize the input data
$transmission__type = $_POST['transmission__type'];

// Sanitize the input data
$transmission__type = pg_escape_string($transmission__type);

// Check if the category already exists
$transmission_query = "SELECT id FROM Transmission WHERE name = '$transmission__type'";
$transmission_result = pg_query($dbconn3, $transmission_query);

if (pg_num_rows($transmission_result) > 0) {
    // Category exists, get its ID
    $transmission_id = pg_fetch_assoc($transmission_result)['id'];
} else {
    // Category does not exist, create it
    $transmission_insert_query = "INSERT INTO Transmission (type) VALUES ('$transmission__type')";
    $transmission_insert_result = pg_query($dbconn3, $brand_insert_query);

    if ($transmission_insert_result) {
        // Category created successfully, get its ID
        $transmission_id = pg_fetch_assoc(pg_query($dbconn3, "SELECT LASTVAL()"))['lastval'];
    } else {
        // Error creating category
        echo "Error creating Transmission: " . pg_last_error($dbconn3);
        exit();
    }
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

// SQL query to insert a new product with the related category
$query = "INSERT INTO Car (model, description, price, color, transmission, body, max_speed, is_sold, is_public, engine, year, created_by) 
VALUES ('$model_id', '$description', '$price', '$color_id', '$transmission_id', '$body_id', '$max_speed', '$is_sold', '$is_public', '$engine', '$year', '$created_by_id')";

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
