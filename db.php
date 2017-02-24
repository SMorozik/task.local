<?php 

$host = 'localhost';
$db = 'task';
$charset = 'UTF8';
$username = 'root';
$password = '';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$opt = array(
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION
);

$pdo = new PDO($dsn, $username, $password, $opt);

?>