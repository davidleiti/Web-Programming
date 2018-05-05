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
        mysqli_close($this->conn);
    }

    public function selectAllTargets(){
        $selectCommand = "SELECT * FROM Targets";
        $result = $this->conn->query($selectCommand);
        return $result;
        mysqli_close($this->conn);
    }

    public function selectDestinationWithID($id){
        $selectCommand = "SELECT * FROM Destinations WHERE DestinationID = " . $id;
        $result = $this->conn->query($selectCommand);
        return $result;
        mysqli_close($this->conn);
    }

    public function selectTargetWithID($id){
        $selectCommand = "SELECT * FROM Targets WHERE TargetID = " . $id;
        $result = $this->conn->query($selectCommand);
        return $result;
        mysqli_close($this->conn);
    }

    public function insertDestination($country, $city, $description){
        $insertCommand = "INSERT INTO Destinations(Country, City, Description) VALUES('" . $country . "', '" . $city . "', '" . $description . "')";
        $b = $this->conn->query($insertCommand);
        if ($b){
            return $b;
        }
        return $this->conn->error();
    }

    public function insertTarget($name, $description, $destinationID){
        $insertCommand = "INSERT INTO Targets(Name, Description, DestinationID) VALUES('" . $name . "', '" . $description . "', '" . $destinationID . "')";
        $b = $this->conn->query($insertCommand);
        if ($b){
            return $b;
        }
        return $this->conn->error();
    }

    public function deleteDestination($id){
        $deleteCommand = "DELETE FROM Destinations WHERE DestinationID = " . $id;
        $b = $this->conn->query($deleteCommand);
        if ($b){
            return $b;
        }
        return $this->conn->error();
    }
    
    public function deleteTarget($id){
        $deleteCommand = "DELETE FROM Targets WHERE TargetID = " . $id;
        $b = $this->conn->query($deleteCommand);
        if ($b){
            return $b;
        }
        return $this->conn->error();
    }

    public function updateDestination($id, $country, $city, $description){
        $updateCommand = "UPDATE Destinations SET Country = '" . $country . "', City = '" . $city . "', Description = '" . $description . "' WHERE DestinationID = " . $id;
        $b = $this->conn->query($updateCommand);
        if ($b){
            return $b;
        }
        return $this->conn->error();
    }

    public function updateTarget($id, $name, $description, $destinationID){
        $updateCommand = "UPDATE Targets SET Name = '" . $name . "', Description = '" . $description . "', DestinationID = '" . $destinationID . "' WHERE TargetID = " . $id;
        $b = $this->conn->query($updateCommand);
        if ($b){
            return $b;
        }
        return $this->conn->error();
    }

}

?>