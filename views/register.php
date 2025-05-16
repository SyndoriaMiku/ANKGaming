<div class="container">
    <h2>Đăng ký tài khoản</h2>
    <form method="POST" action="/check_register.php">
        <div class="form-group">
            <label for="username">Tên đăng nhập:</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Đăng ký</button>
        <a href="/login.php" class="btn btn-secondary">Đăng nhập</a>
    </form>
</div>