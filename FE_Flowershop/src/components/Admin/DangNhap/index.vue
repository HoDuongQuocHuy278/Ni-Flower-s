<template>
    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                <div class="col mx-auto">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="text-center mb-4">
                                    <div class="fs-1">🌸</div>
                                    <h4 class="mt-3 font-weight-bold text-uppercase text-nowrap">ĐĂNG NHẬP ADMIN <span
                                            class="text-danger">NI FLOWER'S</span></h4>
                                </div>
                                <div class="form-body">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label">Email</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-transparent">
                                                    <i class="fa-solid fa-envelope"></i>
                                                </span>
                                                <input v-model="form.email" type="email" class="form-control border-start-0"
                                                    placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label">Mật khẩu</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-transparent">
                                                    <i class="fa-solid fa-lock"></i>
                                                </span>
                                                <input v-model="form.mat_khau" type="password" class="form-control border-start-0"
                                                    placeholder="Mật khẩu" @keyup.enter="dangNhap">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button @click="dangNhap()" class="btn btn-danger" :disabled="loading">
                                                    <span v-if="loading" class="spinner-border spinner-border-sm me-2"></span>
                                                    <i v-else class="fa-solid fa-right-to-bracket me-2"></i>
                                                    Đăng Nhập
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-12 text-center">
                                            <p class="text-muted small">Liên hệ admin nếu quên mật khẩu</p>
                                        </div>
                                    </div>
                                </div>
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
            form: {
                email: '',
                mat_khau: ''
            },
            loading: false
        }
    },
    methods: {
        dangNhap() {
            if (!this.form.email || !this.form.mat_khau) {
                alert('Vui lòng nhập đầy đủ email và mật khẩu!');
                return;
            }
            
            this.loading = true;
            axios.post(ipbe + '/api/admin/dang-nhap', this.form)
                .then((res) => {
                    this.loading = false;
                    if (res.data.status) {
                        alert(res.data.message);
                        localStorage.setItem('key_admin', JSON.stringify(res.data.data));
                        this.$router.push('/admin');
                    } else {
                        alert(res.data.message);
                    }
                })
                .catch((err) => {
                    this.loading = false;
                    alert('Lỗi kết nối server!');
                });
        }
    },
    mounted() {
        
    },
}
</script>
<style>
    
</style>
