<?php
// Informatii conectare
$hostname = 'localhost';
$username = 'root';
$password = '';
$db = 'eveniment2';

// Încercați să vă conectați folosind informațiile de mai sus
$mysqli = mysqli_connect($hostname, $username, $password, $db);
if (!mysqli_connect_errno()) {
    echo 'Conectat la baza de date: '.$db;
    //$mysqli->close();
}
else{
    echo 'Nu se poate conecta';
    exit();
}

?>