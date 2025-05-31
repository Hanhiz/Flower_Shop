<?php
// filepath: c:\xampp\htdocs\Flower_Shop\views\customer\collection.php
include '../../includes/header.php';

// Lấy danh sách collection từ database
$conn = new mysqli('localhost', 'root', '', 'flowershop');
$conn->set_charset('utf8');
$collections = [];
$sql = "SELECT id, name, description FROM collections";
$result = $conn->query($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $collections[] = $row;
    }
}
$conn->close();

// Xác định collection được chọn
$selected = isset($_GET['c']) ? $_GET['c'] : 'all';
?>

<style>
body {
    background: #fff !important;
}
.collection-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 32px 0 48px 0;
}
.collection-menu {
    display: flex;
    justify-content: center;
    gap: 32px;
    margin-bottom: 32px;
    flex-wrap: wrap;
    background: transparent;
}
.collection-menu a {
    color: #222;
    text-decoration: none;
    font-size: 1rem;
    padding: 6px 10px 10px 10px;
    border-radius: 0;
    border-bottom: 2.5px solid transparent;
    transition: border-bottom 0.15s, color 0.15s;
    position: relative;
    font-weight: normal;
    background: transparent;
}
.collection-menu a.active,
.collection-menu a:hover {
    border-bottom: 2.5px solid #d17c7c;
    color: #000;
    background: transparent;
    font-weight: normal;
}
.collection-title {
    text-align: center;
    font-size: 2rem;
    font-family: 'Times New Roman', serif;
    margin-bottom: 32px;
    font-weight: 500;
    letter-spacing: 0.01em;
}
.collection-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 32px;
}
.collection-card {
    position: relative;
    background: none;
    border-radius: 0;
    box-shadow: none;
    overflow: hidden;
    text-align: left;
}
.collection-card img {
    width: 100%;
    height: 260px;
    object-fit: cover;
    display: block;
    border-radius: 0;
    box-shadow: none;
}
.collection-card-info {
    position: absolute;
    left: 0; bottom: 0; right: 0;
    padding: 0 0 18px 18px;
    color: #fff;
    text-shadow: 0 2px 8px rgba(0,0,0,0.25);
    pointer-events: none;
}
.collection-card-label {
    font-size: 0.85rem;
    letter-spacing: 0.08em;
    opacity: 0.85;
    margin-bottom: 2px;
    font-family: 'Times New Roman', serif;
}
.collection-card-title {
    font-size: 1.1rem;
    font-weight: 500;
    line-height: 1.3;
    font-family: 'Times New Roman', serif;
}
@media (max-width: 900px) {
    .collection-grid {
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
}
@media (max-width: 600px) {
    .collection-container {
        padding: 16px 0 24px 0;
    }
    .collection-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    .collection-card img {
        height: 160px;
    }
    .collection-title {
        font-size: 1.2rem;
    }
}
</style>

<div class="collection-container">
    <!-- Thanh menu phụ -->
    <div class="collection-menu">
        <a href="?c=all" class="<?php if($selected=='all') echo 'active'; ?>">All Occasions</a>
        <?php foreach ($collections as $i => $col): ?>
            <a href="?c=<?php echo $i; ?>" class="<?php if($selected==$i) echo 'active'; ?>">
                <?php echo htmlspecialchars($col['name']); ?>
            </a>
        <?php endforeach; ?>
    </div>

    <div class="collection-title">
        EXPLORE OUR FLOWER COLLECTION<br>
        FOR ALL OCCASIONS
    </div>
    <div class="collection-grid">
        <?php
        // Gán ảnh theo thứ tự collection1.png, collection2.png, ...
        if ($selected === 'all') {
            foreach ($collections as $idx => $col) {
                $img = "../../assets/img/collection" . ($idx + 1) . ".png";
                echo '<div class="collection-card">';
                echo '<img src="'.$img.'" alt="'.htmlspecialchars($col['name']).'">';
                echo '<div class="collection-card-info">';
                echo '<div class="collection-card-label">COLLECTIONS</div>';
                echo '<div class="collection-card-title">'.htmlspecialchars($col['name']).'</div>';
                echo '</div></div>';
            }
        } elseif (is_numeric($selected) && isset($collections[$selected])) {
            $col = $collections[$selected];
            $img = "../../assets/img/collection" . ($selected + 1) . ".png";
            echo '<div class="collection-card">';
            echo '<img src="'.$img.'" alt="'.htmlspecialchars($col['name']).'">';
            echo '<div class="collection-card-info">';
            echo '<div class="collection-card-label">COLLECTIONS</div>';
            echo '<div class="collection-card-title">'.htmlspecialchars($col['name']).'</div>';
            echo '</div></div>';
        }
        ?>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>