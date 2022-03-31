<?php

/* class Human
{
    public $name;
    public $age;
    public $city;


    public function __construct($name, $age, $city)
    {
        $this->name = $name;
        $this->age = $age;
        $this->city = $city;
    }

    public function info()
    {
        echo "Меня зовут {$this->name} мне {$this->age} я проживаю в городе - {$this->city}";
    }
}

class Doctor extends Human
{
    public $profession;

    public function __construct($name, $age, $city, $profession)
    {
        $this->profession = $profession;
        parent::__construct($name, $age, $city);
    }

    public function info()
    {
        parent::info();
        echo " И помогаю людям потому-что я работаю {$this->profession}<br>";
    }

    public function treat(Human $target)
    {
        echo "Ко мне {$this->name} приходил на прием {$target->name} я вылечил ему зуб потому что я {$this->profession}<br>";
    }
}

$zina = new Human('Зина', 21, 'Нижний Новгород');
$igor = new Doctor('Игорь', 33, 'Москва', 'Стоматологом');
$irina = new Doctor('Ирина', 23, 'Калининград', 'Хирургом');
$igor->info();
$irina->info();
$igor->treat($zina); */



/* class A
{
    public function foo()
    {
        static $x = 0;
        echo ++$x;
    }
}
$a1 = new A();
$a2 = new A();
$a1->foo();
$a2->foo();
$a1->foo();
$a2->foo(); */

// Ответ $x принадлежит функции и при каждом вызове функции она увеличивается на  - 1 (1,2,3,4)

/* class A
{
    public function foo()
    {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A
{
}
$a1 = new A();
$b1 = new B();
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo(); */

// $x принадлежит классу функции, функции в разных участках памяти, каждая считает свою $x (1,1,2,2) 

/* class A
{
    public function foo() 
    {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A
{
}
$a1 = new A; // нет круглых скобок 
$b1 = new B; // нет круглых скобок
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();

// Вычисление и результат от этого не поменялся) */