<?php
$amount = $_POST['amount'];
$post = [
    'merchant' => '****merchant_id****',
    'callback' => '****callback_url****',
    'amount'   => $amount,
];

$ch = curl_init('https://drtether.com/api/v1/make/transaction');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

$response = curl_exec($ch);

curl_close($ch);

$responseAsArray = json_decode($response, true);
$hash = $responseAsArray['data']['hash'];
$msg = $responseAsArray['message'];
$status = $responseAsArray['status'];

if ($status == 200)
{
header("Location: https://drtether.com/api/v1/pay/transaction/".$hash);
}else{
    echo $response;
}

?>
