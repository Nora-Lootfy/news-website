<?php

// tested

$host = 'localhost';
$port = 3306;
$db_name = 'news_db';
$username = 'root';
$password = '';
$charset = 'utf8';
$collate = 'utf8_unicode_ci';

$attr = "mysql:host=$host;port=$port;db_name=$db_name;charset=$charset;collate=$collate";
$opts = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
    $conn = new PDO($attr, username: $username, password: $password, options: $opts);
//    echo "connected successfully";
} catch (PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}
