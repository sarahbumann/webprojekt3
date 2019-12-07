<?php
require_once 'includes/db.php';
require_once 'includes/session.php';
require_once 'includes/functions.php';

$errors = [];
//echo "<pre>"; var_dump($_FILES); exit("</pre>");
if (isset($_POST['submit']) && !empty($_POST['submit'])) {
	if (empty($_POST['title'])) {
		$errors['title'] = 'required';
	}
	if (!empty($_POST['release_year']) && !preg_match('#^\d{4}$#', $_POST['release_year'])) {
		$errors['password'] = 'invalid';
	}
	if (!empty($_POST['rating']) && (!is_numeric($_POST['rating']) || $_POST['rating'] < 1 || $_POST['rating'] > 5)) {
		$errors['password_repeat'] = 'invalid';
	}
	if ($_POST['password'] !== $_POST['password_repeat']) {
		$errors['password'] = ['not equal', 'Passwort wiederholen'];
	}
	if (!empty($_FILES) && isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
		$filename = preg_replace('#[^a-zA-Z0-9_\-\.]#', '_', $_FILES['image']['name']);
		$destination = sprintf(
				'%1$s%2$sassets%2$simg%2$s%3$s',
			__DIR__,
			DIRECTORY_SEPARATOR,
			$filename
		);
		if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
			$_POST['image'] = $filename;
		}
	}

	if (empty($errors)) {
		unset($_POST['submit']);
		$qry  = 'INSERT INTO `film`(`' . implode('`, `', array_keys($_POST)) . '`) VALUES (:' . implode(', :', array_keys($_POST)) . ')';
		$stmt = $pdo->prepare($qry);
		$data = [];
		foreach ($_POST as $key => $value) {
			$data[':' . $key] = $value;
		}
		if ($stmt->execute($data)) {
			header('Location: index.php');
		} else {
			echo "<pre>";
			var_dump($stmt->errorInfo(), $qry, $data);
			exit("</pre>");
		}
	}
} else {
	$_POST = array_merge([
		'title' => '',
		'release_year' => '',
		'rating' => '',
		'genre' => ''
	], $_POST);
}
?><!DOCTYPE html>
<html lang="de">
	<head>
		<title>Webprojekt Registrierung</title>

		<?php include 'includes/head.php'; ?>
	</head>
	<body>
		<?php include 'includes/navigation.php'; ?>
		<div class="container">
			<?php include 'includes/film-form.php'; ?>
		</div>

		<script src="/assets/js/jquery.3.4.1.min.js"></script>
		<script src="/assets/bootstrap/dist/js/bootstrap.bundle.js"></script>
	</body>
</html>