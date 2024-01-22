<?php
if (!isset($_SESSION["loggedin"])) {
    header("Location: style.html");
    exit;
}
?>
