<?php
    /*
        12.	Write a PHP script that performs asynchronous processing using a message queue system 
            like RabbitMQ or Redis. The script should receive a task (e.g., an email sending request) 
            and process it in the background without blocking the main application. 
            Demonstrate how you would set up the message queue and create a worker script to handle the tasks.
    */

    require '/var/www/html/vendor/autoload.php';

    use Predis\Client;

    // Connect to Redis server: host is docker name for redis from docker-compose.yml
    $redis = new Client([
        'host'   => 'redis-cache',
    ]);

    echo 'Queue worker is listening for jobs...' . PHP_EOL;

    // Infinite loop to keep the worker running
    while (true) {
        // Pop an email from the message queue
        $taskJson = $redis->brpop('email_queue', 0)[1];

        // Process the task
        if ($taskJson) {
            $taskData = json_decode($taskJson, true);

            // Simulate task processing
            echo "Processing task: Send email to {$taskData['to']}\n";
            echo "Subject: {$taskData['subject']}\n";
            echo "Message: {$taskData['message']}\n";

            // Simulate a delay (e.g., sending an email might take some time)
            sleep(2);

            echo "Email has been sent successfully.\n\n";
        }
    }

?>