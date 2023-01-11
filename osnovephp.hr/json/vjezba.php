<?php
// 1. Pročitajte podatke iz datoteke "polaznici.json", te ih ispišite u html tablicu (vidi sliku).
//2. Dodajte novog polaznika u datoteku "polaznici.json", te podatke iz nje ponovo ispišite.

// Čitanje sadržaja datoteke
$studentsJson = file_get_contents(__DIR__ . '/polaznici.json');
// Prebacivanje u niz
$students = json_decode($studentsJson, true);
?>

<!-- Ispis podataka u tablicu -->
<table border="1" cellpadding="10">
    <tr>
        <th>Ime</th> 
        <th>Prezime</th> 
        <th>Godine</th> 
        <th>Email</th> 
        <th>Telefon</th> 
    </tr>
    <?php
        foreach($students as $student){
            echo '<tr>';
            echo '<td>'. $student['ime'] .'</td>';
            echo '<td>'. $student['prezime'] .'</td>';
            echo '<td>'. $student['godine'] .'</td>';
            echo '<td>'. $student['email'] .'</td>';
            echo '<td>'. $student['telefon'] .'</td>';
            echo '</tr>';
        }
    ?>
</table>

<?php
// Dodavanje novog polaznika
$students[] = [
    "ime" => "Novi",        
    "prezime" => "Polaznik",        
    "godine" => 48,        
    "email" => "novi.polaznik@gmail.com",        
    "telefon" => 38597666777
];
// Transformiranje u JSON
$studentsJson = json_encode($students);
// Zapisivanje novih podataka u datoteku
file_put_contents(__DIR__ . '/polaznici.json', $studentsJson); 

// Čitanje sadržaja datoteke
$studentsJson = file_get_contents(__DIR__ . '/polaznici.json');
// Prebacivanje u niz
$students = json_decode($studentsJson, true);
?>

<!-- Ispis podataka u tablicu -->
<table border="1" cellpadding="10">
    <tr>
        <th>Ime</th> 
        <th>Prezime</th> 
        <th>Godine</th> 
        <th>Email</th> 
        <th>Telefon</th> 
    </tr>
    <?php
        foreach($students as $student){
            echo '<tr>';
            echo '<td>'. $student['ime'] .'</td>';
            echo '<td>'. $student['prezime'] .'</td>';
            echo '<td>'. $student['godine'] .'</td>';
            echo '<td>'. $student['email'] .'</td>';
            echo '<td>'. $student['telefon'] .'</td>';
            echo '</tr>';
        }
    ?>
</table>