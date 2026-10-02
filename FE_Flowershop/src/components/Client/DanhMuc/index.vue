<template>
    <div class="category-page py-3 py-lg-4">
        <div class="container">
            <!-- Breadcrumb Navigation -->
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><router-link to="/" class="text-decoration-none text-muted">Trang chủ</router-link></li>
                    <li class="breadcrumb-item active fw-bold text-danger">{{ getTitle() }}</li>
                </ol>
            </nav>

            <!-- Search & Mobile Quick Filter Action Bar -->
            <div class="card border-0 shadow-sm rounded-4 mb-3 p-2 p-md-3 bg-white">
                <div class="row g-2 align-items-center">
                    <!-- Search Input -->
                    <div class="col-12 col-md-6 col-lg-7">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0 ps-3">
                                <i class="fa fa-search text-muted"></i>
                            </span>
                            <input type="text" 
                                class="form-control bg-light border-0 py-2" 
                                placeholder="Tìm mẫu hoa theo tên..." 
                                v-model="searchQuery">
                            <button v-if="searchQuery" class="btn btn-light border-0 text-muted" @click="searchQuery = ''">
                                <i class="fa fa-times-circle"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Filter Triggers (Mobile Filter Sheet Button + Reset) -->
                    <div class="col-12 col-md-6 col-lg-5 d-flex gap-2 justify-content-md-end">
                        <!-- Mobile Filter Button (Opens Bottom Sheet) -->
                        <button class="btn btn-outline-danger d-md-none flex-grow-1 rounded-pill py-2 font-weight-bold" 
                            @click="showMobileFilter = true">
                            <i class="fa fa-filter me-1"></i> Bộ Lọc 
                            <span v-if="activeFilterCount > 0" class="badge bg-danger ms-1">{{ activeFilterCount }}</span>
                        </button>

                        <!-- Reset Filter -->
                        <button v-if="hasActiveFilter" class="btn btn-light rounded-pill px-3 py-2 text-danger small fw-bold" @click="resetFilter">
                            <i class="fa fa-redo-alt me-1"></i> Đặt lại
                        </button>
                    </div>
                </div>

                <!-- App-style Quick Filter Chips (Horizontal swipe on mobile) -->
                <div class="app-scroll-chips mt-3 pt-2 border-top">
                    <button class="app-chip" :class="{ active: !filter.id_danh_muc && !filter.id_mua && !filter.id_dip_le }" @click="resetFilter">
                        <span>💐</span> Tất cả
                    </button>
                    <!-- Mùa -->
                    <button v-for="mua in mua_hoas" :key="'mua-' + mua.id" 
                        class="app-chip" 
                        :class="{ active: filter.id_mua == mua.id }"
                        @click="selectFilter('id_mua', mua.id)">
                        <span>{{ getMuaIcon(mua.ten_mua) }}</span> {{ mua.ten_mua }}
                    </button>
                    <!-- Dịp -->
                    <button v-for="dip in dip_les" :key="'dip-' + dip.id" 
                        class="app-chip" 
                        :class="{ active: filter.id_dip_le == dip.id }"
                        @click="selectFilter('id_dip_le', dip.id)">
                        <span>{{ getDipIcon(dip.ten_dip) }}</span> {{ dip.ten_dip }}
                    </button>
                </div>
            </div>

            <div class="row g-4">
                <!-- Desktop Sidebar Filter (Hidden on Mobile) -->
                <div class="col-md-4 col-lg-3 d-none d-md-block">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden sticky-top" style="top: 80px; z-index: 10;">
                        <div class="card-header bg-gradient-danger text-white py-3 px-3 d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #c2185b, #e91e63);">
                            <span class="fw-bold"><i class="fa fa-filter me-2"></i>Bộ Lọc Sản Phẩm</span>
                            <span v-if="hasActiveFilter" class="badge bg-white text-danger cursor-pointer" @click="resetFilter">Đặt lại</span>
                        </div>
                        <div class="card-body p-0">
                            <!-- Danh Mục Filter -->
                            <div class="filter-group">
                                <div class="filter-group-header" @click="toggleSection('danhMuc')">
                                    <span>📁 Danh Mục</span>
                                    <i class="fa" :class="openSections.danhMuc ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                                </div>
                                <div class="filter-group-body" v-show="openSections.danhMuc">
                                    <a href="#" class="filter-link" :class="{ active: !filter.id_danh_muc }" @click.prevent="filter.id_danh_muc = ''; loadData()">
                                        Tất cả danh mục
                                    </a>
                                    <a href="#" v-for="dm in danh_mucs" :key="dm.id" class="filter-link" :class="{ active: filter.id_danh_muc == dm.id }" @click.prevent="filter.id_danh_muc = dm.id; loadData()">
                                        {{ dm.ten_danh_muc }}
                                    </a>
                                </div>
                            </div>

                            <!-- Mùa Filter -->
                            <div class="filter-group">
                                <div class="filter-group-header" @click="toggleSection('mua')">
                                    <span>🍂 Theo Mùa</span>
                                    <i class="fa" :class="openSections.mua ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                                </div>
                                <div class="filter-group-body" v-show="openSections.mua">
                                    <div class="d-flex flex-wrap gap-2">
                                        <button v-for="mua in mua_hoas" :key="mua.id" 
                                            class="btn btn-sm rounded-pill" 
                                            :class="filter.id_mua == mua.id ? 'btn-success' : 'btn-outline-success'" 
                                            @click="filter.id_mua = filter.id_mua == mua.id ? '' : mua.id; loadData()">
                                            {{ getMuaIcon(mua.ten_mua) }} {{ mua.ten_mua }}
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Dịp Lễ Filter -->
                            <div class="filter-group">
                                <div class="filter-group-header" @click="toggleSection('dip')">
                                    <span>🎉 Theo Dịp Lễ</span>
                                    <i class="fa" :class="openSections.dip ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                                </div>
                                <div class="filter-group-body" v-show="openSections.dip">
                                    <div class="d-flex flex-wrap gap-2">
                                        <button v-for="dip in dip_les" :key="dip.id" 
                                            class="btn btn-sm rounded-pill" 
                                            :class="filter.id_dip_le == dip.id ? 'btn-danger' : 'btn-outline-danger'" 
                                            @click="filter.id_dip_le = filter.id_dip_le == dip.id ? '' : dip.id; loadData()">
                                            {{ getDipIcon(dip.ten_dip) }} {{ dip.ten_dip }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Grid (2 columns on mobile, 3 columns on tablet/desktop) -->
                <div class="col-12 col-md-8 col-lg-9">
                    <!-- Results Header -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold mb-0 text-dark">
                            🌸 {{ getTitle() }}
                        </h5>
                        <span class="badge bg-light text-secondary border px-3 py-2 rounded-pill">
                            {{ filteredList.length }} mẫu hoa
                        </span>
                    </div>

                    <!-- Products Grid -->
                    <div class="row g-2 g-sm-3 g-lg-3">
                        <template v-for="item in filteredList" :key="item.id">
                            <div class="col-6 col-lg-4">
                                <div class="app-product-card" @click="$router.push('/chi-tiet/' + item.id)">
                                    <div class="app-product-img-wrapper">
                                        <img :src="getImageUrl(item.hinh_anh)" 
                                            class="app-product-img" 
                                            :alt="item.ten_bo_hoa" 
                                            @error="onImageError"
                                            loading="lazy">
                                        <div class="app-product-badge-group">
                                            <span v-if="item.noi_bat" class="app-badge-pill app-badge-hot">⭐ Nổi bật</span>
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
                        </template>

                        <!-- Empty Search/Filter State -->
                        <div v-if="filteredList.length === 0" class="col-12 text-center py-5">
                            <div class="py-4">
                                <span class="fs-1">🌸</span>
                                <h6 class="fw-bold mt-3 text-secondary">Không tìm thấy mẫu hoa nào phù hợp</h6>
                                <p class="text-muted small">Thử xóa bộ lọc hoặc tìm kiếm với từ khóa khác bạn nhé!</p>
                                <button class="btn btn-outline-danger btn-sm rounded-pill px-4 mt-2" @click="resetFilter">
                                    <i class="fa fa-redo-alt me-1"></i> Xem tất cả mẫu hoa
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- =========================================================
             MOBILE APP BOTTOM SHEET FILTER (Hiển thị khi nhấn Lọc trên Mobile)
             ========================================================= -->
        <transition name="sheet-fade">
            <div v-if="showMobileFilter" class="app-sheet-backdrop" @click="showMobileFilter = false"></div>
        </transition>

        <transition name="sheet-slide">
            <div v-if="showMobileFilter" class="app-bottom-sheet">
                <div class="app-sheet-handle"></div>
                <div class="app-sheet-header">
                    <h5 class="app-sheet-title">Bộ Lọc Sản Phẩm</h5>
                    <button class="btn btn-sm btn-light rounded-circle" @click="showMobileFilter = false">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="app-sheet-body">
                    <!-- Danh mục -->
                    <div class="mb-4">
                        <h6 class="fw-bold small text-muted text-uppercase mb-2">📁 Danh Mục Hoa</h6>
                        <div class="d-flex flex-wrap gap-2">
                            <button class="btn btn-sm rounded-pill" 
                                :class="!filter.id_danh_muc ? 'btn-danger' : 'btn-outline-secondary'"
                                @click="filter.id_danh_muc = ''">
                                Tất cả
                            </button>
                            <button v-for="dm in danh_mucs" :key="'m-dm-' + dm.id"
                                class="btn btn-sm rounded-pill"
                                :class="filter.id_danh_muc == dm.id ? 'btn-danger' : 'btn-outline-secondary'"
                                @click="filter.id_danh_muc = dm.id">
                                {{ dm.ten_danh_muc }}
                            </button>
                        </div>
                    </div>

                    <!-- Mùa -->
                    <div class="mb-4">
                        <h6 class="fw-bold small text-muted text-uppercase mb-2">🍂 Hoa Theo Mùa</h6>
                        <div class="d-flex flex-wrap gap-2">
                            <button v-for="mua in mua_hoas" :key="'m-mua-' + mua.id"
                                class="btn btn-sm rounded-pill"
                                :class="filter.id_mua == mua.id ? 'btn-success' : 'btn-outline-secondary'"
                                @click="filter.id_mua = filter.id_mua == mua.id ? '' : mua.id">
                                {{ getMuaIcon(mua.ten_mua) }} {{ mua.ten_mua }}
                            </button>
                        </div>
                    </div>

                    <!-- Dịp -->
                    <div class="mb-3">
                        <h6 class="fw-bold small text-muted text-uppercase mb-2">🎉 Hoa Theo Dịp</h6>
                        <div class="d-flex flex-wrap gap-2">
                            <button v-for="dip in dip_les" :key="'m-dip-' + dip.id"
                                class="btn btn-sm rounded-pill"
                                :class="filter.id_dip_le == dip.id ? 'btn-danger' : 'btn-outline-secondary'"
                                @click="filter.id_dip_le = filter.id_dip_le == dip.id ? '' : dip.id">
                                {{ getDipIcon(dip.ten_dip) }} {{ dip.ten_dip }}
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-sheet-footer">
                    <button class="btn btn-light flex-grow-1 rounded-pill py-2" @click="resetFilter">
                        Đặt Lại
                    </button>
                    <button class="btn btn-danger flex-grow-1 rounded-pill py-2 fw-bold" @click="applyMobileFilter">
                        Áp Dụng
                    </button>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
import axios from 'axios';
import { ipbe } from '@/config/api';

export default {
    data() {
        return {
            list_data: [],
            danh_mucs: [],
            mua_hoas: [],
            dip_les: [],
            searchQuery: '',
            showMobileFilter: false,
            filter: {
                id_danh_muc: '',
                id_mua: '',
                id_dip_le: ''
            },
            openSections: {
                danhMuc: true,
                mua: true,
                dip: true
            }
        };
    },
    computed: {
        filteredList() {
            if (!this.searchQuery.trim()) {
                return this.list_data;
            }
            const q = this.searchQuery.toLowerCase().trim();
            return this.list_data.filter(item => 
                (item.ten_bo_hoa && item.ten_bo_hoa.toLowerCase().includes(q)) ||
                (item.mo_ta && item.mo_ta.toLowerCase().includes(q))
            );
        },
        hasActiveFilter() {
            return this.filter.id_danh_muc || this.filter.id_mua || this.filter.id_dip_le || this.searchQuery;
        },
        activeFilterCount() {
            let count = 0;
            if (this.filter.id_danh_muc) count++;
            if (this.filter.id_mua) count++;
            if (this.filter.id_dip_le) count++;
            return count;
        }
    },
    methods: {
        toggleSection(section) {
            this.openSections[section] = !this.openSections[section];
        },
        selectFilter(key, id) {
            this.filter[key] = this.filter[key] == id ? '' : id;
            this.loadData();
        },
        applyMobileFilter() {
            this.showMobileFilter = false;
            this.loadData();
        },
        loadData() {
            let params = {};
            if (this.filter.id_danh_muc) params.id_danh_muc = this.filter.id_danh_muc;
            if (this.filter.id_mua) params.id_mua = this.filter.id_mua;
            if (this.filter.id_dip_le) params.id_dip_le = this.filter.id_dip_le;

            axios.get(ipbe + '/api/client/bo-hoa', { params })
                .then((res) => {
                    if (res.data.status) {
                        this.list_data = res.data.data || [];
                    }
                })
                .catch(() => {
                    this.list_data = [];
                });
        },
        loadFilters() {
            axios.get(ipbe + '/api/client/danh-muc').then((res) => {
                if (res.data.status) this.danh_mucs = res.data.data;
            });
            axios.get(ipbe + '/api/client/mua-hoa').then((res) => {
                if (res.data.status) this.mua_hoas = res.data.data;
            });
            axios.get(ipbe + '/api/client/dip-le').then((res) => {
                if (res.data.status) this.dip_les = res.data.data;
            });
        },
        resetFilter() {
            this.filter = { id_danh_muc: '', id_mua: '', id_dip_le: '' };
            this.searchQuery = '';
            this.showMobileFilter = false;
            this.loadData();
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
        },
        getTitle() {
            if (this.filter.id_mua) {
                const mua = this.mua_hoas.find(m => m.id == this.filter.id_mua);
                return mua ? `Hoa ${mua.ten_mua}` : 'Sản Phẩm Theo Mùa';
            }
            if (this.filter.id_dip_le) {
                const dip = this.dip_les.find(d => d.id == this.filter.id_dip_le);
                return dip ? `Hoa ${dip.ten_dip}` : 'Sản Phẩm Theo Dịp';
            }
            if (this.filter.id_danh_muc) {
                const dm = this.danh_mucs.find(d => d.id == this.filter.id_danh_muc);
                return dm ? dm.ten_danh_muc : 'Danh Mục Hoa';
            }
            return 'Tất Cả Mẫu Hoa Tươi';
        },
        getMuaIcon(tenMua) {
            const icons = { 'Xuân': '🌸', 'Hạ': '☀️', 'Thu': '🍂', 'Đông': '❄️' };
            return icons[tenMua] || '🌺';
        },
        getDipIcon(tenDip) {
            const icons = { 'Tình cảm': '💕', 'Đám cưới': '💒', 'Đám tang': '🕯️', 'Nhà mới': '🏠', 'Sinh nhật': '🎂' };
            return icons[tenDip] || '🌷';
        }
    },
    mounted() {
        if (this.$route.query.q) {
            this.searchQuery = this.$route.query.q;
        }
        if (this.$route.params.id && this.$route.path.includes('/mua/')) {
            this.filter.id_mua = this.$route.params.id;
        }
        if (this.$route.params.id && this.$route.path.includes('/dip-le/')) {
            this.filter.id_dip_le = this.$route.params.id;
        }
        this.loadFilters();
        this.loadData();
    },
    watch: {
        '$route'(to) {
            if (to.query.q) {
                this.searchQuery = to.query.q;
            }
            if (to.params.id && to.path.includes('/mua/')) {
                this.filter = { id_danh_muc: '', id_mua: to.params.id, id_dip_le: '' };
            } else if (to.params.id && to.path.includes('/dip-le/')) {
                this.filter = { id_danh_muc: '', id_mua: '', id_dip_le: to.params.id };
            }
            this.loadData();
        }
    }
};
</script>

<style scoped>
.filter-group {
    border-bottom: 1px solid #f0f0f0;
}

.filter-group:last-child {
    border-bottom: none;
}

.filter-group-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 18px;
    cursor: pointer;
    font-weight: 700;
    font-size: 0.92rem;
    background: #fafafa;
    transition: background 0.2s;
}

.filter-group-header:hover {
    background: #f0f0f0;
}

.filter-group-body {
    padding: 14px 18px;
    background: #ffffff;
}

.filter-link {
    display: block;
    padding: 8px 12px;
    color: #444;
    text-decoration: none;
    border-radius: 10px;
    font-size: 0.88rem;
    font-weight: 500;
    margin-bottom: 4px;
    transition: all 0.2s;
}

.filter-link:hover {
    background: #fff0f5;
    color: #e91e63;
}

.filter-link.active {
    background: #e91e63;
    color: white;
    font-weight: 700;
}

.cursor-pointer {
    cursor: pointer;
}
</style>
