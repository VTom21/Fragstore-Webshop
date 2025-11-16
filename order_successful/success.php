<?php 

$cart_json = $_GET["cart"] ?? "[]";

$total_json = $_GET["total"] ?? "";

$cart_items = json_decode($cart_json, true);

$total_num = json_decode($total_json, true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="success.css">
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

        <?php if (!empty($cart_items)): ?>
            <div class="summary-card">
                <h2 class="section-title">Order Details</h2>
                <div class="item-list">
                    <?php 
                    $subtotal = 0;
                    foreach($cart_items as $item): 
                        $item_total = $item["total_prize"] ?? 0;
                        $subtotal += $item_total;
                    ?>
                        <div class="item-row">
                            <div class="item-info">
                                <div class="item-name"><?= htmlspecialchars($item["name"]) ?></div>
                                <div class="item-quantity">Qty: <?= htmlspecialchars($item["quantity"]) ?></div>
                            </div>
                            <div class="item-price">$<?= number_format($item_total, 2) ?></div>
                        </div>
                    <?php endforeach ?>
                </div>

                <div class="totals">
                    <div class="total-row">
                        <span>Subtotal</span>
                        <span>$<?= number_format($subtotal, 2) ?></span>
                    </div>
                    <div class="total-row">
                        <span>Tax</span>
                        <span>$<?= number_format($subtotal * 0.08, 2) ?></span>
                    </div>
                    <div class="total-row grand-total">
                        <span>Total Paid</span>
                        <span class="value">$<?= number_format($total_num, 2) ?></span>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <div class="actions">
            <a href="../games_main.php" class="btn btn-secondary">Continue Shopping</a>
        </div>

        <div class="note">
            📄 Need help? Contact our support team or check your order history in your account.
        </div>
    </div>

    <script src="sum_main.js"></script>
</body>
</html>