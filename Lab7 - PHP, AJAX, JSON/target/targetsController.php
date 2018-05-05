<?php

require_once '../database.php';
require_once '../model.php';
require_once 'targetsView.php';
class TargetsController{
    private $model;
    private $view;

    public function __construct(){
        $this->model = new Model();
        $this->view = new TargetsView();
    }
        
    public function getAllTargets(){
        $targets = $this->model->getTargets();
        $this->view->printAllTargets($targets);
    }

    public function getTargetWithID($id){
        if ($id === "")
            echo "<br>ID not provided!";
        else{
            $target = $this->model->getTargetWithID($id);
            $this->view->printTarget($target);
        }
    }

    public function insertTarget($name, $description, $destID){
        if ($name === "" || $destID === "")
            echo "Some mandatory fields are missing!";
        else{
            $result = $this->model->insertTarget($name, $description, $destID);
            if ($result == TRUE){
                echo "<br>Target inserted successfully!<br>";
            }
            else
                echo $result;
        }
        $this->getAllTargets();
    }

    public function deleteTarget($id){
        if ($id === ""){
            echo "ID must be specified!";
        }
        else{
            $result = $this->model->deleteTarget($id);
            if ($result == TRUE){
            }
            else{
                echo $result;
            }
        }
        $this->getAllTargets();
    }

    public function updateTarget($id, $name, $description, $destinationID){
        if ($id === "" || $name === "" || $destinationID === ""){
            echo "Some mandatory fields are missing!";
        }
        else{
            $result = $this->model->updateTarget($id, $name, $description, $destinationID);
            if ($result == TRUE){
            }
            else{
                echo $result;
            }
        }
        $this->getAllTargets();
    }

}

$c = new TargetsController();
$request = $_SERVER['REQUEST_METHOD'];
if ($request == "GET"){
    $method = $_GET["methodName"];
    switch ($method){
        case "showAll":
            $c->getAllTargets();
            break;
        case "showWithID":
            $c->getTargetWithID($_GET["id"]);
            break;
    }
}
else if ($request == "POST"){
    $method = $_POST["methodName"];
    switch ($method){
        case "insert":
            $name = $_POST["name"];
            $description = $_POST["description"];
            $destinationID = $_POST["destinationID"];
            $c->insertTarget($name, $description, $destinationID);
            break;
        case "update":
            $id = $_POST["id"];
            $name = $_POST["name"];
            $description = $_POST["description"];
            $destinationID = $_POST["destinationID"];
            $c->updateTarget($id, $name, $description, $destinationID);
            break;
    }
}
else if ($request == "DELETE"){
    parse_str(file_get_contents("php://input"), $del_vars);
    $id = $del_vars["id"];
    $c->deleteTarget($id);
}

?>
