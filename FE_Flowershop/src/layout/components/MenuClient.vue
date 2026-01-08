<template>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark py-0" style="background: linear-gradient(135deg, #c2185b, #e91e63);">
            <div class="container">
                <router-link to="/" class="navbar-brand fs-4 fw-bold text-decoration-none">
                    <span>🌸</span> Ni Flower's
                </router-link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent1">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    </ul>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <router-link to="/">
                            <li class="nav-item">
                                <a class="nav-link text-light fs-6" href="#">Trang Chủ</a>
                            </li>
                        </router-link>
                        <router-link to="/danh-muc">
                            <li class="nav-item">
                                <a class="nav-link text-light fs-6" href="/danh-muc">Sản Phẩm</a>
                            </li>
                        </router-link>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light fs-6" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Theo Mùa
                            </a>
                            <ul class="dropdown-menu">
                                <li><router-link to="/mua/1" class="dropdown-item">🌸 Mùa Xuân</router-link></li>
                                <li><router-link to="/mua/2" class="dropdown-item">☀️ Mùa Hạ</router-link></li>
                                <li><router-link to="/mua/3" class="dropdown-item">🍂 Mùa Thu</router-link></li>
                                <li><router-link to="/mua/4" class="dropdown-item">❄️ Mùa Đông</router-link></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-light fs-6" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Theo Dịp
                            </a>
                            <ul class="dropdown-menu">
                                <li><router-link to="/dip-le/1" class="dropdown-item">💕 Tình Cảm</router-link></li>
                                <li><router-link to="/dip-le/2" class="dropdown-item">💒 Đám Cưới</router-link></li>
                                <li><router-link to="/dip-le/3" class="dropdown-item">🕯️ Đám Tang</router-link></li>
                                <li><router-link to="/dip-le/4" class="dropdown-item">🏠 Nhà Mới</router-link></li>
                                <li><router-link to="/dip-le/5" class="dropdown-item">🎉 Lễ Hội</router-link></li>
                            </ul>
                        </li>
                        <router-link to="/bai-viet">
                            <li class="nav-item">
                                <a class="nav-link text-light fs-6" href="/bai-viet">Tin Tức</a>
                            </li>
                        </router-link>
                    </ul>
                    <div class="d-flex">
                        <a href="tel:0905999276" class="btn btn-warning btn-sm">
                            <i class="fa fa-phone"></i> Hotline: 0905 999 276
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>
<script>
    import { ref } from 'vue';
    import axios from 'axios';
export default {
    data() {
        return {
            
        }
    },
    methods: {
        
    },
    mounted() {
        
    },
}
</script>
<style>
    
</style>