<?php

require_once '../database.php';
require_once '../model.php';
require_once 'destinationsView.php';
class DestinationsController{
    private $model;
    private $view;

    public function __construct(){
        $this->model = new Model();
        $this->dView = new DestinationsView();
    }
        
    public function getAllDestinations(){
        $destinations = $this->model->getDestinations();
        $this->dView->printAllDestinations($destinations);
    }

    public function getDestinationWithID($id){
        if ($id === "")
            echo "<br>ID not provided!";
        else{
            $dest = $this->model->getDestinationWithID($id);
            $this->dView->printDestination($dest);
        }
    }

    public function insertDestination($country, $city, $address, $description){
        if ($country === "" || $city === "")
            echo "Some mandatory fields are missing!";
        else{
            $result = $this->model->insertDestination($country, $city, $address, $description);
            if ($result == TRUE){
                echo "<br>Destination inserted successfully!<br>";
            }
            else
                echo $result;
        }
        $this->getAllDestinations();
    }

    public function deleteDestination($id){
        if ($id === ""){
            echo "ID must be specified!";
        }
        else{
            $result = $this->model->deleteDestination($id);
            if ($result == TRUE){
            }
            else{
                echo $result;
            }
        }
        $this->getAllDestinations();
    }

    public function updateDestination($id, $country, $city, $address, $description){
        if ($id === "" || $country === "" || $city === ""){
            echo "Some mandatory fields are missing!";
        }
        else{
            $result = $this->model->updateDestination($id, $country, $city, $address, $description);
            if ($result == TRUE){
            }
            else{
                echo $result;
            }
        }
        $this->getAllDestinations();
    }

}

$c = new DestinationsController();
$request = $_SERVER['REQUEST_METHOD'];
if ($request == "GET"){
    $method = $_GET["methodName"];
    switch ($method){
        case "showAll":
            $c->getAllDestinations();
            break;
        case "showWithID":
            $c->getDestinationWithID($_GET["id"]);
            break;
    }
}
else if ($request == "POST"){
    $method = $_POST["methodName"];
    switch ($method){
        case "insert":
            print_r($_POST);
            $country = $_POST["country"];
            $city = $_POST["city"];
            $address = $_POST["address"];
            $description = $_POST["description"];
            $c->insertDestination($country, $city, $address, $description);
            break;
        case "update":
            $id = $_POST["id"];
            $country = $_POST["country"];
            $city = $_POST["city"];
            $address = $_POST["address"];
            $description = $_POST["description"];
            $c->updateDestination($id, $country, $city, $address, $description);
            break;
    }
}
else if ($request == "DELETE"){
    parse_str(file_get_contents("php://input"), $del_vars);
    $id = $del_vars["id"];
    $c->deleteDestination($id);
}

?>
