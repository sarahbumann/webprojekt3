<?php
$genres = [
	'Comedy',
	'Drama',
	'Fantasy',
	'Horror',
	'Romanze',
	'Science-Fiction',
	'Thriller'
];
?>

<form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
	<?php if (isset($_POST['id'])): ?>
		<input type="hidden" name="id" value="<?= $_POST['id']; ?>">
	<?php endif; ?>
	<div class="row">
		<div class="col-12">
			<div class="form-row">
				<div class="form-group col-12 col-lg-10">
					<label for="title">Titel</label>
					<input type="text" id="title" name="title" value="<?= $_POST['title']; ?>"
						   class="form-control<?= (isset($errors['title'])) ? ' is-invalid' : ''; ?>"
						   required aria-required="true">
					<div class="invalid-feedback"><?= getErrorMessage('title', 'Titel', $errors); ?></div>
				</div>
				<div class="form-group col-12 col-lg-2">
					<label for="release_year">Erscheinungsjahr</label>
					<input type="number" id="release_year" name="release_year" maxlength="4"
						   value="<?= $_POST['release_year']; ?>"
						   class="form-control<?= (isset($errors['release_year'])) ? ' is-invalid' : ''; ?>">
					<div class="invalid-feedback"><?= getErrorMessage('release_year', 'Erscheinungsjahr', $errors); ?></div>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-12 col-lg-2">
					<label for="rating">Rating</label>
					<input type="number" id="rating" name="rating" min="1" max="5" value="<?= $_POST['rating']; ?>"
						   class="form-control<?= (isset($errors['release_year'])) ? ' is-invalid' : ''; ?>"
						   required aria-required="true">
					<div class="invalid-feedback"><?= getErrorMessage('release_year', 'Rating', $errors); ?></div>
				</div>
				<div class="form-group col-12 col-lg-10">
					<label for="genre">Genre</label>
					<select name="genre" id="genre" class="custom-select">
						<?php foreach ($genres as $genre): ?>
							<?php $selected = ($genre === $_POST['genre']) ? ' selected' : ''; ?>
							<option value="<?= $genre; ?>"<?= $selected; ?>><?= $genre; ?></option>
						<?php endforeach; ?>
					</select>
					<div class="invalid-feedback"><?= getErrorMessage('genre', 'Genre', $errors); ?></div>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-12">
					<div class="custom-file">
						<input type="file" id="image" name="image"
							   class="custom-file-input<?= (isset($errors['genre'])) ? ' is-invalid' : ''; ?>">
						<label class="custom-file-label" for="image">Bitte wählen</label>
						<div class="invalid-feedback"><?= getErrorMessage('image', 'Bild', $errors); ?></div>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-12 text-right">
					<button type="submit" name="submit" value="1" class="btn btn-primary">
						<i class="fas fa-save"></i> Speichern
					</button>
				</div>
			</div>
		</div>
	</div>
</form>