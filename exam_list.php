<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exams Page</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/bootstrap.min.js"></script>
    <style>
        @media screen and (max-width:740px){
            .d-flex{
                flex-direction: column;
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
	<div class="p-3 card">
        <h2>Add exam</h2>
        <form action="sub_new_exam.php" method="post">
            <div class="mb-3 mt-3">
                <label for="exname" class="form-label">Exam name</label>
                <input type="text" name="exam_name" id="exname" class="form-control" placeholder="Enter Exam name">
            </div>
            <div class="mb-3">
                <label for="exnquestion" class="form-label">Total number of question</label>
                <input type="number" name="exam_nquestion" id="exnquestion" class="form-control" placeholder="Enter NO. question">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
    <div class="exam-table card ">
        <table class="table table-hover">
            <thead>
            <tr> <th>S/N</th><th>Exam</th><th>Set</th><th>Questions</th> <th>Action</th> <th>Result</th></tr>
            </thead>
            <tbody>
                <?php
                    require_once "includes/DbObject.inc.php";
                    $data = new DBObject();

                    $exams = $data->fetch_exams();
                    $s_n = 1;
                    foreach($exams as $exam){
                        #htmlspecialchars( $exam["duration"])
                        $exam_id = htmlspecialchars( $exam["ID"]);
                        $exam_name = htmlspecialchars( $exam["exam_name"]);
                        $no_question =  htmlspecialchars($exam["no_question"]);
			?>
                        <tr>
			<td><?php echo $s_n ?></td>
			<td><?php echo "<a href='set_questions.php?id=" . $exam_id . "'>$exam_name</a>"; ?></td>
			<td><?php echo "<a href='set_default_ex.php?exam_id=". $exam_id . "' class='btn btn-warning'> Activate</a>"; ?></td>
			<td><?php echo $no_question ?></td>
			<td><?php echo "<a href='delete_exam.php?id=". $exam_id . "'class='btn btn-danger'>DEL</a>"; ?></td>
			<td><?php echo "<a href='result.php?id=". $exam_id . "' class='btn btn-info'>Result</a>"; ?></td>
			</tr>
			<?php
                        $s_n++;
                    } 
                ?>
               
            </tbody>
            </table>
    </div>
       
    </section>
</body>
</html>