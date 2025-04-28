<?php
ini_set('log_errors', 1);
ini_set('error_log', 'php_errors.log'); 
error_reporting(E_ALL); 

require_once "../classes/Bicycle.php"; 

$rental = new Bicycle();

$response = ['message' => 'An error occurred'];

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $bicycle_id = $_POST['bicycle_id'];
    
    if ($action === 'approve') {
        $result = $rental->approveRental($bicycle_id); 
        $response['message'] = $result['message']; 
    } elseif ($action === 'complete') {
        $result = $rental->completeRental($bicycle_id); 
        $response['message'] = $result['message']; 
    }
}


$output = json_encode($response);

error_log(ob_get_clean());

echo $output;
exit;