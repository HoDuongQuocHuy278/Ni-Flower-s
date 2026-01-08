<template>
    <div>
        <!-- Hero Section - Full Screen with Beautiful Gradient -->
        <section class="hero-section position-relative overflow-hidden">
            <div class="hero-bg"></div>
            <div class="hero-overlay"></div>
            <div class="container position-relative h-100 d-flex align-items-center" style="min-height: 100vh;">
                <div class="row w-100 align-items-center">
                    <div class="col-lg-6 text-center text-lg-start">
                        <span class="badge hero-badge mb-4">🌸 Ni Flower's - Hoa Tươi Mỗi Ngày</span>
                        <h1 class="hero-title">
                            Gửi Yêu Thương
                            <span class="text-gradient">Bằng Hoa</span>
                        </h1>
                        <p class="hero-subtitle">
                            Chuyên cung cấp hoa tươi cao cấp, giao hàng tận nơi trong 2 giờ.
                            Cam kết hoa tươi 100%, thiết kế theo yêu cầu.
                        </p>
                        <div class="d-flex gap-3 flex-wrap justify-content-center justify-content-lg-start">
                            <router-link to="/danh-muc" class="btn btn-hero-primary">
                                <i class="fa fa-shopping-bag me-2"></i> Khám Phá Ngay
                            </router-link>
                            <a href="tel:0905999276" class="btn btn-hero-outline">
                                <i class="fa fa-phone me-2"></i> Gọi Đặt Hoa
                            </a>
                        </div>
                        <div class="hero-stats mt-5">
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
                    <div class="col-lg-6 text-center mt-5 mt-lg-0">
                        <div class="hero-image-container">
                            <img src="https://images.unsplash.com/photo-1487530811176-3780de880c2d?w=800&h=900&fit=crop" 
                                class="hero-main-image" alt="Hoa tươi">
                            <div class="floating-badge badge-1">
                                <span>🚀</span> Giao hàng 2H
                            </div>
                            <div class="floating-badge badge-2">
                                <span>⭐</span> 4.9/5 Rating
                            </div>
                            <div class="floating-badge badge-3">
                                <span>💝</span> Thiết kế đẹp
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="scroll-indicator">
                <a href="#danh-muc"><i class="fa fa-chevron-down"></i></a>
            </div>
        </section>

        <!-- Categories Section -->
        <section id="danh-muc" class="section-padding section-categories">
            <div class="container">
                <div class="section-header text-center">
                    <span class="section-badge">Danh Mục</span>
                    <h2 class="section-title">Hoa Theo <span class="text-primary-gradient">Dịp Lễ</span></h2>
                </div>
                <div class="row g-4 justify-content-center">
                    <div class="col-6 col-md-4 col-lg-2" v-for="(cat, index) in categories" :key="index">
                        <router-link :to="cat.link" class="text-decoration-none">
                            <div class="category-card">
                                <div class="category-icon">{{ cat.icon }}</div>
                                <h6 class="category-name">{{ cat.name }}</h6>
                            </div>
                        </router-link>
                    </div>
                </div>
            </div>
        </section>

        <!-- Hot Products Section -->
        <section id="san-pham-hot" class="section-padding section-products">
            <div class="container">
                <div class="section-header">
                    <div>
                        <span class="section-badge">🔥 Bán Chạy</span>
                        <h2 class="section-title">Sản Phẩm <span class="text-primary-gradient">Hot</span></h2>
                    </div>
                    <router-link to="/danh-muc" class="btn btn-view-all">
                        Xem tất cả <i class="fa fa-arrow-right ms-2"></i>
                    </router-link>
                </div>
                <div class="row g-4">
                    <div class="col-6 col-md-4 col-lg-3" v-for="item in noi_bat.slice(0, 8)" :key="'hot-' + item.id">
                        <div class="product-card">
                            <div class="product-image-wrapper">
                                <img :src="getImageUrl(item.hinh_anh)" class="product-image" alt="">
                                <div class="product-overlay">
                                    <router-link :to="'/chi-tiet/' + item.id" class="btn-quick-view">
                                        <i class="fa fa-eye"></i>
                                    </router-link>
                                </div>
                                <span v-if="item.phan_tram_giam" class="discount-badge">-{{ item.phan_tram_giam }}%</span>
                                <span class="hot-badge">🔥</span>
                            </div>
                            <div class="product-info">
                                <h6 class="product-title">{{ item.ten_bo_hoa }}</h6>
                                <div class="product-price">
                                    <span v-if="item.gia_giam" class="price-sale">{{ formatPrice(item.gia_giam) }}đ</span>
                                    <span :class="item.gia_giam ? 'price-original' : 'price-sale'">{{ formatPrice(item.gia) }}đ</span>
                                </div>
                                <router-link :to="'/chi-tiet/' + item.id" class="btn-product">
                                    Xem Chi Tiết
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Promo Banner -->
        <section class="promo-section">
            <div class="promo-overlay"></div>
            <div class="container position-relative">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <span class="promo-badge">🎉 Ưu Đãi Đặc Biệt</span>
                        <h2 class="promo-title">Giảm 30% Cho Đơn Hàng Online!</h2>
                        <p class="promo-text">Áp dụng từ nay đến hết tháng 12. Đặt hoa ngay để nhận ưu đãi.</p>
                    </div>
                    <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                        <router-link to="/danh-muc" class="btn btn-promo">
                            Mua Ngay <i class="fa fa-arrow-right ms-2"></i>
                        </router-link>
                    </div>
                </div>
            </div>
        </section>

        <!-- Flower Types Section -->
        <section class="section-padding section-flower-types">
            <div class="container">
                <div class="section-header text-center">
                    <span class="section-badge">Loại Hoa</span>
                    <h2 class="section-title">Hoa <span class="text-primary-gradient">Phổ Biến</span></h2>
                </div>
                <div class="row g-4 justify-content-center">
                    <div class="col-6 col-md-4 col-lg-2" v-for="(flower, index) in flowerTypes" :key="index">
                        <div class="flower-card">
                            <div class="flower-image-wrapper">
                                <img :src="flower.image" class="flower-image" alt="">
                            </div>
                            <h6 class="flower-name">{{ flower.name }}</h6>
                            <small class="flower-desc">{{ flower.desc }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Season Section -->
        <section class="section-padding section-seasons">
            <div class="container">
                <div class="section-header text-center">
                    <span class="section-badge">Theo Mùa</span>
                    <h2 class="section-title">Hoa <span class="text-primary-gradient">Bốn Mùa</span></h2>
                </div>
                <div class="row g-4 justify-content-center">
                    <div class="col-6 col-md-3" v-for="(season, index) in seasons" :key="index">
                        <router-link :to="'/mua/' + season.id" class="text-decoration-none">
                            <div class="season-card">
                                <img :src="season.image" class="season-image" alt="">
                                <div class="season-overlay">
                                    <span class="season-icon">{{ season.icon }}</span>
                                    <h4 class="season-name">{{ season.name }}</h4>
                                </div>
                            </div>
                        </router-link>
                    </div>
                </div>
            </div>
        </section>

        <!-- New Products Section -->
        <section class="section-padding section-products bg-light-pink">
            <div class="container">
                <div class="section-header">
                    <div>
                        <span class="section-badge-green">🌱 Mới Nhất</span>
                        <h2 class="section-title">Sản Phẩm <span class="text-success">Mới</span></h2>
                    </div>
                    <router-link to="/danh-muc" class="btn btn-view-all-green">
                        Xem tất cả <i class="fa fa-arrow-right ms-2"></i>
                    </router-link>
                </div>
                <div class="row g-4">
                    <div class="col-6 col-md-4 col-lg-3" v-for="item in moi_nhat.slice(0, 8)" :key="'new-' + item.id">
                        <div class="product-card">
                            <div class="product-image-wrapper">
                                <img :src="getImageUrl(item.hinh_anh)" class="product-image" alt="">
                                <div class="product-overlay">
                                    <router-link :to="'/chi-tiet/' + item.id" class="btn-quick-view green">
                                        <i class="fa fa-eye"></i>
                                    </router-link>
                                </div>
                                <span class="new-badge">NEW</span>
                            </div>
                            <div class="product-info">
                                <h6 class="product-title">{{ item.ten_bo_hoa }}</h6>
                                <div class="product-price">
                                    <span v-if="item.gia_giam" class="price-sale green">{{ formatPrice(item.gia_giam) }}đ</span>
                                    <span :class="item.gia_giam ? 'price-original' : 'price-sale green'">{{ formatPrice(item.gia) }}đ</span>
                                </div>
                                <router-link :to="'/chi-tiet/' + item.id" class="btn-product green">
                                    Xem Chi Tiết
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="section-features">
            <div class="container">
                <div class="row g-4">
                    <div class="col-6 col-md-3" v-for="(feature, index) in features" :key="index">
                        <div class="feature-card">
                            <div class="feature-icon">{{ feature.icon }}</div>
                            <h5 class="feature-title">{{ feature.title }}</h5>
                            <p class="feature-text">{{ feature.text }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Reviews Section -->
        <section class="section-padding section-reviews">
            <div class="container">
                <div class="section-header text-center">
                    <span class="section-badge">Đánh Giá</span>
                    <h2 class="section-title">Khách Hàng <span class="text-primary-gradient">Nói Gì?</span></h2>
                </div>
                <div class="row g-4 justify-content-center">
                    <div class="col-md-4" v-for="(review, index) in reviews" :key="index">
                        <div class="review-card">
                            <div class="review-header">
                                <img :src="review.avatar" class="review-avatar" alt="">
                                <div>
                                    <h6 class="review-name">{{ review.name }}</h6>
                                    <div class="review-stars">{{ review.stars }}</div>
                                </div>
                            </div>
                            <p class="review-content">"{{ review.content }}"</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section">
            <div class="cta-overlay"></div>
            <div class="container text-center position-relative">
                <h2 class="cta-title">Sẵn Sàng Đặt Hoa?</h2>
                <p class="cta-text">Liên hệ ngay để được tư vấn và đặt hoa đẹp nhất!</p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="tel:0905999276" class="btn btn-cta-primary">
                        <i class="fa fa-phone me-2"></i> 0905 999 276
                    </a>
                    <a href="https://zalo.me/0905999276" target="_blank" class="btn btn-cta-outline">
                        <i class="fa fa-comment me-2"></i> Chat Zalo
                    </a>
                </div>
            </div>
        </section>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data() {
        return {
            noi_bat: [],
            moi_nhat: [],
            categories: [
                { name: 'Tình Yêu', icon: '💕', link: '/dip-le/1' },
                { name: 'Đám Cưới', icon: '💒', link: '/dip-le/2' },
                { name: 'Chia Buồn', icon: '🕯️', link: '/dip-le/3' },
                { name: 'Khai Trương', icon: '🏠', link: '/dip-le/4' },
                { name: 'Sinh Nhật', icon: '🎂', link: '/dip-le/5' },
                { name: 'Lễ Hội', icon: '🎉', link: '/dip-le/6' },
            ],
            flowerTypes: [
                { name: 'Hoa Hồng', desc: 'Tình yêu', image: 'https://images.unsplash.com/photo-1518882605630-8a6392e87b54?w=300&h=300&fit=crop' },
                { name: 'Hoa Lan', desc: 'Sang trọng', image: 'https://images.unsplash.com/photo-1566667586429-b16d5ed2b0f0?w=300&h=300&fit=crop' },
                { name: 'Hoa Tulip', desc: 'Thanh lịch', image: 'https://images.unsplash.com/photo-1520763185298-1b434c919102?w=300&h=300&fit=crop' },
                { name: 'Hoa Cúc', desc: 'Thuần khiết', image: 'https://images.unsplash.com/photo-1508610048659-a06b669e3321?w=300&h=300&fit=crop' },
                { name: 'Hoa Ly', desc: 'Quyến rũ', image: 'https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=300&h=300&fit=crop' },
                { name: 'Hoa Sen', desc: 'Tinh tế', image: 'https://images.unsplash.com/photo-1474557157379-8aa74a6ef541?w=300&h=300&fit=crop' },
            ],
            seasons: [
                { id: 1, name: 'Mùa Xuân', icon: '🌸', image: 'https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=500&h=600&fit=crop' },
                { id: 2, name: 'Mùa Hạ', icon: '☀️', image: 'https://images.unsplash.com/photo-1518882605630-8a6392e87b54?w=500&h=600&fit=crop' },
                { id: 3, name: 'Mùa Thu', icon: '🍂', image: 'https://images.unsplash.com/photo-1508610048659-a06b669e3321?w=500&h=600&fit=crop' },
                { id: 4, name: 'Mùa Đông', icon: '❄️', image: 'https://images.unsplash.com/photo-1487530811176-3780de880c2d?w=500&h=600&fit=crop' },
            ],
            features: [
                { icon: '🚚', title: 'Giao Nhanh 2H', text: 'Trong nội thành' },
                { icon: '🌹', title: 'Hoa Tươi 100%', text: 'Cam kết chất lượng' },
                { icon: '💳', title: 'Thanh Toán Dễ', text: 'COD, Banking' },
                { icon: '🎁', title: 'Quà Tặng Kèm', text: 'Thiệp, ruy băng' },
            ],
            reviews: [
                { name: 'Chị Lan Anh', avatar: 'https://randomuser.me/api/portraits/women/32.jpg', stars: '⭐⭐⭐⭐⭐', content: 'Hoa rất đẹp và tươi lâu. Giao hàng nhanh, đóng gói cẩn thận!' },
                { name: 'Anh Minh Tuấn', avatar: 'https://randomuser.me/api/portraits/men/45.jpg', stars: '⭐⭐⭐⭐⭐', content: 'Đặt hoa tặng vợ ngày 8/3, bó hoa đẹp hơn hình. Rất hài lòng!' },
                { name: 'Chị Thu Hà', avatar: 'https://randomuser.me/api/portraits/women/68.jpg', stars: '⭐⭐⭐⭐⭐', content: 'Giá cả hợp lý, mẫu mã phong phú. Liên hệ qua Zalo rất tiện!' },
            ]
        }
    },
    methods: {
        loadData() {
            axios.get('http://127.0.0.1:8000/api/client/home-page')
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
            if (!path) return 'https://images.unsplash.com/photo-1518882605630-8a6392e87b54?w=400&h=400&fit=crop';
            if (path.startsWith('http')) return path;
            return 'http://127.0.0.1:8000' + path;
        }
    },
    mounted() {
        this.loadData();
    },
}
</script>
<style>
/* ===== VARIABLES ===== */
:root {
    --primary: #e91e63;
    --primary-dark: #c2185b;
    --primary-light: #f8bbd9;
    --secondary: #ff6b9d;
    --gradient: linear-gradient(135deg, #e91e63 0%, #ff6b9d 50%, #ffc371 100%);
    --gradient-dark: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
}

/* ===== HERO SECTION ===== */
.hero-section {
    min-height: 100vh;
    position: relative;
}
.hero-bg {
    position: absolute;
    inset: 0;
    background: url('https://images.unsplash.com/photo-1487530811176-3780de880c2d?w=1920&h=1080&fit=crop') center/cover;
}
.hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(26, 26, 46, 0.95) 0%, rgba(22, 33, 62, 0.9) 50%, rgba(15, 52, 96, 0.85) 100%);
}
.hero-badge {
    display: inline-block;
    background: var(--gradient);
    color: white;
    padding: 10px 25px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    animation: pulse 2s infinite;
}
.hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    color: white;
    line-height: 1.2;
    margin-bottom: 1.5rem;
}
.text-gradient {
    background: var(--gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.text-primary-gradient {
    background: var(--gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.hero-subtitle {
    font-size: 1.2rem;
    color: rgba(255,255,255,0.8);
    margin-bottom: 2rem;
    line-height: 1.8;
}
.btn-hero-primary {
    background: var(--gradient);
    color: white;
    padding: 15px 35px;
    border-radius: 50px;
    font-weight: 600;
    border: none;
    transition: all 0.3s ease;
    text-decoration: none;
}
.btn-hero-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(233, 30, 99, 0.4);
    color: white;
}
.btn-hero-outline {
    background: transparent;
    color: white;
    padding: 15px 35px;
    border-radius: 50px;
    font-weight: 600;
    border: 2px solid rgba(255,255,255,0.5);
    transition: all 0.3s ease;
    text-decoration: none;
}
.btn-hero-outline:hover {
    background: white;
    color: var(--primary);
}
.hero-stats {
    display: flex;
    gap: 40px;
}
.stat-item {
    text-align: center;
}
.stat-number {
    display: block;
    font-size: 2rem;
    font-weight: 800;
    background: var(--gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.stat-label {
    color: rgba(255,255,255,0.6);
    font-size: 0.9rem;
}

/* Hero Image */
.hero-image-container {
    position: relative;
}
.hero-main-image {
    width: 100%;
    max-width: 450px;
    height: 550px;
    object-fit: cover;
    border-radius: 30px;
    border: 5px solid rgba(255,255,255,0.2);
    box-shadow: 0 30px 60px rgba(0,0,0,0.3);
}
.floating-badge {
    position: absolute;
    background: white;
    padding: 12px 20px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    font-weight: 600;
    font-size: 0.9rem;
    animation: float 3s ease-in-out infinite;
}
.floating-badge span {
    margin-right: 5px;
}
.badge-1 { top: 10%; left: -10%; animation-delay: 0s; }
.badge-2 { top: 50%; right: -10%; animation-delay: 1s; }
.badge-3 { bottom: 10%; left: 0%; animation-delay: 2s; }

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-15px); }
}
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.8; }
}

