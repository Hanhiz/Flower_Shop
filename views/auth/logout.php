<?php
// filepath: d:\Xampp\htdocs\flower_shop\views\auth\logout.php
session_start();
session_unset();
session_destroy();
header("Location: /flower_shop/homepage.php");
exit;