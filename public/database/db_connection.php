<?php
$host = 'localhost';
$dbName = 'd6_assessment';
$user = 'root';
$password = '';

$connection = new mysqli($host, $user, $password, $dbName);

if ($connection->connect_error) {
    die('Database connection failed: ' . $connection->connect_error);
}