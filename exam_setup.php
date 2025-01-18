<?php
session_start();

require_once "includes/connection.php";
$data = new Connection();

function number_of_questions($obj, $table_name){
    $sq = "SELECT COUNT(*) FROM $table_name;";
    $res = $obj->connect()->query($sq);
    $count = $res->fetchColumn();

    return $count;
}

$total = number_of_questions($data, $_SESSION["exam"]);

echo json_encode(["max_no"=> $total]);
?>