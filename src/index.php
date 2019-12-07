<?php
require_once 'includes/db.php';
require_once 'includes/session.php';
require_once 'includes/functions.php';
?><!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="UTF-8">
		<title>Webprojekt</title>

		<?php include 'includes/head.php'; ?>
	</head>
	<body>
		<?php include 'includes/navigation.php'; ?>
		<div class="container">
			<?php
			$qry    = 'SELECT * FROM `film`';
			$params = [];
			if (isset($_GET['q']) && !empty($_GET['q'])) {
				$qry           .= " WHERE `title` LIKE :qs OR `genre` LIKE :qs OR `release_year` = :q OR `rating` = :q";
				$params[':qs'] = "%{$_GET['q']}%";
				$params[':q']  = $_GET['q'];
			}
			$sort = '';
			if (isset($_GET['sort'])) {
				$sort = $_GET['sort'];
				if (substr($sort, 0, 1) === '-') {
					$qSort      = substr($sort, 1);
					$direction = 'DESC';
				} else {
					$qSort     = $sort;
					$direction = 'ASC';
				}
				$qry .= " ORDER BY `$qSort` $direction";
			}

			$stmt = $pdo->prepare($qry);
			$stmt->execute($params);
			?>
			<table class="table table-striped data-grid">
				<thead>
					<tr>
						<th>&nbsp;</th>
						<th>
							<a href="?sort=<?= $sort === '-title' ? 'title' : '-title'; ?>">
								Titel
							</a>
						</th>
						<th>
							<a href="?sort=<?= $sort === '-genre' ? 'genre' : '-genre'; ?>">
								Genre
							</a>
						</th>
						<th>
							<a href="?sort=<?= $sort === '-release_year' ? 'release_year' : '-release_year'; ?>">
								Erscheinungsjahr
							</a>
						</th>
						<th>
							<a href="?sort=<?= $sort === '-rating' ? 'rating' : '-rating'; ?>">
								Rating
							</a>
						</th>
						<th>Aktionen</th>
					</tr>
				</thead>
				<tbody>
					<?php
					if ($stmt->rowCount()) {
						foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
							?>
							<tr>
								<td>
									<img src="/assets/img/<?= $row['image']; ?>"
										 alt="<?= htmlentities($row['title']); ?>">
								</td>
								<td><?= htmlentities($row['title']); ?></td>
								<td><?= htmlentities($row['genre']); ?></td>
								<td><?= htmlentities($row['release_year']); ?></td>
								<td><?= htmlentities($row['rating']); ?></td>
								<td>
									<a href="edit.php?id=<?= $row['id']; ?>">
										<i class="fas fa-edit"></i>
									</a>
									<a href="delete.php?id=<?= $row['id']; ?>"
									   onclick="return confirm('Wollen Sie den Eintrag wirklich löschen?');">
										<i class="fas fa-trash-alt"></i>
									</a>
								</td>
							</tr>
							<?php
						}
					} else {
						?>
						<tr>
							<td colspan="6">(keine Daten vorhanden)</td>
						</tr>
						<?php
					}
					?>
				</tbody>
			</table>
		</div>

		<script src="/assets/js/jquery.3.4.1.min.js"></script>
		<script src="/assets/bootstrap/dist/js/bootstrap.bundle.js"></script>
	</body>
</html>