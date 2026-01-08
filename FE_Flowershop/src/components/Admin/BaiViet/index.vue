<template>
    <div class="row">
        <div class="col-lg-12">
            <div class="card radius-10 border-top border-0 border-3 border-info">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="mt-2">DANH SÁCH BÀI VIẾT</h4>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                        Thêm bài viết
                    </button>
                </div>
                <div class="card-body table-responsive">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search....">
                        <button class="btn btn-success input-group-text" style="width: 120px;">Tìm kiếm</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr class="bg-primary text-light text-nowrap">
                                    <th class="text-center">#</th>
                                    <th class="text-center">Tiêu Đề</th>
                                    <th class="text-center">Mô tả ngắn</th>
                                    <th class="text-center">Nội Dung</th>
                                    <th class="text-center">Hình Ảnh</th>
                                    <th class="text-center">Tag</th>
                                    <th class="text-center">Trạng Thái</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(item, index) in list_bai_viet" :key="index">
                                    <tr class="">
                                        <th class="align-middle text-center">{{ index + 1 }}</th>
                                        <td class="align-middle text-wrap">{{ item.tieu_de }}</td>
                                        <td class="align-middle text-wrap">{{ item.mo_ta_ngan }}</td>
                                        <td class="align-middle text-center" style="width: 100px;">
                                            <i class="fa-solid fa-circle-info fa-2x" data-bs-toggle="modal"
                                                data-bs-target="#chiTietModal"
                                                v-on:click="Object.assign(chi_tiet_bai_viet, item)"></i>
                                        </td>
                                        <td class="align-middle text-center text-nowrap" style="width: 250px;">
                                            <img :src="item.hinh_anh" alt="Hình Ảnh" class="img-fluid rounded"
                                                style="height: 100px; object-fit: cover; width: 100%;">
                                        </td>
                                        <td class="align-middle text-wrap">{{ item.tag }}</td>
                                        <td @click="doiTrangThai(item)" class="align-middle text-center text-nowrap"
                                            style="width: 100px;">
                                            <button v-if="item.tinh_trang == 1" class="btn btn-success w-100"
                                                style="color: white;">
                                                Hiển Thị
                                            </button>
                                            <button v-else class="btn btn-warning w-100" style="color: white;">
                                                Tạm Tắt
                                            </button>
                                        </td>
                                        <td class="align-middle text-center text-nowrap" style="width: 150px;">
                                            <button class="btn btn-info text-light me-2" data-bs-toggle="modal"
                                                data-bs-target="#updateModal"
                                                v-on:click="Object.assign(edit_bai_viet, item)">
                                                Cập nhật
                                            </button>
                                            <button class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal"
                                                v-on:click="Object.assign(del_bai_viet, item)">
                                                Xóa Bỏ
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Thêm Mới -->

    <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm Bài Viết Mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Tiêu Đề</label>
                        <input v-model="create_bai_viet.tieu_de" type="text" class="form-control mt-1" />
                    </div>
                    <div class="mb-2">
                        <label>Mô tả ngắn</label>
                        <textarea v-model="create_bai_viet.mo_ta_ngan" class="form-control mt-1" rows="1"></textarea>
                    </div>
                    <div class="mb-2">
                        <label>Nội Dung</label>
                        <textarea v-model="create_bai_viet.noi_dung" class="form-control mt-1" rows="3"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label>Hình Ảnh</label>
                                <input v-model="create_bai_viet.hinh_anh" type="text" class="form-control mt-1" />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-2">
                                <label>Tag</label>
                                <input v-model="create_bai_viet.tag" type="text" class="form-control mt-1" />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-2">
                                <label>Trạng Thái</label>
                                <select class="form-select mt-1" v-model="create_bai_viet.tinh_trang">
                                    <option value="0">Tạm Tắt</option>
                                    <option value="1">Hiển Thị</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Đóng
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" v-on:click="themBaiViet()">
                        Thêm mới
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Cập Nhật -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cập Nhật Bài Viết</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2">
                        <label>Tiêu Đề</label>
                        <input v-model="edit_bai_viet.tieu_de" type="text" class="form-control mt-1" />
                    </div>
                    <div class="mb-2">
                        <label>Mô tả ngắn</label>
                        <textarea v-model="edit_bai_viet.mo_ta_ngan" class="form-control mt-1" rows="1"></textarea>
                    </div>
                    <div class="mb-2">
                        <label>Nội Dung</label>
                        <textarea v-model="edit_bai_viet.noi_dung" class="form-control mt-1" rows="3"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label>Hình Ảnh</label>
                                <input v-model="edit_bai_viet.hinh_anh" type="text" class="form-control mt-1" />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-2">
                                <label>Tag</label>
                                <input v-model="edit_bai_viet.tag" type="text" class="form-control mt-1" />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-2">
                                <label>Trạng Thái</label>
                                <select class="form-select mt-1" v-model="edit_bai_viet.tinh_trang">
                                    <option value="0">Tạm Tắt</option>
                                    <option value="1">Hiển Thị</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Đóng
                    </button>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal" v-on:click="capNhatBaiViet()">
                        Cập nhật
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Xóa -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xóa Bài Viết</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger border-0 bg-warning alert-dismissible fade show py-2">
                        <div class="d-flex align-items-center">
                            <div class="font-35 text-dark"><i class="bx bx-info-circle"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0 text-dark">Bạn có chắc chắn muốn xóa bài viết
                                    <b> {{ del_bai_viet.tieu_de }} </b>
                                    này không?
                                </h6>
                                <div class="text-dark"><b>Lưu ý: </b>Điều này không thể hoàn tác khi nhấn xác nhận</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Hủy Bỏ
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" v-on:click="xoaBaiViet()">
                        Xác nhận
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- modal chi tiết -->
    <div class="modal fade" id="chiTietModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Chi Tiết Nội Dung Bài Viết</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">
                        {{ chi_tiet_bai_viet.noi_dung }}
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Đóng
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data() {
        return {
            list_bai_viet: [],
            create_bai_viet: {},
            edit_bai_viet: {},
            del_bai_viet: {},
            chi_tiet_bai_viet: {},
        }
    },
    mounted() {
        this.getBaiViet();
    },
    methods: {
        extractDateTime(isoString) {
            const date = new Date(isoString);
            const time = date.toLocaleTimeString('vi-VN', { hour12: false });
            const day = date.toLocaleDateString('vi-VN');
            return { time, day };
        },
        getBaiViet() {
            axios.get('http://127.0.0.1:8000/api/admin/bai-viet/get-data')
                .then((res) => {
                    this.list_bai_viet = res.data.data;
                })
        },
        themBaiViet() {
            axios.post('http://127.0.0.1:8000/api/admin/bai-viet/add-data', this.create_bai_viet)
                .then((res) => {
                    if (res.data.status) {
                        this.$toast.success(res.data.message);
                        this.create_bai_viet = {}
                        this.getBaiViet();
                    } else {
                        this.$toast.error('Thêm bài viết thất bại');
                    }
                });
        },
        capNhatBaiViet() {
            axios.post('http://127.0.0.1:8000/api/admin/bai-viet/update', this.edit_bai_viet)
                .then((res) => {
                    if (res.data.status) {
                        this.$toast.success(res.data.message);
                        this.getBaiViet();
                    } else {
                        this.$toast.error('Cập nhật bài viết thất bại');
                    }
                });
        },
        xoaBaiViet() {
            axios.post('http://127.0.0.1:8000/api/admin/bai-viet/delete', this.del_bai_viet)
                .then((res) => {
                    if (res.data.status) {
                        this.$toast.success(res.data.message);
                        this.getBaiViet();
                    } else {
                        this.$toast.error('Xóa bài viết thất bại');
                    }
                });
        },
        doiTrangThai(value) {
            axios.post('http://127.0.0.1:8000/api/admin/bai-viet/change-status', value)
                .then((res) => {
                    if (res.data.status) {
                        this.$toast.success(res.data.message);
                        this.getBaiViet();
                    } else {
                        this.$toast.error('Thay đổi trạng thái thất bại');
                    }
                });
        }
    },
}
</script>
<style></style>