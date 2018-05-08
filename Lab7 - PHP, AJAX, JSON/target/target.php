<?php

class Target{
    private $targetID;
    private $name;
    private $description;
    private $price;
    private $destinationID;

    public function __construct($id, $name, $description, $price, $destinationID){
        $this->targetID = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->destinationID = $destinationID;
    }

    public function getTargetID(){
        return $this->targetID;
    }

    public function getname(){
        return $this->name;
    }

    public function getDescription(){
        return $this->description;
    }

    public function getPrice(){
        return $this->price;
    }

    public function getDestinationID(){
        return $this->destinationID;
    }
}

?>