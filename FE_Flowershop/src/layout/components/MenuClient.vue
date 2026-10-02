<template>
    <header class="app-header-sticky">
        <!-- Top Announcement Bar (Desktop & Mobile) -->
        <div class="top-announcement text-center py-1 small">
            <span>🌸 Miễn phí thiệp chúc mừng & băng rôn cho mọi đơn hoa • Giao nhanh trong 2H</span>
        </div>

        <!-- Main Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-dark main-navbar py-2">
            <div class="container d-flex align-items-center justify-content-between">
                <!-- Mobile: Hamburger Menu Toggle -->
                <button class="btn btn-drawer-toggle d-lg-none" type="button" @click="toggleDrawer" aria-label="Mở menu">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Brand Logo -->
                <router-link to="/" class="navbar-brand d-flex align-items-center gap-2 m-0" @click="closeDrawer">
                    <span class="brand-flower-icon">🌸</span>
                    <div class="d-flex flex-column">
                        <span class="brand-title">Ni Flower's</span>
                        <span class="brand-subtitle d-none d-sm-block">Hoa Tươi Đà Nẵng</span>
                    </div>
                </router-link>

                <!-- Desktop Nav Items -->
                <div class="collapse navbar-collapse justify-content-center d-none d-lg-flex" id="navbarMain">
                    <ul class="navbar-nav align-items-center gap-1">
                        <li class="nav-item">
                            <router-link to="/" class="nav-link custom-nav-link" active-class="active">
                                <i class="fa fa-home me-1"></i> Trang Chủ
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/danh-muc" class="nav-link custom-nav-link" active-class="active">
                                <i class="fa fa-th-large me-1"></i> Sản Phẩm
                            </router-link>
                        </li>

                        <!-- Theo Mùa Dropdown -->
                        <li class="nav-item dropdown custom-dropdown">
                            <a class="nav-link dropdown-toggle custom-nav-link" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fa fa-snowflake me-1"></i> Theo Mùa
                            </a>
                            <ul class="dropdown-menu shadow-lg border-0 rounded-4">
                                <li><router-link to="/mua/1" class="dropdown-item py-2">🌸 Hoa Mùa Xuân</router-link></li>
                                <li><router-link to="/mua/2" class="dropdown-item py-2">☀️ Hoa Mùa Hạ</router-link></li>
                                <li><router-link to="/mua/3" class="dropdown-item py-2">🍂 Hoa Mùa Thu</router-link></li>
                                <li><router-link to="/mua/4" class="dropdown-item py-2">❄️ Hoa Mùa Đông</router-link></li>
                            </ul>
                        </li>

                        <!-- Theo Dịp Dropdown -->
                        <li class="nav-item dropdown custom-dropdown">
                            <a class="nav-link dropdown-toggle custom-nav-link" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fa fa-heart me-1"></i> Theo Dịp
                            </a>
                            <ul class="dropdown-menu shadow-lg border-0 rounded-4">
                                <li><router-link to="/dip-le/1" class="dropdown-item py-2">💕 Tình Cảm & Valentine</router-link></li>
                                <li><router-link to="/dip-le/2" class="dropdown-item py-2">💒 Hoa Cưới Lãng Mạn</router-link></li>
                                <li><router-link to="/dip-le/3" class="dropdown-item py-2">🕯️ Hoa Chia Buồn</router-link></li>
                                <li><router-link to="/dip-le/4" class="dropdown-item py-2">🏠 Khai Trương Hồng Phát</router-link></li>
                                <li><router-link to="/dip-le/5" class="dropdown-item py-2">🎂 Chúc Mừng Sinh Nhật</router-link></li>
                                <li><router-link to="/dip-le/6" class="dropdown-item py-2">🎉 Lễ Hội & Sự Kiện</router-link></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <router-link to="/bai-viet" class="nav-link custom-nav-link" active-class="active">
                                <i class="fa fa-newspaper me-1"></i> Tin Tức
                            </router-link>
                        </li>
                    </ul>
                </div>

                <!-- Right Actions: Hotline & Mobile Quick Actions -->
                <div class="d-flex align-items-center gap-2">
                    <!-- Mobile Search Trigger -->
                    <router-link to="/danh-muc" class="btn btn-header-icon d-lg-none" title="Tìm hoa">
                        <i class="fa fa-search"></i>
                    </router-link>

                    <!-- Mobile Call Trigger -->
                    <a href="tel:0905999276" class="btn btn-header-icon call-icon d-lg-none" title="Gọi ngay">
                        <i class="fa fa-phone"></i>
                    </a>

                    <!-- Desktop Hotline Pill -->
                    <div class="d-none d-lg-flex align-items-center gap-2">
                        <a href="https://zalo.me/0905999276" target="_blank" class="btn btn-zalo-pill btn-sm">
                            <i class="fa fa-comment me-1"></i> Zalo
                        </a>
                        <a href="tel:0905999276" class="btn btn-hotline-pill btn-sm">
                            <span class="phone-pulse">
                                <i class="fa fa-phone"></i>
                            </span>
                            <span class="fw-bold">0905 999 276</span>
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Mobile Offcanvas Drawer (Native App Menu) -->
        <transition name="drawer-fade">
            <div v-if="drawerOpen" class="app-drawer-backdrop" @click="closeDrawer"></div>
        </transition>

        <div class="app-drawer" :class="{ open: drawerOpen }">
            <!-- Drawer Header -->
            <div class="app-drawer-header">
                <button class="app-drawer-close" @click="closeDrawer" aria-label="Đóng">
                    <i class="fa fa-times"></i>
                </button>
                <div class="app-drawer-title">
                    <span>🌸</span> Ni Flower's
                </div>
                <div class="small opacity-75 mt-1">Shop Hoa Tươi Nghệ Thuật Đà Nẵng</div>
            </div>

            <!-- Drawer Body -->
            <div class="app-drawer-body">
                <!-- Quick Search Input inside Drawer -->
                <div class="mb-3 px-2">
                    <div class="input-group">
                        <input type="text" class="form-control rounded-start-pill border-end-0 py-2 ps-3" 
                            placeholder="Tìm mẫu hoa yêu thích..." 
                            v-model="drawerSearchQuery" 
                            @keyup.enter="handleSearch">
                        <button class="btn btn-primary rounded-end-pill px-3" @click="handleSearch">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>

                <!-- Navigation Links -->
                <router-link to="/" class="app-drawer-link" @click="closeDrawer">
                    <span class="icon">🏠</span> Trang Chủ
                </router-link>
                <router-link to="/danh-muc" class="app-drawer-link" @click="closeDrawer">
                    <span class="icon">🌸</span> Tất Cả Mẫu Hoa
                </router-link>

                <!-- Theo Mùa Section -->
                <div class="app-drawer-group-title">HOA THEO MÙA</div>
                <router-link to="/mua/1" class="app-drawer-sublink" @click="closeDrawer">
                    <span>🌸</span> Mùa Xuân
                </router-link>
                <router-link to="/mua/2" class="app-drawer-sublink" @click="closeDrawer">
                    <span>☀️</span> Mùa Hạ
                </router-link>
                <router-link to="/mua/3" class="app-drawer-sublink" @click="closeDrawer">
                    <span>🍂</span> Mùa Thu
                </router-link>
                <router-link to="/mua/4" class="app-drawer-sublink" @click="closeDrawer">
                    <span>❄️</span> Mùa Đông
                </router-link>

                <!-- Theo Dịp Lễ Section -->
                <div class="app-drawer-group-title">HOA THEO DỊP</div>
                <router-link to="/dip-le/1" class="app-drawer-sublink" @click="closeDrawer">
                    <span>💕</span> Tình Cảm & Lãng Mạn
                </router-link>
                <router-link to="/dip-le/2" class="app-drawer-sublink" @click="closeDrawer">
                    <span>💒</span> Hoa Cưới Cầm Tay
                </router-link>
                <router-link to="/dip-le/4" class="app-drawer-sublink" @click="closeDrawer">
                    <span>🏠</span> Chúc Mừng Khai Trương
                </router-link>
                <router-link to="/dip-le/5" class="app-drawer-sublink" @click="closeDrawer">
                    <span>🎂</span> Hoa Sinh Nhật
                </router-link>
                <router-link to="/dip-le/3" class="app-drawer-sublink" @click="closeDrawer">
                    <span>🕯️</span> Hoa Chia Buồn
                </router-link>

                <!-- Blog / Tin tức -->
                <div class="app-drawer-group-title">TIN TỨC & BÀI VIẾT</div>
                <router-link to="/bai-viet" class="app-drawer-link" @click="closeDrawer">
                    <span class="icon">📰</span> Tin Tức & Ý Nghĩa Hoa
                </router-link>
            </div>

            <!-- Drawer Footer Contact Details -->
            <div class="app-drawer-footer">
                <a href="tel:0905999276" class="btn btn-success w-100 mb-2 py-2 fw-bold d-flex align-items-center justify-content-center gap-2 rounded-pill">
                    <i class="fa fa-phone"></i> Gọi Hotline 0905 999 276
                </a>
                <a href="https://zalo.me/0905999276" target="_blank" class="btn btn-outline-primary w-100 py-2 fw-bold d-flex align-items-center justify-content-center gap-2 rounded-pill">
                    <i class="fa fa-comment"></i> Chat Zalo Tư Vấn
                </a>
            </div>
        </div>
    </header>
