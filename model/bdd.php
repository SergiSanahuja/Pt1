<?php 
//Eric Rubio Sanchez
require_once("env.php");

/**
 * Summary of obrirBDD
 *    Retorna un PDO si s'ha pogut conectar al servidor o un null si no ha pogut conectarse.
 * @return PDO|null
 */	
function obrirBDD() : PDO{
    try {
      // Ens connectem a la base de dades
      //crearem nou objecte PDO (connexió,base_de_dades,usuari,password);
      $connexio = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
      return $connexio;
    } catch(PDOException $e){ //
  
  
      return null;
    }   
    
}

/**
 * Summary of executarSentencia
 *      En aquesta funcio executem les sentencies SQL.
 * @param string $sentencia Sentencia MySQL
 * @param array $array      Array que porta les variables
 * @param PDO $connexio     Conexio a la BDD
 * @return array|false retorna una array per els SELECTS i un false per la resta.
 */
function executarSentencia($sentencia,$array,$connexio){

    // Preparem la consulta SQL
    $statement = $connexio->prepare($sentencia);
  
    // Executem la consulta
    $statement->execute($array);
  
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  
    return $result;
  
}

/**
 * @param number $id_continent
 * Seleccio de tots els paisos d'un continent
 * 
 */
function paisContinent($id_continent){

  try{
    $connexio=obrirBDD();
    
    $sentencia= "Select * from pais where id_continente=:id_continent";

    $array=array(':id_continent'=> $id_continent);
    
    $result= executarSentencia($sentencia,$array,$connexio);

    
    $connexio=tancarBDD($connexio);
    return $result;
  }catch(Exception $e){
    
    return null;

  }
}


/**
 * @param string $nom_pais
 * @param number $telefon
 * @param number $numPersones
 * @param number $preuFinal
 * @param string $nomPais
 * @param boolean $descompte
 * @param string $dataArribada
 * @param string $dataFi
 * 
 * insertar el viatge a la bd
 */
function insertarViatge($nom,$telefon,$numPersones,$preuFinal,$nomPais,$descompte,$dataArribada,$dataFi){
    try{
        $connexio=obrirBDD();
        
        $sentencia= "INSERT INTO reserves (nom, telefon, num_persones, preu_final, descompte, nom_pais, data_inici, data_fi) VALUES (:nom, :telefon, :num_persones, :preu_final, :descompte, :nom_pais, :data_inici, :data_fi)";

        $array=array(':nom'=> $nom,':telefon'=> $telefon,':num_persones'=> $numPersones,':preu_final'=> $preuFinal,':descompte'=> $descompte,':nom_pais'=> $nomPais,':data_inici'=> $dataArribada,':data_fi'=> $dataFi);
        
        executarSentencia($sentencia,$array,$connexio);

        
        $connexio=tancarBDD($connexio);
       
      }catch(Exception $e){
        echo($e);
        return null;
    
      }

}

/**
 * Crear la taula la qual mostra els viatges guardats a la bd
 */
function mostarViatges($ordre){
  try{
    $connexio=obrirBDD();
    if($ordre=="Pais"){
      $sentencia= "SELECT * FROM reserves ORDER BY nom_pais";
    }elseif($ordre=="DataInici"){
      $sentencia= "SELECT * FROM reserves ORDER BY data_inici";
    }elseif($ordre=="id"){
      $sentencia= "SELECT * FROM reserves ORDER BY id";
    }
    $array=array();
    
    $resultat=executarSentencia($sentencia,$array,$connexio);
    
    $connexio=tancarBDD($connexio);

    // $html="<table id='viatges'><thead><td>id</td><td>'nom'</td><td>'Telefon'</td><td>'Persones'</td><td>'Preu'</td><td>'Descompte'</td><td>'Pais'</td><td>'Data Inici'</td><td>'Data Fi'</td><td>'Imatge'</td></thead>";
    // foreach ($resultat as $viatge) {
    //   $html.="<tr>";
    //   $html.="<td>".$viatge["id"]."</td>"."<td>".$viatge["nom"]."</td>"."<td>".$viatge["telefon"]."</td>"."<td>".$viatge["num_persones"]."</td>"."<td>".$viatge["preu_final"]."</td>"."<td>".$viatge["descompte"]."</td>"."<td>".$viatge["nom_pais"] ."</td>"."<td>".$viatge["data_inici"]."</td>"."<td>".$viatge["data_fi"]."</td>"."<td> <img src="."../img/".$viatge["nom_pais"].".jpg></img></td>";
    //   $html.="</tr>";
    // }
    // $html.="</table>";


    $html="";
    foreach ($resultat as $viatge) {
      $html.="<div class='viatge'>";
      $html.="<div class='imatge'><img src="."../img/".$viatge["nom_pais"].".jpg class='imatge'></img></div>";
      $html.="<div class='info'>";
      $html.="<div class='nom'>".$viatge["nom"]."</div>";
      $html.="<div class='telefon'>".$viatge["telefon"]."</div>";
      $html.="<div class='persones'>".$viatge["num_persones"]."</div>";
      $html.="<div class='preu'>".$viatge["preu_final"].'€'."</div>";
      $html.="<div class='pais'>".$viatge["nom_pais"] ."</div>";
      $html.="<div class='dataInici'>".$viatge["data_inici"]."</div>";
      $html.="<div class='dataFi'>".$viatge["data_fi"]."</div>";
      $html.="</div>";
      $html.="<div class='eliminar' id='eliminar'>"."<a href='../controlador/esborrar.php?eliminarId=".$viatge['id']."'><button type='button' class='btn'><i class='fa fa-trash'></i></button></a>"."</div>";
      $html.="</div>";
    }
    

   return $html;
  }catch(Exception $e){
    echo($e);
    return null;

  }
}

/**
* Summary of tancarBDD
* @param PDO $connexio
* @return null
*/
function tancarBDD($connexio){
    $connexio=null;
    return $connexio;
    }


function esborrarViatge($idViatge){
$conn=obrirBDD();

$sentencia="DELETE FROM reserves WHERE id=:idViatge";

$array=array(':idViatge'=> $idViatge);

executarSentencia($sentencia,$array,$conn);

$conn=tancarBDD($conn);
}


?>