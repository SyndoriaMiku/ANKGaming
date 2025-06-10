<?php include __DIR__ . '/../layout/header.php'; ?>
<div class="side-menu" id="side-menu">
    <form method="GET" action="index.php" id="filter-form">
        <input type="hidden" name="controller" value="product">
        <input type="hidden" name="action" value="filterByCategory">
        <div style="margin-bottom: 10px;">
            <label for="brand">Chọn hãng CPU:</label>
            <input type="checkbox" name="brand[]" value="Intel" <?php if (!empty($_GET['brand']) && is_array($_GET['brand']) && in_array('Intel', $_GET['brand'])) echo 'checked'; ?>> Intel<br>
            <input type="checkbox" name="brand[]" value="AMD" <?php if (!empty($_GET['brand']) && is_array($_GET['brand']) && in_array('AMD', $_GET['brand'])) echo 'checked'; ?>> AMD
        </div>
        <!-- Socket Filter -->
        <div style="margin-bottom: 10px;">
            <label for="socket">Socket CPU:</label>
            <input type="text" name="socket" id="socket" value="<?= htmlspecialchars((string)($_GET['socket'] ?? '')) ?>" placeholder="Socket CPU">
        </div>
        <!-- Price Range Filter -->
        <div style="margin-bottom: 10px;">
            <label for="price-range"> Giá:</label>
            <div class="input-range">
                <input type="number" name="price_min" id="min_price" value="<?= htmlspecialchars((string)($_GET['price_min'] ?? '')) ?>" placeholder="Min Price"><br>
                <span> - </span>
                <input type="number" name="price_max" id="max_price" value="<?= htmlspecialchars((string)($_GET['price_max'] ?? '')) ?>" placeholder="Max Price">
            </div>
        </div>
        <!-- Core Count Filter -->
        <div style="margin-bottom: 10px;">
            <label for="core-range">Số nhân:</label>
            <div class="input-range">
                <input type="number" name="core_min" id="core_min" value="<?= htmlspecialchars((string)($_GET['core_min'] ?? '')) ?>" placeholder="Min Core"><br>
                <span> - </span>
                <input type="number" name="core_max" id="core_max" value="<?= htmlspecialchars((string)($_GET['core_max'] ?? '')) ?>" placeholder="Max Core">
            </div>
        </div>
        <!-- Turbo Boost Maximum Filter -->
        <div style="margin-bottom: 10px;">
            <label for="turbo-range">Turbo Boost tối đa (GHz):</label>
            <input type="number" step="0.1" name="boost_max" id="boost_max" value="<?= htmlspecialchars((string)($_GET['boost_max'] ?? '')) ?>" placeholder="Max Turbo">
        </div>
        <!-- TDP Filter -->
        <div style="margin-bottom: 10px;">
            <label for="tdp-range">TDP tối đa (W):</label>
            <input type="number" name="tdp_max" id="tdp_max" value="<?= htmlspecialchars((string)($_GET['tdp_max'] ?? '')) ?>" placeholder="Max TDP">
        </div>
        <button type="submit" class="btn btn-primary">Lọc</button>
    </form>
</div>

<div style="display: flex" id="layout-container" style="transition: margin-left 0.3s ease;">
    <div style="flex: 1; padding: 20px;" class="main-content" id="main-content">
        <button id="toggle-side-menu">Bộ lọc sản phẩm</button>
        <input type="text" id="search-keyword" placeholder="Nhập tên CPU để tìm kiếm">
        <h2>CPU List</h2>
        <div class="product-container">
            <?php foreach ($products as $cpu): ?>
            <div class="product">
                <a href="detail.php?id=<?php echo htmlspecialchars($cpu['id']); ?>" class="product-link">
                    <img class="product-image" src="<?=$cpu['image']?>" alt="<?= $cpu['name'] ?>" width="100" height="100" style="vertical-align: middle">
                    <div class="product-info">
                        <h3><?php echo htmlspecialchars($cpu['name']); ?></h3>
                        <p class="price">Price: <?php echo number_format($cpu['price'], 0, ',', '.'); ?> VND</p>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php include __DIR__ . '/../layout/footer.php'; ?>
<style>
.product-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
    padding: 20px;
}

.product {
    border: 1px solid #f5f5f5;
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%; /* Make sure all products are the same height */
    display: flex;
    flex-direction: column;

}

.product:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.product-link {
    display: flex;
    text-decoration: none;
    color: inherit;
    flex-direction: column;
    height: 100%;
}


