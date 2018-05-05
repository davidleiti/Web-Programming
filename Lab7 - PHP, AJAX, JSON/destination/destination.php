<?php

class Destination{
    private $destinationID;
    private $country;
    private $city;
    private $description;

    public function __construct($id, $country, $city, $description){
        $this->destinationID = $id;
        $this->county = $country;
        $this->city = $city;
        $this->description = $description;
    }

    public function getDestinationID(){
        return $this->destinationID;
    }

    public function getCountry(){
        return $this->country;
    }

    public function getCity(){
        return $this->city;
    }

    public function getDescription(){
        return $this->description;
    }
}

?>