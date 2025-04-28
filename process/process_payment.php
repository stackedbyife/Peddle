<?php
ob_start();
session_start();

$amount = $_POST['amount']; 
$email = $_POST['email']; 
$order_id = $_POST['order_id']; 


$paystackSecretKey = 'sk_test_91ddf54c5f3307e9e8b42ed258451fe8373aa338'; 


$ch = curl_init('https://api.paystack.co/transaction/initialize');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $paystackSecretKey,
    'Content-Type: application/json'
]);


$data = [
    'email' => $email,
    'amount' => $amount,
    'order_id' => $order_id,
    'callback_url' => 'http://localhost/peddle/process/payment_callback.php'
];

//converting to json
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));


$response = curl_exec($ch);


if (curl_errno($ch)) {
    die('Paystack API error: ' . curl_error($ch));
}

curl_close($ch);

//response
$responseData = json_decode($response, true);

// echo '<pre>';
// var_dump($responseData); 
// echo '</pre>';
// exit();

if ($responseData['status'] == 'success') {
    header('Location: ' . $responseData['data']['authorization_url']);
    exit(); 
} else {
    $_SESSION["errormsg"] = "Error! Payment was not successful";
    header("Location: ../dashboard_payment.php"); 
    exit();  
}
ob_end_flush(); 
?>