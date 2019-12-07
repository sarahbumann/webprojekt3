<?php
require_once 'includes/db.php';
require_once 'includes/session.php';
require_once 'includes/functions.php';

$errors = [];
if (isset($_POST['submit']) && !empty($_POST['submit'])) {
	if (empty($_POST['username'])) {
		$errors['username'] = 'required';
	}
	if (empty($_POST['password'])) {
		$errors['password'] = 'required';
	}
	if (empty($_POST['password_repeat'])) {
		$errors['password_repeat'] = 'required';
	}
	if ($_POST['password'] !== $_POST['password_repeat']) {
		$errors['password'] = ['not equal', 'Passwort wiederholen'];
	}
//	if (!empty($_POST['email']) && !preg_match('#^[a-zA-Z0-9.!#$%&\'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$#i', $_POST['email'])) {
//		$errors['email'] = 'no mail';
//	}

	if (empty($errors)) {
		unset($_POST['submit'], $_POST['password_repeat']);
		$qry  = 'INSERT INTO `user`(`' . implode('`, `',array_keys($_POST)) . '`) VALUES (:' . implode(', :',array_keys($_POST)) . ')';
		$stmt = $pdo->prepare($qry);
		$data = [];
		foreach ($_POST as $key => $value) {
			if ($key === 'password') {
				$value = password_hash($value, PASSWORD_DEFAULT);
				unset($_POST[$key]);
			}
			$data[':'.$key] = $value;
		}
		if ($stmt->execute($data)) {
			$_SESSION['user'] = $_POST;
			header('Location: index.php');
		} else {
			echo "<pre>";
			var_dump($stmt->errorInfo(), $qry, $data);
			exit("</pre>");
		}
	}
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
			<form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
				<div class="row">
					<div class="col-12 col-lg-8 offset-lg-2">
						<div class="form-row">
							<div class="form-group col-12 col-lg-4">
								<label for="username">Benutzername</label>
								<input type="text" id="username" name="username"
									   class="form-control<?= (isset($errors['username'])) ? ' is-invalid' : ''; ?>"
									   required aria-required="true">
								<div class="invalid-feedback"><?= getErrorMessage('username', 'Benutzername', $errors); ?></div>
							</div>
							<div class="form-group col-12 col-lg-4">
								<label for="password">Passwort</label>
								<input type="password" id="password" name="password"
									   class="form-control<?= (isset($errors['password'])) ? ' is-invalid' : ''; ?>"
									   required aria-required="true" minlength="8">
								<div class="invalid-feedback"><?= getErrorMessage('password', 'Passwort', $errors); ?></div>
							</div>
							<div class="form-group col-12 col-lg-4">
								<label for="password_repeat">Passwort wiederholen</label>
								<input type="password" id="password_repeat" name="password_repeat"
									   class="form-control<?= (isset($errors['password_repeat'])) ? ' is-invalid' : ''; ?>"
									   required aria-required="true">
								<div class="invalid-feedback"><?= getErrorMessage('password_repeat', 'Passwort wiederholen', $errors); ?></div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-12 col-lg-6">
								<label for="first_name">Vorname</label>
								<input type="text" id="first_name" name="first_name"
									   class="form-control<?= (isset($errors['first_name'])) ? ' is-invalid' : ''; ?>">
								<div class="invalid-feedback"><?= getErrorMessage('first_name', 'Vorname', $errors); ?></div>
							</div>
							<div class="form-group col-12 col-lg-6">
								<label for="last_name">Nachname</label>
								<input type="text" id="last_name" name="last_name"
									   class="form-control<?= (isset($errors['last_name'])) ? ' is-invalid' : ''; ?>">
								<div class="invalid-feedback"><?= getErrorMessage('last_name', 'Nachname', $errors); ?></div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-12">
								<label for="email">E-Mail</label>
								<input type="email" id="email" name="email"
									   class="form-control<?= (isset($errors['email'])) ? ' is-invalid' : ''; ?>">
								<div class="invalid-feedback"><?= getErrorMessage('email', 'E-Mail', $errors); ?></div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-12 text-right">
								<button type="submit" name="submit" value="signup" class="btn btn-primary">
									<i class="fas fa-user-plus"></i>
									Registrieren
								</button>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>

		<script src="/assets/js/jquery.3.4.1.min.js"></script>
		<script src="/assets/bootstrap/dist/js/bootstrap.bundle.js"></script>
	</body>
</html>