</template>

<script>
export default {
    data() {
        return {
            drawerOpen: false,
            drawerSearchQuery: ''
        };
    },
    methods: {
        toggleDrawer() {
            this.drawerOpen = !this.drawerOpen;
            if (this.drawerOpen) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        },
        closeDrawer() {
            this.drawerOpen = false;
            document.body.style.overflow = '';
        },
        handleSearch() {
            if (this.drawerSearchQuery.trim()) {
                this.$router.push({ path: '/danh-muc', query: { q: this.drawerSearchQuery.trim() } });
                this.closeDrawer();
            } else {
                this.$router.push('/danh-muc');
                this.closeDrawer();
            }
        }
    },
    watch: {
        '$route'() {
            this.closeDrawer();
        }
    },
    beforeUnmount() {
        document.body.style.overflow = '';
    }
};
</script>

<style scoped>
.app-header-sticky {
    position: sticky;
    top: 0;
    z-index: 1030;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.top-announcement {
    background: #a31548;
    color: #ffd1dc;
    font-size: 0.78rem;
    letter-spacing: 0.3px;
    font-weight: 500;
}

.main-navbar {
    background: linear-gradient(135deg, #c2185b 0%, #e91e63 60%, #ff6b9d 100%);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.15);
}

.brand-flower-icon {
    font-size: 1.8rem;
    animation: gentle-spin 12s linear infinite;
    display: inline-block;
}

@keyframes gentle-spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.brand-title {
    font-size: 1.35rem;
    font-weight: 800;
    color: #ffffff;
    line-height: 1.1;
    letter-spacing: -0.3px;
}

.brand-subtitle {
    font-size: 0.7rem;
    color: rgba(255, 255, 255, 0.8);
    font-weight: 500;
    letter-spacing: 0.5px;
}

.btn-drawer-toggle {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.18);
    border: none;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.15rem;
    transition: background 0.2s;
}

.btn-drawer-toggle:active {
    background: rgba(255, 255, 255, 0.35);
}

.btn-header-icon {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.18);
    color: white;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.95rem;
    text-decoration: none;
    transition: transform 0.2s, background 0.2s;
}

