<?php
include("conexion.php");
$con = conexion();

$doc = $_POST["doc"];
$nom = $_POST["nom"];
$ape = $_POST["ape"];
$dir = $_POST["dir"];
$cel = $_POST["cel"];

$sql = "INSERT INTO persona VALUES(default,$1,$2,$3,$4,$5)";
pg_query_params($con, $sql, [$doc, $nom, $ape, $dir, $cel]);

header("location:index.php");
?>