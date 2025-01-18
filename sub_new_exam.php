<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    if(!isset($_POST["exam_name"])){
        header("Location: exam_list.php?error='Enter all inputs'");
        die();

    }
    if(!isset($_POST["exam_nquestion"])){
        header("Location: exam_list.php?error='Enter all inputs'");
        die();
    }
    require_once "includes/connection.php";
    $data = new Connection();

    $ex_name = $_POST["exam_name"];
    $ex_nquestion = $_POST["exam_nquestion"];

    require_once "includes/DbObject.inc.php";
    $data = new DBObject();
    $data->create_exam($ex_name,$ex_nquestion);
    header("Location: exam_list.php");
    die();

}
header("Location: index.php");
die();

?>