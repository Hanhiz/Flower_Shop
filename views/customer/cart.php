<?php
// filepath: d:\Xampp\htdocs\flower_shop\views\customer\cart.php
session_start();
include '../../connectdb.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('You need to log in first!'); window.location='../../login.php';</script>";
    exit;
}
$user_id = $_SESSION['user_id'];

// Handle remove action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove'])) {
    $cart_id = intval($_POST['remove']);
    $stmt = $conn->prepare("DELETE FROM cart_items WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $cart_id, $user_id);
    $stmt->execute();
    // Refresh to update the cart view
    header("Location: cart.php");
    exit;
}

// Handle quantity update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantities'])) {
    foreach ($_POST['quantities'] as $cart_id => $qty) {
        $cart_id = intval($cart_id);
        $qty = max(1, intval($qty));
        $stmt = $conn->prepare("UPDATE cart_items SET quantity = ? WHERE id = ? AND user_id = ?");
        $stmt->bind_param("iii", $qty, $cart_id, $user_id);
        $stmt->execute();
    }
    // Refresh to update the cart view and prevent resubmission
    header("Location: cart.php");
    exit;
}

// Fetch cart items with product and card info
$sql = "
    SELECT ci.id as cart_id, p.id as product_id, p.name as product_name, p.image as product_image, p.price as product_price,
           ci.quantity, s.name as card_name, s.price as card_price, s.image as card_image
    FROM cart_items ci
    JOIN products p ON ci.product_id = p.id
    LEFT JOIN services s ON ci.service_id = s.id
    WHERE ci.user_id = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <style>
        body { background: #f8f8f8; font-family: Arial, sans-serif; }
        .cart-container { max-width: 900px; margin: 40px auto; background: #fff; border-radius: 10px; box-shadow: 0 2px 12px #eee; padding: 32px; }
        h2 { color: #e75480; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: center; border-bottom: 1px solid #eee; }
        th { background: #faf6f8; color: #e75480; }
        img { width: 60px; height: 60px; object-fit: cover; border-radius: 6px; }
        .remove-btn {
            background: #e75480; color: #fff; border: none; border-radius: 4px;
            padding: 6px 14px; cursor: pointer; transition: background 0.2s;
        }
        .remove-btn:hover { background: #d84372; }
        .checkout-btn {
            margin-top: 24px; background: #e75480; color: #fff; border: none; border-radius: 5px;
            padding: 14px 40px; font-size: 18px; cursor: pointer; transition: background 0.2s;
        }
        .checkout-btn:hover { background: #d84372; }
        .empty-cart { text-align: center; color: #888; margin: 40px 0; }
    </style>
</head>
<body>
    <?php include '../../includes/header.php'; ?>
    <div class="cart-container">
        <h2>Your Cart</h2>
        <?php if ($result && $result->num_rows > 0): ?>
        <form method="post" action="">
            <table>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>Product</th>
                    <th>Card</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Remove</th>
                </tr>
                <?php
                $grand_total = 0;
                while ($row = $result->fetch_assoc()):
                    $product_total = $row['product_price'] * $row['quantity'];
                    $card_total = $row['card_price'] ?? 0;
                    $subtotal = $product_total + $card_total;
                    $grand_total += $subtotal;
                ?>
                <tr>
                    <td>
                        <input type="checkbox" name="checkout_items[]" value="<?php echo $row['cart_id']; ?>" class="item-checkbox">
                    </td>
                    <td>
                        <img src="../../assets/img/<?php echo htmlspecialchars($row['product_image']); ?>" alt="">
                        <div><?php echo htmlspecialchars($row['product_name']); ?></div>
                    </td>
                    <td>
                        <?php if ($row['card_name']): ?>
                            <img src="../../assets/img/<?php echo htmlspecialchars($row['card_image']); ?>" alt="" style="width:40px;height:40px;"><br>
                            <?php echo htmlspecialchars($row['card_name']); ?><br>
                            +<?php echo number_format($row['card_price']); ?> VND
                            <span data-card-price="<?php echo $row['card_price']; ?>" style="display:none;"></span>
                        <?php else: ?>
                            <span style="color:#888;">None</span>
                            <span data-card-price="0" style="display:none;"></span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php echo number_format($row['product_price']); ?> VND
                        <span data-product-price="<?php echo $row['product_price']; ?>" style="display:none;"></span>
                        <?php if ($row['card_price']): ?><br>+<?php echo number_format($row['card_price']); ?> VND<?php endif; ?>
                    </td>
                    <td>
                        <input type="number" name="quantities[<?php echo $row['cart_id']; ?>]" value="<?php echo $row['quantity']; ?>" min="1" style="width:60px;" onchange="this.form.submit();">
                    </td>
                    <td class="subtotal-cell">
                        <?php echo number_format($subtotal); ?> VND
                    </td>
                    <td>
                        <button type="submit" name="remove" value="<?php echo $row['cart_id']; ?>" class="remove-btn">Remove</button>
                    </td>
                </tr>
                <?php endwhile; ?>
                <tr>
                    <td colspan="4" style="text-align:right;"><b>Total:</b></td>
                    <td colspan="2"><b id="grand-total"><?php echo number_format($grand_total); ?> VND</b></td>
                </tr>
            </table>
            <a href="#" onclick="submitCheckout(event)" class="checkout-btn" style="text-decoration:none; margin-left:20px;">Checkout</a>
        </form>
        <form id="checkout-form" method="post" action="pay.php" style="display:none;">
            <input type="hidden" name="checkout_items" id="checkout-items">
        </form>
        <?php else: ?>
            <div class="empty-cart">Your cart is empty.</div>
        <?php endif; ?>
    </div>
    <?php include '../../includes/footer.php'; ?>
    <script>
    document.getElementById('select-all').addEventListener('change', function() {
        document.querySelectorAll('.item-checkbox').forEach(cb => cb.checked = this.checked);
    });

    function submitCheckout(e) {
        e.preventDefault();
        const checked = Array.from(document.querySelectorAll('.item-checkbox:checked')).map(cb => cb.value);
        if (checked.length === 0) {
            alert('Please select at least one product to checkout.');
            return;
        }
        document.getElementById('checkout-items').value = checked.join(',');
        document.getElementById('checkout-form').submit();
    }

    // --- Dynamic price update ---
    document.querySelectorAll('input[type="number"][name^="quantities"]').forEach(function(input) {
        input.addEventListener('input', function() {
            const row = input.closest('tr');
            const productPrice = parseInt(row.querySelector('[data-product-price]').getAttribute('data-product-price'));
            const cardPrice = parseInt(row.querySelector('[data-card-price]') ? row.querySelector('[data-card-price]').getAttribute('data-card-price') : 0) || 0;
            const quantity = parseInt(input.value) || 1;
            const subtotal = (productPrice * quantity) + cardPrice;
            row.querySelector('.subtotal-cell').textContent = subtotal.toLocaleString() + ' VND';

            // Update grand total
            let grandTotal = 0;
            document.querySelectorAll('.subtotal-cell').forEach(function(cell) {
                grandTotal += parseInt(cell.textContent.replace(/[^\d]/g, '')) || 0;
            });
            document.getElementById('grand-total').textContent = grandTotal.toLocaleString() + ' VND';
        });
    });
    </script>
</body>
</html>