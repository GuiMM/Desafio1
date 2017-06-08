<?php

 $matricula = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["matricula"])) {
    $matriculaErr = "Matricula is required";
  } else {
    $matricula = $_POST["matricula"];
    // check if name only contains letters and whitespace
    if (!preg_match("/^[0-9]*$/",$matricula)) {
      $matriculaErr = "Only numbers allowed"; 
      
    }
  }
    
    
}

?>     