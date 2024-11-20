<?php
    $host = 'localhost';
    $dbname = 'estacio';
    $username = 'estacio';
    $password = 'y@L3Jg@b2WZ!$nw73@f6';

    try {
        $pdo = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
        die("Erro de Conexão: " . $e->getMessage());
    }
?>