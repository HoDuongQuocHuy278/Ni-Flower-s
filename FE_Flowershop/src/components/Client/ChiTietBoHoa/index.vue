<template>
    <div>
        <div class="container my-5">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/">Trang chủ</router-link></li>
                    <li class="breadcrumb-item"><router-link to="/danh-muc">Sản phẩm</router-link></li>
                    <li class="breadcrumb-item active">{{ bo_hoa.ten_bo_hoa }}</li>
                </ol>
            </nav>

            <div class="row" v-if="bo_hoa.id">
                <!-- Hình ảnh -->
                <div class="col-md-5 mb-4">
                    <!-- Main Image -->
                    <div class="main-image-wrapper mb-3">
                        <img :src="currentImage" 
                            class="main-image" 
                            @click="openLightbox(currentImageIndex)"
                            alt="Hoa">
                        <div class="zoom-hint">
                            <i class="fa fa-search-plus"></i> Click để phóng to
                        </div>
                        <div class="position-absolute top-0 start-0 m-3">
                            <span v-if="bo_hoa.phan_tram_giam" class="badge bg-danger fs-6">-{{ bo_hoa.phan_tram_giam }}%</span>
                            <span v-if="bo_hoa.noi_bat" class="badge bg-warning fs-6 ms-1">⭐ Nổi bật</span>
                        </div>
                    </div>

                    <!-- Thumbnail Gallery -->
                    <div class="thumbnail-gallery">
                        <div v-for="(img, index) in allImages" 
                            :key="index" 
                            class="thumbnail-item"
                            :class="{ active: index === currentImageIndex }"
                            @click="currentImageIndex = index">
                            <img :src="img" alt="Thumbnail">
                        </div>
                    </div>
                </div>

                <!-- Thông tin -->
                <div class="col-md-7">
                    <h2 class="fw-bold text-danger mb-3">{{ bo_hoa.ten_bo_hoa }}</h2>
                    
                    <!-- Giá -->
                    <div class="mb-4">
                        <div v-if="bo_hoa.gia_giam" class="d-flex align-items-center flex-wrap">
                            <span class="fs-2 fw-bold text-danger me-3">{{ formatPrice(bo_hoa.gia_giam) }}đ</span>
                            <span class="fs-5 text-decoration-line-through text-muted">{{ formatPrice(bo_hoa.gia) }}đ</span>
                            <span class="badge bg-danger ms-2">Tiết kiệm {{ formatPrice(bo_hoa.gia - bo_hoa.gia_giam) }}đ</span>
                        </div>
                        <div v-else>
                            <span class="fs-2 fw-bold text-danger">{{ formatPrice(bo_hoa.gia) }}đ</span>
                        </div>
                    </div>

                    <!-- Phân loại -->
                    <div class="mb-4">
                        <span v-if="bo_hoa.danh_muc" class="badge bg-secondary me-2">📁 {{ bo_hoa.danh_muc.ten_danh_muc }}</span>
                        <span v-if="bo_hoa.mua_hoa" class="badge bg-success me-2">🍂 {{ bo_hoa.mua_hoa.ten_mua }}</span>
                        <span v-if="bo_hoa.dip_le" class="badge bg-info me-2">🎉 {{ bo_hoa.dip_le.ten_dip }}</span>
                    </div>

                    <!-- Mô tả -->
                    <div class="mb-4">
                        <h5 class="fw-bold">📝 Mô Tả</h5>
                        <p class="text-muted">{{ bo_hoa.mo_ta || 'Chưa có mô tả' }}</p>
                    </div>

                    <!-- Liên hệ đặt hàng -->
                    <div class="card bg-light border-0 mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold text-success mb-3">📞 LIÊN HỆ ĐẶT HÀNG</h5>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <a href="tel:0905999276" class="btn btn-success btn-lg w-100">
                                        <i class="fa fa-phone"></i> 0905 999 276
                                    </a>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <a href="https://zalo.me/0905999276" target="_blank" class="btn btn-primary btn-lg w-100">
                                        <i class="fa fa-comment"></i> Zalo
                                    </a>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <a href="https://www.facebook.com/profile.php?id=100095340766977" target="_blank" class="btn btn-info btn-lg w-100">
                                        <i class="fab fa-facebook"></i> Facebook
                                    </a>
                                </div>
                            </div>
                            <p class="text-muted small mb-0 mt-2">
                                <i class="fa fa-info-circle"></i> Liên hệ trực tiếp để được tư vấn và đặt hàng nhanh nhất
                            </p>
                        </div>
                    </div>

                    <!-- Thông tin thêm -->
                    <div class="d-flex flex-wrap gap-3">
                        <div class="d-flex align-items-center">
                            <i class="fa fa-truck text-success fs-4 me-2"></i>
                            <small>Giao hàng nhanh</small>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fa fa-leaf text-success fs-4 me-2"></i>
                            <small>Hoa tươi 100%</small>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fa fa-shield text-success fs-4 me-2"></i>
                            <small>Cam kết chất lượng</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Loading -->
            <div v-else class="text-center py-5">
                <div class="spinner-border text-danger" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3 text-muted">Đang tải thông tin...</p>
            </div>

            <!-- Sản phẩm liên quan -->
            <div class="mt-5" v-if="lien_quan.length > 0">
                <h4 class="text-center mb-4">🌷 SẢN PHẨM LIÊN QUAN</h4>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-6 mb-4" v-for="item in lien_quan" :key="item.id">
                        <div class="card h-100 product-card shadow-sm">
                            <div class="position-relative">
                                <img :src="getImageUrl(item.hinh_anh)" class="card-img-top" style="height: 200px; object-fit: cover;">
                                <span v-if="item.phan_tram_giam" class="badge bg-danger position-absolute top-0 end-0 m-2">-{{ item.phan_tram_giam }}%</span>
                            </div>
                            <div class="card-body">
                                <h6 class="card-title text-truncate">{{ item.ten_bo_hoa }}</h6>
                                <div class="d-flex align-items-center mb-2">
                                    <span v-if="item.gia_giam" class="text-danger fw-bold me-2">{{ formatPrice(item.gia_giam) }}đ</span>
                                    <span :class="item.gia_giam ? 'text-decoration-line-through text-muted small' : 'text-danger fw-bold'">{{ formatPrice(item.gia) }}đ</span>
                                </div>
                                <router-link :to="'/chi-tiet/' + item.id" class="btn btn-outline-danger btn-sm w-100">Xem Chi Tiết</router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lightbox Modal -->
        <div v-if="lightboxOpen" class="lightbox-overlay" @click="closeLightbox">
            <div class="lightbox-content" @click.stop>
                <!-- Close Button -->
                <button class="lightbox-close" @click="closeLightbox">
                    <i class="fa fa-times"></i>
                </button>

                <!-- Navigation Arrows -->
                <button class="lightbox-nav prev" @click="prevImage" v-if="allImages.length > 1">
                    <i class="fa fa-chevron-left"></i>
                </button>
                <button class="lightbox-nav next" @click="nextImage" v-if="allImages.length > 1">
                    <i class="fa fa-chevron-right"></i>
                </button>

                <!-- Main Image -->
                <img :src="allImages[lightboxIndex]" class="lightbox-image" alt="Hoa">

                <!-- Image Counter -->
                <div class="lightbox-counter" v-if="allImages.length > 1">
                    {{ lightboxIndex + 1 }} / {{ allImages.length }}
                </div>

                <!-- Thumbnail Strip -->
                <div class="lightbox-thumbnails" v-if="allImages.length > 1">
                    <div v-for="(img, index) in allImages" 
                        :key="index" 
                        class="lightbox-thumb"
                        :class="{ active: index === lightboxIndex }"
                        @click="lightboxIndex = index">
                        <img :src="img" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import { ref } from 'vue';
    import axios from 'axios';
