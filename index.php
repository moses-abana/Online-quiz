<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/bootstrap.min.js"></script>
</head>
<body>
    <?php require_once "includes/nav_bar.php" ?>
    <div class="modal-dialog">
        <div class="modal-dialog mt-1 mb-0">
            <div class="modal-content bg-light">
                <div class="modal-header">
                    <h2>Enter your registration number</h2>
                </div>
                <div class="modal-body p-3">
                   <form action="" class="" method="post">
                        <input type='text' name="reg_no" class='form-control detail mb-2'>
                        <input type="submit"  class="btn btn-primary" value="Login">
                    </form>
                    <p class="mt-2"><b>-:- By ABANA Moses Samson </b></p>
                </div>
            </div>
           
        </div> 
    </div> 

    <?php	
        function is_id_valid($obj, string $matric_no)
    	{
       		$pdo = $obj->connect();

      	 $query = "SELECT * FROM student_record WHERE reg_no = :id_no;";
         $stmt = $pdo->prepare($query);
         $stmt->bindParam(":id_no",$matric_no);

          $stmt->execute();
          $result = $stmt->fetch(PDO::FETCH_ASSOC);

          return $result;
       
        }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
    	require_once "includes/connection.php";
    	$data = new Connection();

           $info = is_id_valid($data, $_POST["reg_no"]);
           if(!isset($info["reg_no"])){
                die();
    }


	function exam_name($obj,int $id){
           
           $pdo = $obj->connect();
           try{

             $stm = $pdo->prepare("SELECT exam_name FROM exam_list WHERE ID = :id ;");
	     $stm->bindParam(":id",$id);
             $stm->execute();
             $result = $stm->fetch(PDO::FETCH_ASSOC);
	     return $result;
           }catch (PDOException $th) {
               echo "Exam doesn't exist <br>";
		die();
            }
   	}
	
	if(exam_name($data, $info["exam_id"]) == false){
		echo "Their is NO EXAM FOR YOU";
		die();
	}

	   $_SESSION["exam_name"] = exam_name($data, $info["exam_id"])["exam_name"];
        $_SESSION["exam"] = ("exam" . (string)$info["exam_id"]);
        $_SESSION["reg_no"] = $info["reg_no"];
        $_SESSION["firstname"] = $info["firstname"];
        $_SESSION["surname"] = $info["surname"];
        $_SESSION["othernames"] = $info["othernames"];
       

        header("Location: exam.php");
        die();

    }
    ?>
</body>
</html>