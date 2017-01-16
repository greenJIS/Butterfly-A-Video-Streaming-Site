<?php
session_start();
$id=$_SESSION['id'];
unset($_SESSION['id']);
unset($_SESSION['link']);

header('Location: index.php');
?>