export default {
    data() {
        return {
            bo_hoa: {},
            lien_quan: [],
            currentImageIndex: 0,
            lightboxOpen: false,
            lightboxIndex: 0
        }
    },
    computed: {
        allImages() {
            let images = [];
            // Main image
            if (this.bo_hoa.hinh_anh) {
                images.push(this.getImageUrl(this.bo_hoa.hinh_anh));
            }
            // Additional images from hinh_anh_phu (if exists)
            if (this.bo_hoa.hinh_anh_phu) {
                try {
                    const extraImages = JSON.parse(this.bo_hoa.hinh_anh_phu);
                    if (Array.isArray(extraImages)) {
                        extraImages.forEach(img => {
                            if (img) images.push(this.getImageUrl(img));
                        });
                    }
                } catch (e) {
                    // If not JSON, treat as single image
                    if (this.bo_hoa.hinh_anh_phu) {
                        images.push(this.getImageUrl(this.bo_hoa.hinh_anh_phu));
                    }
                }
            }
            // Nếu không có ảnh nào, dùng placeholder
            if (images.length === 0) {
                images.push(this.getImageUrl(null));
            }
            return images;
        },
        currentImage() {
            return this.allImages[this.currentImageIndex] || '';
        }
    },
    methods: {
        loadData() {
            const id = this.$route.params.id;
            axios.get('http://localhost:8000/api/client/bo-hoa/' + id)
                .then((res) => {
                    if (res.data.status) {
                        this.bo_hoa = res.data.data;
                        this.lien_quan = res.data.lien_quan || [];
                        this.currentImageIndex = 0;
                    }
                });
        },
        formatPrice(price) {
            return new Intl.NumberFormat('vi-VN').format(price);
        },
        getImageUrl(path) {
            if (!path) return 'https://images.unsplash.com/photo-1518882605630-8a6392e87b54?w=1200&h=1200&fit=crop&q=100';
            if (path.startsWith('http')) return path;
            return 'http://localhost:8000' + path;
        },
        openLightbox(index) {
            this.lightboxIndex = index;
            this.lightboxOpen = true;
            document.body.style.overflow = 'hidden';
        },
        closeLightbox() {
            this.lightboxOpen = false;
            document.body.style.overflow = 'auto';
        },
        nextImage() {
            this.lightboxIndex = (this.lightboxIndex + 1) % this.allImages.length;
        },
        prevImage() {
            this.lightboxIndex = (this.lightboxIndex - 1 + this.allImages.length) % this.allImages.length;
        }
    },
    mounted() {
        this.loadData();
        // Keyboard navigation for lightbox
        document.addEventListener('keydown', (e) => {
            if (!this.lightboxOpen) return;
            if (e.key === 'Escape') this.closeLightbox();
            if (e.key === 'ArrowRight') this.nextImage();
            if (e.key === 'ArrowLeft') this.prevImage();
        });
    },
    watch: {
        '$route.params.id'() {
            this.loadData();
        }
    }
}
</script>
<style>
    .product-card {
        transition: all 0.3s;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    /* Image Quality Optimization */
    img {
        image-rendering: -webkit-optimize-contrast;
        image-rendering: crisp-edges;
        -ms-interpolation-mode: bicubic;
    }

    /* Main Image Wrapper */
    .main-image-wrapper {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        cursor: zoom-in;
    }
    .main-image {
        width: 100%;
        height: 500px;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .main-image-wrapper:hover .main-image {
        transform: scale(1.05);
    }
    .zoom-hint {
        position: absolute;
        bottom: 15px;
        right: 15px;
        background: rgba(0,0,0,0.7);
        color: white;
        padding: 8px 15px;
        border-radius: 25px;
        font-size: 0.85rem;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .main-image-wrapper:hover .zoom-hint {
        opacity: 1;
    }

    /* Thumbnail Gallery */
    .thumbnail-gallery {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    .thumbnail-item {
        width: 80px;
        height: 80px;
        border-radius: 12px;
        overflow: hidden;
        cursor: pointer;
        border: 3px solid transparent;
        transition: all 0.3s ease;
        opacity: 0.6;
    }
    .thumbnail-item:hover,
    .thumbnail-item.active {
        border-color: #e91e63;
        opacity: 1;
        transform: scale(1.05);
    }
    .thumbnail-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Lightbox */
    .lightbox-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.85);
        backdrop-filter: blur(10px);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: fadeIn 0.3s ease;
        padding: 30px;
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    .lightbox-content {
        position: relative;
        width: 900px;
        max-width: 95vw;
        background: linear-gradient(145deg, #2d2d3a, #1f1f2a);
        border-radius: 25px;
        padding: 25px;
        display: flex;
        flex-direction: column;
        align-items: center;
        box-shadow: 0 30px 80px rgba(0,0,0,0.5), 
                    inset 0 1px 0 rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.1);
    }
    .lightbox-image {
        width: 100%;
        height: 700px;
        object-fit: contain;
        border-radius: 20px;
        background: linear-gradient(145deg, #1a1a24, #16161e);
        animation: zoomIn 0.3s ease;
        padding: 10px;
    }
    @keyframes zoomIn {
        from { transform: scale(0.9); opacity: 0; }
        to { transform: scale(1); opacity: 1; }
    }
    .lightbox-close {
        position: absolute;
        top: 20px;
        right: 20px;
        background: linear-gradient(135deg, #ff6b9d, #e91e63);
        border: none;
        color: white;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        font-size: 1.2rem;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 10;
        box-shadow: 0 5px 20px rgba(233, 30, 99, 0.4);
    }
    .lightbox-close:hover {
        transform: scale(1.1) rotate(90deg);
        box-shadow: 0 8px 25px rgba(233, 30, 99, 0.6);
    }
    .lightbox-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: linear-gradient(135deg, rgba(255,255,255,0.2), rgba(255,255,255,0.1));
        border: 1px solid rgba(255,255,255,0.2);
        color: white;
        width: 55px;
        height: 55px;
        border-radius: 50%;
        font-size: 1.4rem;
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 10;
        backdrop-filter: blur(5px);
    }
    .lightbox-nav:hover {
        background: linear-gradient(135deg, #ff6b9d, #e91e63);
        border-color: transparent;
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 5px 20px rgba(233, 30, 99, 0.4);
    }
    .lightbox-nav.prev { left: 30px; }
    .lightbox-nav.next { right: 30px; }
    .lightbox-counter {
        color: rgba(255,255,255,0.8);
        margin-top: 20px;
        font-size: 1rem;
        background: rgba(255,255,255,0.1);
        padding: 8px 20px;
        border-radius: 20px;
    }
    .lightbox-thumbnails {
        display: flex;
        gap: 12px;
        margin-top: 20px;
        flex-wrap: wrap;
        justify-content: center;
    }
    .lightbox-thumb {
        width: 70px;
        height: 70px;
        border-radius: 12px;
        overflow: hidden;
        cursor: pointer;
        border: 3px solid transparent;
        opacity: 0.5;
        transition: all 0.3s ease;
    }
    .lightbox-thumb:hover,
    .lightbox-thumb.active {
        border-color: #e91e63;
        opacity: 1;
        transform: scale(1.1);
        box-shadow: 0 5px 15px rgba(233, 30, 99, 0.3);
    }
    .lightbox-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .main-image { height: 350px; }
        .thumbnail-item { width: 60px; height: 60px; }
        .lightbox-image { height: 400px; }
        .lightbox-nav { width: 45px; height: 45px; font-size: 1.1rem; }
        .lightbox-nav.prev { left: 15px; }
        .lightbox-nav.next { right: 15px; }
    }
</style>
