<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
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
            padding: 15px 20px; 
            border-radius: 4px; 
            cursor: pointer; 
        }
        .bestsellers-text button:hover { 
            background: #d1436c; 
        }
        .text-up { 
            font-size: 18px; 
            font-weight: bold; 
            color: #000; 
            margin-bottom: 210px;
        }
        .text-up h2 { 
            margin: 0; 
        }
        .text-down { 
            font-size: 15px; 
            color: #333; 
            margin-top: 10px; 
        }

        .flower { 
            background: #fafafa; 
            border: 1px solid #eee; 
            border-radius: 8px; 
            width: 30%; 
            text-align: center; 
            box-shadow: 0 2px 8px #eee; 
        }
        .flower img { 
            width: 100%; 
            height: 280px; 
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
            text-decoration: none;
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
        .circle-button {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            border: none;
            background-color: #FFC0CB;
            color: white;
            text-align: center;
            line-height: 48px; /* vertically center text */
            font-size: 18px;
            cursor: pointer;
        }
        .circle-button:hover {
            background-color: #FF69B4;
        }

        .containerc p, .containerc h4 {
            display: none;
        }
        .containerc .faq-section h3,
        .containerc .faq-section h4 {
            display: flex;
            align-items: center;
            cursor: pointer;
            justify-content: space-between;
        }
        .containerc .toggle-icon {
            font-size: 18px;
            margin-left: 10px;
            transition: transform 0.2s;
        }

        .faq-section {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 0 15px;
        }

        .toggle-icon {
            font-size: 12px;
            margin-left: 5px;
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
            width: 300px;
            opacity: 1;
            transition: opacity 0.5s;
        }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <?php if (!empty($_SESSION['login_success'])): ?>
        <div id="login-toast" class="login-toast"><img src="/flower_shop/assets/img/bell.png" style = "width: 6%; margin-right:20px;" >Login successful!</div>
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
    <header>
        <img src="assets/img/home_banner.jpg" alt="Flower Shop" style="width: 40%; height: 500px; object-fit: cover; justify-content: right; border-radius: 8px; position: absolute; right: 0; top: 0px; margin-right: 0px;">
        <h1>Blossom Flower Shop</h1>
        <p style="font-family: 'Charmonman';">A bouquet of love</p>
        <p>Welcome to our flower shop! Explore our beautiful collection of flowers.
        We offer a wide variety of fresh flowers for every occasion.
        From elegant roses to vibrant sunflowers, we have something for everyone.</p><br>
        <a href="shop.php" class="buy-btn">Purchase</a>
        <span style="padding-left: 2%; font-size: 12pt"><a href="#" style="text-decoration:none; color:black;"><b>Read more</b></a></span>
        <br><br><br><br><br>
        <p style="font-size: 12pt; font-family: Montserrat;"><b>Get a discount on your first order!</b></p>
    </header>
    <div class="container" id="bouquet">
        <div class="bestsellers">
            <div class="bestsellers-text">
                <div class="text-up">
                    <h2>Best Sellers</h2>
                </div>
                <div class="text-down">
                    Our selection of best selling bouquets by Blossom Flower Shop. Send a beautiful bouquet today.<br>
                    <br><button><a href="shop.php" style="text-decoration:none; color:white;">Shop Bestsellers</a></button>
                </div>
            </div>
            <button onclick="prevFlower()" class="circle-button"><</button>
            <div class="flowers" id="flowers-slideshow">
                <!-- Images will be injected by JavaScript -->
            </div>
            <button onclick="nextFlower()" class="circle-button">></button>
        </div>
    </div>
    <div class="containerb" id="collection">
        <center>
            <h3>Discover</h3>
            <h2><img src="assets/img/flower_5768957.png" width=1.4%> Our Collections <img src="assets/img/flower_5768957.png" width=1.4%></h2>
        </center>
        <div class="collection1">
            <div class="container1">
                <a href="views/customer/collection.php?c=1">
                    <img src="assets/img/collection1.png" alt="Bouquet 1" style="width: 100%; object-fit: cover; border-radius: 8px;">
                    <div class="bottomleft">Collection<br><span style="font-size: 20pt;"><b>Anniversary Flowers</b></span></div>
                </a>
            </div>
            <div class="container1">
                <a href="views/customer/collection.php?c=2">
                    <img src="assets/img/collection2.png" alt="Bouquet 2" style="width: 100%; object-fit: cover; border-radius: 8px;">
                    <div class="bottomleft">Collection<br><span style="font-size: 20pt;"><b>Birthday Flowers</b></span></div>
                </a>
            </div>
            <div class="container2">
                <a href="views/customer/collection.php?c=3">
                    <img src="assets/img/collection3.png" alt="Bouquet 3" style="width: 100%; height: 770px; object-fit: cover; border-radius: 8px;">
                    <div class="bottomleft">Collection<br><span style="font-size: 20pt;"><b>International Woman’s Day Flowers</b></span></div>
                </a>
            </div>
            <div class="container2">
                <a href="views/customer/collection.php?c=4">
                    <img src="assets/img/collection4.png" alt="Bouquet 4" style="width: 100%; height: 770px; object-fit: cover; border-radius: 8px;">
                    <div class="bottomleft">Collection<br><span style="font-size: 20pt;"><b>Teacher’s Day Flowers</b></span></div>
                </a>
            </div>
            <div class="container2">
                <a href="views/customer/collection.php?c=5">
                    <img src="assets/img/collection5.png" alt="Bouquet 5" style="width: 100%; height: 770px; object-fit: cover; border-radius: 8px;">
                    <div class="bottomleft">Collection<br><span style="font-size: 20pt;"><b>Parents’ Day Flowers</b></span></div>
                </a>
            </div>
        </div>
    </div>

    <div class="containerc" id="about">
        <h2>ABOUT FLOWER DELIVERY WITH BLOSSOM FLOWER SHOP </h2>
        <div class="faq-section">
            <h3>
                Celebrate a special occasion or send a thoughtful message with an impressive bouquet of flowers.
                <span class="toggle-icon"><i class="fa-solid fa-chevron-down"></i></span>
            </h3>
            <p>BLOSSOM FLOWER SHOP is one-of-a-kind florist with efficient flower delivery service. We craft our flower bouquets with the freshest flowers and package them carefully to ensure both our customers and their recipients are 100% satisfied.

            <br><br>Our wide variety of floral arrangements means you can order online the perfect gift for any occasion. Send classic red roses for an anniversary or a bright assorted bouquet for a loved one's birthday.

            <br><br>Additionally, our flowers are ideal for a thank you gift, a get well soon gesture, congratulating someone on a promotion, or celebrating the birth of a new baby. And if you forget to mark your calendar for Valentine's Day or Mother's Day, don't worry — we're pros at last-minute deliveries.

            <br><br>Need some inspiration? Browse the Occasion tab on our website to see what bouquets our florists recommend. Once you've made your choice, all you need to do is order our flowers online and we'll get started on your flower delivery right away.</p>
        </div>
        <div class="faq-section">
            <h3>
                Types of Flower Bouquets We Offer
                <span class="toggle-icon"><i class="fa-solid fa-chevron-down"></i></span>
            </h3>
            <p>With our extensive selection of flower arrangements, you're sure to find the perfect blooms for your loved one. Here are the types of bouquets we offer:

            <span><br><br><b>Roses</b></span>: Surprise your loved one with a timeless bouquet of roses in a color they'll adore, whether it's elegant white, brilliant red, soft pink, or striking purple.

            <span><br><b>Peonies</b></span>: Our soft and delicate peony arrangements add simplicity and elegance to homes and offices.

            <span><br><b>Tulips</b></span>: Vibrant tulips add the perfect touch of color and joy to any space they occupy.

            <span><br><b>Mixed bouquets</b></span>: While one variety is beautiful on its own, consider a mixed bouquet of assorted flowers — the more the merrier!</p>
        </div>
        <div class="faq-section">
            <h3>
                Why Order Flowers from Blossom Flower Shop?
                <span class="toggle-icon"><i class="fa-solid fa-chevron-down"></i></span>
            </h3>
            <p>Here are three of the many reasons you should order and send flowers through Blossom Flower Shop.<br>
                <b>1. Farm Fresh Flowers</b><br>

                Thanks to Blossom Flower Shop, you don't have to travel to Europe to find stunning arrangements. We source our flowers during their peak growing seasons from the top eco-friendly farms in countries such as Ecuador and Holland. Through our partnerships with these farms, we can provide you with fresh, beautiful, and quality blooms year-round.

                <br><br><b>2. Bouquets Hand-Crafted with Love</b><br>

                We treat every order that comes to our shop with the utmost care and attention. Our skilled artisans hand-tie each bouquet with an exquisite French touch, hydrate the stems to ensure optimal freshness, then package your bouquet in our unique signature gift box.

                <br><br><b>3. Delivery across the US & Same-Day Flower Delivery</b><br>

                At Blossom Flower Shop, we pride ourselves on quick and efficient delivery services. We deliver our bouquets nationwide. For last minute purchases, we also offer same-day delivery in select cities: NYC, Chicago, Los Angeles, Austin, Washington D.C., and Miami. Check our flower delivery zones to see how soon we can deliver our flowers near you.
            </p>
        </div>
        <div class="faq-section">
            <h3>
                Frequently Asked Questions About Rose Flower Delivery
                <span class="toggle-icon"><i class="fa-solid fa-chevron-down"></i></span>
            </h3>
            <p>Below are some common questions regarding Blossom flower shop delivery.</p>
            <h4>
                <b>How Much Is Flower Delivery?</b>
                <span class="toggle-icon"><i class="fa-solid fa-chevron-down"></i></span>
            </h4>
            <p>Our delivery fees vary from 5.000₫ for smaller arrangements to 30.000₫ for a couple of our largest bouquets. The large majority of our bouquets are $16 delivery.</p>

            <h4>
                <b>What Payment Methods Do You Accept?</b>
                <span class="toggle-icon"><i class="fa-solid fa-chevron-down"></i></span>
            </h4>
            <p>We currently accept Visa, Mastercard, debit and credit card payments. You can also check out online using banking.</p>

            <h4>
                <b>How Do You Package Bouquets?</b>
                <span class="toggle-icon"><i class="fa-solid fa-chevron-down"></i></span>
            </h4>
            <p>We store our bouquets in water-filled travel vases to keep them hydrated and package them in our signature pink gift boxes for shipping and delivery.</p>

            <h4>
                <b>How Do I Know When My Order Is on the Way?</b>
                <span class="toggle-icon"><i class="fa-solid fa-chevron-down"></i></span>
            </h4>
            <p>Once your order leaves our shop, we'll send you a photo of your arrangement to notify you that it's on the way. After that, you can follow it with our online order tracking feature.</p>

            <h4>
                <b>How Long Will My Bouquet Last?</b>
                <span class="toggle-icon"><i class="fa-solid fa-chevron-down"></i></span>
            </h4>
            <p>While this usually depends on the variety you choose, most of our bouquets will stay fresh for around five days.</p>
        </div>
        <div class="faq-section">
            <h3>
                Order Flowers Online Today
                <span class="toggle-icon"><i class="fa-solid fa-chevron-down"></i></span>
            </h3>
            <p>We also offer same-day flower delivery for those who need a last-minute gift. Simply place your order before our cut-off time and we'll ensure your flowers arrive on the same day.</p>
            <p>At BLOSSOM FLOWER SHOP, we take pride in our customer service and quality. Our team is dedicated to making sure your flower delivery experience is seamless and enjoyable. Whether you're sending flowers to a loved one or treating yourself, we guarantee you'll be satisfied with our service.</p>
            <p>So why wait? Order your flowers online today and let us help you make someone's day special with a beautiful bouquet from BLOSSOM FLOWER SHOP.</p>
        </div>
    </div>
    <?php include 'includes/footer.php'; ?>
    <?php
    include 'connectdb.php';

    $sql = "
        SELECT 
            p.id,
            p.name, 
            p.image, 
            p.price, 
            SUM(oi.quantity) AS total_sales
        FROM products p
        LEFT JOIN order_items oi ON p.id = oi.product_id
        WHERE p.status = 1
        GROUP BY p.id
        ORDER BY total_sales DESC
        LIMIT 5
    ";
    $result = $conn->query($sql);

    $flowers = [];
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $flowers[] = $row;
        }
    }
    ?>
    <script>
        // PHP to JS: encode the $flowers array
        const flowers = <?php echo json_encode($flowers); ?>;
        let current = 0;
        const imagesPerSlide = 3;
        const slideshow = document.getElementById('flowers-slideshow');

        function renderSlide() {
            slideshow.innerHTML = '';
            for (let i = 0; i < imagesPerSlide; i++) {
                const idx = (current + i) % flowers.length;
                const flower = flowers[idx];
                const div = document.createElement('div');
                div.className = 'flower';
                div.innerHTML = `
                    <a href="product_details.php?id=${flower.id}" style="text-decoration:none;color:inherit;">
                        <img src="assets/img/${flower.image}" alt="${flower.name}">
                        <h3>${flower.name}</h3>
                        <p>${Number(flower.price).toLocaleString()} VND</p>
                    </a>
                `;
                slideshow.appendChild(div);
            }
        }

        function nextFlower() {
            current = (current + 1) % flowers.length;
            renderSlide();
        }

        function prevFlower() {
            current = (current - 1 + flowers.length) % flowers.length;
            renderSlide();
        }

        // Auto-slide every 3 seconds
        let autoSlide = setInterval(nextFlower, 3000);

        // Pause on hover
        slideshow.addEventListener('mouseenter', () => clearInterval(autoSlide));
        slideshow.addEventListener('mouseleave', () => autoSlide = setInterval(nextFlower, 3000));

        renderSlide();

        // Hide all <p> and <h4> at start
        document.querySelectorAll('.containerc p, .containerc h4').forEach(el => el.style.display = 'none');

        // Toggle FAQ section on h3 click
        document.querySelectorAll('.containerc .faq-section h3').forEach(h3 => {
            h3.addEventListener('click', function() {
                const section = h3.parentElement;
                const isOpen = h3.classList.toggle('open');
                // Toggle icon
                h3.querySelector('.toggle-icon').innerHTML = isOpen
                    ? '<i class="fa-solid fa-chevron-up"></i>'
                    : '<i class="fa-solid fa-chevron-down"></i>';
                // Show/hide all h4 and p in this section (except h3)
                Array.from(section.children).forEach(child => {
                    if (child !== h3) {
                        if (child.tagName === 'H4') {
                            child.style.display = isOpen ? 'flex' : 'none';
                            // Reset h4 icon and hide its p's
                            child.classList.remove('open');
                            child.querySelector('.toggle-icon').innerHTML = '<i class="fa-solid fa-chevron-down"></i>';
                            let next = child.nextElementSibling;
                            while (next && next.tagName === 'P') {
                                next.style.display = 'none';
                                next = next.nextElementSibling;
                            }
                        } else if (child.tagName === 'P') {
                            // Only show <p> if not after h4
                            const prev = child.previousElementSibling;
                            if (!prev || prev.tagName !== 'H4') {
                                child.style.display = isOpen ? 'block' : 'none';
                            }
                        }
                    }
                });
            });
        });

        // Toggle answer on h4 click
        document.querySelectorAll('.containerc .faq-section h4').forEach(h4 => {
            h4.addEventListener('click', function(e) {
                e.stopPropagation(); // Prevent h3 toggle
                const isOpen = h4.classList.toggle('open');
                h4.querySelector('.toggle-icon').innerHTML = isOpen
                    ? '<i class="fa-solid fa-chevron-up"></i>'
                    : '<i class="fa-solid fa-chevron-down"></i>';
                // Toggle all following <p> until next h4/h3
                let next = h4.nextElementSibling;
                while (next && next.tagName === 'P') {
                    next.style.display = isOpen ? 'block' : 'none';
                    next = next.nextElementSibling;
                }
            });
        });
</script>
</body>
</html>