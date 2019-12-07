<?php

require_once 'includes/session.php';

session_destroy();
session_regenerate_id();

header('Location: index.php');