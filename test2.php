<?php
    session_start();
    require_once "includes/connection.php";
    $data = new Connection();
    
    $index = (int)$_GET["q"];
    $index -=1;

    function get_question_by_id(int $index, string $table_name, $data_b){
        $pdo = $data_b->connect();
        
        $query = "SELECT id,question,A,B,C,D,sec FROM $table_name LIMIT $index, 1;";
        $stmt = $pdo->prepare($query);
    
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    $result = get_question_by_id($index, $_SESSION["exam"], $data);

    if(isset($_SESSION["answers"][$result['id']])){
        $result["sec"] = $_SESSION["answers"][$result['id']]["time_left"];
        $result["ans"] = $_SESSION["answers"][$result['id']]["ans"];
        echo json_encode($result);
        die();
    }

    echo json_encode(array_merge($result, ["ans" => '']));
    die();
?>