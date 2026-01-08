<template>
    <div>
        <div class="container my-5">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><router-link to="/">Trang chủ</router-link></li>
                    <li class="breadcrumb-item active">Danh mục sản phẩm</li>
                </ol>
            </nav>

            <div class="row">
                <!-- Sidebar Filter -->
                <div class="col-md-3">
                    <div class="card mb-4 filter-card">
                        <div class="card-header bg-danger text-white">
                            <i class="fa fa-filter"></i> Lọc Sản Phẩm
                        </div>
                        <div class="card-body p-0">
                            <!-- Danh mục - Collapsible -->
                            <div class="filter-section">
                                <div class="filter-header" @click="toggleSection('danhMuc')">
                                    <span>📁 Danh Mục</span>
                                    <i class="fa" :class="openSections.danhMuc ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                                </div>
                                <div class="filter-content" v-show="openSections.danhMuc">
                                    <a href="#" class="filter-item" :class="{ active: !filter.id_danh_muc }" @click.prevent="filter.id_danh_muc = ''; loadData()">
                                        Tất cả
                                    </a>
                                    <a href="#" v-for="dm in danh_mucs" :key="dm.id" class="filter-item" :class="{ active: filter.id_danh_muc == dm.id }" @click.prevent="filter.id_danh_muc = dm.id; loadData()">
                                        {{ dm.ten_danh_muc }}
                                    </a>
                                </div>
                            </div>

                            <!-- Mùa - Collapsible -->
                            <div class="filter-section">
                                <div class="filter-header" @click="toggleSection('mua')">
                                    <span>🍂 Theo Mùa</span>
                                    <i class="fa" :class="openSections.mua ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                                </div>
                                <div class="filter-content" v-show="openSections.mua">
                                    <div class="filter-buttons">
                                        <button v-for="mua in mua_hoas" :key="mua.id" class="btn btn-sm" :class="filter.id_mua == mua.id ? 'btn-success' : 'btn-outline-success'" @click="filter.id_mua = filter.id_mua == mua.id ? '' : mua.id; loadData()">
                                            {{ getMuaIcon(mua.ten_mua) }} {{ mua.ten_mua }}
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Dịp lễ - Collapsible -->
                            <div class="filter-section">
                                <div class="filter-header" @click="toggleSection('dip')">
                                    <span>🎉 Theo Dịp</span>
                                    <i class="fa" :class="openSections.dip ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                                </div>
                                <div class="filter-content" v-show="openSections.dip">
                                    <div class="filter-buttons">
                                        <button v-for="dip in dip_les" :key="dip.id" class="btn btn-sm" :class="filter.id_dip_le == dip.id ? 'btn-danger' : 'btn-outline-danger'" @click="filter.id_dip_le = filter.id_dip_le == dip.id ? '' : dip.id; loadData()">
                                            {{ getDipIcon(dip.ten_dip) }} {{ dip.ten_dip }}
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Reset Button -->
                            <div class="p-3">
                                <button class="btn btn-secondary w-100" @click="resetFilter">
                                    <i class="fa fa-refresh"></i> Đặt lại
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Grid -->
                <div class="col-md-9">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">🌸 {{ getTitle() }}</h4>
                        <span class="badge bg-secondary">{{ list_data.length }} sản phẩm</span>
                    </div>

                    <div class="row">
                        <template v-for="item in list_data" :key="item.id">
                            <div class="col-lg-4 col-md-6 col-6 mb-4">
                                <div class="card h-100 product-card shadow-sm">
                                    <div class="position-relative">
                                        <img :src="getImageUrl(item.hinh_anh)" class="card-img-top" style="height: 220px; object-fit: cover;">
                                        <span v-if="item.phan_tram_giam" class="badge bg-danger position-absolute top-0 end-0 m-2">-{{ item.phan_tram_giam }}%</span>
                                        <span v-if="item.noi_bat" class="badge bg-warning position-absolute top-0 start-0 m-2">⭐</span>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-title text-truncate" :title="item.ten_bo_hoa">{{ item.ten_bo_hoa }}</h6>
                                        <p class="card-text small text-muted text-truncate">{{ item.mo_ta }}</p>
                                        <div class="d-flex align-items-center mb-2">
                                            <span v-if="item.gia_giam" class="text-danger fw-bold me-2">{{ formatPrice(item.gia_giam) }}đ</span>
                                            <span :class="item.gia_giam ? 'text-decoration-line-through text-muted small' : 'text-danger fw-bold'">{{ formatPrice(item.gia) }}đ</span>
                                        </div>
                                        <router-link :to="'/chi-tiet/' + item.id" class="btn btn-outline-danger btn-sm w-100">
                                            <i class="fa fa-eye"></i> Xem Chi Tiết
                                        </router-link>
                                    </div>
                                </div>
                            </div>
                        </template>
                        <div v-if="list_data.length === 0" class="col-12 text-center py-5">
                            <img src="https://cdn-icons-png.flaticon.com/512/6134/6134065.png" style="width: 100px; opacity: 0.5;">
                            <p class="text-muted mt-3">Không tìm thấy sản phẩm phù hợp</p>
                        </div>
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
            list_data: [],
            danh_mucs: [],
            mua_hoas: [],
            dip_les: [],
            filter: {
                id_danh_muc: '',
                id_mua: '',
                id_dip_le: ''
            },
            openSections: {
                danhMuc: false,
                mua: false,
                dip: false
            }
        }
    },
    methods: {
        toggleSection(section) {
            this.openSections[section] = !this.openSections[section];
        },
        loadData() {
            let params = {};
            if (this.filter.id_danh_muc) params.id_danh_muc = this.filter.id_danh_muc;
            if (this.filter.id_mua) params.id_mua = this.filter.id_mua;
            if (this.filter.id_dip_le) params.id_dip_le = this.filter.id_dip_le;

            axios.get('http://localhost:8000/api/client/bo-hoa', { params })
                .then((res) => {
                    if (res.data.status) {
                        this.list_data = res.data.data;
                    }
                });
        },
        loadFilters() {
            axios.get('http://localhost:8000/api/client/danh-muc').then((res) => {
                if (res.data.status) this.danh_mucs = res.data.data;
            });
            axios.get('http://localhost:8000/api/client/mua-hoa').then((res) => {
                if (res.data.status) this.mua_hoas = res.data.data;
            });
            axios.get('http://localhost:8000/api/client/dip-le').then((res) => {
                if (res.data.status) this.dip_les = res.data.data;
            });
        },
        resetFilter() {
            this.filter = { id_danh_muc: '', id_mua: '', id_dip_le: '' };
            this.loadData();
        },
        formatPrice(price) {
            return new Intl.NumberFormat('vi-VN').format(price);
        },
        getImageUrl(path) {
            if (!path) return 'https://images.unsplash.com/photo-1518882605630-8a6392e87b54?w=300&h=300&fit=crop';
            if (path.startsWith('http')) return path;
            return 'http://localhost:8000' + path;
        },
        getTitle() {
            if (this.filter.id_mua) {
                const mua = this.mua_hoas.find(m => m.id == this.filter.id_mua);
                return mua ? `Hoa ${mua.ten_mua}` : 'Sản phẩm';
            }
            if (this.filter.id_dip_le) {
                const dip = this.dip_les.find(d => d.id == this.filter.id_dip_le);
                return dip ? `Hoa ${dip.ten_dip}` : 'Sản phẩm';
            }
            return 'Tất Cả Sản Phẩm';
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
        // Check route params
        if (this.$route.params.id && this.$route.path.includes('/mua/')) {
            this.filter.id_mua = this.$route.params.id;
            this.openSections.mua = true;
        }
        if (this.$route.params.id && this.$route.path.includes('/dip-le/')) {
            this.filter.id_dip_le = this.$route.params.id;
            this.openSections.dip = true;
        }
        this.loadFilters();
        this.loadData();
    },
    watch: {
        '$route'(to, from) {
            if (to.params.id && to.path.includes('/mua/')) {
                this.filter = { id_danh_muc: '', id_mua: to.params.id, id_dip_le: '' };
                this.openSections.mua = true;
            } else if (to.params.id && to.path.includes('/dip-le/')) {
                this.filter = { id_danh_muc: '', id_mua: '', id_dip_le: to.params.id };
                this.openSections.dip = true;
            }
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

    /* Filter Card Styles */
    .filter-card {
        border-radius: 15px;
        overflow: hidden;
    }
    .filter-section {
        border-bottom: 1px solid #eee;
    }
    .filter-section:last-of-type {
        border-bottom: none;
    }
    .filter-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 15px;
        cursor: pointer;
        font-weight: 600;
        background: #f8f9fa;
        transition: all 0.3s ease;
    }
    .filter-header:hover {
        background: #e9ecef;
    }
    .filter-header i {
        font-size: 12px;
        transition: transform 0.3s ease;
    }
    .filter-content {
        padding: 10px 15px;
        background: white;
    }
    .filter-item {
        display: block;
        padding: 8px 12px;
        color: #333;
        text-decoration: none;
        border-radius: 8px;
        margin-bottom: 5px;
        transition: all 0.3s ease;
    }
    .filter-item:hover {
        background: #f8f9fa;
        color: #dc3545;
    }
    .filter-item.active {
        background: #dc3545;
        color: white;
    }
    .filter-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    .filter-buttons .btn {
        font-size: 12px;
        border-radius: 20px;
    }
</style>
