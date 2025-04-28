<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];        
    $amount = $_POST['amount'];       
    $amount_in_kobo = $amount * 100;  
    
    $secretKey = "";
    

    $url = "https://api.paystack.co/transaction/initialize";
    

    $data = [
        'email' => $email,               // User's email
        'amount' => $amount_in_kobo,     // Amount in kobo
        'currency' => 'NGN',             // Currency code
        'callback_url' => '', 
    ];


    $ch = curl_init($url);


    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $secretKey", 
        "Content-Type: application/json"
    ]);


    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));


    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


    $response = curl_exec($ch);


    if (curl_errno($ch)) {
        echo 'Error: ' . curl_error($ch);
    } else {

        $response = json_decode($response, true);

        if ($response['status'] == 'success') {

            $authorizationUrl = $response['data']['authorization_url'];
            header("Location: $authorizationUrl");
            exit;
        } else {
            echo "Error: " . $response['message'];
        }
    }


    curl_close($ch);
} else {
    echo "Invalid Request";
}
?>