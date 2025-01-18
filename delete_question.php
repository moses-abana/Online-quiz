<?php

if($_SERVER['REQUEST_METHOD'] == "GET"){
    if(isset($_GET["id"]) && isset($_GET["q"])){
        require_once "includes/DbObject.inc.php";
        $id0 = $_GET["id"];
        $data = new DBObject();
        $table_name = "exam" . (string)$id0;
        $con = $data->connect();
        $stm = $con->prepare("DELETE FROM $table_name WHERE id= :id");
	    $stm->bindParam(":id", $_GET["q"]);
	    $stm->execute();
    }
}
header("Location: set_questions.php?id=$id0");
die();

?>