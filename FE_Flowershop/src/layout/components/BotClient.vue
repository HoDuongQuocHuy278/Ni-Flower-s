<template>
    <footer class="app-footer-wrapper">
        <!-- Footer Top Wave Accent -->
        <div class="footer-wave">
            <svg viewBox="0 0 1440 80" preserveAspectRatio="none">
                <path fill="#1a1a2e" d="M0,32 C240,64 480,10 720,38 C960,66 1200,20 1440,32 L1440,80 L0,80 Z"></path>
            </svg>
        </div>

        <!-- Main Footer Content -->
        <div class="footer-main">
            <div class="container py-4 py-lg-5">
                <div class="row g-4">
                    <!-- Brand & Commitment -->
                    <div class="col-lg-4 col-md-6 text-center text-md-start">
                        <div class="footer-brand mb-3 justify-content-center justify-content-md-start">
                            <span class="brand-icon">🌸</span>
                            <span class="brand-text">Ni Flower's</span>
                        </div>
                        <p class="text-light opacity-75 mb-3 small">
                            Tiệm hoa tươi nghệ thuật Đà Nẵng. Cam kết hoa tươi mới mỗi ngày, giao nhanh hỏa tốc trong 2 giờ, cắm hoa tỉ mỉ theo từng thông điệp yêu thương.
                        </p>
                        <div class="footer-badges d-flex flex-wrap gap-2 justify-content-center justify-content-md-start">
                            <span class="badge-trust">🚀 Giao 2H</span>
                            <span class="badge-trust">🌹 100% Hoa Tươi</span>
                            <span class="badge-trust">💝 Tặng Kèm Thiệp</span>
                        </div>
                    </div>

                    <!-- Quick Links (Danh Mục) -->
                    <div class="col-6 col-lg-2 col-md-3">
                        <h6 class="footer-section-title">Danh Mục</h6>
                        <ul class="footer-nav-list">
                            <li><router-link to="/danh-muc">Tất Cả Sản Phẩm</router-link></li>
                            <li><router-link to="/mua/1">🌸 Hoa Mùa Xuân</router-link></li>
                            <li><router-link to="/mua/2">☀️ Hoa Mùa Hạ</router-link></li>
                            <li><router-link to="/mua/3">🍂 Hoa Mùa Thu</router-link></li>
                            <li><router-link to="/mua/4">❄️ Hoa Mùa Đông</router-link></li>
                        </ul>
                    </div>

                    <!-- Theo Dịp Lễ -->
                    <div class="col-6 col-lg-2 col-md-3">
                        <h6 class="footer-section-title">Theo Dịp Lễ</h6>
                        <ul class="footer-nav-list">
                            <li><router-link to="/dip-le/1">💕 Tình Cảm</router-link></li>
                            <li><router-link to="/dip-le/2">💒 Hoa Cưới</router-link></li>
                            <li><router-link to="/dip-le/4">🏠 Khai Trương</router-link></li>
                            <li><router-link to="/dip-le/5">🎂 Sinh Nhật</router-link></li>
                            <li><router-link to="/dip-le/3">🕯️ Chia Buồn</router-link></li>
                        </ul>
                    </div>

                    <!-- Contact & Map -->
                    <div class="col-lg-4 col-md-12">
                        <h6 class="footer-section-title text-center text-md-start">Liên Hệ Hỗ Trợ 24/7</h6>
                        <div class="contact-card-grid">
                            <a href="tel:0905999276" class="contact-pill-item hotline">
                                <div class="pill-icon"><i class="fa fa-phone"></i></div>
                                <div class="pill-text">
                                    <small>Hotline / Zalo đặt hoa</small>
                                    <strong>0905 999 276</strong>
                                </div>
                            </a>

                            <a href="https://zalo.me/0905999276" target="_blank" class="contact-pill-item zalo">
                                <div class="pill-icon"><i class="fa fa-comment"></i></div>
                                <div class="pill-text">
                                    <small>Tư vấn mẫu nhanh qua</small>
                                    <strong>Zalo Official</strong>
                                </div>
                            </a>

                            <div class="contact-pill-item address">
                                <div class="pill-icon"><i class="fa fa-map-marker-alt"></i></div>
                                <div class="pill-text">
                                    <small>Địa chỉ cửa hàng</small>
                                    <span class="small fw-semibold text-white">87 Đô Đốc Lộc, Cẩm Lệ, Đà Nẵng</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="border-secondary opacity-25 my-4">

                <!-- Bottom Copyright -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2 small text-light opacity-50 text-center">
                    <span>© 2026 Ni Flower's Đà Nẵng. Tất cả quyền được bảo lưu.</span>
                    <span>Thiết kế tối ưu cho Website & Ứng dụng Di động.</span>
                </div>
            </div>
        </div>

        <!-- =========================================================
             MOBILE APP BOTTOM NAVIGATION BAR (Hiển thị trên điện thoại)
             ========================================================= -->
        <nav class="app-bottom-nav" aria-label="Điều hướng chính di động">
            <router-link to="/" class="app-nav-tab" active-class="active" exact>
                <div class="tab-icon"><i class="fa fa-home"></i></div>
                <span class="tab-label">Trang Chủ</span>
            </router-link>

            <router-link to="/danh-muc" class="app-nav-tab" active-class="active">
                <div class="tab-icon"><i class="fa fa-th-large"></i></div>
                <span class="tab-label">Sản Phẩm</span>
            </router-link>

            <!-- Hot Deals Button -->
            <router-link to="/danh-muc" class="app-nav-tab" :class="{ active: isHotActive }">
                <div class="tab-icon">
                    <i class="fa fa-fire text-warning"></i>
                    <span class="app-nav-tab-badge">Hot</span>
                </div>
                <span class="tab-label">Khuyến Mãi</span>
            </router-link>

            <router-link to="/bai-viet" class="app-nav-tab" active-class="active">
                <div class="tab-icon"><i class="fa fa-newspaper"></i></div>
                <span class="tab-label">Tin Tức</span>
            </router-link>

            <!-- Consultation / Contact Trigger -->
            <button class="app-nav-tab btn-reset" @click="showContactSheet = true">
                <div class="tab-icon"><i class="fa fa-headset text-success"></i></div>
                <span class="tab-label">Tư Vấn</span>
            </button>
        </nav>

        <!-- =========================================================
             FLOATING CONTACT SPEED-DIAL (Desktop & Mobile)
             ========================================================= -->
        <div class="app-speed-dial" :class="{ expanded: speedDialOpen }" v-if="!isDetailPage || isDesktop">
            <transition name="dial-fade">
                <div v-show="speedDialOpen || isDesktop" class="speed-dial-items">
                    <a href="https://www.facebook.com/profile.php?id=100095340766977" 
                        target="_blank" 
                        class="app-dial-btn fb" 
                        title="Chat Facebook Messenger">
                        <i class="fab fa-facebook-messenger"></i>
                    </a>
                    <a href="https://zalo.me/0905999276" 
                        target="_blank" 
                        class="app-dial-btn zalo" 
                        title="Chat Zalo Tư Vấn">
                        <span>Zalo</span>
                    </a>
                    <a href="tel:0905999276" 
                        class="app-dial-btn phone" 
                        title="Gọi Hotline">
                        <i class="fa fa-phone"></i>
                    </a>
                </div>
            </transition>

            <!-- Mobile Main Toggle Button (Hidden on Desktop) -->
            <button class="app-dial-btn main-toggle d-lg-none" 
                @click="speedDialOpen = !speedDialOpen" 
                aria-label="Liên hệ nhanh">
                <i class="fa" :class="speedDialOpen ? 'fa-times' : 'fa-comment-dots'"></i>
            </button>
        </div>

        <!-- =========================================================
             MOBILE QUICK CONTACT BOTTOM SHEET MODAL
             ========================================================= -->
        <transition name="sheet-fade">
            <div v-if="showContactSheet" class="app-sheet-backdrop" @click="showContactSheet = false"></div>
        </transition>

        <transition name="sheet-slide">
            <div v-if="showContactSheet" class="app-bottom-sheet">
                <div class="app-sheet-handle"></div>
                <div class="app-sheet-header">
                    <div class="d-flex align-items-center gap-2">
                        <span class="fs-4">🌸</span>
                        <h5 class="app-sheet-title mb-0">Liên Hệ Đặt Hoa Nhanh</h5>
                    </div>
                    <button class="btn btn-sm btn-light rounded-circle" @click="showContactSheet = false">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="app-sheet-body">
                    <p class="text-muted small mb-3">
                        Đội ngũ thợ cắm hoa Ni Flower's sẵn sàng tư vấn mẫu hoa phù hợp nhất theo ngân sách và dịp của bạn!
                    </p>
                    <div class="d-flex flex-column gap-2">
                        <a href="tel:0905999276" class="btn btn-success py-3 rounded-4 d-flex align-items-center justify-content-between px-3 text-white fw-bold">
                            <span class="d-flex align-items-center gap-2">
                                <i class="fa fa-phone fs-5"></i> Gọi Ngay (0905 999 276)
                            </span>
                            <i class="fa fa-chevron-right small opacity-75"></i>
                        </a>

                        <a href="https://zalo.me/0905999276" target="_blank" class="btn btn-primary py-3 rounded-4 d-flex align-items-center justify-content-between px-3 text-white fw-bold">
                            <span class="d-flex align-items-center gap-2">
                                <i class="fa fa-comment-dots fs-5"></i> Chat Zalo Tư Vấn Mẫu
                            </span>
                            <i class="fa fa-chevron-right small opacity-75"></i>
                        </a>

                        <a href="https://www.facebook.com/profile.php?id=100095340766977" target="_blank" class="btn btn-info py-3 rounded-4 d-flex align-items-center justify-content-between px-3 text-white fw-bold">
                            <span class="d-flex align-items-center gap-2">
                                <i class="fab fa-facebook-messenger fs-5"></i> Facebook Messenger
                            </span>
                            <i class="fa fa-chevron-right small opacity-75"></i>
                        </a>

                        <a href="https://www.google.com/maps/place/87+%C4%90%C3%B4+%C4%90%E1%BB%91c+L%E1%BB%99c,+Ho%C3%A0+Xu%C3%A2n,+C%E1%BA%A9m+L%E1%BB%87,+%C4%90%C3%A0+N%E1%BA%B5ng+550000" target="_blank" class="btn btn-light py-2 rounded-4 d-flex align-items-center gap-2 px-3 text-secondary mt-1">
                            <i class="fa fa-map-marker-alt text-danger"></i>
                            <small class="text-truncate">87 Đô Đốc Lộc, Cẩm Lệ, Đà Nẵng</small>
                        </a>
                    </div>
                </div>
            </div>
        </transition>
    </footer>
