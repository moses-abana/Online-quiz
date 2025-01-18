<?php

$questions = null;

function question_no($obj,int $id){
           
           $pdo = $obj->connect();
           try{

             $stm = $pdo->prepare("SELECT * FROM exam_list WHERE ID = :id ;");
	     $stm->bindParam(":id",$id);
             $stm->execute();
             $result = $stm->fetch(PDO::FETCH_ASSOC);
	     return $result;
           }catch (PDOException $th) {
               echo "Exam doesn't exist <br>";
		die();
            }
   	}

if($_SERVER['REQUEST_METHOD'] == "GET"){
    if(isset($_GET["id"])){
        require_once "includes/DbObject.inc.php";
        $data = new DBObject();
	$exam_deatials = question_no($data, (int)$_GET["id"]);
       $questions = $data->fetch_questions($_GET["id"]);
    }else{
        header("Location: exam_list.php");
        die();
    }

}else{
    header("Location: exam_list.php");
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exams Page</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/bootstrap.min.js"></script>
    <style >
        @media screen and (max-width:740px){
            .d-flex{
                flex-direction: column-reverse;
            }
           
        }
    </style>
</head>
<body>
	<nav class="navbar navbar-light bg-light shadow-sm">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1"><h4><b>M.A.U CSC</b></h4></span>
        </div>
    </nav>
    <section class="d-flex justify-content-around pt-3">

    <div class="questions">
        <?php
	    echo "<h3>" . $exam_deatials["exam_name"] . "</h3>";
            $sn = count($questions);
            foreach($questions as $quest){
        ?>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header p-2">
                        <h5 class="modal-title"><?php echo $sn . ". " . $quest["question"]; ?></h5>
                    </div>
                    <div class="modal-body p-2">
                        <?php
                             echo "<p>A. " . $quest["A"] . "</p>";
                             echo "<p>B. " . $quest["B"] . "</p>";
                             echo "<p>C. " . $quest["C"] . "</p>";
                             echo "<p>D. " . $quest["D"] . "</p>";
                        ?>
                    </div>
                    <div class="modal-footer p-2"> <?php
                    echo "<b>Ans: " . $quest["Ans"] . "</b>";
                    echo "<a class='btn btn-danger'href='delete_question.php?id=" . $exam_deatials["ID"] . "&q=" . $quest["id"] . "'>Del</a>";
                    ?>

                    </div>
                </div>
            </div>
            <?php $sn--; } ?>
    </div>

    <div >
        <form action="sub_question.php" method="post" class="card p-2">
        <h2>Add Question</h2>
        <input type="hidden" name="db" value=<?php echo $_GET["id"]; ?> >
        <input type="hidden" name="n" value=<?php echo $exam_deatials["no_question"]; ?> >
            <div class="mb-2 mt-3 input-group">
            <span class="input-group-text">Question</span>
                <textarea name="question" id="question" rows="2" class="form-control clr" required></textarea>
            </div>
            <div class="mb-2 input-group">
                <span class="input-group-text">A</span>
                <input type="text" name="A" id="A" class="form-control clr" placeholder="Enter option A" required>
            </div>

            <div class="mb-2 input-group">
            <span class="input-group-text">B</span>
                <input type="text" name="B" id="B" class="form-control clr" placeholder="Enter option B" required>
            </div>

            <div class="mb-2 input-group">
            <span class="input-group-text">C</span>
                <input type="text" name="C" id="C" class="form-control clr" placeholder="Enter option C" required>
            </div>

            <div class="mb-2 input-group">
            <span class="input-group-text">D</span>
                <input type="text" name="D" id="D" class="form-control clr" placeholder="Enter option D" required>
            </div>
            <div class="mb-3 input-group">
            <span class="input-group-text">Duration(sec)</span>
                <input type="number" name="sec" id="D" class="form-control clr" placeholder="time(seconds)" required>
            </div>
            <div  class="mb-2 input-group">
            <span class="input-group-text">Answer</span>
                <select name="Ans" id="selAns" class="form-select clr">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
                <br>
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
       
    </section>
</body>
</html>