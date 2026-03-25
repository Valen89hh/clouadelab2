<?php
function conexion() {
    $host = getenv("DB_HOST");
    $port = getenv("DB_PORT");
    $dbname = getenv("DB_NAME");
    $user = getenv("DB_USER");
    $password = getenv("DB_PASSWORD");

    $connStr = "host=$host port=$port dbname=$dbname user=$user password=$password";

    $db = pg_connect($connStr);

    if (!$db) {
        die("Error de conexión: " . pg_last_error());
    }

    return $db;
}
