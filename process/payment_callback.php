<?php
session_start();
$id = $_SESSION["member_id"];
$paymentReference = $_GET['reference'];


$paystackSecretKey = ''; 

$ch = curl_init('https://api.paystack.co/transaction/verify/' . $paymentReference);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $paystackSecretKey
]);


$response = curl_exec($ch);


if (curl_errno($ch)) {
    die('Paystack API error: ' . curl_error($ch));
}

curl_close($ch);

$responseData = json_decode($response, true);


if ($responseData['status'] == 'success') {
    // Payment successful, updating database and redirecting the user
    $transactionStatus = 'success';
    $transactionReference = $responseData['data']['reference'];
    $amountPaid = $responseData['data']['amount'] / 100; // Converting from kobo to Naira

    require_once '../classes/Payment.php';
    require_once '../classes/Member.php';
    $member = new Payment();
    $user = new Member();
    
    $user = $user-> get_member($id);
    $type_id = $user["membership_type"];
    $member ->start_subscription($id, $type_id);
    $sub = $member -> fetch_subscription();
    $subscription_id = $sub["subscription_id"];
    $member->update_payment_status($transactionReference, $amountPaid, $transactionStatus,$subscription_id);


    $_SESSION["feedback"] = "Your Payment was Successful ";
    header("location:../dashboard_payment.php");
} else {
    $_SESSION["errormsg"] = 'Payment failed. Please try again.';
    header("location:../dashboard_payment.php"); 
}


?>