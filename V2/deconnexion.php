<?php
require 'db.php' ;
$db = Database::connect();

session_start();
$_SESSION = array();
session_destroy();
header("Location: page.php");
Database::disconnect();
?>