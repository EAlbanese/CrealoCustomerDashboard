<?php
$host = 'ebicogeh.mysql.db.internal';
$db   = 'ebicogeh_Dashboard';
$user = 'ebicogeh_dashbo';
$pass = 'GvWjZwfK!XV4bDDLkWApAnT@';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Verbindung erfolgreich hergestellt.";
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
