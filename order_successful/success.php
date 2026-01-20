<?php
include '../test.php';
$cart_json = $_GET["cart"] ?? "[]";
$total_json = $_GET["total"] ?? "";
$cart_items = json_decode($cart_json, true);
$total_num = json_decode($total_json, true);
$currency_local = $_GET["currency"] ?? "$";

// --- Connect to the database ---
$host = 'localhost';
$db = 'videogames';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    echo $twig->render('error.twig', [
        'title' => 'Unexpected Error',
        'message' => 'Something went wrong.',
        'details' => $e->getMessage(),
        'redirectUrl' => '../home/home.php'
    ]);
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="success.css">
    <link rel="icon" type="image/x-icon" href="/icons/array.png">
    <title>Order Summary</title>
</head>

<body>
    <div class="container">
        <div class="success-banner">
            <div class="success-icon">✅</div>
            <h1>Order Confirmed!</h1>
            <p style="color: var(--gray1); font-size: 1.1rem;">Thank you for your purchase</p>
            <p class="order-number">Order #<span><?= strtoupper(uniqid()) ?></span></p>
        </div>

        <div class="info-grid">
            <div class="info-box">
                <h3>📧 Email Confirmation</h3>
                <p>A confirmation email has been sent to your registered email address.</p>
            </div>
            <div class="info-box">
                <h3>🚚 Delivery</h3>
                <p>Your digital items will be available in your library immediately.</p>
            </div>
        </div>



        <div class="actions">
            <a href="../games_main.php" class="btn btn-secondary">Continue Shopping</a>
        </div>

        <div class="note">
            📄 Need help? Contact our support team or check your order history in your account.
        </div>
    </div>

    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>

    <script>
        const firebaseConfig = {
            apiKey: "AIzaSyBnS-LKU-wG1f4WyUeGUTV8KYQsApoWvUc",
            authDomain: "delivery-96dc7.firebaseapp.com",
            projectId: "delivery-96dc7",
            storageBucket: "delivery-96dc7.firebasestorage.app",
            messagingSenderId: "1071368884734",
            appId: "1:1071368884734:web:18bc322a07a34d959330af",
            measurementId: "G-WVFVSRFGY6",
            databaseURL: "https://stock-9bff5-default-rtdb.europe-west1.firebasedatabase.app/"
        };

        const app = firebase.initializeApp(firebaseConfig);

        const database = firebase.database(app);
    </script>
    <script src="success.js"></script>
</body>

</html>