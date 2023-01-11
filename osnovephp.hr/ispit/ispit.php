<?php

//1.Treba kreirati aplikaciju (vidi sliku) koja će iz datoteke
//words.json u desno tablicu ispisati sve riječi koje su analizirane.

//2. S lijeve strane treba kreirati obrazac kroz koji će se unositi nova riječ.

//3. Unesenu riječ treba obraditi na sljedeći način:
//  - polje ne smije biti prazno.
//  - izbrojiti broj slova u riječi.
//  - izbrojiti suglasnike i samoglasnike u riječi
//      (za ovu funkcionalost kreirajte funkcije.)


//4.Obrađenu riječ treba zapisati u words.json datoteku.

?>

<form action="">
    <label for="word">Upišite riječ</label>
    <input type="text" name="word" pattern="[a-zA-Z]{1,}" required>
    <input type="submit" value="Pošalji">
</form>

<?php

function isVowel($letter)
{
    $vowels = ['a','e','i','o','u'];

    return in_array($letter, $vowels);
}

$wordsJson = file_get_contents('words.json');
$words = json_decode($wordsJson, true);

if (!empty($_GET['word'])){
    //dohvatiti riječ
    $word = $_GET['word'];

    $numberOfLetters = 0;
    $numberOfVowels = 0;
    $numberOfConsonsants = 0;
    $vowels = ['a','e','i','o','u'];

    //proći kroz riječ i analizirati svako slovo
    foreach(str_split($word) as $wordLetter){
        //ustnoviti rdi li se o samoglasniku
        if (isVowel($wordLetter)){
        $numberOfVowels++;
        } else {
            $numberOfConsonsants++;
        }


        //brojati broj slova
        $numberOfLetters++;
    }

    //pripremiti za zapisivanje u datoteku i zapisati
    $wordToSave = [
        'word' => $word,
        'numberOfLetters' => $numberOfLetters,
        'numberOfVowels' => $numberOfVowels,
        'numberOfConsonants' => $numberOfConsonsants
    ];

    $words = [];
    $words[] = $wordToSave;

    file_put_contents('words.json', json_encode($words));
}

?>

<table border="1">
<tr>
    <th>Riječ</th>
    <th>Broj slova</th>
    <th>Broj suglasnika</th>
    <th>Broj samoglasnika</th>
</tr>
<?php
foreach($words as $word){
    echo '<tr>';
    echo '<td>'. $word['word'] . '</td>';
    echo '<td>'. $numberOfLetters['numberOfLetters'] . '</td>';
    echo '<td>'. $numberOfVowels['numberOfVowels'] . '</td>';
    echo '<td>'. $numberOfConsonsants['numberOfConsonstants'] . '</td>';
    echo '</tr>';
}
?>
</table>