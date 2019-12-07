<?php
require_once 'includes/db.php';
require_once 'includes/session.php';
require_once 'includes/functions.php';

if (isset($_POST['submit']) && !empty($_POST['submit'])) {
	$qry = 'SELECT * FROM `user` WHERE `username` = :username';
	$stmt = $pdo->prepare($qry);
	$stmt->execute([':username' => $_POST['username']]);
	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	if (password_verify($_POST['password'], $row['password'])) {
		$_SESSION['user'] = $row;
		header('Location: index.php');
		exit;
	}
}
?><!DOCTYPE html>
<html lang="de">
	<head>
		<title>Webprojekt Login</title>

		<?php include 'includes/head.php'; ?>
	</head>
	<body>
		<?php include 'includes/navigation.php'; ?>
		<div class="container">
			<form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
				<div class="row">
					<div class="col-12 col-lg-8 offset-lg-2">
						<div class="form-row">
							<div class="form-group col-12">
								<label for="username">Benutzername</label>
								<input type="text" id="username" name="username" class="form-control">
							</div>
							<div class="form-group col-12">
								<label for="password">Passwort</label>
								<input type="password" id="password" name="password" class="form-control">
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-12 col-md-6">
								<a href="signup.php" class="btn btn-outline-primary">
									<i class="fas fa-user-plus"></i>
									Registrieren
								</a>
							</div>
							<div class="form-group col-12 col-md-6 text-md-right">
								<input type="submit" name="submit" value="Login" class="btn btn-primary">
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