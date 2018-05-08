<?php

require_once 'database.php';
require_once 'destination/destination.php';

class BrowseView{
    private $country;
    private $offset;
    private $destinations = [];

    public function __construct($country, $offset){
        $this->country = $country;
        $this->offset = $offset;
        $db = new DB();
        $result = $db->getNthFromCountry($country, $offset);
        while($row = $result->fetch_row()){
            $dest = new Destination($row[0], $row[1], $row[2], $row[3], $row[4]);
            $this->destinations[] = $dest;
        }
    }

    public function displayCurrent(){
        echo "<form action = './index.html'><input type = 'submit' value = '<< Return'></form>";
        if (count($this->destinations) === 0 && $this->offset == 0){
            echo "No destinations for this country... :(";
        }
        else{
            if (count($this->destinations) === 0)
            echo "No more destinations for this country... :(<br><br>";
            $db = new DB();
            for ($i = 0; $i < count($this->destinations); $i++){
                echo "<div style = 'border:2px solid grey; padding-left: 10px; margin-bottom: 0; width: 600px'>";
                echo "<h3 style = 'font-style: italic'>Destination #" . ($this->offset + $i) . "</h3>";
                echo  $this->destinations[$i]->toString();
                $targets = $db->selectTopTargets($this->destinations[$i]->getDestinationID());
                if ($targets){
                    echo "<p><b>Nearby tourist locations:</b><p>";
                    while ($row = $targets->fetch_assoc()){
                        echo "<div style = 'border:2px solid grey; width: 400px; height: 85px; margin-bottom: 10px;'>";
                        echo "<p style = 'padding-left: 10px; margin: 5px'>Location name: <b>" . $row["Name"] . "</b>. Estimated cost: " . $row["Price"] . "</p>";
                        echo "<p style = 'padding-left: 10px; text-align: justify'>Description: " . $row["Description"] . "</p></div>";
                    }
                }
                echo "</div><br><br>";
            }
            $back = "<form action = '' style = 'width: 70px; margin:0; float:left;'><input type = 'submit' value = '<< Back'";
            if ($this->offset == 0)
                $back = $back . "disabled";
            $back = $back . "><input type = 'hidden' name = country value = " . $this->country . ">" .
            "<input type = 'hidden' name = 'offset' value = " . ($this->offset - 4) . "></form>";
            $next = "<form action = ''>" . 
            "<input type = 'submit' value = 'Next >>' ";
            if (count($this->destinations) == 0)
                $next = $next . "disabled";
            $next = $next . "><input type = 'hidden' name = 'country' value = " . $this->country . ">" .
            "<input type = 'hidden' name = 'offset' value = " . ($this->offset + 4) . ">";
            echo "<div>" . $back . $next . "</div>";
        }
    }

    public function getDestCount(){
        return count($this->destinations);
    }

}

$b = new BrowseView($_GET["country"], $_GET["offset"]);
$b->displayCurrent();
?>
<head>
<style>
body {background-color: powderblue;}
</style>
</head>
<body>
</body>