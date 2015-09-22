<?php
// Fetches the request parameter user and results in 'nobody' if it doesn't exist
$username = $_GET['user'] ?? 'nobody';
// equivalent to: $username = isset($_GET['user']) ? $_GET['user'] : 'nobody';

// Calls a hypothetical model-getting function, and uses the provided default if it fails
$model = Model::get($id) ?? $default_model;
// equivalent to: if (($model = Model::get($id)) === NULL) { $model = $default_model; }

// Parse JSON image metadata, and if the width is missing, assume 100
$imageData = json_decode(file_get_contents('php://input'));
$width = $imageData['width'] ?? 100;
// equivalent to: $width = isset($imageData['width']) ? $imageData['width'] : 100;