.scroll-indicator {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
}
.scroll-indicator a {
    color: white;
    font-size: 1.5rem;
    animation: bounce 2s infinite;
}
@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(10px); }
}

/* ===== SECTIONS ===== */
.section-padding {
    padding: 80px 0;
}
.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 50px;
    flex-wrap: wrap;
    gap: 20px;
}
.section-header.text-center {
    flex-direction: column;
}
.section-badge {
    display: inline-block;
    background: var(--primary-light);
    color: var(--primary);
    padding: 8px 20px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 15px;
}
.section-badge-green {
    display: inline-block;
    background: #c8e6c9;
    color: #2e7d32;
    padding: 8px 20px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 15px;
}
.section-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: #1a1a2e;
    margin: 0;
}
.btn-view-all {
    background: var(--primary-light);
    color: var(--primary);
    border: none;
    padding: 12px 25px;
    border-radius: 50px;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
}
.btn-view-all:hover {
    background: var(--primary);
    color: white;
}
.btn-view-all-green {
    background: #c8e6c9;
    color: #2e7d32;
    border: none;
    padding: 12px 25px;
    border-radius: 50px;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
}
.btn-view-all-green:hover {
    background: #2e7d32;
    color: white;
}

/* ===== CATEGORY CARDS ===== */
.section-categories {
    background: linear-gradient(180deg, #fff5f8 0%, #ffffff 100%);
}
.category-card {
    background: white;
    padding: 30px 20px;
    border-radius: 20px;
    text-align: center;
    box-shadow: 0 10px 40px rgba(233, 30, 99, 0.08);
    transition: all 0.3s ease;
    height: 100%;
}
.category-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 50px rgba(233, 30, 99, 0.15);
}
.category-icon {
    font-size: 3rem;
    margin-bottom: 15px;
}
.category-name {
    font-weight: 700;
    color: #1a1a2e;
    margin: 0;
}

