<template>
    <div class="home-page-container">
        <!-- =========================================================
             HERO SECTION (App-Optimized Banner & Desktop Hero)
             ========================================================= -->
        <section class="hero-section position-relative overflow-hidden">
            <div class="hero-bg"></div>
            <div class="hero-overlay"></div>
            <div class="container position-relative py-4 py-lg-5">
                <div class="row align-items-center">
                    <div class="col-lg-6 text-center text-lg-start">
                        <span class="badge hero-badge mb-3 mb-lg-4">
                            <span>🌸</span> Ni Flower's • Tiệm Hoa Đà Nẵng
                        </span>
                        <h1 class="hero-title">
                            Gửi Yêu Thương <span class="text-gradient">Bằng Hoa</span>
                        </h1>
                        <p class="hero-subtitle">
                            Hoa tươi thiết kế tinh tế theo yêu cầu, giao hỏa tốc 2 giờ tại Đà Nẵng. Cam kết hoa tươi 100% tuyển chọn mỗi ngày.
                        </p>
                        <div class="d-flex gap-2 gap-sm-3 flex-wrap justify-content-center justify-content-lg-start mb-4">
                            <router-link to="/danh-muc" class="btn btn-hero-primary">
                                <i class="fa fa-shopping-bag me-1 me-sm-2"></i> Khám Phá Ngay
                            </router-link>
                            <a href="tel:0905999276" class="btn btn-hero-outline">
                                <i class="fa fa-phone me-1 me-sm-2"></i> Gọi Đặt Hoa
                            </a>
                        </div>
                        <div class="hero-stats d-flex justify-content-center justify-content-lg-start gap-4">
                            <div class="stat-item">
                                <span class="stat-number">500+</span>
                                <span class="stat-label">Mẫu Hoa</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">10K+</span>
                                <span class="stat-label">Khách Hàng</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">99%</span>
                                <span class="stat-label">Hài Lòng</span>
                            </div>
                        </div>
                    </div>

                    <!-- Hero Visual (Desktop Only / Tablet) -->
                    <div class="col-lg-6 text-center mt-4 mt-lg-0 d-none d-lg-block">
                        <div class="hero-image-container">
                            <img src="https://images.unsplash.com/photo-1487530811176-3780de880c2d?w=800&h=900&fit=crop" 
                                class="hero-main-image" 
                                alt="Hoa tươi Đà Nẵng">
                            <div class="floating-badge badge-1">
                                <span>🚀</span> Giao nhanh 2H
                            </div>
                            <div class="floating-badge badge-2">
                                <span>⭐</span> 4.9/5 Đánh giá
                            </div>
                            <div class="floating-badge badge-3">
                                <span>💝</span> Tặng kèm thiệp
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- =========================================================
             APP-STYLE HORIZONTAL CATEGORIES & STORIES
             ========================================================= -->
        <section class="section-quick-categories py-3 py-lg-4">
            <div class="container">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h5 class="fw-bold mb-0 d-flex align-items-center gap-2">
                        <span>✨</span> Danh Mục Nổi Bật
                    </h5>
                    <router-link to="/danh-muc" class="text-decoration-none small text-danger fw-bold">
                        Xem tất cả <i class="fa fa-chevron-right small"></i>
                    </router-link>
                </div>

                <!-- Horizontal Scroll for Mobile, Grid for Desktop -->
                <div class="app-scroll-chips mb-2">
                    <router-link to="/danh-muc" class="app-chip active">
                        <span>💐</span> Tất cả
                    </router-link>
                    <router-link v-for="(cat, index) in categories" :key="index" :to="cat.link" class="app-chip">
                        <span>{{ cat.icon }}</span> {{ cat.name }}
                    </router-link>
                    <router-link to="/mua/1" class="app-chip">
                        <span>🌸</span> Mùa Xuân
                    </router-link>
                    <router-link to="/mua/2" class="app-chip">
                        <span>☀️</span> Mùa Hạ
                    </router-link>
                    <router-link to="/mua/3" class="app-chip">
                        <span>🍂</span> Mùa Thu
                    </router-link>
                    <router-link to="/mua/4" class="app-chip">
                        <span>❄️</span> Mùa Đông
                    </router-link>
                </div>

                <!-- Category Cards Grid (Desktop & Tablet) -->
                <div class="row g-3 g-lg-4 mt-2 d-none d-md-flex">
                    <div class="col-4 col-lg-2" v-for="(cat, index) in categories" :key="'grid-' + index">
                        <router-link :to="cat.link" class="text-decoration-none">
                            <div class="category-box">
                                <div class="category-icon">{{ cat.icon }}</div>
                                <h6 class="category-name">{{ cat.name }}</h6>
                            </div>
                        </router-link>
                    </div>
                </div>
            </div>
        </section>

        <!-- =========================================================
             HOT PRODUCTS SECTION (Bán Chạy)
             ========================================================= -->
        <section id="san-pham-hot" class="section-padding py-4 py-lg-5">
            <div class="container">
                <div class="section-header d-flex justify-content-between align-items-center mb-3 mb-lg-4">
                    <div>
                        <span class="app-badge-pill app-badge-hot mb-1">
                            <i class="fa fa-fire"></i> Bán Chạy Nhất
                        </span>
                        <h2 class="section-title fs-3 fs-lg-2">
                            Sản Phẩm <span class="text-primary-gradient">Nổi Bật</span>
                        </h2>
                    </div>
                    <router-link to="/danh-muc" class="btn btn-view-all btn-sm">
                        Xem tất cả <i class="fa fa-arrow-right ms-1"></i>
                    </router-link>
                </div>

                <!-- 2 Columns on Mobile, 4 Columns on Desktop -->
                <div class="row g-2 g-sm-3 g-lg-4">
                    <div class="col-6 col-md-4 col-lg-3" v-for="item in noi_bat.slice(0, 8)" :key="'hot-' + item.id">
                        <div class="app-product-card" @click="$router.push('/chi-tiet/' + item.id)">
                            <div class="app-product-img-wrapper">
                                <img :src="getImageUrl(item.hinh_anh)" 
                                    class="app-product-img" 
                                    :alt="item.ten_bo_hoa" 
                                    @error="onImageError"
                                    loading="lazy">
                                <div class="app-product-badge-group">
                                    <span class="app-badge-pill app-badge-hot">
                                        <i class="fa fa-fire"></i> Hot
                                    </span>
                                </div>
                                <span v-if="item.phan_tram_giam" class="app-badge-pill app-badge-discount">
                                    -{{ item.phan_tram_giam }}%
                                </span>
                            </div>
                            <div class="app-product-body">
                                <h6 class="app-product-title" :title="item.ten_bo_hoa">{{ item.ten_bo_hoa }}</h6>
                                <div class="app-product-price-row">
                                    <span v-if="item.gia_giam" class="app-price-current">{{ formatPrice(item.gia_giam) }}đ</span>
                                    <span :class="item.gia_giam ? 'app-price-old' : 'app-price-current'">{{ formatPrice(item.gia) }}đ</span>
                                </div>
                                <router-link :to="'/chi-tiet/' + item.id" class="app-btn-view" @click.stop>
                                    <i class="fa fa-eye"></i> Xem Chi Tiết
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Empty state fallback if no hot products loaded -->
                <div v-if="noi_bat.length === 0" class="text-center py-5">
                    <div class="spinner-border text-danger" role="status"></div>
                    <p class="text-muted mt-2 small">Đang tải sản phẩm...</p>
                </div>
            </div>
        </section>

        <!-- =========================================================
             PROMO BANNER
             ========================================================= -->
        <section class="promo-section my-3 my-lg-4">
            <div class="promo-overlay"></div>
            <div class="container position-relative py-4 py-lg-5">
                <div class="row align-items-center text-center text-lg-start">
                    <div class="col-lg-8">
                        <span class="promo-badge">
                            <i class="fa fa-gift me-1"></i> Ưu Đãi Đặt Online
                        </span>
                        <h2 class="promo-title">Giảm Ngay 10% - 30% Đặt Trước 24H</h2>
                        <p class="promo-text mb-3 mb-lg-0">
                            Tặng kèm thiệp thiết kế riêng & miễn phí ship bán kính 5km tại Đà Nẵng.
                        </p>
                    </div>
                    <div class="col-lg-4 text-center text-lg-end mt-2 mt-lg-0">
                        <router-link to="/danh-muc" class="btn btn-promo">
                            Chọn Hoa Ngay <i class="fa fa-arrow-right ms-1"></i>
                        </router-link>
                    </div>
                </div>
            </div>
        </section>

        <!-- =========================================================
             NEW PRODUCTS SECTION (Mới Nhất)
             ========================================================= -->
        <section class="section-padding py-4 py-lg-5 bg-subtle-pink">
            <div class="container">
                <div class="section-header d-flex justify-content-between align-items-center mb-3 mb-lg-4">
                    <div>
                        <span class="app-badge-pill app-badge-new mb-1">
                            <i class="fa fa-leaf"></i> Vừa Ra Mắt
                        </span>
                        <h2 class="section-title fs-3 fs-lg-2">
                            Mẫu Mới <span class="text-success">Tháng Này</span>
                        </h2>
                    </div>
                    <router-link to="/danh-muc" class="btn btn-view-all-green btn-sm">
                        Xem tất cả <i class="fa fa-arrow-right ms-1"></i>
                    </router-link>
                </div>

                <!-- 2 Columns on Mobile, 4 Columns on Desktop -->
                <div class="row g-2 g-sm-3 g-lg-4">
                    <div class="col-6 col-md-4 col-lg-3" v-for="item in moi_nhat.slice(0, 8)" :key="'new-' + item.id">
                        <div class="app-product-card" @click="$router.push('/chi-tiet/' + item.id)">
                            <div class="app-product-img-wrapper">
                                <img :src="getImageUrl(item.hinh_anh)" 
                                    class="app-product-img" 
                                    :alt="item.ten_bo_hoa"
                                    @error="onImageError"
                                    loading="lazy">
                                <div class="app-product-badge-group">
                                    <span class="app-badge-pill app-badge-new">NEW</span>
                                </div>
                                <span v-if="item.phan_tram_giam" class="app-badge-pill app-badge-discount">
                                    -{{ item.phan_tram_giam }}%
                                </span>
                            </div>
                            <div class="app-product-body">
                                <h6 class="app-product-title" :title="item.ten_bo_hoa">{{ item.ten_bo_hoa }}</h6>
                                <div class="app-product-price-row">
                                    <span v-if="item.gia_giam" class="app-price-current text-success">{{ formatPrice(item.gia_giam) }}đ</span>
                                    <span :class="item.gia_giam ? 'app-price-old' : 'app-price-current text-success'">{{ formatPrice(item.gia) }}đ</span>
                                </div>
                                <router-link :to="'/chi-tiet/' + item.id" class="app-btn-view btn-green" @click.stop>
                                    <i class="fa fa-eye"></i> Xem Chi Tiết
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- =========================================================
             SEASON SHOWCASE (Bốn Mùa)
             ========================================================= -->
        <section class="section-padding py-4 py-lg-5">
            <div class="container">
                <div class="text-center mb-3 mb-lg-4">
                    <span class="app-badge-pill bg-light text-secondary mb-1">Thiết Kế Theo Mùa</span>
                    <h2 class="section-title fs-3 fs-lg-2">Bộ Sưu Tập <span class="text-primary-gradient">Bốn Mùa</span></h2>
                </div>
                <div class="row g-2 g-sm-3 g-lg-4 justify-content-center">
                    <div class="col-6 col-md-3" v-for="(season, index) in seasons" :key="'season-' + index">
                        <router-link :to="'/mua/' + season.id" class="text-decoration-none">
                            <div class="season-card">
                                <img :src="season.image" class="season-image" :alt="season.name">
                                <div class="season-overlay">
                                    <span class="season-icon">{{ season.icon }}</span>
                                    <h5 class="season-name">{{ season.name }}</h5>
                                </div>
                            </div>
                        </router-link>
                    </div>
                </div>
            </div>
        </section>

        <!-- =========================================================
             APP FEATURES & COMMITMENTS (Tại sao chọn Ni Flower's)
             ========================================================= -->
        <section class="section-features py-4 py-lg-5">
            <div class="container">
                <div class="row g-3 g-lg-4">
                    <div class="col-6 col-md-3" v-for="(feature, index) in features" :key="'feat-' + index">
                        <div class="feature-box">
                            <div class="feature-icon">{{ feature.icon }}</div>
                            <h6 class="feature-title">{{ feature.title }}</h6>
                            <p class="feature-text">{{ feature.text }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- =========================================================
             CUSTOMER REVIEWS
             ========================================================= -->
        <section class="section-padding py-4 py-lg-5 bg-white">
            <div class="container">
                <div class="text-center mb-3 mb-lg-4">
                    <span class="app-badge-pill bg-light text-secondary mb-1">Khách Hàng Tin Cậy</span>
                    <h2 class="section-title fs-3 fs-lg-2">Đánh Giá Từ <span class="text-primary-gradient">Khách Yêu</span></h2>
                </div>
                <div class="row g-3 g-lg-4">
                    <div class="col-12 col-md-4" v-for="(review, index) in reviews" :key="'rev-' + index">
                        <div class="review-box">
                            <div class="d-flex align-items-center gap-3 mb-2">
                                <img :src="review.avatar" class="review-avatar" alt="Avatar">
                                <div>
                                    <h6 class="review-name mb-0">{{ review.name }}</h6>
                                    <div class="text-warning small">{{ review.stars }}</div>
                                </div>
                            </div>
                            <p class="review-text small mb-0">"{{ review.content }}"</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- =========================================================
             BOTTOM CTA SECTION
             ========================================================= -->
        <section class="cta-section py-4 py-lg-5 text-center text-white position-relative">
            <div class="cta-overlay"></div>
            <div class="container position-relative">
                <h2 class="cta-title fs-2 fs-lg-1">Bạn Cần Tư Vấn Đặt Hoa Ngay?</h2>
                <p class="cta-text mb-4 opacity-90">Gọi hotline hoặc nhắn Zalo để được tư vấn bó hoa ưng ý nhất chỉ trong 5 phút!</p>
                <div class="d-flex gap-2 gap-sm-3 justify-content-center flex-wrap">
                    <a href="tel:0905999276" class="btn btn-cta-primary">
                        <i class="fa fa-phone me-1"></i> Gọi 0905 999 276
                    </a>
                    <a href="https://zalo.me/0905999276" target="_blank" class="btn btn-cta-outline">
                        <i class="fa fa-comment me-1"></i> Chat Zalo Tư Vấn
                    </a>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import axios from 'axios';
import { ipbe } from '@/config/api';

export default {
    data() {
        return {
            noi_bat: [],
            moi_nhat: [],
            categories: [
                { name: 'Tình Yêu', icon: '💕', link: '/dip-le/1' },
                { name: 'Đám Cưới', icon: '💒', link: '/dip-le/2' },
                { name: 'Khai Trương', icon: '🏠', link: '/dip-le/4' },
                { name: 'Sinh Nhật', icon: '🎂', link: '/dip-le/5' },
                { name: 'Chia Buồn', icon: '🕯️', link: '/dip-le/3' },
                { name: 'Lễ Hội', icon: '🎉', link: '/dip-le/6' },
            ],
            seasons: [
                { id: 1, name: 'Mùa Xuân', icon: '🌸', image: 'https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=500&h=600&fit=crop' },
                { id: 2, name: 'Mùa Hạ', icon: '☀️', image: 'https://images.unsplash.com/photo-1518882605630-8a6392e87b54?w=500&h=600&fit=crop' },
                { id: 3, name: 'Mùa Thu', icon: '🍂', image: 'https://images.unsplash.com/photo-1508610048659-a06b669e3321?w=500&h=600&fit=crop' },
                { id: 4, name: 'Mùa Đông', icon: '❄️', image: 'https://images.unsplash.com/photo-1487530811176-3780de880c2d?w=500&h=600&fit=crop' },
            ],
            features: [
                { icon: '🚀', title: 'Giao Nhanh 2H', text: 'Nội thành Đà Nẵng' },
                { icon: '🌹', title: 'Hoa Tươi 100%', text: 'Tuyển chọn mỗi sáng' },
                { icon: '💝', title: 'Tặng Kèm Thiệp', text: 'Thiết kế chữ nắn nót' },
                { icon: '🛡️', title: 'Đổi Trả Uy Tín', text: 'Cam kết chất lượng' },
            ],
            reviews: [
                { name: 'Chị Lan Anh', avatar: 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?w=120&h=120&fit=crop', stars: '⭐⭐⭐⭐⭐', content: 'Hoa rất đẹp và tươi lâu. Giao hàng hỏa tốc đúng giờ, gói rất sang trọng!' },
                { name: 'Anh Minh Tuấn', avatar: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=120&h=120&fit=crop', stars: '⭐⭐⭐⭐⭐', content: 'Đặt hoa tặng bạn gái ngày 8/3, bó hoa ngoài đời đẹp hơn hình chụp. Sẽ tiếp tục ủng hộ!' },
                { name: 'Chị Thu Hà', avatar: 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=120&h=120&fit=crop', stars: '⭐⭐⭐⭐⭐', content: 'Shop tư vấn nhiệt tình, giá cả rất hợp lý. Có chụp ảnh gửi xem trước khi ship!' },
            ]
        };
    },
    methods: {
        loadData() {
            axios.get(ipbe + '/api/client/home-page')
                .then((res) => {
                    if (res.data.status) {
                        this.noi_bat = res.data.noi_bat || [];
                        this.moi_nhat = res.data.moi_nhat || [];
                    }
                })
                .catch(() => {
                    this.noi_bat = [];
                    this.moi_nhat = [];
                });
        },
        formatPrice(price) {
            return new Intl.NumberFormat('vi-VN').format(price);
        },
        getImageUrl(path) {
            if (!path) return 'https://images.unsplash.com/photo-1561181286-d3fee7d55364?w=500&h=500&fit=crop';
            if (path.startsWith('http')) return path;
            return ipbe + '' + path;
        },
        onImageError(e) {
            e.target.src = 'https://images.unsplash.com/photo-1561181286-d3fee7d55364?w=500&h=500&fit=crop';
        }
    },
    mounted() {
        this.loadData();
    }
};
</script>

<style scoped>
.home-page-container {
    overflow-x: hidden;
}

/* ===== HERO SECTION ===== */
.hero-section {
    position: relative;
    background: #1a1a2e;
    color: white;
}

.hero-bg {
    position: absolute;
    inset: 0;
    background: url('https://images.unsplash.com/photo-1487530811176-3780de880c2d?w=1920&h=1080&fit=crop') center/cover;
    filter: brightness(0.65);
}

.hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(26, 26, 46, 0.94) 0%, rgba(194, 24, 91, 0.75) 100%);
}

.hero-badge {
    background: linear-gradient(135deg, #e91e63, #ff6b9d);
    color: white;
    padding: 8px 18px;
    border-radius: 50px;
    font-size: 0.88rem;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    box-shadow: 0 4px 15px rgba(233, 30, 99, 0.4);
}

.hero-title {
    font-size: 2.8rem;
    font-weight: 800;
    line-height: 1.15;
    letter-spacing: -0.5px;
    margin-bottom: 1rem;
    color: #ffffff !important;
    text-shadow: 0 2px 12px rgba(0, 0, 0, 0.4);
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 1.85rem;
    }
}

.text-gradient {
    background: linear-gradient(135deg, #ff6b9d 0%, #ffc371 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.text-primary-gradient {
    background: linear-gradient(135deg, #e91e63 0%, #ff6b9d 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.hero-subtitle {
    font-size: 1rem;
    color: rgba(255, 255, 255, 0.85);
    line-height: 1.6;
    margin-bottom: 1.5rem;
    max-width: 520px;
}

.btn-hero-primary {
    background: linear-gradient(135deg, #e91e63 0%, #ff6b9d 100%);
    color: white;
    padding: 12px 26px;
    border-radius: 50px;
    font-weight: 700;
    border: none;
    font-size: 0.95rem;
    box-shadow: 0 8px 24px rgba(233, 30, 99, 0.4);
    text-decoration: none;
    transition: all 0.25s ease;
}

.btn-hero-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 28px rgba(233, 30, 99, 0.5);
    color: white;
}

.btn-hero-outline {
    background: rgba(255, 255, 255, 0.12);
    color: white;
    padding: 12px 24px;
    border-radius: 50px;
    font-weight: 700;
    border: 1.5px solid rgba(255, 255, 255, 0.4);
    font-size: 0.95rem;
    text-decoration: none;
    transition: all 0.25s ease;
}

.btn-hero-outline:hover {
    background: white;
    color: #c2185b;
}

.hero-stats {
    gap: 30px;
}

.stat-number {
    display: block;
    font-size: 1.6rem;
    font-weight: 800;
    background: linear-gradient(135deg, #ff8e53, #ff6b9d);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    line-height: 1.1;
}

.stat-label {
    font-size: 0.78rem;
    color: rgba(255, 255, 255, 0.7);
    font-weight: 500;
}

.hero-image-container {
    position: relative;
    display: inline-block;
}

.hero-main-image {
    width: 100%;
    max-width: 420px;
    height: 480px;
    object-fit: cover;
    border-radius: 28px;
    box-shadow: 0 25px 60px rgba(0, 0, 0, 0.4);
    border: 4px solid rgba(255, 255, 255, 0.2);
}

.floating-badge {
    position: absolute;
    background: white;
    color: #1a1a2e;
    padding: 8px 16px;
    border-radius: 16px;
    font-weight: 700;
    font-size: 0.85rem;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    animation: floatAnim 3s ease-in-out infinite;
}

.badge-1 { top: 12%; left: -6%; }
.badge-2 { top: 52%; right: -6%; animation-delay: 1s; }
.badge-3 { bottom: 10%; left: 0%; animation-delay: 2s; }

@keyframes floatAnim {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
}

/* Category Box (Grid view for desktop) */
.category-box {
    background: white;
    border-radius: 18px;
    padding: 20px 10px;
    text-align: center;
    box-shadow: 0 4px 18px rgba(233, 30, 99, 0.06);
    border: 1px solid rgba(233, 30, 99, 0.08);
    transition: all 0.25s ease;
    height: 100%;
}

.category-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 28px rgba(233, 30, 99, 0.15);
    border-color: #ff6b9d;
}

.category-icon {
    font-size: 2.2rem;
    margin-bottom: 8px;
}

.category-name {
    font-size: 0.9rem;
    font-weight: 700;
    color: #1a1a2e;
    margin: 0;
}

.btn-view-all {
    background: #fff0f5;
    color: #e91e63;
    border-radius: 30px;
    padding: 6px 16px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s;
    border: 1px solid rgba(233, 30, 99, 0.2);
}

.btn-view-all:hover {
    background: #e91e63;
    color: white;
}

.btn-view-all-green {
    background: #e8f5e9;
    color: #2e7d32;
    border-radius: 30px;
    padding: 6px 16px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s;
    border: 1px solid rgba(46, 125, 50, 0.2);
}

.btn-view-all-green:hover {
    background: #2e7d32;
    color: white;
}

.bg-subtle-pink {
    background: linear-gradient(180deg, #fffbfd 0%, #faf8f9 100%);
}

.btn-green {
    background: linear-gradient(135deg, #34c759, #28a745) !important;
}

/* Promo Banner */
.promo-section {
    position: relative;
    background: url('https://images.unsplash.com/photo-1518882605630-8a6392e87b54?w=1920&h=400&fit=crop') center/cover;
    border-radius: 20px;
    margin-left: 12px;
    margin-right: 12px;
    overflow: hidden;
}

.promo-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(233, 30, 99, 0.95), rgba(194, 24, 91, 0.88));
}

.promo-badge {
    background: rgba(255, 255, 255, 0.22);
    color: white;
    padding: 6px 14px;
    border-radius: 30px;
    font-size: 0.8rem;
    font-weight: 700;
    display: inline-block;
    margin-bottom: 10px;
}

.promo-title {
    color: white;
    font-size: 1.8rem;
    font-weight: 800;
    margin-bottom: 8px;
}

@media (max-width: 768px) {
    .promo-title { font-size: 1.4rem; }
}

.promo-text {
    color: rgba(255, 255, 255, 0.9);
    font-size: 0.95rem;
}

.btn-promo {
    background: white;
    color: #e91e63;
    padding: 12px 28px;
    border-radius: 50px;
    font-weight: 800;
    font-size: 0.95rem;
    text-decoration: none;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    display: inline-block;
    transition: all 0.25s ease;
}

.btn-promo:hover {
    transform: translateY(-2px);
    color: #c2185b;
}

/* Season Cards */
.season-card {
    position: relative;
    height: 180px;
    border-radius: 18px;
    overflow: hidden;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    transition: transform 0.25s ease;
}

@media (min-width: 768px) {
    .season-card { height: 260px; }
}

.season-card:hover {
    transform: translateY(-4px);
}

.season-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.season-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, transparent 40%, rgba(0, 0, 0, 0.8) 100%);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-end;
    padding: 16px;
}

.season-icon {
    font-size: 1.8rem;
    margin-bottom: 4px;
}

.season-name {
    color: white;
    font-weight: 700;
    font-size: 1rem;
    margin: 0;
}

/* Features */
.section-features {
    background: #1a1a2e;
    color: white;
}

.feature-box {
    text-align: center;
    padding: 16px 10px;
}

.feature-icon {
    font-size: 2.2rem;
    margin-bottom: 8px;
}

.feature-title {
    font-weight: 700;
    font-size: 0.95rem;
    margin-bottom: 4px;
}

.feature-text {
    font-size: 0.78rem;
    color: rgba(255, 255, 255, 0.6);
    margin: 0;
}

/* Reviews */
.review-box {
    background: #fbfbfb;
    border: 1px solid #f0f0f0;
    border-radius: 18px;
    padding: 18px;
    height: 100%;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
}

.review-avatar {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    object-fit: cover;
}

.review-name {
    font-weight: 700;
    font-size: 0.92rem;
}

/* CTA */
.cta-section {
    position: relative;
    background: url('https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=1920&h=400&fit=crop') center/cover;
}

.cta-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(233, 30, 99, 0.95), rgba(194, 24, 91, 0.92));
}

.btn-cta-primary {
    background: white;
    color: #e91e63;
    padding: 12px 28px;
    border-radius: 50px;
    font-weight: 800;
    text-decoration: none;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    transition: all 0.2s;
}

.btn-cta-primary:hover {
    transform: translateY(-2px);
    color: #c2185b;
}

.btn-cta-outline {
    background: transparent;
    color: white;
    border: 2px solid white;
    padding: 12px 24px;
    border-radius: 50px;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s;
}

.btn-cta-outline:hover {
    background: white;
    color: #e91e63;
}
</style>
