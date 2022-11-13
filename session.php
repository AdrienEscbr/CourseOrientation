<?php
    session_start();
    if(empty($_SESSION['id']))
    {
      header('Location: http://localhost/CourseOrientation/eleve/eleve.php');
    }

?>