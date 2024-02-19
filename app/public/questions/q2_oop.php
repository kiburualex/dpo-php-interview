<?php
/*
    2.	Describe the principles of Object-Oriented Programming (OOP) in PHP. 
        How do you define a class and create objects in PHP? Provide an example of a class 
        and its instantiation.
*/

    class Person {
        private $name;
        private $age;
        public function setName($name){
            $this->name = $name;
        }

        public function setAge($age){
            $this->age = $age;
        }

        public function introductionSelf(){
            echo "Hello, my name is ". $this->name . ". I am ". $this->age . " years old.";
        }
    }

    // Instantiate a class:
    $person = new Person();
    $person->setName("Alex");
    $person->setAge("34");

    // output the set variables
    $person->introductionSelf();

?>