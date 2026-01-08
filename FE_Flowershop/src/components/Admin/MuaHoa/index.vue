<template>
    <div>
        <div class="container-fluid">
            <h3 class="mb-4">Quản Lý Mùa Hoa</h3>
            
            <!-- Form thêm/sửa -->
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <i class="fa fa-plus"></i> {{ isEdit ? 'Sửa' : 'Thêm' }} Mùa Hoa
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Tên Mùa</label>
                                <input type="text" class="form-control" v-model="form.ten_mua" placeholder="VD: Xuân, Hạ, Thu, Đông">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Mô Tả</label>
                                <input type="text" class="form-control" v-model="form.mo_ta" placeholder="Mô tả về mùa hoa">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label">Tình Trạng</label>
                                <select class="form-select" v-model="form.tinh_trang">
                                    <option value="1">Hoạt động</option>
                                    <option value="0">Ẩn</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button class="btn btn-success me-2" @click="save">
                                <i class="fa fa-save"></i> {{ isEdit ? 'Cập nhật' : 'Thêm' }}
                            </button>
                            <button class="btn btn-secondary" @click="resetForm" v-if="isEdit">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Danh sách -->
            <div class="card">
                <div class="card-header bg-info text-white">
                    <i class="fa fa-list"></i> Danh Sách Mùa Hoa
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th width="60">STT</th>
                                <th>Tên Mùa</th>
                                <th>Mô Tả</th>
                                <th width="120">Tình Trạng</th>
                                <th width="150">Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in list_data" :key="item.id">
                                <td>{{ index + 1 }}</td>
                                <td>{{ item.ten_mua }}</td>
                                <td>{{ item.mo_ta }}</td>
                                <td>
                                    <span class="badge" :class="item.tinh_trang == 1 ? 'bg-success' : 'bg-secondary'">
                                        {{ item.tinh_trang == 1 ? 'Hoạt động' : 'Ẩn' }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm me-1" @click="edit(item)">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" @click="deleteItem(item.id)">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr v-if="list_data.length === 0">
                                <td colspan="5" class="text-center">Chưa có dữ liệu</td>
                            </tr>
                        </tbody>
                    </table>
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
                ten_mua: '',
                mo_ta: '',
                tinh_trang: 1
            },
            isEdit: false
        }
    },
    methods: {
        loadData() {
            axios.get('http://localhost:8000/api/admin/mua-hoa/get-data')
                .then((res) => {
                    if (res.data.status) {
                        this.list_data = res.data.data;
                    }
                });
        },
        save() {
            if (!this.form.ten_mua) {
                alert('Vui lòng nhập tên mùa!');
                return;
            }
            
            const url = this.isEdit 
                ? 'http://localhost:8000/api/admin/mua-hoa/update-data'
                : 'http://localhost:8000/api/admin/mua-hoa/add-data';
            
            axios.post(url, this.form)
                .then((res) => {
                    if (res.data.status) {
                        alert(res.data.message);
                        this.resetForm();
                        this.loadData();
                    }
                });
        },
        edit(item) {
            this.form = { ...item };
            this.isEdit = true;
        },
        deleteItem(id) {
            if (confirm('Bạn có chắc muốn xóa?')) {
                axios.post('http://localhost:8000/api/admin/mua-hoa/delete-data', { id })
                    .then((res) => {
                        if (res.data.status) {
                            alert(res.data.message);
                            this.loadData();
                        }
                    });
            }
        },
        resetForm() {
            this.form = { id: null, ten_mua: '', mo_ta: '', tinh_trang: 1 };
            this.isEdit = false;
        }
    },
    mounted() {
        this.loadData();
    },
}
</script>
<style>
    
</style>
