<?php

require_once "destination.php";

class DestinationsView{
    public function __construct(){}

    public function printAllDestinations($result){
        if ($result->num_rows > 0){
            echo "<h4>All destinations:</h4>";
            echo "<table style = 'border-collapse: collapse;'>  <col width='50'><col width='100'><col width='100'><col width='100'><tr> " . 
            "<th style = 'border:1px solid black'>ID</th> ". 
            "<th style = 'border:1px solid black'>City</th>" . 
            "<th style = 'border:1px solid black'>Country</th> " . 
            "<th style = 'border:1px solid black'>Description</th></tr>";
            while ($row = $result->fetch_assoc()){
                echo "<tr>";
                echo "<th style = 'border:1px solid black'>" . $row["DestinationID"] . "</th>";
                echo "<th style = 'border:1px solid black'>" . $row["Country"] . "</th>";
                echo "<th style = 'border:1px solid black'>" . $row["City"] . "</th>";
                echo "<th style = 'border:1px solid black'>" . $row["Description"] . "</th>";
                echo "</tr>";
            }
            echo "</table>";
        }
        else{
            echo "0 results";
        }
    }

    public function printDestination($dest){
        echo "<br>";
        if ($dest == NULL){
            echo "0 results";
        }
        else
            echo "ID: " . $dest->getDestinationID() . "<br>Country: " . $dest->getCountry() . "<br>City: " . $dest->getCity() . "<br>Description: " . $dest->getDescription();
    }
}

?>