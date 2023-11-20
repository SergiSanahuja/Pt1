<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../vista/style.css">
    <script defer src="../controlador/controlador.js"></script>
</head>
<body>
<?php require_once'../controlador/controlador.php'; ?>
    <div class="navegació">

        <header>
            <div class ="logo">
                <img height="100px" src="../img/logo.png"></img>
            </div>
            <div class="titulo">
                Wanderfull travel
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
                Data Arribada: <input type="date" onchange='document.getElementById("dataFi").setAttribute("min", document.getElementById("dataArribada").value)' name="dataArribada" id="dataArribada" value="<?php if(isset($dataArribada)){echo $dataArribada;}?>" ><br>
                Data Fi:       <input type="date" name="dataFi" id="dataFi" value="<?php if(isset($dataFi)){echo $dataFi;}?>" >
            </label>
            <br>
            <label>
                Destí:
                <select name="continent" id="continent" required>
                    <option value="0" selected>Selsecciona un pais</option>                
                    <option value="1" >Europa</option>
                    <option value="3">Asia</option>
                    <option value="2">America</option>
                    <option value="4">Oceania</option>
                    <option value="5">Africa</option>
                    <option value="6">Antartida</option>
            </select>
            
            <select name="pais" id="pais"  required>
                
                </select>
            </label>
            <br>
            <label>
                Preu:  <input type="text" name="preuFinal" id="preuFinal"  readonly> €
            </label>
            <br>
            <label>
                Nom: <input type="text" name="nom" id="nom" minlength="1" value="<?php if(isset($nom)){echo $nom;}?>" maxlength="10">
            </label>
            <br>
            <label>
                Telèf: <input type="text" name="telefon" id="telefon" minlength="9" maxlength="9" value="<?php if(isset($telefon)){echo $telefon;}?>" >
            </label>
            <br>
            <label>
                Persones: <input type="number" name="numPersones" id="numPersones" min="1" max="10" value="<?php if(isset($numPersones)){echo $numPersones;}?>" >
            </label>
            <br>
            <label>
                <input type="checkbox" name="descompte" value="checked" id="descompte"/> Descompte 20%
            </label>
            <input type="submit" value="Afegir">
        </form>
        <div id="viatges">
            Viatges Guardats
        </div>
        
    </div>
    






    <table id="tablaPaises" hidden>
        <?php echo $paisEuropa;
        echo $paisAmerica;
        echo $paisAsia;
        echo $paisOceania;
        echo $paisAfrica;
         ?>

    </table>
    </body>
    
</html>