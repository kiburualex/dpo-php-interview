<?php
    /*
        15.	Develop a PHP application that connects to an MS SQL Server database, 
            retrieves data from multiple tables, performs a complex SQL query to join and aggregate data, 
            and then returns the results as JSON. Demonstrate proper error handling and security 
            measures in your code.
    */

    require '/var/www/html/vendor/autoload.php';
    require './conn/Database.php';

    try {
        $database = new Database();
        $data = $database->getData();

        header('Content-Type: application/json');
        echo json_encode($data);
    } catch (Exception $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(['error' => $e->getMessage()]);
    }


?>