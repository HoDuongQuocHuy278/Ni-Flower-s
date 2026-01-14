<template>
    <div>
        <div class="container-fluid">
            <h3 class="mb-4">🌸 Dashboard - Ni Flower's</h3>
            
            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="card text-white" style="background: linear-gradient(135deg, #ff6b9d, #c2185b);">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title mb-0">Tổng Sản Phẩm</h6>
                                    <h2 class="mb-0">{{ stats.tong_san_pham }}</h2>
                                </div>
                                <i class="fa fa-leaf fa-3x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title mb-0">Sản Phẩm Còn Hàng</h6>
                                    <h2 class="mb-0">{{ stats.con_hang }}</h2>
                                </div>
                                <i class="fa fa-check-circle fa-3x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card text-white bg-warning">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title mb-0">Sản Phẩm Nổi Bật</h6>
                                    <h2 class="mb-0">{{ stats.noi_bat }}</h2>
                                </div>
                                <i class="fa fa-star fa-3x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card text-white bg-info">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="card-title mb-0">Đang Giảm Giá</h6>
                                    <h2 class="mb-0">{{ stats.giam_gia }}</h2>
                                </div>
                                <i class="fa fa-percent fa-3x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-dark text-white">
                            <i class="fa fa-bolt"></i> Truy Cập Nhanh
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-2 col-6 mb-3">
                                    <router-link to="/admin/bo-hoa" class="text-decoration-none">
                                        <div class="card hover-card p-3">
                                            <i class="fa fa-leaf fa-2x text-success"></i>
                                            <p class="mt-2 mb-0">Bó Hoa</p>
                                        </div>
                                    </router-link>
                                </div>
                                <div class="col-md-2 col-6 mb-3">
                                    <router-link to="/admin/danh-muc" class="text-decoration-none">
                                        <div class="card hover-card p-3">
                                            <i class="fa fa-folder fa-2x text-primary"></i>
                                            <p class="mt-2 mb-0">Danh Mục</p>
                                        </div>
                                    </router-link>
                                </div>
                                <div class="col-md-2 col-6 mb-3">
                                    <router-link to="/admin/mua-hoa" class="text-decoration-none">
                                        <div class="card hover-card p-3">
                                            <i class="fa fa-sun fa-2x text-warning"></i>
                                            <p class="mt-2 mb-0">Mùa Hoa</p>
                                        </div>
                                    </router-link>
                                </div>
                                <div class="col-md-2 col-6 mb-3">
                                    <router-link to="/admin/dip-le" class="text-decoration-none">
                                        <div class="card hover-card p-3">
                                            <i class="fa fa-gift fa-2x text-danger"></i>
                                            <p class="mt-2 mb-0">Dịp Lễ</p>
                                        </div>
                                    </router-link>
                                </div>
                                <div class="col-md-2 col-6 mb-3">
                                    <router-link to="/admin/bai-viet" class="text-decoration-none">
                                        <div class="card hover-card p-3">
                                            <i class="fa fa-newspaper fa-2x text-info"></i>
                                            <p class="mt-2 mb-0">Bài Viết</p>
                                        </div>
                                    </router-link>
                                </div>
                                <div class="col-md-2 col-6 mb-3">
                                    <router-link to="/admin/nhan-vien" class="text-decoration-none">
                                        <div class="card hover-card p-3">
                                            <i class="fa fa-users fa-2x text-secondary"></i>
                                            <p class="mt-2 mb-0">Nhân Viên</p>
                                        </div>
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Products -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <i class="fa fa-clock"></i> Sản Phẩm Mới Nhất
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="60">Ảnh</th>
                                            <th>Tên Bó Hoa</th>
                                            <th>Giá</th>
                                            <th>Giảm</th>
                                            <th>Trạng Thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in recent_products" :key="item.id">
                                            <td>
                                                <img :src="getImageUrl(item.hinh_anh)" style="width: 50px; height: 50px; object-fit: cover;" class="rounded">
                                            </td>
                                            <td>{{ item.ten_bo_hoa }}</td>
                                            <td>{{ formatPrice(item.gia) }}đ</td>
                                            <td>
                                                <span v-if="item.phan_tram_giam" class="badge bg-danger">-{{ item.phan_tram_giam }}%</span>
                                                <span v-else class="text-muted">-</span>
                                            </td>
                                            <td>
                                                <span class="badge" :class="item.tinh_trang == 1 ? 'bg-success' : 'bg-secondary'">
                                                    {{ item.tinh_trang == 1 ? 'Còn hàng' : 'Hết hàng' }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr v-if="recent_products.length === 0">
                                            <td colspan="5" class="text-center text-muted">Chưa có sản phẩm</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
    import { ipbe } from '@/config/api';
export default {
    data() {
        return {
            stats: {
                tong_san_pham: 0,
                con_hang: 0,
                noi_bat: 0,
                giam_gia: 0
            },
            recent_products: []
        }
    },
    methods: {
        loadData() {
            axios.get(ipbe + '/api/admin/bo-hoa/get-data')
                .then((res) => {
                    if (res.data.status) {
                        const data = res.data.data;
                        this.stats.tong_san_pham = data.length;
                        this.stats.con_hang = data.filter(x => x.tinh_trang == 1).length;
                        this.stats.noi_bat = data.filter(x => x.noi_bat).length;
                        this.stats.giam_gia = data.filter(x => x.phan_tram_giam > 0).length;
                        this.recent_products = data.slice(0, 5);
                    }
                });
        },
        formatPrice(price) {
            return new Intl.NumberFormat('vi-VN').format(price);
        },
        getImageUrl(path) {
            if (!path) return 'https://via.placeholder.com/50x50?text=🌸';
            if (path.startsWith('http')) return path;
            return ipbe + '' + path;
        }
    },
    mounted() {
        this.loadData();
    },
}
</script>
<style>
    .hover-card {
        transition: all 0.3s;
        cursor: pointer;
    }
    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
</style>
