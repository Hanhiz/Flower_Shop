<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href='https://fonts.googleapis.com/css?family=Charmonman' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Inria Serif' rel='stylesheet'>
    <title>Flower Shop</title>
    <style>
        html {
            scroll-behavior: smooth;
            margin: 0;
            padding: 0;
            width: 100%;
        }
        body { 
            font-family: Montserrat; 
            background-color: #f8f8f8; 
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
        .containerb { 
            clear: both;
            width: 80%; 
            background: #fff; 
            margin: 0 auto;
            padding: 20px 10%;

        }
        .container { 
            clear: both;
            width: 100%; 
            background: #fff; 
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
        .bottomleft {
            position: absolute;
            bottom: 8px;
            left: 12px;
            font-size: 20px;
            color: white;
            font-family: 'Inria Serif', serif;
            width: 60%;
        }

        footer { 
            clear: both;
            text-align: center; 
            color: #888; 
            margin: 40px 0 10px; 
        }
        .container1 {
            width: 49%;
            position: relative;
            float: left;
            margin: 0 0.5%;
        }
        .container2 {
            width: 33%;
            position: relative;
            float: left;
            margin: 0 0.1%;
        }
        .collection1 {
            margin-top: 20px;
        }
        .collection1::after {
            content: "";
            display: table;
            clear: both;
        }
        .containerc {
            width: 80%;
            margin: 0 auto;
            padding: 20px 10%;
            background: #fff;
            color: #333;
            font-size: 16px;
            line-height: 1.6;
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
    <div class="containerb">
        <center>
            <h3>Discover</h3>
            <h2><img src="assets/img/flower_5768957.png" width=1.4%> Our Collection <img src="assets/img/flower_5768957.png" width=1.4%></h2>
        </center>
        <div class="collection1">
            <div class="container1">
                <img src="assets/img/collection1.png" alt="Bouquet 1" style="width: 100%; object-fit: cover; border-radius: 8px;">
                <div class="bottomleft">Collection<br><span style="font-size: 20pt;"><b>Anniversary Flowers</b></span></div>
            </div>
            <div class="container1">
                <img src="assets/img/collection2.png" alt="Bouquet 2" style="width: 100%; object-fit: cover; border-radius: 8px;">
                <div class="bottomleft">Collection<br><span style="font-size: 20pt;"><b>Birthday Flowers</b></span></div>
            </div>
            <div class="container2">
                <img src="assets/img/collection3.png" alt="Bouquet 3" style="width: 100%; height: 770px; object-fit: cover; border-radius: 8px;">
                <div class="bottomleft">Collection<br><span style="font-size: 20pt;"><b>International Woman’s Day Flowers</b></span></div>
            </div>
            <div class="container2">
                <img src="assets/img/collection4.png" alt="Bouquet 4" style="width: 100%; height: 770px; object-fit: cover; border-radius: 8px;">
                <div class="bottomleft">Collection<br><span style="font-size: 20pt;"><b>Teacher’s Day Flowers</b></span></div>
            </div>
            <div class="container2">
                <img src="assets/img/collection5.png" alt="Bouquet 5" style="width: 100%; height: 770px; object-fit: cover; border-radius: 8px;">
                <div class="bottomleft">Collection<br><span style="font-size: 20pt;"><b>Parents’ Day Flowers</b></span></div>
            </div>
        </div>
    </div>

    <div class="containerc">
        <h2>ABOUT FLOWER DELIVERY WITH BLOSSOM FLOWER SHOP </h2>
        <h3>Celebrate a special occasion or send a thoughtful message with an impressive bouquet of flowers.</h3>
        <p>BLOSSOM FLOWER SHOP is one-of-a-kind florist with efficient flower delivery service. We craft our flower bouquets with the freshest flowers and package them carefully to ensure both our customers and their recipients are 100% satisfied.

        Our wide variety of floral arrangements means you can order online the perfect gift for any occasion. Send classic red roses for an anniversary or a bright assorted bouquet for a loved one's birthday.

        Additionally, our flowers are ideal for a thank you gift, a get well soon gesture, congratulating someone on a promotion, or celebrating the birth of a new baby. And if you forget to mark your calendar for Valentine's Day or Mother's Day, don't worry — we're pros at last-minute deliveries.

        Need some inspiration? Browse the Occasion tab on our website to see what bouquets our florists recommend. Once you've made your choice, all you need to do is order our flowers online and we'll get started on your flower delivery right away.</p>
        <p>We also offer same-day flower delivery for those who need a last-minute gift. Simply place your order before our cut-off time and we'll ensure your flowers arrive on the same day.</p>
        <p>At BLOSSOM FLOWER SHOP, we take pride in our customer service and quality. Our team is dedicated to making sure your flower delivery experience is seamless and enjoyable. Whether you're sending flowers to a loved one or treating yourself, we guarantee you'll be satisfied with our service.</p>
        <p>So why wait? Order your flowers online today and let us help you make someone's day special with a beautiful bouquet from BLOSSOM FLOWER SHOP.</p>

    </div>
    <?php include 'includes/footer.php'; ?>
    
</body>
</html>