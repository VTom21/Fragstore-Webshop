<?php
header('Content-Type: application/json');


$input = json_decode(file_get_contents('php://input'), true);

$cart = $input['cart'];
$delivery = $input['delivery'];
$payment = $input['payment'];
$currency = $input['currency'] ?? 'USD';
$address = $input['address'];
$card = $input['card'];
$paypal = $input['paypal'];



$projectId = 'delivery-96dc7';
$databaseUrl = "https://delivery-96dc7-default-rtdb.europe-west1.firebasedatabase.app ";


$subtotal = 0;
foreach($cart as $item){
    $subtotal += $item['total_prize'] ?? 0;
}

$shipping = 0;
if($delivery === 'home') $shipping = 5.99;
if($delivery === 'pickup') $shipping = 2.99;

$taxRate = 0.08;
$tax = $subtotal * $taxRate;
$total = $subtotal + $tax + $shipping;

// Prepare Firestore data format
$data = [
    "fields" => [
        "cart" => ["stringValue" => json_encode($cart)],
        "total_amount" => ["doubleValue" => $total],
        "currency" => ["stringValue" => $currency],
        "payment_method" => ["stringValue" => $payment],
        "delivery_method" => ["stringValue" => $delivery],
        "status" => ["stringValue" => "pending"],
        "shipping" => ["doubleValue" => $shipping],
        "tax" => ["doubleValue" => $tax],
        "timestamp" => ["timestampValue" => gmdate('Y-m-d\TH:i:s\Z')],
        "address" => ["stringValue" => json_encode($address)],
        "card" => ["stringValue" => json_encode($card)],
        "paypal" => ["stringValue" => json_encode($paypal)]
    ]
];


$ch = curl_init($databaseUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer YOUR_FIREBASE_ID_TOKEN' 
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);
$err = curl_error($ch);


if ($err) {
    echo json_encode(['success'=>false,'error'=>$err]);
} else {
    $resJson = json_decode($response, true);

    $docName = $resJson['name'] ?? '';
    $orderId = basename($docName); 
    echo json_encode(['success'=>true,'order_id'=>$orderId]);
}
