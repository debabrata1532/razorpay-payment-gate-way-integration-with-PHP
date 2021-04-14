<?php 
require('razorpay_integration/config.php');
require('razorpay_integration/razorpay-php/Razorpay.php');
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php



// Create the Razorpay Order

// Here some varivale are fixed like order id and price, we can also fecth data from DATABASE 

if(isset($_POST['orderid'])){

    $orderid=$_POST['orderid'];
    $name = $_POST['name'];
    $price =$_POST['price'];
    $email =$_POST['email'];
    $mobile =$_POST['mobile'];
    $lastname =$_POST['last_name'];

}


use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//
$orderData = [
    'receipt'         => 3456,
    'amount'          => $price * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$checkout = 'automatic';

if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
{
    $checkout = $_GET['checkout'];
}

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => "Company Name",
    "description"       => "Slogan here if any",
    "image"             => "company logo url",
    "prefill"           => [
    "name"              => $name,
    "email"             => $email,
    "contact"           => $mobile,
    ],
    "notes"             => [
    "address"           => "Hello World",
    "merchant_order_id" => $orderid,
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,    // do not  edit thise line, it is razorpay order_id
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);

require("razorpay_integration/checkout/{$checkout}.php");
?> 
</body>
</html>