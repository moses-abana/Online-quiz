<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exams Page</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/bootstrap.min.js"></script>
</head>
<body>
   <nav class="navbar navbar-light bg-light shadow-sm">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1"><h4><b>M.A.U CSC</b></h4></span>
        </div>
    </nav>

<?php

$db = "exam" . (string)$_GET["id"];
require_once "includes/DbObject.inc.php";
$data = new DBObject();

$results = $data->veiw_result($db);
foreach ($results as $result) {
   echo $result["reg_no"] . " -> " . $result["grade"];
   echo "<br>";
}
?>
</body>
</html>