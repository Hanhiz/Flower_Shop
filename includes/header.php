<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flower Shop</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body { margin: 0; }
        .header-top {
            background: #e3f5e1;
            height: 8px;
        }
        .header-main {
            background: #FAD1CC;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding: 0 40px;
            height: 70px;
            font-family: 'Montserrat', Arial, sans-serif;
        }
        .header-left {
            display: flex;
            align-items: center;
            gap: 40px;
            flex: 1;
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
        .nav {
            display: flex;
            gap: 40px;
            position: relative;
        }
        .nav-item {
            position: relative;
        }
        .nav a {
            text-decoration: none;
            color: #3c3c3c;
            font-size: 14px;
            font-weight: 100; /* Montserrat Thin */
            letter-spacing: 1px;
            font-family: 'Montserrat', Verdana;
            padding: 8px 0;
            display: inline-block;
            transition: color 0.2s;
        }
        .nav a::after {
            content: "";
            display: block;
            height: 2px;
            width: 0;
            background: #b97a56;
            transition: width 0.3s;
            margin: 0 auto;
        }
        .nav a:hover, .nav a:focus {
            color: #b97a56;
        }
        .nav a:hover::after, .nav a:focus::after {
            width: 100%;
        }
        /* Dropdown styles */
        .dropdown {
            display: none;
            position: absolute;
            left: 0;
            top: 100%;
            background: #fff;
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.08);
            border-radius: 4px;
            z-index: 10;
        }
        .dropdown a {
            color: #222;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 500;
            display: block;
            background: none;
        }
        .dropdown a:hover {
            background: #FAD1CC;
            color: #b97a56;
        }
        .nav-item:hover .dropdown {
            display: block;
        }
        .header-actions {
            display: flex;
            align-items: center;
            gap: 30px;
            margin-left: 60px; /* Thêm dòng này để đẩy header-actions sang trái gần menu hơn */
        }
        .call {
            display: flex;
            align-items: center;         
            text-decoration: none;
            color: #3c3c3c;
            font-size: 14px;
            font-weight: 100; /* Montserrat Thin */
            letter-spacing: 1px;
            font-family: 'Montserrat', Verdana;
            color: #444;
        }
        .call-text {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
            font-size: 10px;
            font-weight: 100; /* Montserrat Thin */
            color: #6f6f6f;
        }
        .call-icon {
            margin-right: 7px;
            font-size: 25px;
        }
        .call-number {
            margin-left: 0;
            color: #3c3c3c;
            font-family: 'Montserrat', Verdana;
            font-size: 14px;
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
            color: #3c3c3c;
            font-size: 14px;
            font-weight: 100; /* Montserrat Thin */
            letter-spacing: 1px;
            font-family: 'Montserrat', Verdana;
            font-weight: 500;
            display: flex;
            align-items: center;
        }
        .dot {
            color: #e74c3c;
            font-size: 22px;
            margin-right: 5px;
            align-self: center;
            line-height: 1;
        }
    </style>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <div class="header-main">
        <div class="header-left">
            <div class="logo">
                <div class="logo-img" style="background:none; border:none;">
                    <img src="assets/img/web_logo.png" alt="Blossom Logo" style="width:60px; height:60px; object-fit:contain;">
                </div>
            </div>
            <nav class="nav">
                <div class="nav-item">
                    <a href="#">BOUQUET</a>
                    <div class="dropdown">
                        <a href="#">Roses</a>
                        <a href="#">Lilies</a>
                        <a href="#">Sunflowers</a>
                    </div>
                </div>
                <div class="nav-item">
                    <a href="#">COLLECTION</a>
                    <div class="dropdown">
                        <a href="#">Birthday</a>
                        <a href="#">Anniversary</a>
                        <a href="#">Congratulations</a>
                    </div>
                </div>
                <div class="nav-item">
                    <a href="#">OUR STORY</a>
                    <div class="dropdown">
                        <a href="#">About Us</a>
                        <a href="#">Our Team</a>
                    </div>
                </div>
            </nav>
        </div>
        <div class="header-actions">
            <div class="call">
                <span class="call-icon"><i class="fa fa-phone"></i></span>
                <div class="call-text">
                    <span>CALL TO ORDER</span>
                    <span class="call-number">+84 9001090</span>
                </div>
            </div>
            <span class="icon-heart"><i class="fa-regular fa-heart"></i></span>
            <a href="#" class="sign-in"><span class="dot">•</span><b>SIGN-IN</b></a>
        </div>
    </div>
</body>
</html>