<?php
    /*
        9.	Create a PHP script that reads a text file, counts the number of words in the file, 
            and displays the result. Ensure that your code handles file open and read errors gracefully.
    */

    function countWordsInFile($fileName) {
        try {
            // open the file
            $fileHandle = fopen($fileName, 'r');

            // check if file was able to open
            if(!$fileHandle){
                throw new Exception("Unable to open the file '{$fileName }'");
            }

            // read file contents
            $contents = fread($fileHandle, filesize($fileName));

            // count words using php str_word_count function
            $wordCount = str_word_count($contents);

            // display the result
            echo "Number of words in '{$fileName}': {$wordCount} words";
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            // close the file in the finally block to ensure it's closed even if an exception occurs
            if (isset($fileHandle) && is_resource($fileHandle)) {
                fclose($fileHandle);
            }
        }
        
    }

    // file name
    $filename = 'file.txt';

    // execute function to calculate words
    countWordsInFile($filename);

?>