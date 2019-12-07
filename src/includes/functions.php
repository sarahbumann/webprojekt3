<?php

/**
 * @param $field
 * @param $name
 * @param array $errors
 * @return mixed|string
 */
function getErrorMessage($field, $name, $errors = []) {
	if (empty($errors)) {
		return '';
	}
	if (!isset($errors[$field])) {
		return '';
	}

	$type     = is_array($errors[$field])
		? $errors[$field][0]
		: $errors[$field];
	$relation = is_array($errors[$field])
		? $errors[$field][1]
		: null;

	switch ($type) {
		case 'required':
			return sprintf('Das Feld <b>%s</b> ist ein Pflichtfeld!', $name);
		case 'not equal':
			return sprintf('Die Werte <b>%s</b> und <b>%s</b> müssen identisch sein!', $name, $relation);
		case 'no mail':
		case 'no email':
			return 'Der eingegebene Wert ist keine gültige Mailadresse!';
	}

	return $type;
}