<template>
    <div>
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="mb-0">🏷️ Quản Lý Chức Vụ</h3>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal" @click="resetForm">
                    <i class="fa fa-plus"></i> Thêm Chức Vụ
                </button>
            </div>

            <!-- Alert -->
            <div class="alert alert-info mb-4">
                <i class="fa fa-info-circle"></i> <strong>Phân quyền:</strong> Chức vụ có quyền <strong>Admin</strong> sẽ được truy cập tất cả chức năng. Chức vụ <strong>Nhân viên</strong> sẽ không thể quản lý nhân viên và chức vụ.
            </div>

            <!-- Table -->
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th width="50">#</th>
                                    <th>Tên Chức Vụ</th>
                                    <th>Mô Tả</th>
                                    <th>Quyền</th>
                                    <th>Trạng Thái</th>
                                    <th width="150">Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in list_data" :key="item.id">
                                    <td>{{ index + 1 }}</td>
                                    <td class="fw-bold">{{ item.ten_chuc_vu }}</td>
                                    <td>{{ item.mo_ta }}</td>
                                    <td>
                                        <span class="badge" :class="item.quyen == 1 ? 'bg-danger' : 'bg-secondary'">
                                            {{ item.quyen == 1 ? '👑 Admin' : '👤 Nhân viên' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge" :class="item.tinh_trang == 1 ? 'bg-success' : 'bg-secondary'">
                                            {{ item.tinh_trang == 1 ? 'Hoạt động' : 'Ẩn' }}
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
                                    <td colspan="6" class="text-center py-4 text-muted">Chưa có chức vụ</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add/Edit Modal -->
        <div class="modal fade" id="addModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">{{ form.id ? 'Cập Nhật' : 'Thêm' }} Chức Vụ</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Tên Chức Vụ <span class="text-danger">*</span></label>
                            <input v-model="form.ten_chuc_vu" type="text" class="form-control" placeholder="VD: Admin, Nhân viên bán hàng...">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mô Tả</label>
                            <input v-model="form.mo_ta" type="text" class="form-control" placeholder="Mô tả ngắn về chức vụ">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Quyền Hạn</label>
                            <select v-model="form.quyen" class="form-select">
                                <option :value="1">👑 Admin - Toàn quyền</option>
                                <option :value="0">👤 Nhân viên - Hạn chế</option>
                            </select>
                            <small class="text-muted">Admin có thể quản lý nhân viên và chức vụ</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Trạng Thái</label>
                            <select v-model="form.tinh_trang" class="form-select">
                                <option :value="1">Hoạt động</option>
                                <option :value="0">Ẩn</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-primary" @click="saveData">
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
            form: {
                id: null,
                ten_chuc_vu: '',
                mo_ta: '',
                quyen: 0,
                tinh_trang: 1
            }
        }
    },
    methods: {
        loadData() {
            axios.get('http://localhost:8000/api/admin/chuc-vu/get-data')
                .then((res) => {
                    if (res.data.status) {
                        this.list_data = res.data.data;
                    }
                });
        },
        resetForm() {
            this.form = { id: null, ten_chuc_vu: '', mo_ta: '', quyen: 0, tinh_trang: 1 };
        },
        editItem(item) {
            this.form = { ...item };
        },
        saveData() {
            if (!this.form.ten_chuc_vu) {
                alert('Vui lòng nhập tên chức vụ!');
                return;
            }

            const url = this.form.id 
                ? 'http://localhost:8000/api/admin/chuc-vu/update-data'
                : 'http://localhost:8000/api/admin/chuc-vu/add-data';

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
            if (confirm('Xác nhận xóa chức vụ ' + item.ten_chuc_vu + '?')) {
                axios.post('http://localhost:8000/api/admin/chuc-vu/delete-data', { id: item.id })
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
