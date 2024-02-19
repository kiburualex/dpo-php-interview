<?php
/*
    12.	Write a PHP script that performs asynchronous processing using a message queue system 
        like RabbitMQ or Redis. The script should receive a task (e.g., an email sending request) 
        and process it in the background without blocking the main application. 
        Demonstrate how you would set up the message queue and create a worker script to handle the tasks.
*/

require '/var/www/html/vendor/autoload.php';

use Predis\Client;

// Connect to Redis server
$redis = new Client([
    'host'   => 'redis-cache',
]);


// Add a task (e.g., email sending request) to the message queue
$taskData = [
    'to'      => 'alexkiburu@gmail.com',
    'subject' => 'Sample Email',
    'message' => 'This is a sample email.',
];

// Convert the task data to JSON for the message queue
$taskJson = json_encode($taskData);

// Push the task to the message queue
$redis->lpush('task_queue', $taskJson);

echo "Task added to the message queue.\n";



?>