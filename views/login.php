<div class=container>
    <h2>Đăng nhập</h2>
    <form method="POST" action="/check_login.php">
        <div class="form-group">
            <label for="username">Tên đăng nhập:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-buttons">
            <button type="submit" class="btn btn-primary">Đăng nhập</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='/register.php'">Đăng ký</button>
        </div>
    </form>
</div>

<style>
    /* CSS chung cho cả 2 trang */
:root {
    --primary-color: #3498db;
    --secondary-color: #2ecc71;
    --dark-color: #2c3e50;
    --light-color: #ecf0f1;
    --danger-color: #e74c3c;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f7fa;
    margin: 0;
    padding: 0;
    color: #333;
    line-height: 1.6;
}

.container {
    max-width: 500px;
    margin: 50px auto;
    padding: 30px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

h2 {
    color: var(--dark-color);
    text-align: center;
    margin-bottom: 30px;
    position: relative;
    padding-bottom: 10px;
}

h2::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 3px;
    background: var(--primary-color);
}

/* Form styling */
.form-group {
    margin-bottom: 20px;
}

.form-buttons {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 25px;
    gap: 15px;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: var(--dark-color);
}

.form-control {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
    transition: border 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
}

.form-actions {
    display: flex;
    align-items: center;
    margin-top: 30px;
    gap: 15px;
}


/* Button styling */
.btn {
    display: inline-block;
    padding: 12px 25px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    font-weight: 500;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-primary {
    background-color: var(--primary-color);
    color: white;
    padding: 12px 30px;
    border-radius: 30px;
    box-shadow: 0 4px 6px rgba(50, 152, 219, 0.3);
    transition: all 0.3s ease;
    border: 2px solid var(--primary-color);
    font-weight: 600;
}

.btn-primary:hover {
    background-color: #2980b9;
    transform: translateY(-2px);
    box-shadow: 0 6px 8px rgba(50, 152, 219, 0.4);
}

/* Nút phụ (btn-secondary) */
.btn-secondary {
    background-color: transparent;
    color: var(--primary-color);
    padding: 12px 25px;
    border-radius: 30px;
    border: 2px solid var(--primary-color);
    transition: all 0.3s ease;
    font-weight: 600;
}

.btn-secondary:hover {
    background-color: rgba(52, 152, 219, 0.1);
    color: var(--primary-color);
    transform: translateY(-2px);
}


/* Hiệu ứng đặc biệt */
form {
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Thông báo lỗi (có thể thêm vào sau) */
.error-message {
    color: var(--danger-color);
    font-size: 14px;
    margin-top: 5px;
}


</style>