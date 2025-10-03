<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$recipes = [
    [
        'id' => 'rendang', 'title' => 'Rendang', 'image' => 'img/rendang-daging.jpg', 'alt' => 'Rendang',
        'short_desc' => 'Resep tradisional dari Minangkabau.',
        'long_desc' => 'Rendang adalah hidangan daging sapi khas Minangkabau, Sumatera Barat, yang dimasak perlahan dengan santan kelapa dan rempah-rempah hingga kering dan bumbu meresap, menghasilkan rasa gurih pedas yang mendalam serta daya tahan lama sebagai makanan pengawet tradisional.'
    ],
    [
        'id' => 'sate-lilit', 'title' => 'Sate Lilit', 'image' => 'img/Sate_lilit.jpg', 'alt' => 'Sate Lilit',
        'short_desc' => 'Resep khas Bali yang lezat.',
        'long_desc' => 'Sate lilit merupakan sate khas Bali yang unik, terbuat dari daging ikan atau ayam cincang yang dibalutkan ke batang serai, dibumbui bumbu genep lengkap beraroma harum, kemudian dibakar hingga kering, melambangkan persatuan masyarakat Bali dan kejantanan pria dalam proses pembuatannya.'
    ]
];

$search_query = '';
$filtered_recipes = $recipes;
if (isset($_GET['q']) && !empty($_GET['q'])) {
    $search_query = strtolower(trim($_GET['q']));
    $filtered_recipes = [];
    foreach ($recipes as $recipe) {
        if (strpos(strtolower($recipe['title']), $search_query) !== false || strpos(strtolower($recipe['long_desc']), $search_query) !== false) {
            $filtered_recipes[] = $recipe;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Kumpulan Resep</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <div class="logo">Kumpulan Resep Makanan Tradisional</div>
            <nav class="nav">
                <a class="btn btn-primary" href="#about">About Us</a>
                <a class="btn btn-secondary" href="logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?');">Logout</a>
            </nav>
        </header>

        <main>
            <section id="home" class="home">
                 <h2 style="text-align:center; margin-bottom: 1rem;">Selamat Datang, <b><?= htmlspecialchars($_SESSION['username']) ?></b>!</h2>
                <form class="search-bar" action="dashboard.php" method="get" autocomplete="off">
                    <input type="text" name="q" class="search-input" placeholder="Cari resep makanan tradisional..." aria-label="Cari resep" value="<?= htmlspecialchars($search_query) ?>">
                    <button type="submit" class="btn btn-primary search-btn">Cari</button>
                </form>
            </section>

            <section id="recipes">
                <h2>
                    <?= !empty($search_query) ? 'Hasil Pencarian untuk "' . htmlspecialchars($search_query) . '"' : 'Resep Populer' ?>
                </h2>
                <div class="grid">
                    <?php if (count($filtered_recipes) > 0): ?>
                        <?php foreach ($filtered_recipes as $recipe): ?>
                            <div class="card card-featured recipe-card-clickable" 
                                data-title="<?= htmlspecialchars($recipe['title']) ?>" 
                                data-image="<?= $recipe['image'] ?>" 
                                data-desc="<?= htmlspecialchars($recipe['long_desc']) ?>">
                                
                                <img src="<?= $recipe['image'] ?>" alt="<?= $recipe['alt'] ?>">
                                <div class="card-title"><?= $recipe['title'] ?></div>
                                <div class="card-desc">
                                    <p><?= $recipe['short_desc'] ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="no-results">Resep tidak ditemukan.</p>
                    <?php endif; ?>
                </div>
            </section>

            <section id="about" class="about">
                <h2>Tentang Kami</h2>
                <div class="card about-card">
                    <div class="card-desc">
                        <p><b>Kumpulan Resep Makanan Tradisional</b> adalah website yang didedikasikan untuk melestarikan dan membagikan resep-resep otentik dari berbagai daerah di Indonesia. Kami percaya bahwa kekayaan kuliner Nusantara adalah warisan budaya yang patut dijaga dan dikenalkan ke generasi berikutnya.</p>
                        <p>Tim kami terdiri dari pecinta kuliner, penulis, dan kontributor yang berkomitmen menghadirkan resep yang teruji, mudah diikuti, dan tetap menjaga cita rasa asli.</p>
                    </div>
                </div>
            </section>

        </main>

        <div id="recipe-modal-overlay">
            <div id="recipe-modal">
                <span class="close-btn">&times;</span>
                <img id="modal-img" src="" alt="Gambar Resep">
                <h2 id="modal-title"></h2>
                <p id="modal-desc"></p>
            </div>
        </div>
        
        <footer id="footer" class="footer">
            <div class="footer-flex">
                <div class="footer-col">
                    <b>Kontak</b>
                    <ul class="footer-list">
                        <li>Email: <a href="mailto:info@reseptradisional.id">info@reseptradisional.id</a></li>
                        <li>Instagram: <a href="https://instagram.com/reseptradisional.id" target="_blank">@reseptradisional.id</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <b>Referensi</b>
                    <ul class="footer-list">
                        <li><a href="https://www.cookpad.com" target="_blank">Cookpad</a></li>
                        <li><a href="https://www.masakapahariini.com" target="_blank">Masak Apa Hari Ini</a></li>
                    </ul>
                </div>
            </div>
            <hr class="footer-hr">
            <div class="footer-copyright">
                &copy; 2025 Kumpulan Resep Makanan Tradisional. All rights reserved.
            </div>
        </footer>
    </div>
    <script src="script.js"></script>
</body>
</html>