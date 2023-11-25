<?php

 require_once("../model/bdd.php");

 if ($_SERVER["REQUEST_METHOD"]=="GET"){
    $idViatge = ($_GET["eliminarId"]);
    esborrarViatge($idViatge);
 }



 header("Location: ../vista/index.php?mensaje=Viatge+Esborrat");
 exit();
?>