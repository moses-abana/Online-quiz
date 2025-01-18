<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(!isset($_POST["db"])){
        header("Location: index.php");
        die();
    }
    $db = $_POST["db"];
    if(!isset($_POST["question"])){
        header("Location: set_questions.php?id=$db");
        die();

    }
    if(!isset($_POST["Ans"])){
        header("Location: set_questions.php?id=$db");
        die();

    }

    require_once "includes/DbObject.inc.php";
    $data = new DBObject();
    $i = $data->number_of_questions(("exam" . $db));
    $n = (int)$_POST["n"];
    if($i >= $n){
	header("Location: set_questions.php?id=$db&error=fill");
	die();
    }
    $question = $_POST["question"];
    $A = $_POST["A"];
    $B = $_POST["B"];
    $C = $_POST["C"];
    $D = $_POST["D"];
    $Ans = $_POST["Ans"];
    $sec = $_POST["sec"];

    
    
    $data->insert_question(("exam" . $db), $question, $A, $B, $C, $D, $Ans, $sec);

    header("Location: set_questions.php?id=" . $db);
    die();
}

header("Location: index.php");
die();
?>