.btn-header-icon.call-icon {
    background: #34c759;
    color: white;
}

.btn-header-icon:active {
    transform: scale(0.92);
}

.custom-nav-link {
    color: rgba(255, 255, 255, 0.9) !important;
    font-weight: 600;
    font-size: 0.95rem;
    padding: 8px 16px !important;
    border-radius: 25px;
    transition: all 0.25s ease;
}

.custom-nav-link:hover,
.custom-nav-link.active {
    color: #ffffff !important;
    background: rgba(255, 255, 255, 0.2);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.custom-dropdown .dropdown-menu {
    border-radius: 16px;
    padding: 8px;
    min-width: 220px;
    margin-top: 8px;
    border: 1px solid rgba(233, 30, 99, 0.1);
}

.custom-dropdown .dropdown-item {
    border-radius: 10px;
    font-weight: 600;
    color: #333;
    transition: all 0.2s ease;
}

.custom-dropdown .dropdown-item:hover {
    background: #fff0f5;
    color: #e91e63;
    transform: translateX(4px);
}

.btn-hotline-pill {
    background: #ffffff;
    color: #c2185b;
    border-radius: 30px;
    padding: 8px 18px;
    border: none;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.12);
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-hotline-pill:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
    color: #c2185b;
}

.btn-zalo-pill {
    background: rgba(255, 255, 255, 0.2);
    color: #ffffff;
    border: 1px solid rgba(255, 255, 255, 0.4);
    border-radius: 30px;
    padding: 8px 14px;
    font-size: 0.9rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.2s;
}

.btn-zalo-pill:hover {
    background: #ffffff;
    color: #0088ff;
}

.phone-pulse {
    width: 26px;
    height: 26px;
    border-radius: 50%;
    background: #e91e63;
    color: white;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    animation: gentle-pulse 2s infinite;
}

@keyframes gentle-pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.15); }
    100% { transform: scale(1); }
}

.drawer-fade-enter-active,
.drawer-fade-leave-active {
    transition: opacity 0.3s ease;
}
.drawer-fade-enter-from,
.drawer-fade-leave-to {
    opacity: 0;
}
</style>
