<?php

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exams Page</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/bootstrap.min.js"></script>
    <style>
        .circular-span{
            height:100px;
            width:100px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-light bg-light shadow-sm">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1"><h4><b>M.A.U CSC</b></h4></span>
        </div>
    </nav>
<?php

require_once "includes/connection.php";
$data = new Connection();
$score = 0;

if(!isset($_SESSION["answers"])){
 session_unset();
 session_destroy();
 ?>
 <p>You didn't answer any question.</p>
 <a class="btn btn-primary" href='index.php'>Done</a>
 <?php
 die();

}
$full_name = $_SESSION['surname'] . " ". $_SESSION['firstname'] ." ". $_SESSION['othernames'];
$exam_name = $_SESSION["exam_name"]; 

function get_ans(string $question_table, $data_b){
    $pdo = $data_b->connect();
    $query = "SELECT id,Ans FROM $question_table;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function record_result($obj, $grade){
   $reg_no = $_SESSION["reg_no"];
   $table = $_SESSION["exam"] . "_result";
   $pdo = $obj->connect();
   $stmt = $pdo->prepare("INSERT INTO $table(reg_no,grade) VALUES(?,?) ;");
   $stmt->execute([$reg_no, $grade]);
}

$answers = get_ans($_SESSION["exam"],$data);
$choices = $_SESSION["answers"];
foreach($answers as $answer){
    if(isset($choices[$answer["id"]])){
	if($choices[$answer["id"]]["ans"] == $answer["Ans"]){ $score +=1;}
    }
}
$percentage = (int)($score/count($answers) *100);
function grade($percentage){
   $grade="";
   if($percentage >= 70){ $grade = "A";}
   else if($percentage >=60){ $grade = "B";}
   else if($percentage >= 50){ $grade = "C";}
   else if($percentage >= 40){ $grade = "F"; }
   else{ $grade = "F";}
   return $grade;
}
$grade = grade($percentage);
record_result($data,$grade );
?>


            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header p-2">
                        <h5 class="modal-title mx-auto">Result</h5>
                    </div>
                    <div class="modal-body p-2 card">

                        <div class="mb-0 input-group">
                            <span class="input-group-text">ID</span>
                            <?php echo "<input type='text' class='form-control detail' value='" . $_SESSION["reg_no"] . "' readonly>"; ?>
                        </div>
                        <div class="mb-0 input-group">
                            <span class="input-group-text">NAME</span>
                            <?php echo "<input type='text' class='form-control detail' value='" . $full_name . "' readonly>"; ?>
                        </div>
                        <div class="mb-0 input-group">
                            <span class="input-group-text">COURSE</span>
                            <?php echo "<input type='text' class='form-control detail' value='" . $exam_name . "' readonly>"; ?>
                        </div>
                        <div class="rounded-circle text-center mx-auto p-3 circular-span h3 mt-3 bg-light shadow"><?php echo $percentage . "%";?></div>
                        <a class="btn btn-primary" href='index.php'>Done</a>
                    <?php                        
                        $remark = (int)($score/count($answers) *100);
                        session_unset();
                        session_destroy();

                        die();
                        ?>
                    </div>
                    <div class="modal-footer p-2"> 
                    </div>
                </div>
            </div>
</body>
</html>