<?php
//1. Kreirajte datoteku obrazac.php i u njoj kreirajte html obrazac
// za upload datoteke. Obrazac treba poslati podatke na obradu
//datoteci obrada.php.
?>

<form action="obrada.php" method="post" enctype="multipart/form-data">
    <input type="file" name="userfile">
    <input type="submit" value="Pošalji">
</form>