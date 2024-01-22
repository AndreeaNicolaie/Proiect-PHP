<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Event Details</title>
    <link rel="stylesheet" href="styles_event.css">
</head>
<body>
<?php
// Include your database connection file
include("conectare.php");

// Get the event ID from the URL
$event_id = isset($_GET['ID_Eveniment']) ? intval($_GET['ID_Eveniment']) : 0;

// Query your database for the details of the event with the given ID
if ($stmt = $mysqli->prepare("SELECT Nume_Eveniment, Descriere, Data_Start, Data_Finish, Locatie, Numar_Participant_Maxim, Image_Path FROM eveniment WHERE ID_Eveniment = ?")) {
    $stmt->bind_param("i", $event_id);
    $stmt->execute();
    $stmt->bind_result($nume_eveniment, $descriere, $data_start, $data_finish, $locatie, $numar_participanti_maxim, $Image_path);
    $stmt->fetch();
    $stmt->close();

    // Check if we got a result
    if ($nume_eveniment) {
        // Display the event details
        echo "<div class='event-container'>";
        echo "<h1>" . htmlspecialchars($nume_eveniment) . "</h1>";
        // Use the image path from the database
        echo "<img src='" . htmlspecialchars($Image_path) . "' alt='Event Image' class='event-image'>";
        echo "<p><strong>Date Start:</strong> " . htmlspecialchars($data_start) . "</p>";
        echo "<p><strong>Date Finish:</strong> " . htmlspecialchars($data_finish) . "</p>";
        echo "<p><strong>Location:</strong> " . htmlspecialchars($locatie) . "</p>";
        echo "<p><strong>Maximum Participants:</strong> " . htmlspecialchars($numar_participanti_maxim) . "</p>";
        echo "<p><strong>Description:</strong> " . htmlspecialchars($descriere) . "</p>";
        echo "</div>";
    } else {
        echo "<p>Event details not found.</p>";
    }
} else {
    // Handle errors
    error_log('MySQL error: ' . $mysqli->error);
    echo "<p>Error retrieving event details. Please try again later.</p>";
}
// Close your database connection
$mysqli->close();
?>
</body>
</html>
