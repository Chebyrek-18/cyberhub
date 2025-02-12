<?php
$host = "localhost";
$dbname = "hardware_store";
$username = "root";
$password = "";
try {
    $connect = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    die($e);
}
