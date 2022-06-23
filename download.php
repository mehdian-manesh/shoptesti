<?php
include __DIR__ . '/../files.php';

session_start();

$id = $_GET['id'] ?? null;

if(
	$id 
	&& array_key_exists($id, $files)
	&& in_array($id, $_SESSION['validated'])
	&& file_exists(__DIR__ . '/../storage/' . $files[$id])
){
	$fileLocation = __DIR__ . '/../storage/' . $files[$id];
	// download the file
	// set headers
	header('Content-Type: ' . mime_content_type($fileLocation));
	header('Content-Disposition: attachment; filename="' . $files[$id] . '"');
	header('Content-Length: ' . filesize($fileLocation));
	// output file content
	readfile($fileLocation);
	exit;
}else{
	echo 'فایل یافت نشد';
	print_r([
		'id' => $id,
		'files' => $files,
		'validated' => $_SESSION['validated'],
		'file_exists' => file_exists(__DIR__ . '/../storage/' . $files[$id]),
	]);
}