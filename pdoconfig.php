<?php

$host = 'localhost';
$db   = 'fxbrokerfund_db';
$user = 'fxbrokerfund_user';
$pass = 'Alabastar08160$';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
try {
     $con = new PDO($dsn, $user, $pass);
     $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\PDOException $e) {
     echo "Database connection failed: " . $e->getMessage();
}