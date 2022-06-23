<?php
include __DIR__ . '/../files.php';

session_start();
// check for session expires
if(time() > (int)($_SESSION['date'] ?? 0) + 30*60){
    session_destroy();
	http_response_code(401);
    header('Location: /');
    exit;
}

$id = $_GET['id'] ?? null;

if(
	!$id 
	|| ! array_key_exists($id, $files)
	|| ! file_exists(__DIR__ . '/../storage/' . $files[$id])
)
{	
	http_response_code(404);
	header('Location: /');
}
elseif(!in_array($id, $_SESSION['validated']))
{
	http_response_code(401);
	header('Location: /');
}
else
{
	$fileLocation = __DIR__ . '/../storage/' . $files[$id];
	// download the file
	header('Content-Type: ' . mime_content_type($fileLocation));
	header('Content-Disposition: attachment; filename="' . $files[$id] . '"');
	header('Content-Length: ' . filesize($fileLocation));
	readfile($fileLocation);
	exit;
}