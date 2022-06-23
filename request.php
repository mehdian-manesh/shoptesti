<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>انتقال به درگاه پرداخت</title>
</head>
<body>
    <div style="text-align: center;" dir="rtl">
        <h2>
            در حال انتقال به درگاه پرداخت ...
        </h2>
    </div>
</body>
</html> -->

<?php
$jsonData = json_encode([
    'order_id' => 100,
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
?>