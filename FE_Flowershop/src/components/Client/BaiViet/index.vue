<template>
    <div class="news-page py-3 py-lg-4">
        <!-- Banner Header -->
        <div class="container mb-4">
            <div class="news-hero-banner rounded-4 text-center text-white py-4 py-lg-5 px-3 position-relative overflow-hidden shadow-sm">
                <div class="banner-overlay"></div>
                <div class="position-relative">
                    <span class="badge bg-white text-danger rounded-pill px-3 py-2 fw-bold mb-2">🌸 Cẩm Nang & Ý Nghĩa Hoa</span>
                    <h1 class="fw-bold fs-2 fs-lg-1 mb-2">Góc Yêu Hoa Ni Flower's</h1>
                    <p class="small opacity-90 mb-0 max-w-500 mx-auto">
                        Khám phá thông điệp của từng đóa hoa, bí quyết giữ hoa tươi lâu và gợi ý chọn hoa tinh tế nhất.
                    </p>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row g-4">
                <!-- Featured Article (Cột Trái hoặc Trên Mobile) -->
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 hover-card">
                        <img src="https://images.unsplash.com/photo-1561181286-d3fee7d55364?w=800&h=450&fit=crop" 
                            class="card-img-top news-main-img" 
                            alt="Hoa tươi">
                        <div class="card-body p-3 p-md-4">
                            <div class="d-flex align-items-center gap-2 mb-2 text-muted small">
                                <span class="badge bg-danger rounded-pill">Nổi Bật</span>
                                <span><i class="fa fa-calendar me-1"></i> Hôm nay</span>
                                <span>• 5 phút đọc</span>
                            </div>
                            <h4 class="card-title fw-bold text-dark mb-2">
                                7 Mẹo Đơn Giản Giúp Hoa Tươi Lâu Đến 10 Ngày Mà Ai Cũng Làm Được
                            </h4>
                            <p class="card-text text-secondary small lh-lg">
                                Bạn vừa nhận được một bó hoa tuyệt đẹp nhưng lo lắng hoa sẽ sớm tàn? Khám phá ngay các bí quyết tỉa gốc chéo 45 độ, thay nước sạch hàng ngày và dinh dưỡng tự nhiên giúp hoa nở đều và giữ độ tươi lâu nhất!
                            </p>
                            <router-link to="/danh-muc" class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-bold">
                                Khám Phá Mẫu Hoa Tươi <i class="fa fa-arrow-right ms-1"></i>
                            </router-link>
                        </div>
                    </div>
                </div>

                <!-- Article List (Cột Phải) -->
                <div class="col-lg-5">
                    <div class="d-flex flex-column gap-3">
                        <div class="card border-0 shadow-sm rounded-4 p-3 hover-card" v-for="(post, index) in blogPosts" :key="index">
                            <div class="row g-3 align-items-center">
                                <div class="col-4 col-sm-3 col-lg-4">
                                    <img :src="post.image" class="img-fluid rounded-3 w-100 object-fit-cover" style="height: 90px;" :alt="post.title">
                                </div>
                                <div class="col-8 col-sm-9 col-lg-8">
                                    <span class="badge bg-light text-danger small mb-1">{{ post.tag }}</span>
                                    <h6 class="fw-bold text-dark mb-1 text-truncate-2 small">{{ post.title }}</h6>
                                    <p class="text-muted small mb-0 text-truncate-1">{{ post.desc }}</p>
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
export default {
    data() {
        return {
            blogPosts: [
                {
                    title: 'Ý Nghĩa Số Lượng Bông Hoa Hồng Bạn Cần Biết Trước Khi Tặng',
                    desc: '1 bông nghĩa là Duy nhất, 9 bông là Trường cửu, 99 bông là Tình yêu vĩnh hằng...',
                    tag: 'Ý Nghĩa Hoa',
                    image: 'https://images.unsplash.com/photo-1518882605630-8a6392e87b54?w=300&h=300&fit=crop'
                },
                {
                    title: 'Cách Chọn Hoa Cưới Cầm Tay Cô Dâu Tone Pastel Sang Trọng',
                    desc: 'Tone màu hồng phấn, trắng kem và cam đào đang là xu hướng hoa cưới dẫn đầu năm nay...',
                    tag: 'Hoa Cưới',
                    image: 'https://images.unsplash.com/photo-1520763185298-1b434c919102?w=300&h=300&fit=crop'
                },
                {
                    title: 'Top 5 Loài Hoa Chúc Mừng Khai Trương Mang Lại Tài Lộc Phát Đạt',
                    desc: 'Hoa đồng tiền, hoa hướng dương, lan hồ điệp - những biểu tượng vạn lộc hanh thông...',
                    tag: 'Khai Trương',
                    image: 'https://images.unsplash.com/photo-1508610048659-a06b669e3321?w=300&h=300&fit=crop'
                },
                {
                    title: 'Bí Quyết Tặng Hoa Sinh Nhật Cho Người Yêu Khiến Nàng Say Đắm',
                    desc: 'Không chỉ là đóa hoa đẹp, tấm thiệp viết tay chân thành sẽ nhân đôi cảm xúc yêu thương...',
                    tag: 'Tư Vấn',
                    image: 'https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=300&h=300&fit=crop'
                }
            ]
        };
    }
};
</script>

<style scoped>
.news-hero-banner {
    background: url('https://images.unsplash.com/photo-1487530811176-3780de880c2d?w=1600&h=400&fit=crop') center/cover;
}

.banner-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(194, 24, 91, 0.92), rgba(26, 26, 46, 0.85));
}

.max-w-500 {
    max-width: 500px;
}

.news-main-img {
    height: 240px;
    object-fit: cover;
}

@media (min-width: 768px) {
    .news-main-img {
        height: 320px;
    }
}

.hover-card {
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.hover-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(233, 30, 99, 0.1) !important;
}

.text-truncate-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.text-truncate-1 {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
