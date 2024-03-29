<html>

<head>
    <title>Vizualizare Inregistrari</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Inregistrarile din tabela speaker</h1>
    <p><b>Toate inregistrarile din speaker</b></p>
    <?php
    include("conectare.php");

    // Interogarea SQL
    $sql = "SELECT * FROM speaker ORDER BY ID_Speaker";
    $result = $mysqli->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            echo "<table border='1' cellpadding='10'>";
            echo "<tr><th>ID Speaker</th><th>Nume</th><th>Prenume</th><th>Email</th><th>Telefon</th><th>Bio</th><th></th><th></th></tr>";

            while ($row = $result->fetch_object()) {
                echo "<tr>";
                echo "<td>" . $row->ID_Speaker . "</td>";
                echo "<td>" . $row->Nume . "</td>";
                echo "<td>" . $row->Prenume . "</td>";
                echo "<td>" . $row->Email . "</td>";
                echo "<td>" . $row->Telefon . "</td>";
                echo "<td>" . $row->Bio . "</td>";
                echo "<td><a href='modificare.php?id=" . $row->ID_Speaker . "'>Modificare</a></td>";
                echo "<td><a href='stergere.php?id=" . $row->ID_Speaker . "'>Stergere</a></td>";
                echo "</tr>";
            }
            echo "</table>";

        } else {
            echo "Nu sunt inregistrari in tabela!";
        }
    } else {
        echo "Error: " . $mysqli->error;
    }
    $mysqli->close();
    ?>
    <a href="inserare_speaker.php">Adaugarea unei noi inregistrari</a>
    <a href="style.html">Home</a>
</body>

</html>