/* ===== PRODUCT CARDS ===== */
.product-card {
    background: white;
    border-radius: 25px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    height: 100%;
}
.product-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 60px rgba(0,0,0,0.15);
}
.product-image-wrapper {
    height: 280px;
    position: relative;
    overflow: hidden;
}
.product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}
.product-card:hover .product-image {
    transform: scale(1.1);
}
.product-overlay {
    position: absolute;
    inset: 0;
    background: rgba(233, 30, 99, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}
.product-card:hover .product-overlay {
    opacity: 1;
}
.btn-quick-view {
    width: 50px;
    height: 50px;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--primary);
    font-size: 1.2rem;
    transition: all 0.3s ease;
    text-decoration: none;
}
.btn-quick-view.green {
    color: #2e7d32;
}
.btn-quick-view:hover {
    transform: scale(1.1);
}
.discount-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: var(--primary);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 700;
}
.hot-badge, .new-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 700;
}
.hot-badge { background: #ff6b35; color: white; }
.new-badge { background: #2e7d32; color: white; }
.product-info {
    padding: 25px;
}
.product-title {
    font-weight: 700;
    color: #1a1a2e;
    margin-bottom: 10px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.product-price {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 15px;
}
.price-sale {
    color: var(--primary);
    font-weight: 800;
    font-size: 1.2rem;
}
.price-sale.green {
    color: #2e7d32;
}
.price-original {
    color: #999;
    text-decoration: line-through;
    font-size: 0.9rem;
}
.btn-product {
    display: block;
    width: 100%;
    background: var(--gradient);
    color: white;
    text-align: center;
    padding: 12px;
    border-radius: 15px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}
.btn-product.green {
    background: linear-gradient(135deg, #4caf50, #2e7d32);
}
.btn-product:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(233, 30, 99, 0.3);
    color: white;
}
.btn-product.green:hover {
    box-shadow: 0 10px 25px rgba(76, 175, 80, 0.3);
}

/* ===== PROMO SECTION ===== */
.promo-section {
    background: url('https://images.unsplash.com/photo-1518882605630-8a6392e87b54?w=1920&h=400&fit=crop') center/cover;
    position: relative;
    padding: 80px 0;
}
.promo-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(233, 30, 99, 0.95), rgba(194, 24, 91, 0.9));
}
.promo-badge {
    display: inline-block;
    background: rgba(255,255,255,0.2);
    color: white;
    padding: 8px 20px;
    border-radius: 50px;
    font-weight: 600;
    margin-bottom: 15px;
}
.promo-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: white;
    margin-bottom: 10px;
}
.promo-text {
    color: rgba(255,255,255,0.8);
    font-size: 1.1rem;
}
.btn-promo {
    background: white;
    color: var(--primary);
    padding: 15px 40px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    text-decoration: none;
}
.btn-promo:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    color: var(--primary);
}

