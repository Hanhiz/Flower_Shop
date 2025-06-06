<?php
// filepath: d:\Xampp\htdocs\flower_shop\views\auth\login.php
session_start();
include '../../connectdb.php';

$error = '';
$redirect = isset($_GET['redirect']) ? $_GET['redirect'] : (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/flower_shop/homepage.php');

if (isset($_SESSION['user_id'])) {
    header("Location: $redirect");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows === 1) {
        $stmt->bind_result($user_id, $db_password, $role);
        $stmt->fetch();
        if ($password === $db_password) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['role'] = $role;

            // Add login notification
            $type = 'login';
            $message = 'You have logged in successfully.';
            $created_at = date('Y-m-d H:i:s');
            $noti_stmt = $conn->prepare("INSERT INTO notifications (user_id, target_user_id, type, message, created_at) VALUES (?, ?, ?, ?, ?)");
            $noti_stmt->bind_param("iisss", $user_id, $user_id, $type, $message, $created_at);
            $noti_stmt->execute();
            $noti_stmt->close();

            $_SESSION['login_success'] = true;

            if ($role === 'admin') {
                header("Location: /flower_shop/views/admin/dashboard.php");
            } else {
                header("Location: $redirect");
            }
            exit;
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "User not found.";
    }
    $stmt->close();
}
include '../../includes/header.php'; ?>

<!DOCTYPE html>
<div class="login-bg">
    <div class="login-box">
        <div class="login-title">SIGN IN</div>
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <form method="post" action="login.php?redirect=<?php echo urlencode($redirect); ?>">
            <label class="login-label" for="email">Email</label>
            <input class="login-input" type="text" name="email" id="email" required autofocus>
            <label class="login-label" for="password">Password</label>
            <input class="login-input" type="password" name="password" id="password" required>
            <div class="login-row">
                <div>
                    <input class="login-checkbox" type="checkbox" id="remember" name="remember">
                    <label for="remember" style="font-size:12px; color:#222;">Remember me</label>
                </div>
                <a href="#" class="login-link">Forgot your password?</a>
            </div>
            <button class="login-btn" type="submit">Login</button>
        </form>
        <hr class="login-divider">
        <div class="login-new-title">New customer ?</div>
        <div class="login-discount">
            <span>Free and easy, enjoy a discount every 3 orders!</span>
            <span class="login-discount-icon"><i class="fa-solid fa-seedling"></i></span>
        </div>
        <form action="register.php" method="get">
            <button class="login-create-btn" type="submit">Create my account</button>
        </form>
    </div>
</div>

<style>
.login-bg {
    height: calc(100vh - 70px);
    min-height: unset;
    background: url('https://www.odealarose.com/media/cache/1920_1080_webp/build/images/flower-delivery.webp') center center/cover no-repeat;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    padding-top: 0;
}
.login-modal-bg {
    position: fixed;
    inset: 0;
    background: rgba(255,255,255,0.7);
    z-index: 0;
}
.login-box {
    position: relative;
    z-index: 1;
    background: #fff;
    border: 1px solid #222;
    border-radius: 0;
    max-width: 370px;
    width: 100%;
    margin: 48px auto;
    padding: 36px 32px 28px 32px;
    box-sizing: border-box;
    box-shadow: 0 2px 12px #eee;
}
.login-title {
    font-family: 'Playfair Display', serif;
    font-size: 2rem;
    font-weight: 700;
    letter-spacing: 1px;
    text-align: left;
    margin-bottom: 28px;
}
.login-label {
    font-size: 13px;
    color: #222;
    margin-bottom: 3px;
    display: block;
    font-weight: 400;
}
.login-input {
    width: 100%;
    padding: 8px 10px;
    margin-bottom: 18px;
    border-radius: 0;
    border: 1px solid #222;
    font-size: 15px;
    font-family: 'Montserrat', Arial, sans-serif;
    background: #fff;
    box-sizing: border-box;
}
.login-input:focus {
    outline: none;
    border-color: #e75480;
}
.login-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 12px;
}
.login-link {
    font-size: 12px;
    color: #222;
    text-decoration: underline;
    cursor: pointer;
    transition: color 0.2s;
}
.login-link:hover {
    color: #e75480;
}
.login-checkbox {
    margin-right: 6px;
}
.login-btn {
    width: 100%;
    background: #222;
    color: #fff;
    border: none;
    border-radius: 24px;
    padding: 12px 0;
    font-size: 16px;
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 700;
    cursor: pointer;
    margin: 18px 0 18px 0;
    transition: background 0.2s;
}
.login-btn:hover {
    background: #e75480;
}
.login-divider {
    border: none;
    border-top: 1px solid #eee;
    margin: 18px 0;
}
.login-new-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.1rem;
    font-style: italic;
    color: #222;
    margin-bottom: 10px;
}
.login-discount {
    background: #fad1cc;
    color: #b97a56;
    font-size: 14px;
    border-radius: 6px;
    padding: 14px 12px 14px 16px;
    margin-bottom: 18px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.login-discount-icon {
    font-size: 18px;
}
.login-create-btn {
    width: 100%;
    background: #fff;
    color: #222;
    border: 1.5px solid #222;
    border-radius: 24px;
    padding: 12px 0;
    font-size: 16px;
    font-family: 'Montserrat', Arial, sans-serif;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.2s, color 0.2s;
}
.login-create-btn:hover {
    background: #e75480;
    color: #fff;
    border-color: #e75480;
}
.error {
    color: #e75480;
    text-align: center;
    margin-bottom: 12px;
    font-size: 14px;
}
.header-main {
    z-index: 20;
    position: relative;
}
.login-toast {
    position: fixed;
    left: 24px;
    bottom: 32px;
    background: #2ecc40;
    color: #fff;
    padding: 16px 32px;
    border-radius: 8px;
    font-size: 1.1rem;
    box-shadow: 0 2px 12px #aaa;
    z-index: 9999;
    opacity: 1;
    transition: opacity 0.5s;
}
</style>
<?php if (!empty($_SESSION['login_success'])): ?>
    <div id="login-toast" class="login-toast">Login successful!</div>
    <script>
        setTimeout(function() {
            document.getElementById('login-toast').style.opacity = '0';
        }, 2000);
        setTimeout(function() {
            document.getElementById('login-toast').style.display = 'none';
        }, 2500);
    </script>
    <?php unset($_SESSION['login_success']); ?>
<?php endif; ?>