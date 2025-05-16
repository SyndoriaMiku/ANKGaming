<style>
    /* Style cho footer */
    footer {
        background-color: #2c3e50;
        color: #ecf0f1;
        padding: 40px 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        padding: 0 20px;
    }
    
    .footer-section {
        margin-bottom: 20px;
    }
    
    .footer-section h3 {
        color: #f39c12;
        margin-bottom: 20px;
        font-size: 1.2rem;
        position: relative;
        padding-bottom: 10px;
    }
    
    .footer-section h3::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 2px;
        background-color: #f39c12;
    }
    
    .footer-section p, 
    .footer-section a {
        color: #bdc3c7;
        line-height: 1.6;
        margin-bottom: 10px;
        display: block;
        text-decoration: none;
        transition: color 0.3s;
    }
    
    .footer-section a:hover {
        color: #f39c12;
    }
    
    .social-icons {
        display: flex;
        gap: 15px;
        margin-top: 20px;
    }
    
    .social-icons a {
        color: #ecf0f1;
        font-size: 1.5rem;
    }
    
    .copyright {
        text-align: center;
        padding-top: 20px;
        margin-top: 30px;
        border-top: 1px solid #34495e;
        color: #7f8c8d;
        font-size: 0.9rem;
    }
    
    @media (max-width: 768px) {
        .footer-container {
            grid-template-columns: 1fr;
        }
    }
</style>

<footer>
    <div class="footer-container">
        <div class="footer-section">
            <h3>CPU Store by An Ngoc Khanh</h3>
            <p>Chuyên cung cấp các sản phẩm CPU và linh kiện máy tính chất lượng cao</p>
        </div>   
        <div class="footer-section">
            <h3>Kết nối với chúng tôi</h3>
            <p>Email: contact@anngockhanh.com</p>
            <p>Hotline: 0123 456 789</p>
        </div>
    </div>
    
    <div class="copyright">
        <p>&copy; 2025 CPU Store by An Ngoc Khanh. All rights reserved.</p>
    </div>
</footer>