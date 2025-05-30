
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flower Shop</title>
    <style>
        body { margin: 0; }
        .header-top {
            background: #e3f5e1;
            height: 8px;
        }
        .header-main {
            background: #fcd6d6;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
            height: 70px;
            font-family: Arial, sans-serif;
        }
        .logo {
            display: flex;
            align-items: center;
        }
        .logo-img {
            width: 60px;
            height: 60px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            border: 1px solid #eee;
        }
        .logo-text {
            font-family: 'Brush Script MT', cursive;
            font-size: 22px;
            color: #b97a56;
        }
        .nav {
            display: flex;
            gap: 40px;
        }
        .nav a {
            text-decoration: none;
            color: #222;
            font-size: 18px;
            font-weight: 500;
            letter-spacing: 1px;
        }
        .header-actions {
            display: flex;
            align-items: center;
            gap: 30px;
        }
        .call {
            display: flex;
            align-items: center;
            font-size: 15px;
            color: #444;
        }
        .call-icon {
            margin-right: 7px;
            font-size: 18px;
        }
        .call-number {
            font-weight: bold;
            margin-left: 5px;
            color: #222;
        }
        .icon-heart {
            font-size: 28px;
            color: #222;
            margin-right: 10px;
        }
        .sign-in {
            font-size: 17px;
            color: #222;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
        }
        .dot {
            color: #e74c3c;
            font-size: 22px;
            margin-right: 5px;
        }
    </style>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <div class="header-top"></div>
    <div class="header-main">
        <div class="logo">
            <div class="logo-img">
                <!-- Bạn có thể thay bằng <img src="logo.png" ...> -->
                <span class="logo-text">Blossom</span>
            </div>
        </div>
        <nav class="nav">
            <a href="#">BOUQUET</a>
            <a href="#">COLLECTION</a>
            <a href="#">OUR STORY</a>
        </nav>
        <div class="header-actions">
            <div class="call">
                <span class="call-icon"><i class="fa fa-phone"></i></span>
                <span>Call to order</span>
                <span class="call-number">+84 9001090</span>
            </div>
            <span class="icon-heart"><i class="fa-regular fa-heart"></i></span>
            <a href="#" class="sign-in"><span class="dot">•</span>SIGN-IN</a>
        </div>
    </div>
</body>
</html>