<?php

class Human {

    public $name; 
    public $age;
    public $gender;
    public $city;
    

    public function __construct($name, $age, $gender, $city) {
        var_dump($this);
        $this.$name = $name;
        $this.$age = $age;
        $this.$gender = $gender;
        $this.$city = $city;
        
    }
}
