<?php

class Destination{
    private $destinationID;
    private $country;
    private $city;
    private $address;
    private $description;

    public function __construct($id, $country, $city, $address, $description){
        $this->destinationID = $id;
        $this->country = $country;
        $this->city = $city;
        $this->address = $address;
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

    public function getAddress(){
        return $this->address;
    }

    public function getDescription(){
        return $this->description;
    }

    public function toString(){
        echo "ID: " . $this->destinationID . "<br>Country: " . $this->country . "<br>City: " . $this->city . "<br>Address: " . $this->address . "<br>Description: " . $this->description;
    }

}

?>