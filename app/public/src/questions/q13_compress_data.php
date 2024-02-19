<?php 
    /*
        13.	Write a PHP script that serializes a large data structure (e.g., an array or object), 
        compresses it, saves it to a file, and then unserializes and decompresses the data from the file. 
        You can use standard PHP functions for serialization and a compression library like zlib to achieve this.
    */

    function fetchLargeUsersData(){
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
                throw new Exception("Error: unable to decoding response JSON");
                exit;
            }

            return $users;
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return null;
    }


    function compressAndDecompressLargeData(){
        try{
            $data = fetchLargeUsersData();

            // check if has large data
            if(!$data){
                throw new Exception("Error: No large data");
            }

            // specify the file path for storing the compressed data
            $filePath = 'data/compressed_user_data.dat';

            // serialize to convert to string representation
            $serializedData = serialize($data);

            // compress the serialized data
            $compressedData = zlib_encode($serializedData, ZLIB_ENCODING_DEFLATE);

            // write the compressed data to the specified file
            file_put_contents($filePath, $compressedData);

            echo "Compressed Data saved to '{$filePath}'<br>";

            // read the compressed data from the file
            $readCompressedData = file_get_contents($filePath);

            // decompress the data
            $decompressedData = zlib_decode($readCompressedData);
           
            // unserialize the data
            $unserializedData = unserialize($decompressedData);

            // display the decompressed and unserialized data
            echo "Decompressed data:<br>";
            print_r($unserializedData);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
    compressAndDecompressLargeData();

?>