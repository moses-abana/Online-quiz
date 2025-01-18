if($_SERVER['REQUEST_METHOD'] == "GET"){
    $result = $data->get_question_by_id((int)$_SESSION["question_no"]);
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_SESSION["matric_no"] ) && isset($_SESSION["question_no"])){
        if(isset($_POST["ans"])){
           $qn =  (string)$_SESSION["question_no"];
           $_SESSION[$qn] = $_POST["ans"];

            $_SESSION["question_no"] +=1;
        }
        $result = $data->get_question_by_id((int)$_SESSION["question_no"]);

        

    }
        
}else{
    header("Location: index.php");
    die();