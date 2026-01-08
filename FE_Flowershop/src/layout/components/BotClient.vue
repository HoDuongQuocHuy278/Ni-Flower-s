<template>
    <footer class="footer-section">
        <!-- Footer Top with Wave -->
        <div class="footer-wave">
            <svg viewBox="0 0 1440 100" preserveAspectRatio="none">
                <path fill="#1a1a2e" d="M0,50 C150,100 350,0 500,50 C650,100 800,0 1000,50 C1200,100 1350,0 1440,50 L1440,100 L0,100 Z"></path>
            </svg>
        </div>

        <!-- Main Footer -->
        <div class="footer-main" style="background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);">
            <div class="container py-5">
                <div class="row g-4">
                    <!-- Logo & About -->
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-brand mb-4">
                            <span class="brand-icon">🌸</span>
                            <span class="brand-text">Ni Flower's</span>
                        </div>
                        <p class="text-light opacity-75 mb-4">
                            Chuyên cung cấp hoa tươi đẹp, giao hàng nhanh trong 2 giờ. 
                            Cam kết hoa tươi 100%, thiết kế theo yêu cầu.
                        </p>
                        <div class="footer-features">
                            <div class="feature-item">
                                <span class="feature-icon">🚚</span>
                                <span class="feature-text">Giao hàng nhanh</span>
                            </div>
                            <div class="feature-item">
                                <span class="feature-icon">🌹</span>
                                <span class="feature-text">Hoa tươi 100%</span>
                            </div>
                            <div class="feature-item">
                                <span class="feature-icon">💝</span>
                                <span class="feature-text">Thiết kế theo yêu cầu</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="col-lg-2 col-md-6">
                        <h5 class="footer-title">Danh Mục</h5>
                        <ul class="footer-links">
                            <li><router-link to="/danh-muc">Tất Cả Sản Phẩm</router-link></li>
                            <li><router-link to="/mua/1">Hoa Mùa Xuân</router-link></li>
                            <li><router-link to="/dip-le/1">Hoa Tình Yêu</router-link></li>
                            <li><router-link to="/dip-le/2">Hoa Cưới</router-link></li>
                            <li><router-link to="/dip-le/5">Hoa Sinh Nhật</router-link></li>
                        </ul>
                    </div>

                    <!-- Dịp Lễ -->
                    <div class="col-lg-2 col-md-6">
                        <h5 class="footer-title">Theo Dịp</h5>
                        <ul class="footer-links">
                            <li><router-link to="/dip-le/1">💕 Tình Yêu</router-link></li>
                            <li><router-link to="/dip-le/2">💒 Đám Cưới</router-link></li>
                            <li><router-link to="/dip-le/4">🏠 Khai Trương</router-link></li>
                            <li><router-link to="/dip-le/5">🎂 Sinh Nhật</router-link></li>
                            <li><router-link to="/dip-le/6">🎉 Lễ Hội</router-link></li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div class="col-lg-4 col-md-6">
                        <h5 class="footer-title">Liên Hệ Đặt Hoa</h5>
                        <div class="contact-info">
                            <a href="tel:0905999276" class="contact-item hotline">
                                <div class="contact-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="contact-detail">
                                    <span class="contact-label">Hotline</span>
                                    <span class="contact-value">0905 999 276</span>
                                </div>
                            </a>
                            <a href="https://zalo.me/0905999276" target="_blank" class="contact-item zalo">
                                <div class="contact-icon">
                                    <i class="fa fa-comment"></i>
                                </div>
                                <div class="contact-detail">
                                    <span class="contact-label">Chat Zalo</span>
                                    <span class="contact-value">0905 999 276</span>
                                </div>
                            </a>
                            <a href="https://www.facebook.com/profile.php?id=100095340766977" target="_blank" class="contact-item facebook">
                                <div class="contact-icon">
                                    <i class="fab fa-facebook-f"></i>
                                </div>
                                <div class="contact-detail">
                                    <span class="contact-label">Facebook</span>
                                    <span class="contact-value">Ni Flower's</span>
                                </div>
                            </a>
                            <a href="https://www.google.com/maps/place/87+%C4%90%C3%B4+%C4%90%E1%BB%91c+L%E1%BB%99c,+Ho%C3%A0+Xu%C3%A2n,+C%E1%BA%A9m+L%E1%BB%87,+%C4%90%C3%A0+N%E1%BA%B5ng+550000" target="_blank" class="contact-item address">
                                <div class="contact-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="contact-detail">
                                    <span class="contact-label">Địa chỉ</span>
                                    <span class="contact-value">87 Đô Đốc Lộc, Đà Nẵng</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Floating Contact Buttons -->
        <div class="floating-buttons">
            <a href="tel:0905999276" class="float-btn phone-btn" title="Gọi ngay">
                <i class="fa fa-phone"></i>
            </a>
            <a href="https://zalo.me/0905999276" target="_blank" class="float-btn zalo-btn" title="Chat Zalo">
                <span>Zalo</span>
            </a>
            <a href="https://www.facebook.com/profile.php?id=100095340766977" target="_blank" class="float-btn fb-btn" title="Facebook">
                <i class="fab fa-facebook-messenger"></i>
            </a>
        </div>
    </footer>
