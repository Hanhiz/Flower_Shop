<?php
// filepath: d:\Xampp\htdocs\flower_shop\views\auth\login.php
session_start();
include '../../connectdb.php';

// Get the last page (referer) or default to homepage
$redirect = isset($_GET['redirect']) ? $_GET['redirect'] : (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/flower_shop/homepage.php');

if (isset($_SESSION['user_id'])) {
    header("Location: $redirect");
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($user_id, $db_password);
        $stmt->fetch();
        if ($password === $db_password) {
            $_SESSION['user_id'] = $user_id;
            header("Location: $redirect");
            exit;
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "User not found.";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Blossom Flower Shop</title>
    <style>
        body { background: #f8f8f8; font-family: Arial, sans-serif; }
        .login-container {
            max-width: 400px; margin: 60px auto; background: #fff;
            border-radius: 10px; box-shadow: 0 2px 12px #eee; padding: 32px;
        }
        h2 { color: #e75480; text-align: center; }
        input[type="text"], input[type="password"] {
            width: 100%; padding: 10px; margin-bottom: 18px; border-radius: 5px; border: 1px solid #ccc;
        }
        button {
            width: 100%; background: #e75480; color: #fff; border: none; border-radius: 5px;
            padding: 12px 0; font-size: 18px; cursor: pointer; transition: background 0.2s;
        }
        button:hover { background: #d84372; }
        .error { color: #d84372; text-align: center; margin-bottom: 12px; }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="post" action="login.php?redirect=<?php echo urlencode($redirect); ?>">
            <input type="text" name="email" placeholder="Email" required autofocus>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <div style="text-align:center; margin-top:18px;">
            <a href="register.php" style="color:#e75480;">Don't have an account? Register</a>
        </div>
    </div>
    <p>Alo, cái này tui chỉ làm demo thôi, để thử mấy cái sau cho tiện.</p>
    <p>Ai làm phần này có gì chỉnh lại css các kiểu giúp tui nhe hehe :))</p>
</body>
</html>