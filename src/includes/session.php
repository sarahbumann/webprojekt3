<?php
session_start();

if (!isset($_SESSION['user']) && !preg_match('#(login|signup)\.php$#', $_SERVER['PHP_SELF'])) {
	header('Location: login.php');
}