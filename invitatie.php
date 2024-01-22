<?php
// Verificați dacă formularul a fost trimis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesați datele primite din formular
    $nume_partener = $_POST["nume_partener"];
    $email_partener = $_POST["email_partener"];
    $mesaj = "Salutare $nume_partener! Ești invitat la evenimentul nostru.";

    // Trimite e-mailul
    $subject = "Invitație la Eveniment";
    $headers = "From: your_email@example.com"; // Schimbați cu adresa dvs. de e-mail
    $success = mail($email_partener, $subject, $mesaj, $headers);

    // Verificați dacă e-mailul a fost trimis cu succes
    if ($success) {
        $message = "Invitația a fost trimisă cu succes către $email_partener.";
    } else {
        $error = "Eroare la trimiterea invitației.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trimitere Invitație</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h2 {
            color: pink;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: pink;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #d64021;
        }

        .success {
            color: #4caf50;
        }

        .error {
            color: #e44d26;
        }
    </style>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h2>Trimitere Invitație</h2>
        <?php
        if (isset($message)) {
            echo '<p class="success">' . $message . '</p>';
        }
        if (isset($error)) {
            echo '<p class="error">' . $error . '</p>';
        }
        ?>
        <label for="nume_partener">Nume:</label>
        <input type="text" name="nume_partener" required>

        <label for="email_partener">E-mail:</label>
        <input type="email" name="email_partener" required>

        <input type="submit" value="Trimite Invitație">
    </form>
</body>
</html>