.product-link:hover {
    background-color: #f5f5f5;
}

.product-image {
    width: 100%;
    height: 180px;
    object-fit: contain;
    padding: 10px;
    background-color: #ffffff;
    border-bottom: 1px solid #eee;
}

.product-info {
    padding: 15px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.product-info h3 {
    margin: 0 0 10px 0;
    font-size: 16px;
    line-height: 1.3;
    flex-grow: 1;
}

.price {
    margin: 0;
    color: #d32f2f;
    font-weight: bold;
    font-size: 18px;
}

#search-keyword {
    width: calc(100% - 40px); /* full màn hình trừ 40px (20px mỗi bên) */
    max-width: 800px; /* nếu muốn, để tránh quá to trên màn hình lớn */
    padding: 12px 16px;
    margin: 20px auto;
    display: block;
    font-size: 16px;
    border: 2px solid #ccc;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

#search-keyword:focus {
    border-color: #4CAF50;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    outline: none;
}
.side-menu {
    position: fixed;
    top: 106px; /* Dưới header */
    left: -350px;
    width: 350px;
    height: calc(100% - 106px); /* Chiều cao bằng 100% trừ đi chiều cao header */
    background-color: #f9f9f9;
    border-right: 1px solid #ccc;
    box-shadow: 2px 0 5px rgba(0,0,0,0.1);
    padding: 15px;
    box-sizing: border-box;
    overflow-y: auto;
    transition: left 0.3s ease;
    z-index: 1000;
}

.side-menu.active {
    left: 0;
}

.input-range {
    display: flex;
    align-items: center;
    gap: 10px;
}

.main-content {
    flex: 1;
    padding: 20px;
    transition: margin-left 0.3s ease;
    margin-left: 0; /* ban đầu không có khoảng cách */
}



.main-content.shifted {
    margin-left: 350px; /* bằng width của side-menu */
}


/* Nút toggle */
#toggle-side-menu {
    display: inline-block;
    padding: 8px 12px;
    background-color: #007bff;
    color: #fff;
    cursor: pointer;
    border: none;
    border-radius: 4px;
    margin: 10px;
}

#toggle-side-menu:hover {
    background-color: #0056b3;
}

/* Style tổng thể cho side-menu form */
#filter-form {
    font-family: Arial, sans-serif;
    font-size: 14px;
    color: #333;
}

/* Style cho mỗi block filter */
#filter-form > div {
    margin-bottom: 15px;
    padding: 10px;
    border-bottom: 1px solid #e0e0e0;
}

/* Label */
#filter-form label {
    display: block;
    font-weight: bold;
    margin-bottom: 6px;
    color: #555;
}

/* Input text và number - đồng style */
#filter-form input[type="text"],
#filter-form input[type="number"] {
    width: 100%;
    padding: 8px 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 14px;
    height: 40px; /* ✅ set chiều cao cố định */
    line-height: 1.4;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    appearance: none; /* cho safari */
    -moz-appearance: textfield; /* cho firefox */
}

/* Ẩn mũi tên trong input number cho Chrome, Edge, Safari */
#filter-form input[type="number"]::-webkit-outer-spin-button,
#filter-form input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}


/* Focus */
#filter-form input[type="text"]:focus,
#filter-form input[type="number"]:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    outline: none;
}

/* Checkbox style */
#filter-form input[type="checkbox"] {
    margin-right: 6px;
    transform: scale(1.1);
}

/* Button style */
#filter-form button[type="submit"] {
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 14px;
    font-size: 15px;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s ease;
}

#filter-form button[type="submit"]:hover {
    background-color: #0056b3;
}

/* Optional: scroll side menu nếu dài */
.side-menu {
    overflow-y: auto;
    padding-right: 10px;
}



</style>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    function filterProducts() {
        var keyword = $('#search-keyword').val().toLowerCase();
        if (keyword !== '' || keyword.length >=3) {
            var encodedkeyword = encodeURIComponent(keyword);
            window.location.href = 'index.php?controller=product&action=filter&keyword=' + encodedkeyword;
        }
    }

    //Enter to search
    $('#search-keyword').on('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault(); // Prevent form submission
            filterProducts();
        }
    });

    $(document).ready(function() {
    $('#toggle-side-menu').click(function() {
        $('#side-menu').toggleClass('active');
        $('#main-content').toggleClass('shifted');
    });
});
</script>
