<?php
session_start();
// check for session expires
if(time() > (int)($_SESSION['date'] ?? 0) + 30*60){
    session_destroy();
	http_response_code(401);
    header('Location: /');
    exit;
}

$order_id = $_GET['order_id'] ?? null;
$_SESSION['order_id'] = $order_id;

// validate order_id
if(! $order_id){
	http_response_code(400);
	header('Location: /');
	exit;
}

// check if this file is already purchased
if(in_array($order_id, $_SESSION['validated'] ?? []))
{
	header('Location: https://shoptesti.freehost.io/download.php?id='.$order_id);
	exit;
}
else
{
	$jsonData = json_encode([
		'order_id' => $order_id,
		'amount' => 10000,
		'name' => 'حمید حمیدی',
		'phone' => '09378871187',
		'mail' => 'my@mail.info',
		'desc' => 'خرید موبایل از شاپ تستی',
		'callback' => 'https://shoptesti.freehost.io/verify.php',
	]);
	$curl = curl_init();
	
	curl_setopt_array($curl, [
		CURLOPT_URL => "https://api.idpay.ir/v1.1/payment",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => $jsonData,
		CURLOPT_HTTPHEADER => [
			"Content-Type: application/json",
			"X-API-KEY: 6a7f99eb-7c20-4412-a972-6dfb7cd253a4",
			"X-SANDBOX: 1"
		],
	]);
	
	$result = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	
	if ($err) {
		echo "cURL Error #:" . $err;
	} else {
		$idpay = json_decode($result, true);
		header('Location: '.$idpay['link']);
	}
}
?>