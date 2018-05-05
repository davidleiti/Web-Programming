<?php

require_once "target.php";

class TargetsView{
    public function __construct(){}

    public function printAllTargets($result){
        if ($result->num_rows > 0){
            echo "<h2 style = 'font-style: italic'>All tourist targets:</h2>";
            echo "<table style = 'border-collapse: collapse;'>  <col width='50'><col width='100'><col width='100'><col width='100'><tr> " . 
            "<th style = 'border:1px solid black'>ID</th> ". 
            "<th style = 'border:1px solid black'>Description</th> " . 
            "<th style = 'border:1px solid black'>Name</th>" . 
            "<th style = 'border:1px solid black'>DestinationID</th></tr>";
            while ($row = $result->fetch_assoc()){
                echo "<tr>";
                echo "<th style = 'border:1px solid black'>" . $row["TargetID"] . "</th>";
                echo "<th style = 'border:1px solid black'>" . $row["Name"] . "</th>";
                echo "<th style = 'border:1px solid black'>" . $row["Description"] . "</th>";
                echo "<th style = 'border:1px solid black'>" . $row["DestinationID"] . "</th>";
                echo "</tr>";
            }
            echo "</table>";
        }
        else{
            echo "0 results";
        }
    }

    public function printTarget($dest){
        echo "<br>";
        if ($dest == NULL){
            echo "0 results";
        }
        else
            echo "ID: " . $dest->getTargetID() . "<br>Name: " . $dest->getName() . "<br>Description: " . $dest->getDescription() . "<br>DestinationID: " . $dest->getDestinationID();
    }
}

?>