/* ===== FLOWER TYPES ===== */
.section-flower-types {
    background: #f9f9f9;
}
.flower-card {
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
}
.flower-card:hover {
    transform: scale(1.05);
}
.flower-image-wrapper {
    width: 120px;
    height: 120px;
    margin: 0 auto 15px;
    border-radius: 50%;
    overflow: hidden;
    border: 4px solid var(--primary-light);
    transition: all 0.3s ease;
}
.flower-card:hover .flower-image-wrapper {
    border-color: var(--primary);
}
.flower-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.flower-name {
    font-weight: 700;
    color: #1a1a2e;
    margin-bottom: 5px;
}
.flower-desc {
    color: #666;
}

/* ===== SEASONS ===== */
.season-card {
    position: relative;
    height: 300px;
    border-radius: 25px;
    overflow: hidden;
    cursor: pointer;
    transition: all 0.3s ease;
}
.season-card:hover {
    transform: scale(1.03);
}
.season-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.season-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,0.8) 100%);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-end;
    padding: 30px;
}
.season-icon {
    font-size: 2.5rem;
    margin-bottom: 10px;
}
.season-name {
    color: white;
    font-weight: 700;
    margin: 0;
}

/* ===== FEATURES ===== */
.section-features {
    background: var(--gradient-dark);
    padding: 60px 0;
}
.feature-card {
    text-align: center;
    padding: 30px;
    transition: all 0.3s ease;
}
.feature-card:hover {
    transform: translateY(-5px);
}
.feature-icon {
    font-size: 3rem;
    margin-bottom: 15px;
}
.feature-title {
    color: white;
    font-weight: 700;
    margin-bottom: 5px;
}
.feature-text {
    color: rgba(255,255,255,0.6);
    margin: 0;
}

