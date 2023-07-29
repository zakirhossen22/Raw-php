<?php
class Fruit {
  // Properties
  public $name;

  // Methods
  function  __construct($name) {
   $this->name = $name;
    
  }


  function get_name(){
    return $this->name;
  }
  
}

$apple = new Fruit("zakir");
// $banana = new Fruit();
// $apple->set_name('Apple');

echo "my name is".$apple->get_name();

?>