<?php
session_start();
if((!isset($_SESSION["exam_name"]))||(!isset($_SESSION["reg_no"]))){

	header("Location: index.php");
	die();
}
$full_name = $_SESSION['surname'] . " ". $_SESSION['firstname'] ." ". $_SESSION['othernames'];
$exam_name = $_SESSION["exam_name"]; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $exam_name ?></title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="setup.js"></script>
    <style>
       
    </style>
</head>
<body>
    <nav class="navbar navbar-light bg-light shadow-sm">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1"><h4><b>M.A.U CSC</b></h4></span>
        </div>
    </nav>
    <div class="paper modal-dialog mt-3">
        <div class="candate-details">
            <div class="mb-0 input-group">
                    <span class="input-group-text">COURSE</span>
                   <?php echo "<input type='text' class='form-control detail' value='" . $exam_name . "' readonly>"; ?>
            </div>
            <div class="mb-0 input-group">
                    <span class="input-group-text">ID NO.</span><?php
                    echo "<input type='text' class='form-control detail' value='".  $_SESSION["reg_no"] ."' readonly>";
                    ?>
            </div>
            <div class="mb-0 input-group">
                    <span class="input-group-text">NAME</span>
                    <?php
                    echo "<input type='text' class='form-control detail' value='$full_name' readonly>";
                    ?>
            </div>
        </div>
        <div class="modal-dialog mt-1 mb-0">
            <div class="modal-content bg-light">
                <div class="modal-header pt-1 pb-1 ">
                    <h3 class="shadow-sm p-1 ps-3 pe-3 bg-body rounded mx-auto" id="timer">0s</h3>
                    <a href="end_exam.php" class="btn-outline-danger btn">End Exam</a>
                </div>
                <div class="modal-body">
                    <p id="question">1.</p>
                    <form action="" method="post">   
                        <div class="form-check">
                            <input class="form-check-input" type="radio" onclick="submitOnClick()" name="ans" value="A" id="A">
                            <label class="form-check-label" id="opA" for="A">A.</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" onclick="submitOnClick()" name="ans" value="B" id="B">
                            <label class="form-check-label" id="opB" for="B">B.</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" onclick="submitOnClick()" name="ans" value="C" id="C">
                            <label class="form-check-label" id="opC" for="C">C.</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" onclick="submitOnClick()" name="ans" value="D" id="D">
                            <label class="form-check-label" id="opD" for="D">D.</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-between pt-1 pb-1">
                <button type="button" class="btn btn-success" id="prev" onclick="load_question(-1)">Prev</button>
                <span class="progress">1/4</span>
                <button type="button" class="btn btn-success" id="next" onclick="load_question(1)">Next</button>
            </div>
            </div>
           
        </div> 
    </div> 

       <script src="app.js"></script>
</body>
</html>