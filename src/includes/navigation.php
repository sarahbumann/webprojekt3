<?php
$menuEntries = [
	'index.php'  => ['Home', '*'],
	'login.php'  => ['Login', '?'],
	'create.php' => ['Erstellen', '@'],
	'logout.php' => ['Logout', '@']
];
?>
<div class="navbar navbar-expand-lg navbar-light bg-light mb-5">
	<div class="container">
		<a class="navbar-brand">Projekt</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar"
				aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbar">
			<ul class="navbar-nav mr-auto">
				<?php foreach ($menuEntries as $script => $entry): ?>
					<?php if ($entry[1] === '*' || ($entry[1] === '?' && !isset($_SESSION['user'])) || ($entry[1] === '@' && isset($_SESSION['user']))): ?>
						<?php $active = preg_match("#$script\$#", $_SERVER['PHP_SELF']); ?>
						<li class="nav-item<?php if ($active) { echo ' active'; } ?>">
							<a class="nav-link" href="<?= $script; ?>"><?= htmlentities($entry[0]); ?><?php if ($active) { ?> <span class="sr-only">(current)</span><?php } ?></a>
						</li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
			<?php if (isset($_SESSION['user'])): ?>
			<span class="navbar-text mr-3">Eingeloggt als <?=$_SESSION['user']['username'];?></span>
			<?php endif; ?>
			<form action="/index.php" method="get" class="form-inline my-2 my-lg-0">
				<?php if (isset($_GET['sort'])): ?>
				<input type="hidden" name="sort" value="<?= $_GET['sort']; ?>">
				<?php endif; ?>
				<input class="form-control mr-sm-2" type="search" name="q" placeholder="Suchen" aria-label="Suchen"
					   value="<?= isset($_GET['q']) ? $_GET['q'] : ''; ?>">
				<button class="btn btn-outline-success my-2 my-sm-0" type="submit">
					<i class="fas fa-search"></i>
					Suchen
				</button>
			</form>
		</div>
	</div>
</div>
