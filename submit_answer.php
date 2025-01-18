<?php
session_start();
    
    #var_dump($_POST);
    $_SESSION["answers"][$_POST['q_id']] = $_POST;
    var_dump($_SESSION["answers"][$_POST['q_id']]);

?>