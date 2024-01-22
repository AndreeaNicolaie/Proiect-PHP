<?php
include("conectare.php");
$error = '';
if (isset($_POST['submit'])) {
    $nume = htmlentities($_POST['nume'], ENT_QUOTES);
    $prenume = htmlentities($_POST['prenume'], ENT_QUOTES);
    $email = htmlentities($_POST['email'], ENT_QUOTES);
    $telefon = htmlentities($_POST['telefon'], ENT_QUOTES);
    $bio = htmlentities($_POST['bio'], ENT_QUOTES);

    if ($nume == '' || $prenume == '' || $email == '' || $telefon == '' || $bio == '') {
        $error = 'ERROR: Campuri goale!';
    } else {
        if ($stmt = $mysqli->prepare("INSERT INTO speaker(Nume, Prenume, Email, Telefon, Bio) VALUES (?, ?, ?, ?, ?)")) {
            $stmt->bind_param("sssss", $nume, $prenume, $email, $telefon, $bio);
            $stmt->execute();
            $stmt->close();
        } else {
            echo "ERROR: Nu se poate executa insert.";
        }
    }
}
$mysqli->close();
?>
<html>

<head>
    <title><?php echo "Inserare inregistrare"; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1><?php echo "Inserare inregistrare"; ?></h1>
    <?php
    if ($error != '') {
        echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
    }
    ?>
    <form action="" method="post">
        <div>
            <strong> Nume: </strong> <input type="text" name="nume" value="" /> <br />
            <strong> Prenume: </strong> <input type="text" name="prenume" value="" /> <br />
            <strong> Email: </strong> <input type="text" name="email" value="" /> <br />
            <strong> Telefon: </strong> <input type="text" name="telefon" value="" /> <br />
            <strong> Bio: </strong> <input type="text" name="bio" value="" /> <br />
            <br />
            <input type="submit" name="submit" value="Submit" />
            <a href="vizualizare_speaker.php">Index</a>
        </div>
    </form>
</body>

</html>

