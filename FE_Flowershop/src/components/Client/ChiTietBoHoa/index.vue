<template>
    <div class="product-detail-page py-3 py-lg-4">
        <div class="container">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><router-link to="/" class="text-decoration-none text-muted">Trang chủ</router-link></li>
                    <li class="breadcrumb-item"><router-link to="/danh-muc" class="text-decoration-none text-muted">Sản phẩm</router-link></li>
                    <li class="breadcrumb-item active fw-bold text-danger text-truncate" style="max-width: 250px;">{{ bo_hoa.ten_bo_hoa }}</li>
                </ol>
            </nav>

            <div class="row g-4" v-if="bo_hoa.id">
                <!-- Hình ảnh sản phẩm -->
                <div class="col-lg-5">
                    <div class="card border-0 shadow-sm rounded-4 p-2 p-md-3 bg-white">
                        <!-- Main Image -->
                        <div class="main-image-wrapper mb-3 position-relative">
                            <img :src="currentImage" 
                                class="main-image" 
                                @click="openLightbox(currentImageIndex)"
                                @error="onMainImageError"
                                alt="Hoa tươi">
                            <div class="zoom-hint">
                                <i class="fa fa-search-plus"></i> Chạm để phóng to
                            </div>
                            <div class="position-absolute top-0 start-0 m-3 d-flex flex-column gap-1">
                                <span v-if="bo_hoa.phan_tram_giam" class="app-badge-pill app-badge-discount">-{{ bo_hoa.phan_tram_giam }}%</span>
                                <span v-if="bo_hoa.noi_bat" class="app-badge-pill app-badge-hot">⭐ Bán chạy</span>
                            </div>
                        </div>

                        <!-- Thumbnail Gallery -->
                        <div class="thumbnail-gallery" v-if="allImages.length > 1">
                            <div v-for="(img, index) in allImages" 
                                :key="index" 
                                class="thumbnail-item"
                                :class="{ active: index === currentImageIndex }"
                                @click="currentImageIndex = index">
                                <img :src="img" @error="onThumbError($event)" alt="Thumbnail">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Thông tin sản phẩm & Đặt hàng -->
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm rounded-4 p-3 p-md-4 bg-white h-100">
                        <div class="d-flex flex-wrap gap-2 mb-2">
                            <router-link v-for="dm in allDanhMucs" :key="'dm-' + dm.id" 
                                to="/danh-muc" 
                                class="badge bg-light text-secondary text-decoration-none py-2 px-3 rounded-pill border">
                                📁 {{ dm.ten_danh_muc }}
                            </router-link>
                            <router-link v-for="m in allMuas" :key="'mua-' + m.id" 
                                :to="'/mua/' + m.id" 
                                class="badge bg-success-subtle text-success text-decoration-none py-2 px-3 rounded-pill border border-success-subtle">
                                🍂 Mùa {{ m.ten_mua }}
                            </router-link>
                            <router-link v-for="d in allDips" :key="'dip-' + d.id" 
                                :to="'/dip-le/' + d.id" 
                                class="badge bg-danger-subtle text-danger text-decoration-none py-2 px-3 rounded-pill border border-danger-subtle">
                                🎉 {{ d.ten_dip }}
                            </router-link>
                        </div>

                        <h1 class="product-detail-title fw-bold text-dark mt-2 mb-3">{{ bo_hoa.ten_bo_hoa }}</h1>
                        
                        <!-- Giá sản phẩm -->
                        <div class="price-box p-3 rounded-4 mb-4" style="background: #fff5f8;">
                            <div v-if="bo_hoa.gia_giam" class="d-flex align-items-center flex-wrap gap-2">
                                <span class="fs-1 fw-bold text-danger">{{ formatPrice(bo_hoa.gia_giam) }}đ</span>
                                <span class="fs-5 text-decoration-line-through text-muted">{{ formatPrice(bo_hoa.gia) }}đ</span>
                                <span class="badge bg-danger rounded-pill px-3 py-2 ms-auto">
                                    Tiết kiệm {{ formatPrice(bo_hoa.gia - bo_hoa.gia_giam) }}đ
                                </span>
                            </div>
                            <div v-else>
                                <span class="fs-1 fw-bold text-danger">{{ formatPrice(bo_hoa.gia) }}đ</span>
                            </div>
                            <div class="small text-muted mt-2 d-flex align-items-center gap-2">
                                <i class="fa fa-truck text-success"></i> Miễn phí giao hàng bán kính 5km tại Đà Nẵng
                            </div>
                        </div>

                        <!-- Mô tả sản phẩm -->
                        <div class="mb-4">
                            <h6 class="fw-bold text-uppercase small text-muted mb-2">📝 Chi Tiết Bó Hoa</h6>
                            <p class="text-secondary lh-lg mb-0" style="white-space: pre-line;">{{ bo_hoa.mo_ta || 'Mẫu hoa tươi thiết kế đặc biệt từ tiệm Ni Flower\'s, kết hợp các loại hoa tươi tuyển chọn loại 1, phù hợp cho mọi dịp lễ và ngày kỷ niệm.' }}</p>
                        </div>

                        <!-- Cam kết chất lượng -->
                        <div class="row g-2 mb-4">
                            <div class="col-4">
                                <div class="trust-badge-box text-center p-2 rounded-3 bg-light">
                                    <div class="fs-4 mb-1">🚀</div>
                                    <small class="fw-bold d-block">Giao nhanh 2H</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="trust-badge-box text-center p-2 rounded-3 bg-light">
                                    <div class="fs-4 mb-1">🌹</div>
                                    <small class="fw-bold d-block">Hoa tươi 100%</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="trust-badge-box text-center p-2 rounded-3 bg-light">
                                    <div class="fs-4 mb-1">💌</div>
                                    <small class="fw-bold d-block">Tặng kèm thiệp</small>
                                </div>
                            </div>
                        </div>

                        <!-- Desktop CTA buttons -->
                        <div class="mt-auto pt-3 border-top d-none d-lg-block">
                            <div class="row g-3">
                                <div class="col-6">
                                    <a href="tel:0905999276" class="btn btn-success btn-lg w-100 py-3 fw-bold rounded-pill shadow-sm d-flex align-items-center justify-content-center gap-2">
                                        <i class="fa fa-phone"></i> Gọi Đặt Hoa Ngay
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="https://zalo.me/0905999276" target="_blank" class="btn btn-primary btn-lg w-100 py-3 fw-bold rounded-pill shadow-sm d-flex align-items-center justify-content-center gap-2">
                                        <i class="fa fa-comment-dots"></i> Chat Zalo Tư Vấn
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Loading Spinner -->
            <div v-else class="text-center py-5">
                <div class="spinner-border text-danger" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3 text-muted">Đang tải thông tin mẫu hoa...</p>
            </div>

            <!-- Sản phẩm liên quan (Gợi ý) -->
            <div class="mt-5" v-if="lien_quan.length > 0">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="fw-bold mb-0">🌷 Mẫu Hoa Tương Tự</h4>
                    <router-link to="/danh-muc" class="text-decoration-none small text-danger fw-bold">
                        Xem thêm <i class="fa fa-chevron-right small"></i>
                    </router-link>
                </div>

                <div class="row g-2 g-sm-3 g-lg-4">
                    <div class="col-6 col-md-4 col-lg-3" v-for="item in lien_quan.slice(0, 4)" :key="'rel-' + item.id">
                        <div class="app-product-card" @click="$router.push('/chi-tiet/' + item.id)">
                            <div class="app-product-img-wrapper">
                                <img :src="getImageUrl(item.hinh_anh)" 
                                    class="app-product-img" 
                                    :alt="item.ten_bo_hoa" 
                                    @error="onImageError"
                                    loading="lazy">
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
            </div>
        </div>

        <!-- =========================================================
             MOBILE STICKY BOTTOM ACTION BAR (Native E-Commerce App)
             ========================================================= -->
        <div class="app-detail-sticky-bar" v-if="bo_hoa.id">
            <div class="app-sticky-price">
                <span class="app-sticky-price-label">Giá đặt hoa</span>
                <span class="app-sticky-price-value">{{ formatPrice(bo_hoa.gia_giam || bo_hoa.gia) }}đ</span>
            </div>
            <div class="app-sticky-actions">
                <a href="tel:0905999276" class="app-btn-call">
                    <i class="fa fa-phone"></i> Gọi Đặt
                </a>
                <a href="https://zalo.me/0905999276" target="_blank" class="app-btn-zalo">
                    <i class="fa fa-comment"></i> Zalo
                </a>
            </div>
        </div>

        <!-- =========================================================
             LIGHTBOX MODAL FOR ZOOMING IMAGES
             ========================================================= -->
        <div v-if="lightboxOpen" class="lightbox-overlay" @click="closeLightbox">
            <div class="lightbox-content" @click.stop>
                <button class="lightbox-close" @click="closeLightbox">
                    <i class="fa fa-times"></i>
                </button>
                <button class="lightbox-nav prev" @click="prevImage" v-if="allImages.length > 1">
                    <i class="fa fa-chevron-left"></i>
                </button>
                <button class="lightbox-nav next" @click="nextImage" v-if="allImages.length > 1">
                    <i class="fa fa-chevron-right"></i>
                </button>
                <img :src="allImages[lightboxIndex]" class="lightbox-image" @error="onMainImageError" alt="Hoa tươi">
                <div class="lightbox-counter" v-if="allImages.length > 1">
                    {{ lightboxIndex + 1 }} / {{ allImages.length }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { ipbe } from '@/config/api';

export default {
    data() {
        return {
            bo_hoa: {},
            lien_quan: [],
            currentImageIndex: 0,
            lightboxOpen: false,
            lightboxIndex: 0
        };
    },
    computed: {
        allImages() {
            let images = [];
            if (this.bo_hoa.hinh_anh) {
                images.push(this.getImageUrl(this.bo_hoa.hinh_anh));
            }
            if (this.bo_hoa.hinh_anh_phu) {
                try {
                    const extraImages = JSON.parse(this.bo_hoa.hinh_anh_phu);
                    if (Array.isArray(extraImages)) {
                        extraImages.forEach(img => {
                            if (img) images.push(this.getImageUrl(img));
                        });
                    }
                } catch (e) {
                    if (this.bo_hoa.hinh_anh_phu) {
                        images.push(this.getImageUrl(this.bo_hoa.hinh_anh_phu));
                    }
                }
            }
            if (images.length === 0) {
                images.push('https://images.unsplash.com/photo-1561181286-d3fee7d55364?w=800&h=800&fit=crop');
            }
            return images;
        },
        currentImage() {
            return this.allImages[this.currentImageIndex] || 'https://images.unsplash.com/photo-1561181286-d3fee7d55364?w=800&h=800&fit=crop';
        },
        allDanhMucs() {
            if (this.bo_hoa.danh_mucs && this.bo_hoa.danh_mucs.length > 0) return this.bo_hoa.danh_mucs;
            if (this.bo_hoa.danh_muc) return [this.bo_hoa.danh_muc];
            return [];
        },
        allMuas() {
            if (this.bo_hoa.mua_hoas && this.bo_hoa.mua_hoas.length > 0) return this.bo_hoa.mua_hoas;
            if (this.bo_hoa.mua_hoa) return [this.bo_hoa.mua_hoa];
            return [];
        },
        allDips() {
            if (this.bo_hoa.dip_les && this.bo_hoa.dip_les.length > 0) return this.bo_hoa.dip_les;
            if (this.bo_hoa.dip_le) return [this.bo_hoa.dip_le];
            return [];
        }
    },
    methods: {
        loadData() {
            const id = this.$route.params.id;
            axios.get(ipbe + '/api/client/bo-hoa/' + id)
                .then((res) => {
                    if (res.data.status) {
                        this.bo_hoa = res.data.data;
                        this.lien_quan = res.data.lien_quan || [];
                        this.currentImageIndex = 0;
                    }
                })
                .catch(() => {
                    this.bo_hoa = {};
                });
        },
        formatPrice(price) {
            return new Intl.NumberFormat('vi-VN').format(price);
        },
        getImageUrl(path) {
            if (!path) return 'https://images.unsplash.com/photo-1561181286-d3fee7d55364?w=800&h=800&fit=crop';
            if (path.startsWith('http')) return path;
            return ipbe + '' + path;
        },
        onMainImageError(e) {
            e.target.src = 'https://images.unsplash.com/photo-1561181286-d3fee7d55364?w=800&h=800&fit=crop';
        },
        onThumbError(e) {
            e.target.src = 'https://images.unsplash.com/photo-1561181286-d3fee7d55364?w=200&h=200&fit=crop';
        },
        onImageError(e) {
            e.target.src = 'https://images.unsplash.com/photo-1561181286-d3fee7d55364?w=500&h=500&fit=crop';
        },
        openLightbox(index) {
            this.lightboxIndex = index;
            this.lightboxOpen = true;
            document.body.style.overflow = 'hidden';
        },
        closeLightbox() {
            this.lightboxOpen = false;
            document.body.style.overflow = '';
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
    },
    watch: {
        '$route.params.id'() {
            this.loadData();
        }
    }
};
</script>

<style scoped>
.product-detail-title {
    font-size: 1.85rem;
    line-height: 1.25;
}

@media (max-width: 768px) {
    .product-detail-title {
        font-size: 1.35rem;
    }
}

.main-image-wrapper {
    width: 100%;
    aspect-ratio: 1 / 1;
    border-radius: 20px;
    overflow: hidden;
    background: #fdfdfd;
    cursor: zoom-in;
}

.main-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.main-image-wrapper:hover .main-image {
    transform: scale(1.04);
}

.zoom-hint {
    position: absolute;
    bottom: 12px;
    right: 12px;
    background: rgba(0, 0, 0, 0.65);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.thumbnail-gallery {
    display: flex;
    gap: 8px;
    overflow-x: auto;
    padding-bottom: 4px;
}

.thumbnail-item {
    width: 64px;
    height: 64px;
    border-radius: 12px;
    overflow: hidden;
    cursor: pointer;
    border: 2px solid transparent;
    opacity: 0.6;
    transition: all 0.2s ease;
    flex-shrink: 0;
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

.trust-badge-box {
    border: 1px solid #f0f0f0;
}

/* Lightbox Modal */
.lightbox-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.9);
    backdrop-filter: blur(8px);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px;
}

.lightbox-content {
    position: relative;
    max-width: 90vw;
    max-height: 90vh;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.lightbox-image {
    max-width: 100%;
    max-height: 80vh;
    object-fit: contain;
    border-radius: 16px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
}

.lightbox-close {
    position: absolute;
    top: -45px;
    right: 0;
    background: white;
    border: none;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
    cursor: pointer;
}

.lightbox-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.25);
    border: none;
    color: white;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    font-size: 1.2rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(4px);
}

.lightbox-nav.prev { left: -50px; }
.lightbox-nav.next { right: -50px; }

@media (max-width: 768px) {
    .lightbox-nav.prev { left: 10px; }
    .lightbox-nav.next { right: 10px; }
}

.lightbox-counter {
    color: white;
    margin-top: 10px;
    font-size: 0.9rem;
}
</style>
