<template>
    <div>
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0">👥 Quản Lý Nhân Viên</h3>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal" @click="resetForm">
                    <i class="fa fa-plus"></i> Thêm Nhân Viên
                </button>
            </div>

            <!-- Table -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th width="50">#</th>
                                    <th>Họ Tên</th>
                                    <th>Email</th>
                                    <th>SĐT</th>
                                    <th>Chức Vụ</th>
                                    <th>Trạng Thái</th>
                                    <th width="150">Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in list_data" :key="item.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ item.ho_va_ten }}</td>
                                    <td>{{ item.email }}</td>
                                    <td>{{ item.so_dien_thoai }}</td>
                                    <td>
                                        <span class="badge" :class="item.ten_chuc_vu == 'Admin' ? 'bg-danger' : 'bg-primary'">
                                            {{ item.ten_chuc_vu || 'Chưa phân' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge" :class="item.tinh_trang == 1 ? 'bg-success' : 'bg-secondary'">
                                            {{ item.tinh_trang == 1 ? 'Hoạt động' : 'Khóa' }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-warning btn-sm me-1" @click="editItem(item)" data-bs-toggle="modal" data-bs-target="#addModal">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" @click="deleteItem(item)">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="list_data.length === 0">
                                    <td colspan="7" class="text-center py-4 text-muted">Chưa có nhân viên</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add/Edit Modal -->
        <div class="modal fade" id="addModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">{{ form.id ? 'Cập Nhật' : 'Thêm' }} Nhân Viên</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Họ Tên <span class="text-danger">*</span></label>
                                <input v-model="form.ho_va_ten" type="text" class="form-control" placeholder="Nhập họ tên">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input v-model="form.email" type="email" class="form-control" placeholder="Nhập email">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Mật Khẩu {{ form.id ? '(để trống nếu không đổi)' : '' }}</label>
                                <input v-model="form.mat_khau" type="password" class="form-control" placeholder="Nhập mật khẩu">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Số Điện Thoại</label>
                                <input v-model="form.so_dien_thoai" type="text" class="form-control" placeholder="Nhập SĐT">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Ngày Sinh</label>
                                <input v-model="form.ngay_sinh" type="date" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Chức Vụ</label>
                                <select v-model="form.id_chuc_vu" class="form-select">
                                    <option value="">-- Chọn chức vụ --</option>
                                    <option v-for="cv in chuc_vus" :key="cv.id" :value="cv.id">{{ cv.ten_chuc_vu }}</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Địa Chỉ</label>
                                <input v-model="form.dia_chi" type="text" class="form-control" placeholder="Nhập địa chỉ">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Trạng Thái</label>
                                <select v-model="form.tinh_trang" class="form-select">
                                    <option :value="1">Hoạt động</option>
                                    <option :value="0">Khóa</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-success" @click="saveData">
                            <i class="fa fa-save"></i> {{ form.id ? 'Cập Nhật' : 'Thêm Mới' }}
                        </button>
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
            chuc_vus: [],
            form: {
                id: null,
                ho_va_ten: '',
                email: '',
                mat_khau: '',
                so_dien_thoai: '',
                dia_chi: '',
                ngay_sinh: '',
                id_chuc_vu: '',
                tinh_trang: 1
            }
        }
    },
    methods: {
        loadData() {
            axios.get('http://127.0.0.1:8000/api/admin/nhan-vien/get-data')
                .then((res) => {
                    if (res.data.status) {
                        this.list_data = res.data.data;
                    }
                });
            axios.get('http://127.0.0.1:8000/api/admin/chuc-vu/get-data')
                .then((res) => {
                    if (res.data.status) {
                        this.chuc_vus = res.data.data;
                    }
                });
        },
        resetForm() {
            this.form = {
                id: null,
                ho_va_ten: '',
                email: '',
                mat_khau: '',
                so_dien_thoai: '',
                dia_chi: '',
                ngay_sinh: '',
                id_chuc_vu: '',
                tinh_trang: 1
            };
        },
        editItem(item) {
            this.form = { ...item, mat_khau: '' };
        },
        saveData() {
            if (!this.form.ho_va_ten || !this.form.email) {
                alert('Vui lòng nhập họ tên và email!');
                return;
            }
            if (!this.form.id && !this.form.mat_khau) {
                alert('Vui lòng nhập mật khẩu!');
                return;
            }

            const url = this.form.id 
                ? 'http://127.0.0.1:8000/api/admin/nhan-vien/update-data'
                : 'http://127.0.0.1:8000/api/admin/nhan-vien/add-data';

            axios.post(url, this.form)
                .then((res) => {
                    if (res.data.status) {
                        alert(res.data.message);
                        this.loadData();
                        bootstrap.Modal.getInstance(document.getElementById('addModal')).hide();
                    }
                });
        },
        deleteItem(item) {
            if (confirm('Xác nhận xóa nhân viên ' + item.ho_va_ten + '?')) {
                axios.post('http://127.0.0.1:8000/api/admin/nhan-vien/delete-data', { id: item.id })
                    .then((res) => {
                        if (res.data.status) {
                            alert(res.data.message);
                            this.loadData();
                        }
                    });
            }
        }
    },
    mounted() {
        this.loadData();
    },
}
</script>
<style>
</style>
