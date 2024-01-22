<?php
if (!isset($_SESSION["admin_loggedin"])) {
    header("Location: style.html");
    exit;
}
?>
