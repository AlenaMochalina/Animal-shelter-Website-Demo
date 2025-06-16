<?php

    $db_host = "127.0.0.1";
    $db_user = "AlenaMochalina";
    $db_password = "admin123";
    $db_name = "zvířata";

    $connection = mysqli_connect($db_host,$db_user,$db_password, $db_name);

    if (mysqli_connect_error()){
        echo mysqli_connect_error();
        exit;
    }

    echo "Přihlášení do databáze.";

    $sql = "SELECT Druh FROM adopce";
    //echo "<br>";

    $result = mysqli_query($connection, $sql);
    //var_dump($result);
    //echo "<br>";
    //echo "<br>";
    $animals = mysqli_fetch_all ($result);
    //var_dump($animals);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <div class ="container">
    <h1> Naši kamarádi hledají domov</h1>
    <img src="shelter-16.jpg" style="width:20%;" alt="">
    <img src="shelter-17.jpg" style="width:20%;" alt="">
    <img src="shelter-18.jpg" style="width:20%;" alt="">
    <p>Podívejte se na naše úžasné chlupaté kamarády, kteří čekají na nový domov.
        Pokud vás některý z nich zaujal, neváhejte vyplnit adopční formulář.</p>

     <h3>Seznam zvířat k adopci</h2>
     <?php
     // Dotaz na 7 zvířat
$sql = "SELECT Plemeno, Popis, Věk, obrazek FROM adopce LIMIT 7";
$result = mysqli_query($connection, $sql);

     // HTML tabulka
echo "<table border='1'>";
echo "<tr><th>Fotografie</th><th>Plemeno</th><th>Popis</th><th>Věk</th></tr>";

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
         // Cesta k obrázkům 
        $cestaKObrazku = "../image-library/" . htmlspecialchars($row["obrazek"]);
        echo "<td> <a href='$cestaKObrazku' data-lightbox='zvire' data-title='" . htmlspecialchars($row["Plemeno"]) . "'>
            <img src='$cestaKObrazku' alt='zvíře' width='100'>
        </a></td>";
        echo "<td>" . htmlspecialchars($row["Plemeno"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["Popis"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["Věk"]) . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>Žádná zvířata k adopci nebyla nalezena.</td></tr>";
    
}

echo "</table>";

mysqli_close($connection);
?>

     <h2>Adopční formulář</h2>
    <form>
        <input type="text" name="first_name" placeholder="Křestní jméno"><br>
        <input type="text" name="second_name" placeholder="Příjmení"><br>
        <input type="email" name="email" placeholder="E-mail"><br>
        <input type="telefon" name="telenon" placeholder="Telefon"><br>
        <input type="hidden" name="form-type" value="kontakt">
        <textarea name="message" placeholder="Vaše zpráva"></textarea><br>
        <!-- <input type="submit" value="Registrovat"> -->
        <button>Odeslat</button>
     </form> <br> <br>
    <a href="mainPage.php">Zpět na úvodní stránku</a> 
    <br>
    <br>
    <br>
    <br>
    </div>
</body>
</html>