</template>

<script>
export default {
    data() {
        return {
            speedDialOpen: false,
            showContactSheet: false,
            windowWidth: typeof window !== 'undefined' ? window.innerWidth : 1200
        };
    },
    computed: {
        isDesktop() {
            return this.windowWidth >= 992;
        },
        isHotActive() {
            return this.$route.hash === '#san-pham-hot';
        },
        isDetailPage() {
            return this.$route.path.startsWith('/chi-tiet/');
        }
    },
    mounted() {
        window.addEventListener('resize', this.onResize);
    },
    beforeUnmount() {
        window.removeEventListener('resize', this.onResize);
    },
    methods: {
        onResize() {
            this.windowWidth = window.innerWidth;
        }
    }
};
</script>

<style scoped>
.app-footer-wrapper {
    position: relative;
    background: transparent;
}

.footer-wave svg {
    display: block;
    width: 100%;
    height: 50px;
}

.footer-main {
    background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
    color: #ffffff;
}

.footer-brand {
    display: flex;
    align-items: center;
    gap: 10px;
}

.brand-icon {
    font-size: 2rem;
}

.brand-text {
    font-size: 1.4rem;
    font-weight: 800;
    background: linear-gradient(135deg, #ff6b9d 0%, #ffc371 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.badge-trust {
    background: rgba(255, 255, 255, 0.1);
    color: #ffd1dc;
    border: 1px solid rgba(255, 255, 255, 0.15);
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.footer-section-title {
    color: #ffffff;
    font-weight: 700;
    font-size: 0.95rem;
    margin-bottom: 16px;
    position: relative;
    padding-bottom: 8px;
}

.footer-section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 30px;
    height: 3px;
    background: #e91e63;
    border-radius: 2px;
}

@media (max-width: 768px) {
    .footer-section-title::after {
        left: 0;
    }
}

.footer-nav-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-nav-list li {
    margin-bottom: 10px;
}

.footer-nav-list a {
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    font-size: 0.88rem;
    transition: all 0.2s ease;
    display: inline-block;
}

.footer-nav-list a:hover {
    color: #ff6b9d;
    transform: translateX(4px);
}

.contact-card-grid {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.contact-pill-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 10px 14px;
    border-radius: 14px;
    text-decoration: none;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.25s ease;
}

.contact-pill-item:hover {
    background: rgba(255, 255, 255, 0.12);
    transform: translateY(-2px);
}

.contact-pill-item.hotline .pill-icon {
    background: #34c759;
}

.contact-pill-item.zalo .pill-icon {
    background: #0088ff;
}

.contact-pill-item.address .pill-icon {
    background: #e91e63;
}

.pill-icon {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
    flex-shrink: 0;
}

.pill-text {
    display: flex;
    flex-direction: column;
}

.pill-text small {
    font-size: 0.72rem;
    color: rgba(255, 255, 255, 0.6);
}

.pill-text strong {
    font-size: 0.95rem;
    color: white;
}

.btn-reset {
    background: none;
    border: none;
    padding: 0;
    cursor: pointer;
}

/* Speed dial on desktop vs mobile */
.speed-dial-items {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.app-dial-btn.fb {
    background: linear-gradient(135deg, #0084ff, #0066cc);
}

/* Animations */
.dial-fade-enter-active,
.dial-fade-leave-active {
    transition: all 0.25s ease;
}
.dial-fade-enter-from,
.dial-fade-leave-to {
    opacity: 0;
    transform: translateY(15px);
}

.sheet-fade-enter-active,
.sheet-fade-leave-active {
    transition: opacity 0.3s ease;
}
.sheet-fade-enter-from,
.sheet-fade-leave-to {
    opacity: 0;
}

.sheet-slide-enter-active,
.sheet-slide-leave-active {
    transition: transform 0.32s cubic-bezier(0.2, 0.9, 0.3, 1);
}
.sheet-slide-enter-from,
.sheet-slide-leave-to {
    transform: translateY(100%);
}
</style>
