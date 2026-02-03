<?php

$cart_json = $_GET["cart"] ?? "[]";
$cart_items = json_decode($cart_json, true);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sum_main.css">
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/icons/array.png">
    <title>Checkout</title>
</head>

<body>
    <div class="container">
        <header class="checkout-header">
            <h1>Checkout</h1>
            <p class="subtitle">Complete your purchase</p>
        </header>

        <div class="checkout-grid">
            <!-- Left Column - Forms -->
            <div class="checkout-forms">
                <!-- Delivery Method -->
                <div class="form-section">
                    <h2 class="section-title">
                        <span class="step-number">1</span>
                        Delivery Method
                    </h2>
                    <div class="delivery-options">
                        <label class="radio-card">
                            <input type="radio" name="delivery" value="digital" checked>
                            <div class="radio-content">
                                <div class="radio-header">
                                    <span class="radio-icon">💾</span>
                                    <span class="radio-title">Digital Delivery</span>
                                </div>
                                <p class="radio-description">Instant access to your games</p>
                            </div>
                        </label>

                        <label class="radio-card">
                            <input type="radio" name="delivery" value="home">
                            <div class="radio-content">
                                <div class="radio-header">
                                    <span class="radio-icon">🏠</span>
                                    <span class="radio-title">Home Delivery</span>
                                </div>
                                <p class="radio-description">Physical copy delivered to your address</p>
                            </div>
                        </label>

                        <label class="radio-card">
                            <input type="radio" name="delivery" value="pickup">
                            <div class="radio-content">
                                <div class="radio-header">
                                    <span class="radio-icon">📦</span>
                                    <span class="radio-title">Package Point</span>
                                </div>
                                <p class="radio-description">Pick up from nearest collection point</p>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Delivery Address -->
                <div class="form-section" id="address-section">
                    <h2 class="section-title">
                        <span class="step-number">2</span>
                        Delivery Address
                    </h2>
                    <div class="form-grid">
                        <div class="form-group full-width">
                            <label>Full Name</label>
                            <input type="text" id="full-name" placeholder="John Doe" required>
                        </div>
                        <div class="form-group full-width">
                            <label>Street Address</label>
                            <input type="text" id="street-address" placeholder="123 Main Street" required>
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" id="city" placeholder="Budapest" required>
                        </div>
                        <div class="form-group">
                            <label>Postal Code</label>
                            <input type="text" id="postal-code" placeholder="1011" required>
                        </div>
                        <div class="form-group">
                            <label>Country</label>
                            <select id="country" required>
                                <option value="">Select Country</option>
                                <option value="HU" selected>Hungary</option>
                                <option value="AT">Austria</option>
                                <option value="SK">Slovakia</option>
                                <option value="RO">Romania</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="tel" id="phone" placeholder="+36 30 123 4567" required>
                        </div>
                    </div>
                </div>


                <!-- Payment Method -->
                <div class="form-section">
                    <h2 class="section-title">
                        <span class="step-number">3</span>
                        Payment Method
                    </h2>
                    <div class="payment-options">
                        <label class="radio-card">
                            <input type="radio" name="payment" value="card" checked>
                            <div class="radio-content">
                                <div class="radio-header">
                                    <span class="radio-icon">💳</span>
                                    <span class="radio-title">Credit/Debit Card</span>
                                </div>
                            </div>
                        </label>

                        <label class="radio-card">
                            <input type="radio" name="payment" value="cash">
                            <div class="radio-content">
                                <div class="radio-header">
                                    <span class="radio-icon">💵</span>
                                    <span class="radio-title">Cash on Delivery</span>
                                </div>
                            </div>
                        </label>

                        <label class="radio-card">
                            <input type="radio" name="payment" value="paypal">
                            <div class="radio-content">
                                <div class="radio-header">
                                    <span class="radio-icon">🅿️</span>
                                    <span class="radio-title">PayPal</span>
                                </div>
                            </div>
                        </label>
                    </div>

                    <!-- Card Details -->
                    <div class="card-details" id="card-section">
                        <div class="form-grid">
                            <div class="form-group full-width">
                                <label>Card Number</label>
                                <input type="text" id="card-number" placeholder="1234 5678 9012 3456" maxlength="19">
                            </div>
                            <div class="form-group full-width">
                                <label>Cardholder Name</label>
                                <input type="text" id="card-name" placeholder="Name on card">
                            </div>
                            <div class="form-group">
                                <label>Expiry Date</label>
                                <input type="text" id="card-expiry" placeholder="MM/YY" maxlength="5">
                            </div>
                            <div class="form-group">
                                <label>CVV</label>
                                <input type="text" id="card-cvc" placeholder="123" maxlength="3">
                            </div>

                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" id="card-email" placeholder="Email Address">
                            </div>
                        </div>
                    </div>

                    <div class="paypal-section" style="display:none;">
                        <div class="form-group full-width">
                            <label>Paypal Number</label>
                            <input type="text" id="paypal-number" placeholder="Number on paypal"><br>
                            <label>Email Address</label>
                            <input type="email" id="paypal-email" placeholder="Email Address">
                        </div>
                    </div>

                </div>
            </div>

            <!-- Right Column - Order Summary -->
            <div class="order-summary">
                <div class="summary-sticky">
                    <h2 class="summary-title">Order Summary</h2>

                    <?php if (!empty($cart_items)): ?>
                        <div class="summary-items">
                            <?php
                            $subtotal = 0;
                            foreach ($cart_items as $item):
                                $item_total = $item["total_prize"] ?? 0;
                                $subtotal += $item_total;
                            ?>
                                <div class="summary-item">
                                    <div class="summary-item-info">
                                        <span class="summary-item-name"><?= htmlspecialchars($item["name"]) ?></span>
                                        <span class="summary-item-qty">x<?= htmlspecialchars($item["quantity"]) ?></span>
                                    </div>
                                    <span class="summary-item-price"><?= number_format($item_total, 2) ?></span>
                                </div>
                            <?php endforeach ?>
                        </div>

                        <div class="summary-totals">
                            <div class="summary-row">
                                <span>Subtotal</span>
                                <span id="subtotal-amount"><?= number_format($subtotal, 2) ?></span>
                            </div>
                            <div class="summary-row">
                                <span>Shipping</span>
                                <span id="shipping-amount" class="shipping-cost">Free</span>
                            </div>
                            <div class="summary-row">
                                <span>Tax (8%)</span>
                                <span id="tax-amount"><?= number_format($subtotal * 0.08, 2) ?></span>
                            </div>
                            <div class="summary-row total">
                                <span>Total</span>
                                <span id="total-amount"><?= number_format($subtotal * 1.08, 2) ?></span>
                            </div>
                        </div>


                        <button class="btn-checkout" onclick="processCheckout()">
                            Complete Purchase
                        </button>
                    <?php endif; ?>

                    <div class="security-note">
                        <span class="security-icon">🔒</span>
                        <span>Secure checkout - Your information is protected</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.23.0/firebase-database-compat.js"></script>
    <script>
        const subtotal = <?= floatval($subtotal ?? 0) ?>;
        const taxRate = 0.08;

        const firebaseConfig = {
        apiKey: "AIzaSyBnS-LKU-wG1f4WyUeGUTV8KYQsApoWvUc",
        authDomain: "delivery-96dc7.firebaseapp.com",
        projectId: "delivery-96dc7",
        storageBucket: "delivery-96dc7.firebasestorage.app",
        messagingSenderId: "1071368884734",
        appId: "1:1071368884734:web:18bc322a07a34d959330af",
        measurementId: "G-WVFVSRFGY6",
        databaseURL: "https://delivery-96dc7-default-rtdb.europe-west1.firebasedatabase.app"
};

// Initialize Firebase
const app = firebase.initializeApp(firebaseConfig);

// Use database in the correct region
const database = firebase.database(app);

    </script>

    <script src="sum_main.js"></script>

</body>

</html>