/* ===== REVIEWS ===== */
.section-reviews {
    background: white;
}
.review-card {
    background: #f9f9f9;
    padding: 30px;
    border-radius: 20px;
    height: 100%;
    transition: all 0.3s ease;
}
.review-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.1);
}
.review-header {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}
.review-avatar {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    object-fit: cover;
}
.review-name {
    font-weight: 700;
    color: #1a1a2e;
    margin-bottom: 5px;
}
.review-stars {
    font-size: 0.9rem;
}
.review-content {
    color: #666;
    font-style: italic;
    line-height: 1.7;
    margin: 0;
}

/* ===== CTA ===== */
.cta-section {
    background: url('https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=1920&h=400&fit=crop') center/cover;
    position: relative;
    padding: 100px 0;
}
.cta-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(255, 107, 157, 0.95), rgba(194, 24, 91, 0.9));
}
.cta-title {
    font-size: 3rem;
    font-weight: 800;
    color: white;
    margin-bottom: 15px;
}
.cta-text {
    color: rgba(255,255,255,0.8);
    font-size: 1.2rem;
    margin-bottom: 30px;
}
.btn-cta-primary {
    background: white;
    color: var(--primary);
    padding: 18px 45px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    text-decoration: none;
}
.btn-cta-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    color: var(--primary);
}
.btn-cta-outline {
    background: transparent;
    color: white;
    padding: 18px 45px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 1.1rem;
    border: 2px solid white;
    transition: all 0.3s ease;
    text-decoration: none;
}
.btn-cta-outline:hover {
    background: white;
    color: var(--primary);
}

/* ===== MISC ===== */
.bg-light-pink {
    background: linear-gradient(180deg, #f0fff0 0%, #ffffff 100%);
}

/* ===== RESPONSIVE ===== */
@media (max-width: 992px) {
    .hero-title { font-size: 2.5rem; }
    .hero-main-image { max-width: 350px; height: 400px; }
    .floating-badge { display: none; }
    .section-title { font-size: 2rem; }
    .promo-title { font-size: 1.8rem; }
    .cta-title { font-size: 2rem; }
}
@media (max-width: 768px) {
    .hero-section { min-height: auto; padding: 100px 0 60px; }
    .hero-stats { justify-content: center; }
    .section-header { text-align: center; }
    .product-image-wrapper { height: 200px; }
    .season-card { height: 200px; }
}
</style>