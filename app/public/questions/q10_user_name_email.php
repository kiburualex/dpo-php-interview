<?php 
    /*
        10. Using PHP, make a GET request to a sample REST API (e.g., JSONPlaceholder) 
            to retrieve a list of users. Parse the JSON response and display the user's 
            name and email address.
    */

    function displayUserDetails() {
        try {
        // JSONPlaceholder URL with user email and name
            $usersUrl = 'https://jsonplaceholder.typicode.com/users';

            // initialize cURL session
            $curl = curl_init($usersUrl);

            // set cURL options
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, 30);

            // execute cURL session and get the response
            $response = curl_exec($curl);

            // check for cURL errors
            if (curl_errno($curl)) {
                echo 'GET Request Error: ' . curl_error($curl);
                exit;
            }

            // close cURL session
            curl_close($curl);

            // decode the JSON response
            $users = json_decode($response, true);

            // check if decoding was successful
            if ($users === null) {
                echo 'Error decoding JSON';
                exit;
            }

            // display user name and email
            foreach ($users as $user) {
                echo "<br>";
                echo "Name: {$user['name']}<br>";
                echo "Email: {$user['email']}<br>";
                
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        
    }

    // execute function
    displayUserDetails();

?>