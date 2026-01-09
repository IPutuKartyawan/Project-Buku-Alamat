<?php

$host = "localhost";
$dbname = "buku_alamat";
$username = "root";
$password = "";


$pdo = null;

try {

    $dsn = "mysql:host=$host;dbname=$dbname;charset=UTF8";

    $pdo = new PDO($dsn, $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $exception) {

    echo "Koneksi database gagal. ";
    echo "Pesan error: " . $exception->getMessage();
    exit;
}
