<?php
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Blossom Footer</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body, .footer-bg {
      background-color: #FAD1CC !important;
    }
  </style>
</head>
<body class="text-gray-900">

  <!-- Top footer: Logo & Social icons -->
  <div class="footer-bg px-8 py-6">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
      <!-- Logo -->
      <div class="flex-shrink-0">
        <img src="../assets/img/web_logo.png" alt="Blossom Logo" class="h-24 w-auto">
      </div>

      <!-- Social icons -->
      <div class="flex items-center space-x-8">
        <a href="#"><img src="../assets/img/ig.png" alt="Instagram" class="h-12 w-12 hover:opacity-70 transition"></a>
        <a href="#"><img src="../assets/img/facebook.png" alt="Facebook" class="h-12 w-12 hover:opacity-70 transition"></a>
        <a href="#"><img src="../assets/img/x.png" alt="X" class="h-12 w-12 hover:opacity-70 transition"></a>
        <a href="#"><img src="../assets/img/youtube.png" alt="YouTube" class="h-12 w-12 hover:opacity-70 transition"></a>
        <a href="#"><img src="../assets/img/email.png" alt="Email" class="h-12 w-12 hover:opacity-70 transition"></a>
      </div>
    </div>
  </div>

  <!-- Footer main -->
  <footer class="footer-bg px-8 py-12">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">

      <!-- Shop -->
      <div class="text-left">
        <h3 class="text-lg font-semibold mb-3">Shop</h3>
        <ul class="space-y-1 text-sm">
          <li><a href="#">All Bouquets</a></li>
          <li><a href="#">Signature Bouquets</a></li>
          <li><a href="#">Preserved Roses</a></li>
          <li><a href="#">Roses</a></li>
          <li><a href="#">Flowers and Gifts</a></li>
        </ul>
      </div>

      <!-- About -->
      <div class="text-left">
        <h3 class="text-lg font-semibold mb-3">About</h3>
        <ul class="space-y-1 text-sm">
          <li><a href="#">Our Story</a></li>
          <li><a href="#">Contact Us</a></li>
          <li><a href="#">Blog</a></li>
          <li><a href="#">Your Account</a></li>
          <li><a href="#">FAQ</a></li>
          <li><a href="#">Where We Deliver</a></li>
        </ul>
      </div>

      <!-- Same-day Delivery -->
      <div class="text-left">
        <h3 class="text-lg font-semibold mb-3">Same-day Delivery</h3>
        <div class="grid grid-cols-2 gap-x-4 text-sm">
          <ul class="space-y-1">
            <li>Cau Giay</li>
            <li>Dong Da</li>
            <li>Thanh Xuan</li>
            <li>Nam Tu Liem</li>
            <li>Bac Tu Liem</li>
            <li>Ha Dong</li>
          </ul>
          <ul class="space-y-1">
            <li>Ba Dinh</li>
            <li>Tay Ho</li>
          </ul>
        </div>
      </div>

      <!-- Next-day Delivery -->
      <div class="text-left">
        <h3 class="text-lg font-semibold mb-3">Next-day Delivery</h3>
        <div class="grid grid-cols-2 gap-x-4 text-sm">
          <ul class="space-y-1">
            <li>Hoai Duc</li>
            <li>Son Tay</li>
            <li>Dan Phuong</li>
            <li>Chuong My</li>
            <li>Thach That</li>
            <li>Soc Son</li>
          </ul>
          <ul class="space-y-1">
            <li>Hai Duong</li>
            <li>Ha Nam</li>
            <li>Ninh Binh</li>
            <li>Hung Yen</li>
          </ul>
        </div>
      </div>

    </div>

    <!-- Bottom links -->
    <div class="mt-8 border-t pt-4 text-xs text-center text-gray-600 space-x-4">
      <a href="#" class="hover:underline">Sitemap</a>
      <a href="#" class="hover:underline">Accessibility Statement</a>
      <a href="#" class="hover:underline">Term & Condition</a>
      <a href="#" class="hover:underline">Privacy Policy</a>
    </div>
  </footer>

</body>
</html>