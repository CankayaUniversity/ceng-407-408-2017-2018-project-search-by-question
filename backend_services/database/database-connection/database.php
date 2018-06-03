<?php
try {
    $db = new PDO(
        "mysql:host=localhost;dbname=sbq",
        "root",
        "root");
} catch (PDOException $e) {
    print $e->getMessage();
}

