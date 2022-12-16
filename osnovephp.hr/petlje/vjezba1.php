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

// 1. Koristeći vježbu while, ispišite prvih deset brojeva.
$i = 1;   

while($i<=10){
        echo $i, ' ';
        $i++;
    }

    echo '<hr />';

//2. Koristeći petlju for, ispišite sve parne brojeve do 100.
for ($i = 1; $i <= 100; $i++) {
    if ($i % 2 === 0 && $i !== 0) {
        echo $i, ' ';
    }
}
    ?>
</body>
</html>