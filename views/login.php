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
        <button type="submit" class="btn btn-primary">Đăng nhập</button>
        <a href="/register.php" class="btn btn-secondary">Đăng ký</a>
    </form>
