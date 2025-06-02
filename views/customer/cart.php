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
                        <img src="../../assets/img/<?php echo htmlspecialchars($row['product_image']); ?>" alt="">
                        <div><?php echo htmlspecialchars($row['product_name']); ?></div>
                    </td>
                    <td>
                        <?php if ($row['card_name']): ?>
                            <img src="../../assets/img/<?php echo htmlspecialchars($row['card_image']); ?>" alt="" style="width:40px;height:40px;"><br>
                            <?php echo htmlspecialchars($row['card_name']); ?><br>
                            +<?php echo number_format($row['card_price']); ?> VND
                        <?php else: ?>
                            <span style="color:#888;">None</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php echo number_format($row['product_price']); ?> VND
                        <?php if ($row['card_price']): ?><br>+<?php echo number_format($row['card_price']); ?> VND<?php endif; ?>
                    </td>
                    <td>
                        <input type="number" name="quantities[<?php echo $row['cart_id']; ?>]" value="<?php echo $row['quantity']; ?>" min="1" style="width:60px;">
                    </td>
                    <td>
                        <?php echo number_format($subtotal); ?> VND
                    </td>
                    <td>
                        <button type="submit" name="remove" value="<?php echo $row['cart_id']; ?>" class="remove-btn">Remove</button>
                    </td>
                </tr>
                <?php endwhile; ?>
                <tr>
                    <td colspan="4" style="text-align:right;"><b>Total:</b></td>
                    <td colspan="2"><b><?php echo number_format($grand_total); ?> VND</b></td>
                </tr>
            </table>
            <button type="submit" name="update" class="checkout-btn">Update Cart</button>
            <a href="pay.php" class="checkout-btn" style="text-decoration:none; margin-left:20px;">Checkout</a>
        </form>
        <?php else: ?>
            <div class="empty-cart">Your cart is empty.</div>
        <?php endif; ?>
    </div>
    <?php include '../../includes/footer.php'; ?>
</body>
</html>