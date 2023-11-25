<?php

 require_once("../model/bdd.php");
   


$paisEuropa=generarTaula(1);
$paisAmerica=generarTaula(2);
$paisAsia=generarTaula(3);
$paisOceania=generarTaula(4);
$paisAfrica=generarTaula(5);

/*
$viatgesPais=mostarViatges("Pais");
$viatgesDataInici=mostarViatges("DataInici");
$viatgesDataInici=mostarViatges("id");
*/    




function generarTaula($num){
    $html="";

    $result=paisContinent($num);

    $html.="<tr>";
    foreach($result as $pais){
        $html.="<td>".$pais["nom_Pais"]."</td>";        
        $html.="<td>".$pais["preu_nit"]."</td>";   
        $html.="<td>".$pais["preu_vols"]."</td>";     
    }
    $html.="</tr>";
    
    return $html;

}


/**
 * Summary of tractarDades
 *    Aquesta funcio serveix per evitar l'injeccio de codi treient els espais, les '\' i convertint els caracters especial en entitats HTML.
 * @param string $data Qualsevol tipus d'string. 
 * @return string retorna l'string tractat.
 */



function tractarDades($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    //Agafem les variables del formulari i les enviem a una funcio del controlador en la que tartem d'evitar l'injeccio de codi.
    $dataArribada = tractarDades($_POST["dataArribada"]);
    $dataFi = tractarDades($_POST["dataFi"]);
    $nom = tractarDades($_POST["nom"]);
    $nomContinent = tractarDades($_POST["continent"]);
    $nomPais = tractarDades($_POST["pais"]);
    $telefon = tractarDades($_POST["telefon"]);
    $numPersones = tractarDades($_POST["numPersones"]);
    $preuFinal = tractarDades($_POST["preuFinal"]);
    if(isset($_POST["descompte"])){
        $descompte=true;
    }else{$descompte = false;}
    echo"<script>alert(".$preuFinal.")</script>";
   if($dataArribada&&$dataFi&&$nom&&$nomContinent&&$nomPais&&$telefon&&$numPersones&&$preuFinal){
    insertarViatge($nom,$telefon,$numPersones,$preuFinal,$nomPais,$descompte,$dataArribada,$dataFi);
    header("Location: ../vista/index.php?mensaje=Viatge+Afegit");
    exit();
   }
    //mostarViatges();

    //echo '<script>console.log("'.$descompte.$dataArribada. $dataFi. $nom. $nomContinent.$nomPais.$telefon.$numPersones.'");</script>';
    
}






/*
En la variable continents i paises ccodigo como este en un string

<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5" selected="selected">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
*/

require_once("../vista/index.php");
?>