<template>
    <div class="container py-4 py-md-5">
        <div class="row g-4">
            <div class="col-lg-12">
                <div class="bg-white rounded shadow-sm p-3 p-md-4 mb-4">
                    <!-- Tiêu đề bài viết  -->
                    <h1 class="fs-2 fs-md-1 fw-bold text-dark mb-3 text-uppercase">{{ chi_tiet_bai_viet.tieu_de }}</h1>
                    <div class="d-flex flex-wrap align-items-center gap-3 pb-3 mb-4 border-bottom text-secondary small">
                        <span><i class="bi bi-calendar3 text-danger me-1"></i> 10/05/2025</span>
                        <div class="ms-auto mt-2 mt-sm-0 d-flex align-items-center">
                            <span class="me-2">Chia sẻ:</span>
                            <a href="#"
                                class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary text-white me-1"
                                style="width: 32px; height: 32px;">
                                <i class="fa-brands fa-2x fa-square-facebook"></i>
                            </a>
                            <a href="#"
                                class="d-inline-flex align-items-center justify-content-center rounded-circle bg-dark text-white me-1"
                                style="width: 32px; height: 32px;">
                                <i class="fa-brands fa-2x fa-square-twitter"></i>
                            </a>
                            <a href="#"
                                class="d-inline-flex align-items-center justify-content-center rounded-circle bg-danger text-white"
                                style="width: 32px; height: 32px;">
                                <i class="fa-solid fa-2x fa-envelope"></i>
                            </a>
                        </div>
                    </div>

                    <div class="mb-4 rounded overflow-hidden text-center">
                        <img :src="chi_tiet_bai_viet.hinh_anh"
                            alt="" style="height: 500px;" class="img-fluid">
                    </div>
                    <div class="lh-lg">
                        <h3 class="fs-4 fw-semibold mb-3">Nội dung bài viết:</h3>
                        <div class="bg-warning-subtle border-start border-4 border-warning rounded p-4 my-4">
                              <span v-html="chi_tiet_bai_viet.noi_dung"></span>
                        </div>
                    </div>
                    <!-- Tags -->
                    <div class="mt-4 pt-3 border-top">
                        <span class="fw-semibold text-secondary me-2">Tags:</span>
                        <a href="#"
                            class="badge rounded-pill bg-light text-secondary text-decoration-none me-1 mb-2 py-2 px-3">khuyến
                            mãi</a>
                        <a href="#"
                            class="badge rounded-pill bg-light text-secondary text-decoration-none me-1 mb-2 py-2 px-3">mua
                            1 tặng 1</a>
                        <a href="#"
                            class="badge rounded-pill bg-light text-secondary text-decoration-none me-1 mb-2 py-2 px-3">DZ
                            member</a>
                        <a href="#"
                            class="badge rounded-pill bg-light text-secondary text-decoration-none me-1 mb-2 py-2 px-3">vé
                            xem phim</a>
                        <a href="#"
                            class="badge rounded-pill bg-light text-secondary text-decoration-none me-1 mb-2 py-2 px-3">ưu
                            đãi</a>
                    </div>

                </div>
            </div>
            <div class="col-lg-12">
                <div class="bg-white rounded shadow-sm p-3 p-md-4 mb-4">
                    <h3 class="mb-4">Các Bài Viết Liên Quan</h3>
                    <div class="row">
                        <div class="col-lg-3 d-flex">
                            <div class="card flex-full">
                                <img src="https://www.galaxycine.vn/media/2025/2/27/1800x1200_1740651635343.jpg"
                                    class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h6 class="card-title ">Phim Hay Tháng 03.2025: Bạch Tuyết pk Quỷ Nhập Tràng</h6>
                                    <p class="card-text "><small>Some quick example text to build on the card title and
                                            make
                                            up the
                                            bulk of the card's content.</small></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 d-flex">
                            <div class="card flex-full">
                                <img src="https://www.galaxycine.vn/media/2024/10/28/pht11-750_1730103049846.jpg"
                                    class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h6 class="card-title ">Những Người Hùng Trở Lại</h6>
                                    <p class="card-text "><small>Some quick example text to build on the card title and
                                            make
                                            up the
                                            bulk of the card's content.</small></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 d-flex">
                            <div class="card flex-full">
                                <img src="https://www.galaxycine.vn/media/2024/4/2/pht-750_1712045387498.jpg"
                                    class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h6 class="card-title ">"Lật Mặt" Hạnh Phúc</h6>
                                    <p class="card-text "><small>Some quick example text to build on the card title and
                                            make
                                            up the
                                            bulk of the card's content.</small></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 d-flex">
                            <div class="card flex-full">
                                <img src="https://www.galaxycine.vn/media/2024/3/6/1800x1200_1709717527256.jpg"
                                    class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h6 class="card-title ">Đại Chiến Không Hồi Kết</h6>
                                    <p class="card-text "><small>Some quick example text to build on the card title and
                                            make
                                            up the
                                            bulk of the card's content.</small></p>
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
import axios from 'axios';

export default {
    props: ["id_bai_viet"],
    data() {
        return {
            id_bai_viet: this.$route.params.id_bai_viet,
            chi_tiet_bai_viet: {},
        }
    },
    mounted() {
        this.loadChiTietBaiViet();
    },
    methods: {
        loadChiTietBaiViet() {
            var payload = {
                id: this.id_bai_viet
            }
            axios.post('http://127.0.0.1:8000/api/client/chi-tiet-bai-viet/get-data', payload)
                .then((res) => {
                    if (res.data.status) {
                        this.chi_tiet_bai_viet = res.data.data;
                    } else {
                        this.$toast.error(res.data.message);
                        this.$router.push('/');
                    }
                });
        }
    },
}
</script>
