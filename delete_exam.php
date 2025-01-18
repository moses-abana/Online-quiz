<?php
if($_SERVER['REQUEST_METHOD'] == "GET"){
    if(isset($_GET["id"])){
        require_once "includes/DbObject.inc.php";
        $data = new DBObject();
        $data->delete_exam($_GET["id"]);

    }
}
header("Location: exam_list.php");
die();

?>