<?php
$params = [
    'id' => $_POST['id'] ?? 0,
    'order_id' => $_POST['order_id'] ?? 0,
];
  
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment/verify');
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'X-API-KEY: 6a7f99eb-7c20-4412-a972-6dfb7cd253a4',
    'X-SANDBOX: 1',
]);

$result = curl_exec($ch);
$err = curl_error($ch);
curl_close($ch);

$result = json_decode($result, true);
if ($err) {
    echo "cURL Error #:" . $err;
} else {
    if ($result['status'] == 100) {
        echo 'تراکنش با موفقیت انجام شد. کد رهگیری آدی‌پی: ' . $result['track_id'];
    } else {
        echo 'خطا در انجام تراکنش. کد خطا: ' . $result['error_code'];
        echo 'پیغام سیستم: '. $result['error_message'];
    }
}

?>