</template>

<script>
export default {
};
</script>

<style>
/* Footer Wave */
.footer-wave {
    margin-top: -2px;
}
.footer-wave svg {
    display: block;
    width: 100%;
    height: 60px;
}

/* Footer Brand */
.footer-brand {
    display: flex;
    align-items: center;
    gap: 10px;
}
.brand-icon {
    font-size: 2.5rem;
}
.brand-text {
    font-size: 1.5rem;
    font-weight: bold;
    color: white;
    background: linear-gradient(135deg, #ff6b9d 0%, #ffc371 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Footer Features */
.footer-features {
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.feature-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    color: rgba(255,255,255,0.8);
    text-decoration: none;
}
.feature-item.address-link:hover {
    color: #ff6b9d;
}
.feature-icon {
    margin-top: -40px ;
    font-size: 1.2rem;
    flex-shrink: 0;
}
.feature-text {
    margin-top:20px;
    line-height: 1.4;
}

/* Footer Title */
.footer-title {
    color: white;
    font-weight: bold;
    margin-bottom: 20px;
    position: relative;
    padding-bottom: 10px;
}
.footer-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 40px;
    height: 3px;
    background: linear-gradient(90deg, #e91e63, #ff6b9d);
    border-radius: 3px;
}

/* Footer Links */
.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}
.footer-links li {
    margin-bottom: 12px;
}
.footer-links a {
    color: rgba(255,255,255,0.7);
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-block;
}
.footer-links a:hover {
    color: #ff6b9d;
    transform: translateX(5px);
}

/* Contact Info */
.contact-info {
    display: flex;
    flex-direction: column;
    gap: 15px;
}
.contact-item {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 12px 15px;
    border-radius: 12px;
    text-decoration: none;
    transition: all 0.3s ease;
}
.contact-item.hotline {
    background: linear-gradient(135deg, rgba(76, 175, 80, 0.2), rgba(76, 175, 80, 0.1));
    border: 1px solid rgba(76, 175, 80, 0.3);
}
.contact-item.zalo {
    background: linear-gradient(135deg, rgba(0, 136, 255, 0.2), rgba(0, 136, 255, 0.1));
    border: 1px solid rgba(0, 136, 255, 0.3);
}
.contact-item.facebook {
    background: linear-gradient(135deg, rgba(59, 89, 152, 0.2), rgba(59, 89, 152, 0.1));
    border: 1px solid rgba(59, 89, 152, 0.3);
}
.contact-item.address {
    background: linear-gradient(135deg, rgba(233, 30, 99, 0.2), rgba(233, 30, 99, 0.1));
    border: 1px solid rgba(233, 30, 99, 0.3);
}
.contact-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 20px rgba(0,0,0,0.3);
}
.contact-icon {
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 1.2rem;
}
.contact-item.hotline .contact-icon {
    background: #4caf50;
    color: white;
}
.contact-item.zalo .contact-icon {
    background: #0088ff;
    color: white;
}
.contact-item.facebook .contact-icon {
    background: #3b5998;
    color: white;
}
.contact-item.address .contact-icon {
    background: #e91e63;
    color: white;
}
.contact-detail {
    display: flex;
    flex-direction: column;
}
.contact-label {
    font-size: 0.8rem;
    color: rgba(255,255,255,0.6);
}
.contact-value {
    font-size: 1.1rem;
    font-weight: bold;
    color: white;
}

/* Floating Buttons */
.floating-buttons {
    position: fixed;
    bottom: 20px;
    right: 20px;
    display: flex;
    flex-direction: column;
    gap: 10px;
    z-index: 1000;
}
.float-btn {
    width: 55px;
    height: 55px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    color: white;
    text-decoration: none;
    font-size: 1.3rem;
    box-shadow: 0 5px 20px rgba(0,0,0,0.3);
    transition: all 0.3s ease;
    animation: pulse-ring 2s infinite;
}
.phone-btn { background: linear-gradient(135deg, #4caf50, #2e7d32); }
.zalo-btn { background: linear-gradient(135deg, #0088ff, #0066cc); font-size: 0.9rem; font-weight: bold; }
.fb-btn { background: linear-gradient(135deg, #0084ff, #0066cc); }
.float-btn:hover {
    transform: scale(1.1);
}
@keyframes pulse-ring {
    0% { box-shadow: 0 0 0 0 rgba(76, 175, 80, 0.4); }
    70% { box-shadow: 0 0 0 15px rgba(76, 175, 80, 0); }
    100% { box-shadow: 0 0 0 0 rgba(76, 175, 80, 0); }
}

/* Responsive */
@media (max-width: 768px) {
    .footer-title::after {
        left: 50%;
        transform: translateX(-50%);
    }
}
</style>