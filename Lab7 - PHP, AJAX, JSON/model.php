<?php

require_once "database.php";
require_once "destination/destination.php";

class Model{
    private $db;

    public function __construct(){
        $this->db = new DB();
    }

    public function getDestinations(){
        $resultSet = $this->db->selectAllDestinations();
        return $resultSet;
    }

    public function getTargets(){
        $resultSet = $this->db->selectAllTargets();
        return $resultSet;
    }

    public function getDestinationWithID($id){
        $result = $this->db->selectDestinationWithID($id);
        if ($result && $result->num_rows > 0){
            $result = $result->fetch_row();
            $dest = new Destination($result[0], $result[1], $result[2], $result[3]);
        }
        else
            $dest = NULL;
        return $dest;
    }

    public function getTargetWithID($id){
        $result = $this->db->selectTargetWithID($id);
        if ($result && $result->num_rows > 0){
            $result = $result->fetch_row();
            $tar = new Target($result[0], $result[1], $result[2], $result[3]);
        }
        else
            $tar = NULL;
        return $tar;
    }

    public function insertDestination($country, $city, $description){
        return $this->db->insertDestination($country, $city, $description);
    }

    public function insertTarget($name, $description, $destinationID){
        return $this->db->insertTarget($name, $description, $destinationID);
    }

    public function deleteDestination($id){
        return $this->db->deleteDestination($id);
    }

    public function deleteTarget($id){
        return $this->db->deleteTarget($id);
    }

    public function updateDestination($id, $country, $city, $description){
        return $this->db->updateDestination($id, $country, $city, $description);
    }

    public function updateTarget($id, $name, $description, $destinationID){
        return $this->db->updateTarget($id, $name, $description, $destinationID);
    }

}

?>