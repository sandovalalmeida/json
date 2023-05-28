<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$db = "db_magalu";

$cn = new PDO("mysql:host=$servidor;dbname=$db", $usuario, $senha);