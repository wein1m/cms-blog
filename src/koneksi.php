<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "cms_blog";

$conn = new PDO(
    'mysql:host=' . $host . ';dbname=' . $database,
    $username,
    $password
);
