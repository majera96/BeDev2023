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
    //1. Definirajte varijable a,b,c te im istim redoslijedom dodjelite vrijednosti 5,10,15.
$a = 5;
$b = 3;
$c = 15;

//2. Koristeći uvjetovani tip kontrolne strukture provjerite je li vrijednost b između a i c. 
if(($a < $b && $a < $c) || ($)){
    echo "Točno. $b je između $a i $c, <br />";
} else {
    echo 'Netočno';
}

// 3. Ako je uvjet istinit, ispišite da je b između a i c,a ako je lažan ispišite da nije.
 // Isto rješenje.

//4. Kod mora raditi i ako zamjenimo vrijednosti u varijablama a i c.
 // Radi.



?>
</body>
</html>