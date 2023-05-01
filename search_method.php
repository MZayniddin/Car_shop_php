<?php
function searchObject($searchTerm) {
    require_once 'vendor/autoload.php';
    require_once 'database/db.php';
    
    $loader = new \Twig\Loader\FilesystemLoader('templates');
    $twig = new \Twig\Environment($loader);
    
    // Escape the search term to prevent SQL injection
    $escapedSearchTerm = pg_escape_string($conn, $searchTerm);

    // SQL query to search for objects matching the search term
    $query = "SELECT * FROM Car WHERE model__name ILIKE '%$escapedSearchTerm%'";

    // Execute the query
    $result = pg_query($conn, $query);

    // Check if any results were returned
    if (pg_num_rows($result) > 0) {
        // Iterate through the results and store them in an array
        $objects = array();
        while ($row = pg_fetch_assoc($result)) {
            $objects[] = $row;
        }

        // Return the array of objects
        return $objects;
    } else {
        // No results found
        return null;
    }
}
