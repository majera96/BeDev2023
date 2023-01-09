<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
//1. Kreirajte datoteku obrazac.php i kreirajte obrazac (vidi sliku). 
//Obrazac treba poslati podatke na obradu datoteci "obrada.php".
?>

<form action="obrada.php" method="post">
        <label>Ime</label>
        <input type="text" name="ime">
        <br />
        <label>Prezime</label>
        <input type="text" name="prezime">
        <br />
        <button type="submit" name="posalji">Pošalji</button>
    </form> 
    
</body>
</html>