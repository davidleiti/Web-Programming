<?php
require_once "database.php";
$db = new DB();
$country = $_GET["country"];
$targets = $db->selectTopTargets($country);
for ($i = 0; $i < count($targets); i++){
    echo "<div style = 'margin:1px solid grey; width = 300px; height = 150px;'>";
    echo "<h3 style = 'font-style: italic'>" . $targets[$i]["Name"] . "</h3>";
    echo "<p>" . $target[$i]["Description"] . "</p><p>" . $target[$i]["Price"] . "</p></div>";
}
?>