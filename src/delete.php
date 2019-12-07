<?php
include 'includes/db.php';
include 'includes/session.php';

$qry = 'DELETE FROM `film` WHERE `id` = :id';
$stmt = $pdo->prepare($qry);
$stmt->execute(['id' => $_GET['id']]);
header('Location: index.php');