<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../views/layout/header.php';
?>

<div class="container">
    <p>Zalo: 0123456789</p>
    <p>Facebook: <a href="https://www.facebook.com/KhanhAn2k5">ANK Gaming Store</a></p>
</div>

<?php include __DIR__ . '/../views/layout/footer.php'; ?>