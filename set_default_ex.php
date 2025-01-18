<?php
session_start();
var_dump($_GET["exam_id"]);

if(!isset($_GET["exam_id"])){
    header("Location: exam_list.php");
    die();
}

$exam_id = (int)$_GET["exam_id"];
require_once "includes/connection.php";
$data = new Connection();

function set_ex_id($obj, int $exam_id){
    $stmt = $obj->Connect()->prepare("UPDATE student_record SET exam_id = :exam_id ;");
    $stmt->bindParam(":exam_id", $exam_id);
    $stmt->execute();
}

set_ex_id($data,$exam_id);
header("Location: exam_list.php");
die();

?>