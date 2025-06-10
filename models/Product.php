<?php
require_once __DIR__ . '/../config/database.php';

class Product {
    public static function getAll() {
        global $conn;
        $result = $conn->query("SELECT * FROM products");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public static function getById($id) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public static function create($conn, $data, $imageFile = null) {
        $imagePath = null;
        if ($imageFile && $imageFile['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../public/images/'; // Đường dẫn tới thư mục public/images
            $fileName = uniqid() . '_' . basename($imageFile['name']);
            $targetPath = $uploadDir . $fileName;
        
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
        
            if (move_uploaded_file($imageFile['tmp_name'], $targetPath)) {
                $imagePath = 'images/' . $fileName;
            } else {
                throw new Exception("Không thể upload ảnh");
            }
        }

        $data['image'] = $imagePath;

        $stmt = $conn->prepare("INSERT INTO products (id, name, core, thread, base_clock, boost_clock, cache_l1, cache_l2, cache_l3, socket, tdp, price, stock, image, description) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiiddssssidiss",
            $data['id'],
            $data['name'],
            $data['core'],
            $data['thread'],
            $data['base_clock'],
            $data['boost_clock'],
            $data['cache_l1'],
            $data['cache_l2'],
            $data['cache_l3'],
            $data['socket'],
            $data['tdp'],
            $data['price'],
            $data['stock'],
            $data['image'],
            $data['description']
        );
        $stmt->execute();
    }

    public static function update($conn, $id, $data, $imageFile = null) {
        $imagePath = null;
        if ($imageFile && $imageFile['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../public/images/'; // Đường dẫn tới thư mục public/images
            $fileName = uniqid() . '_' . basename($imageFile['name']);
            $targetPath = $uploadDir . $fileName;
        
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
        
            if (move_uploaded_file($imageFile['tmp_name'], $targetPath)) {
                $imagePath = 'images/' . $fileName;
            } else {
                throw new Exception("Không thể upload ảnh");
            }
        }
        $data['image'] = $imagePath;

        $stmt = $conn->prepare("UPDATE products SET name = ?, core = ?, thread = ?, base_clock = ?, boost_clock = ?, cache_l1 = ?, cache_l2 = ?, cache_l3 = ?, socket = ?, tdp = ?, price = ?, stock = ?, description = ? WHERE id = ?");
        $stmt->bind_param("siiddssssidiss",
            $data['name'],
            $data['core'],
            $data['thread'],
            $data['base_clock'],
            $data['boost_clock'],
            $data['cache_l1'],
            $data['cache_l2'],
            $data['cache_l3'],
            $data['socket'],
            $data['tdp'],
            $data['price'],
            $data['stock'],
            $data['description'],
            $id
        );
        $stmt->execute();
    }

    public static function delete($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
    }

    public static function getByKeyword($keyword) {
        $keyword = "%$keyword%";
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE CONCAT('%', ?, '%')");
        $stmt->bind_param("s", $keyword);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public static function getByFilter($filters) {
        global $conn;
        $query = "SELECT * FROM products WHERE 1";
        $params = [];
        $types = ''; // Chuỗi các loại dữ liệu cho bind_param
        
        // Brand Filter (tìm trong name)
        if (!empty($filters['brand']) && is_array($filters['brand'])) {
            $brandConditions = [];
            foreach ($filters['brand'] as $brand) {
                $brandConditions[] = "name LIKE ?";
                $params[] = '%' . $brand . '%';
                $types .= 's';
            }
            if (!empty($brandConditions)) {
                $query .= " AND (" . implode(' OR ', $brandConditions) . ")";
            }
        }
    
        // Price Range Filter
        if (!empty($filters['price_min'])) {
            $query .= " AND price >= ?";
            $params[] = $filters['price_min'];
            $types .= 'd'; // double hoặc số
        }
        if (!empty($filters['price_max'])) {
            $query .= " AND price <= ?";
            $params[] = $filters['price_max'];
            $types .= 'd';
        }
    
        // Core Count Filter
        if (!empty($filters['core_min'])) {
            $query .= " AND core >= ?";
            $params[] = $filters['core_min'];
            $types .= 'd';
        }
        if (!empty($filters['core_max'])) {
            $query .= " AND core <= ?";
            $params[] = $filters['core_max'];
            $types .= 'd';
        }
    
        // Turbo Boost Maximum Filter
        if (!empty($filters['boost_max'])) {
            $query .= " AND boost_clock <= ?";
            $params[] = $filters['boost_max'];
            $types .= 'd';
        }
    
        // TDP Filter
        if (!empty($filters['tdp_max'])) {
            $query .= " AND tdp <= ?";
            $params[] = $filters['tdp_max'];
            $types .= 'd';
        }
    
        // Socket Filter
        if (!empty($filters['socket'])) {
            $query .= " AND socket LIKE ?";
            $params[] = '%' . $filters['socket'] . '%';
            $types .= 's';
        }
    
        // Prepare and bind
        $stmt = $conn->prepare($query);
    
        if (!empty($params)) {
            // bind_param yêu cầu truyền các giá trị theo biến tham chiếu
            $stmt->bind_param($types, ...$params);
        }
    
        $stmt->execute();
        $result = $stmt->get_result();
    
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

}