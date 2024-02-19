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

$taskJson = $redis->get('task_queue');


// Infinite loop to keep the worker running
while (true) {
    // Pop a task from the message queue (blocking operation)
    $taskJson = $redis->brpop('task_queue', 0)[1];

    // Process the task
    if ($taskJson) {
        $taskData = json_decode($taskJson, true);

        // Simulate task processing (you can replace this with your actual task processing logic)
        echo "Processing task: Send email to {$taskData['to']}\n";
        echo "Subject: {$taskData['subject']}\n";
        echo "Message: {$taskData['message']}\n";

        // Simulate a delay (e.g., sending an email might take some time)
        sleep(2);

        echo "Task processed.\n";
    }
}

?>