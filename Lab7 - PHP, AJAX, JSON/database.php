<?php

class DB{
    private $host = "127.0.0.1";
    private $user = "root";
    private $password = "";
    private $database = "vacations";

    private $conn;

    public function __construct(){
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database);
        if ($this->conn->connect_error){
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function selectAllDestinations(){
        $selectCommand = "SELECT * FROM Destinations";
        $result = $this->conn->query($selectCommand);
        return $result;
    }

    public function selectAllTargets(){
        $selectCommand = "SELECT * FROM Targets";
        $result = $this->conn->query($selectCommand);
        return $result;
    }

    public function selectDestinationWithID($id){
        $selectCommand = "SELECT * FROM Destinations WHERE DestinationID = " . $id;
        $result = $this->conn->query($selectCommand);
        return $result;
    }

    public function getNthFromCountry($country, $n){
        $selectCommand = "SELECT * FROM Destinations WHERE Country = '" . $country . "' LIMIT 4 OFFSET " . $n;
        $result = $this->conn->query($selectCommand);
        if (!$result){
            echo $this->conn->error;
            return;
        }
        return $result;
    }

    public function selectTargetWithID($id){
        $selectCommand = "SELECT * FROM Targets WHERE TargetID = " . $id;
        $result = $this->conn->query($selectCommand);
        return $result;
    }
    
    public function selectTargetsAtDestination($id){
        $selectCommand = "SELECT * FROM Targets WHERE DestinationID = " . $id;
        $result = $this->conn->query($selectCommand);
        return $result;
    }

    public function selectTopTargets($id){
        $selectCommand = "SELECT Name, Description, Price FROM Targets WHERE DestinationID = " . $id . " ORDER BY Price LIMIT 3";
        $result = $this->conn->query($selectCommand);
        if (!$result)
            echo $this->conn->error;
        return $result;
    }

    public function insertDestination($country, $city, $address, $description){
        $insertCommand = "INSERT INTO Destinations(Country, City, Address, Description) VALUES('" . $country . "', '" . $city . "', '" . $address . "', '" . $description . "')";
        $b = $this->conn->query($insertCommand);
        if ($b){
            return $b;
        }
        return $this->conn->error;
    }

    public function insertTarget($name, $description, $price, $destinationID){
        $insertCommand = "INSERT INTO Targets(Name, Description, Price, DestinationID) VALUES('" . $name . "', '" . $description . "', " . $price . ", '" . $destinationID . "')";
        $b = $this->conn->query($insertCommand);
        if ($b){
            return $b;
        }
        return $this->conn->error;
    }

    public function deleteDestination($id){
        $deleteCommand = "DELETE FROM Destinations WHERE DestinationID = " . $id;
        $b = $this->conn->query($deleteCommand);
        if ($b){
            return $b;
        }
        return $this->conn->error;
    }
    
    public function deleteTarget($id){
        $deleteCommand = "DELETE FROM Targets WHERE TargetID = " . $id;
        $b = $this->conn->query($deleteCommand);
        if ($b){
            return $b;
        }
        return $this->conn->error;
    }

    public function updateDestination($id, $country, $city, $address, $description){
        $updateCommand = "UPDATE Destinations SET Country = '" . $country . "', City = '" . $city . "',Address = '" . $address . "', Description = '" . $description . "' WHERE DestinationID = " . $id;
        $b = $this->conn->query($updateCommand);
        if ($b){
            return $b;
        }
        return $this->conn->error;
    }

    public function updateTarget($id, $name, $description, $price, $destinationID){
        $updateCommand = "UPDATE Targets SET Name = '" . $name . "', Description = '" . $description . "', Price = " . $price . ", DestinationID = " . $destinationID . " WHERE TargetID = " . $id;
        $b = $this->conn->query($updateCommand);
        if ($b){
            return $b;
        }
        echo $this->conn->error;
        return $this->conn->error;
    }

}

?>