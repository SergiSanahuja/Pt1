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

function insertarViatge($nom,$telefon,$numPersones,$preuFinal,$id_pais,$dataArribada,$dataFi){
    try{
        $connexio=obrirBDD();
        
        $sentencia= "INSERT INTO reserva (nom, telefon, num_persones, preu_final, descompte, id_pais, data_inici, data_fi) VALUES (:nom, :telefon, :num_persones, :preu_final, :descompte, :id_pais, :data_inici, :data_fi)";

        $array=array(':nom'=> $nom,':telefon'=> $telefon,':num_persones'=> $numPersones,':preu_final'=> $preuFinal,':id_pais'=> $id_pais,':data_inici'=> $dataArribada,':data_fi'=> $dataFi);
        
        executarSentencia($sentencia,$array,$connexio);

        
        $connexio=tancarBDD($connexio);
       
      }catch(Exception $e){
        
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



?>