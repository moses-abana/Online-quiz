<?php


class DBObject{
   private $dsn = "mysql:host=localhost;dbname=csc102";
   private $dbname = "root";
   private $dbpassword = "";


   public function create_exam($ex_name,$ex_nquestion){

        $pdo = $this->connect();
        $add_entity = "INSERT INTO exam_list(exam_name,no_question) VALUES(?,?); ";
        #Adds a new exam entity, and then get it id, so as to create tables
        $stm1 = $pdo->prepare($add_entity);
        $stm1 ->execute([$ex_name,$ex_nquestion]);
        $id = $this->get_exam_id($ex_name)["ID"];

        #create tables for the exam question and result.
        $exam_id = "exam" . (string)$id;
        $exam_result = $exam_id . "_result";

        $this->create_question($exam_id);
        $this->create_result($exam_result);

   }

   public function delete_exam($id){
    $id0 = (string)$id;
    $pdo = $this->connect();
    $stm = $pdo->prepare("DELETE FROM exam_list WHERE ID = :id");
    $stm->bindParam(":id", $id0);
    $stm->execute();
    $this->on_delete_exam("exam" . $id0);
   
   }
   public function get_question_by_id(int $question_id, string $question_table){
    $pdo = $this->connect();
    #fetch a question base on the parameter.
    $query = "SELECT id,question,A,B,C,D FROM $question_table WHERE id = :id_no;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":id_no",$question_id);

    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
   }

   public function veiw_result($db){
	$result = $db . "_result";
	$pdo = $this->connect();
	$stm = $pdo->prepare("SELECT * FROM $result");
	$stm->execute();
	$results = $stm->fetchAll(PDO::FETCH_ASSOC);
	return $results;
	}

   public function connect(){
    try {
        $pdo = new PDO($this->dsn,$this->dbname,$this->dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     } catch (PDOException $th) {
         echo "Connection failed" . $th->getMessage();
     }

     return $pdo;
   }

   public function number_of_questions($table_name){
       $sq = "SELECT COUNT(*) FROM $table_name;";
       $res = $this->connect()->query($sq);
       $count = $res->fetchColumn();

       return $count;
   }

   public function fetch_exams(){
       $pdo = $this->connect();

       $sql = "SELECT * FROM exam_list ORDER BY ID DESC;";
       $stm = $pdo->prepare($sql);
        $stm->execute();
       $result = $stm->fetchAll(PDO::FETCH_ASSOC);

       return $result;
   }

   public function fetch_questions($id){
       $table = "exam" . $id;
       $result = false;
       $pdo = $this->connect();
       try{

        $stm = $pdo->prepare("SELECT * FROM $table ORDER BY id DESC");
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

       }catch (PDOException $th) {
        echo "Exam doesn't exist <br>";
        }
       return $result;
   }

    public function insert_question($db, $question, $A, $B, $C, $D, $Ans, $sec){
        $pdo = $this->connect();
        $stm = $pdo->prepare("INSERT INTO $db(question,A,B,C,D,Ans,sec) VALUES(?,?,?,?,?,?,?);");
        $stm->execute([$question, $A, $B, $C, $D, $Ans,$sec]);
        }

   protected function create_question($db){
        $pdo = $this->connect();
        $stm = $pdo->prepare(" CREATE TABLE $db(
            id INT NOT NULL AUTO_INCREMENT ,
            question TEXT NOT NULL ,
            A VARCHAR(300) NOT NULL ,
            B VARCHAR(300) NOT NULL ,
            C VARCHAR(300) NOT NULL ,
            D VARCHAR(300) NOT NULL ,
            Ans CHAR(1) NOT NULL ,
	    sec INT NOT NULL,
            PRIMARY KEY  (id)
        );");

        $stm->execute();
   }

   protected function create_result($db){
    $pdo = $this->connect();
    $stm = $pdo->prepare("CREATE TABLE $db(
        id INT NOT NULL AUTO_INCREMENT ,
        reg_no VARCHAR(80) UNIQUE NOT NULL ,
        dept  VARCHAR(80) NOT NULL ,
        grade CHAR(1) NOT NULL ,
        PRIMARY KEY  (id)
    );");

    $stm->execute();
   }

   protected function on_delete_exam($db){
        $result = $db . "_result";
        $pdo = $this->connect();
        $stm = $pdo->prepare("DROP TABLE $db; DROP TABLE $result;");
        $stm->execute();
   }

   public function get_exam_id($ex_name){
       $pdo = $this->connect();
       $stm = $pdo->prepare("SELECT ID FROM exam_list WHERE exam_name = :ex_name;");
       $stm->bindParam(":ex_name", $ex_name);
       $stm->execute();

       return $stm->fetch(PDO::FETCH_ASSOC);
   }

}
 
