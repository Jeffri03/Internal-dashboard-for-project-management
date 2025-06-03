<?php
$servername = 'localhost'; // or 'localhost:3306'
$username = 'root';
$password = '';
$dbname = 'projectmanagement';

$mysqli = mysqli_connect($servername, $username, $password, $dbname);

if ($mysqli) {
    echo "";
} else {
    die("Connection failed: " . mysqli_connect_error());
}
?>