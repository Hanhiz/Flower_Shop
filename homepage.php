<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href='https://fonts.googleapis.com/css?family=Charmonman' rel='stylesheet'>
    <title>Flower Shop</title>
    <style>
        html {
            scroll-behavior: smooth;
            margin: 0;
            padding: 0;
            width: 100%;
        }
        body { 
            font-family: Arial, sans-serif; 
            background: #f8f8f8; 
            margin: 0; 
        }
        header { 
            width: 100%;
            background: #FFE8EE; 
            color: black; 
            padding: 130px 0px 20px 0px; 
            position: relative;
        }
        header h1 { 
            font-size: 48px; 
            margin: 0 30px; 
            font-weight: bold; 
        }
        header p { 
            font-size: 20px; 
            margin: 10px 30px; 
            line-height: 1.5; 
            width: 50%;
        }
        .container { 
            width: 100%; 
            background: #fff; 
            border-radius: 8px; 
            margin: 0 auto;
            padding: 20px 0px;
        }
        .container h2 { 
            margin: 0 30px;
        }
        .bestsellers { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            margin-bottom: 30px; 
            width: 100%;
        }
        .flowers { 
            display: flex; 
            flex-wrap: wrap; 
            gap: 30px; 
            width: 60%; 
            justify-content: right;
            margin-right: 20px;
        }

        .bestsellers-text { 
            font-size: 15px; 
            width: 40%;
            color: #e75480; 
            margin-left: 30px;
            display: flex;
            flex-direction: column;
            gap: 20px; 
            margin-top: auto;
        }

        .bestsellers-text button {
            width: 160px; 
            background: #e75480; 
            color: #fff; 
            border: none; 
            padding: 10px 20px; 
            border-radius: 4px; 
            cursor: pointer; 
        }
        .bestsellers-text button:hover { 
            background: #d1436c; 
        }
        .flower { 
            background: #fafafa; 
            border: 1px solid #eee; 
            border-radius: 8px; 
            width: 220px; 
            text-align: center; 
            box-shadow: 0 2px 8px #eee; 
        }
        .flower img { 
            width: 100%; 
            height: 180px; 
            object-fit: cover; 
            border-radius: 8px 8px 0 0; 
        }
        .flower h3 { 
            margin: 15px 0 5px; 
        }
        .flower p { 
            margin: 0 0 15px; 
        }
        .buy-btn { 
            background: #e75480; 
            color: #fff; 
            border: none; 
            padding: 10px 20px; 
            border-radius: 4px; 
            cursor: pointer; 
            margin: 0px 20px;
        }
        .buy-btn:hover { 
            background: #d1436c; 
        }
        footer { 
            text-align: center; 
            color: #888; 
            margin: 40px 0 10px; 
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <header>
        <img src="assets/img/home_banner.jpg" alt="Flower Shop" style="width: 40%; height: 500px; object-fit: cover; justify-content: right; border-radius: 8px; position: absolute; right: 0; top: 0px; margin-right: 50px;">
        <h1>Blossom Flower Shop</h1>
        <p style="font-family: 'Charmonman';">A bouquet of love</p>
        <p>Welcome to our flower shop! Explore our beautiful collection of flowers.
        We offer a wide variety of fresh flowers for every occasion.
        From elegant roses to vibrant sunflowers, we have something for everyone.</p>
        <button class="buy-btn">Purchase</button>
        <span style="padding-left: 2%; font-size: 12pt"><b>Read more</b></span>
        <br><br><br><br><br>
        <p style="font-size: 12pt; font-family: Montserrat;"><b>Get a discount on your first order!</b></p>
    </header>
    <div class="container">
        <h2>Our Bestsellers</h2>
        
        <div class="bestsellers">
            <div class="bestsellers-text">
                Our selection of best selling bouquets by Blossom Flower Shop. Send a beautiful bouquet today.<br>
                <button>Shop Bestsellers</button>
            </div>
            <div class="flowers">
                <img src="assets/img/hoa1.png" alt="Red Roses" class="flower">
                <img src="assets/img/hoa2.png" alt="Tulips" class="flower">
                <img src="assets/img/hoa3.png" alt="Sunflowers" class="flower">
            </div>
        </div>
    </div>
    <footer>
        <?php include 'includes/footer.php'; ?>
        &copy; <?php echo date('Y'); ?> Flower Shop. All rights reserved.
    </footer>
</body>
</html>