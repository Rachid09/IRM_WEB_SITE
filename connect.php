<?php

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = "irm_site";

try {
    $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $err) {
    echo 'connection failed' . $err->getMessage();
}
