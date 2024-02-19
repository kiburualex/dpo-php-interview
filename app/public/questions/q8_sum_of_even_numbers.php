<?php 
    /*
        8.	Write a PHP function that takes an array of integers and 
            returns the sum of all even numbers in the array.
    */

    function sumOfEvenNumbers($numbersArray){
        $sum = 0;
        foreach($numbersArray as $number){
            if($number % 2 == 0){
                $sum += $number;
            }
        }
        return $sum;
    }

    $numbersArray = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    $numbersAsString = implode(", ", $numbersArray);
    echo "Even numbers: [$numbersAsString] <br>";

    // display the result
    $total = sumOfEvenNumbers($numbersArray);
    echo "Sum of even numbers is: $total";


?>