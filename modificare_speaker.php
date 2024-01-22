<?php
include("Conectare.php");

$error = '';

if (!empty($_POST['id'])) {
    if (isset($_POST['submit'])) {
        if (is_numeric($_POST['id'])) {
            $id = $_POST['id'];
            $nume = htmlentities($_POST['nume'], ENT_QUOTES);
            $prenume = htmlentities($_POST['prenume'], ENT_QUOTES);
            $email = htmlentities($_POST['email'], ENT_QUOTES);
            $telefon = htmlentities($_POST['telefon'], ENT_QUOTES);
            $bio = htmlentities($_POST['bio'], ENT_QUOTES);

            if ($nume == '' || $prenume == '' || $email == '' || $telefon == '' || $bio == '') {
                echo "<div> ERROR: Completati campurile obligatorii!</div>";
            } else {
                if ($stmt = $mysqli->prepare("UPDATE speaker SET Nume=?, Prenume=?, Email=?, Telefon=?, Bio=? WHERE ID_Speaker='" . $id . "'")) {
                    $stmt->bind_param("sssss", $nume, $prenume, $email, $telefon, $bio);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    echo "ERROR: nu se poate executa update.";
                }
            }
        } else {
            echo "id incorect!";
        }
    }
}
?>

<html>

<head>
    <title> <?php if ($_GET['id'] != '') {
                echo "Modificare inregistrare";
            } ?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1><?php if ($_GET['id'] != '') {
            echo "Modificare Inregistrare";
        } ?></h1>

    <?php if ($error != '') {
        echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
    } ?>

    <form action="" method="post">
        <div>
            <?php if ($_GET['id'] != '') { ?>
                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
                <p>ID: <?php echo $_GET['id'];
                        if ($result = $mysqli->query("SELECT * FROM speaker WHERE ID_Speaker='" . $_GET['id'] . "'")) {
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_object(); ?></p>
                                <strong>Nume: </strong> <input type="text" name="nume" value="<?php echo $row->Nume; ?>" /><br />
                                <strong>Prenume: </strong> <input type="text" name="prenume" value="<?php echo $row->Prenume; ?>" /><br />
                                <strong>Email: </strong> <input type="text" name="email" value="<?php echo $row->Email; ?>" /><br />
                                <strong>Telefon: </strong> <input type="text" name="telefon" value="<?php echo $row->Telefon; ?>" /><br />
                                <strong>Bio: </strong> <input type="text" name="bio" value="<?php echo $row->Bio; ?>" /><br />
            <?php }
                        }
                    } ?>
            <br />
            <br />
            <input type="submit" name="submit" value="Submit" />
            <a href="vizualizare_speaker.php">Index</a>
        </div>
    </form>
</body>

</html>

