<?php
// Simple Flower Shop Homepage

$flowers = [
    [
        'name' => 'Red Roses',
        'price' => 25.00,
        'image' => 'https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=400&q=80'
    ],
    [
        'name' => 'Tulips',
        'price' => 18.00,
        'image' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80'
    ],
    [
        'name' => 'Sunflowers',
        'price' => 20.00,
        'image' => 'https://images.unsplash.com/photo-1465101178521-c1a9136a3b99?auto=format&fit=crop&w=400&q=80'
    ],
    [
        'name' => 'Lilies',
        'price' => 22.00,
        'image' => 'https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=400&q=80'
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href='https://fonts.googleapis.com/css?family=Charmonman' rel='stylesheet'>
    <title>Flower Shop</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f8f8f8; margin: 0; }
        header { 
            background: #FFE8EE; 
            background-image: url('assets/img/home_banner.png');
            background-repeat: no-repeat;
            background-size: 900px 900px;
            background-position: right;
            color: black; 
            padding: 130px 0px 130px 50px; 
            position: relative;
        }
        .container { max-width: 1000px; margin: 30px auto; background: #fff; padding: 30px; border-radius: 8px; }
        .flowers { display: flex; flex-wrap: wrap; gap: 30px; justify-content: center; }
        .flower { background: #fafafa; border: 1px solid #eee; border-radius: 8px; width: 220px; text-align: center; box-shadow: 0 2px 8px #eee; }
        .flower img { width: 100%; height: 180px; object-fit: cover; border-radius: 8px 8px 0 0; }
        .flower h3 { margin: 15px 0 5px; }
        .flower p { margin: 0 0 15px; }
        .buy-btn { background: #e75480; color: #fff; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; }
        .buy-btn:hover { background: #d1436c; }
        footer { text-align: center; color: #888; margin: 40px 0 10px; }
    </style>
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <header>
        <h1>Blossom Flower Shop</h1>
        <p style="font-family: 'Charmonman';">A bouquet of love</p>
        <p>Welcome to our flower shop! Explore our beautiful collection of flowers.</p>
        <button class="buy-btn">Purchase</button>
        <span style="padding-left: 2%;"> Read more </span>
    </header>
    <div class="container">
        <h2>Our Flowers</h2>
        <div class="flowers">
            <?php foreach ($flowers as $flower): ?>
                <div class="flower">
                    <img src="<?php echo htmlspecialchars($flower['image']); ?>" alt="<?php echo htmlspecialchars($flower['name']); ?>">
                    <h3><?php echo htmlspecialchars($flower['name']); ?></h3>
                    <p>$<?php echo number_format($flower['price'], 2); ?></p>
                    <button class="buy-btn">Buy Now</button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <footer>
        &copy; <?php echo date('Y'); ?> Flower Shop. All rights reserved.
    </footer>
</body>
</html>