<?php
session_start();
unset($_SESSION['getEmail']);
header('Location: index.php');
?>