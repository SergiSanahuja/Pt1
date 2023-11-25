<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">  
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../vista/style.css">
    <script defer src="../controlador/controlador.js"></script>
</head>
<body>

<?php require_once'../controlador/controlador.php'; ?>
<table id="tablaPaises" hidden>
        <?php echo $paisEuropa;
        echo $paisAmerica;
        echo $paisAsia;
        echo $paisOceania;
        echo $paisAfrica;
         ?>

    </table>
    <div class="navegació">

        <header>
            <div class ="logo">
                <img height="100px" src="../img/logo.png"></img>
            </div>
            <div class="titulo">
            wonderful travel
            </div>
            <div class="Rellotje">
                <div id="data" class="datahora"></div><br><br>
            </div>
        </header>
    </div>
    <div class="formulari">

        <div id="imagenes">
            
        </div>

        <form action="../controlador/controlador.php" method="post">
            <br>
            <label>
                Data Arribada: <br><input type="date" onchange='document.getElementById("dataFi").setAttribute("min", document.getElementById("dataArribada").value)' name="dataArribada" id="dataArribada" value="<?php if(isset($dataArribada)){echo $dataArribada;}?>" ><br>
                Data Fi:    <br>   <input type="date" name="dataFi" id="dataFi" value="<?php if(isset($dataFi)){echo $dataFi;}?>" >
            </label>
            <br>
            <label>
                Destí: <br>
                <select name="continent" id="continent" required>
                    <option value="0" selected>Selsecciona un pais</option>                
                    <option value="1" >Europa</option>
                    <option value="3">Asia</option>
                    <option value="2">America</option>
                    <option value="4">Oceania</option>
                    <option value="5">Africa</option>
            </select>
            
            <select name="pais" id="pais"  required>
                
                </select>
            </label>
            <br>
            <label>
                Preu: <br> <input type="text" name="preuFinal" id="preuFinal"  readonly> €
            </label>
            <br>
            <label>
                Nom: <br> <input type="text" name="nom" id="nom" required minlength="1" value="<?php if(isset($nom)){echo $nom;}?>" maxlength="10">
            </label>
            <br>
            <label>
                Telèf: <br> <input type="text" name="telefon" id="telefon" required minlength="9" maxlength="9" value="<?php if(isset($telefon)){echo $telefon;}?>" >
            </label>
            <br>
            <label>
                Persones: <br> <input type="number" name="numPersones" id="numPersones" required min="1" max="10" value="<?php if(isset($numPersones)){echo $numPersones;}?>" >
            </label>
            <br>
            <label>
                Descompte 20%
                <input type="checkbox" name="descompte" value="checked" id="descompte"/> 
            </label>
            <input type="submit" value="Afegir">
            <div id="mensaje">
            
            <?php 
                if(isset($_GET["mensaje"])){
                    echo($_GET["mensaje"]);
                    $_GET["mensaje"]="";
                }
            ?>
            </div>

        </form>
    </div>
        <div class="taulaViatges">
            
            <?php
             echo(mostarViatges());
            ?>
        </div>
        
    







    </body>
    
</html>