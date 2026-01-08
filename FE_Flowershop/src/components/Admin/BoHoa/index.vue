<template>
    <div>
        <div class="container-fluid">
            <h3 class="mb-4">🌸 Quản Lý Bó Hoa</h3>
            
            <!-- Form thêm/sửa -->
            <div class="card mb-4">
                <div class="card-header bg-pink text-white" style="background: linear-gradient(135deg, #ff6b9d, #c2185b);">
                    <i class="fa fa-plus"></i> {{ isEdit ? 'Sửa' : 'Thêm' }} Bó Hoa
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Tên Bó Hoa <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" v-model="form.ten_bo_hoa" placeholder="VD: Bó hồng đỏ tình yêu">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label">Giá (VNĐ) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" v-model="form.gia" placeholder="500000">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label">% Giảm Giá</label>
                                <input type="number" class="form-control" v-model="form.phan_tram_giam" placeholder="10" @input="tinhGiaGiam">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label">Giá Sau Giảm</label>
                                <input type="number" class="form-control" v-model="form.gia_giam" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label">Nổi Bật</label>
                                <select class="form-select" v-model="form.noi_bat">
                                    <option :value="false">Không</option>
                                    <option :value="true">Có</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Danh Mục</label>
                                <select class="form-select" v-model="form.id_danh_muc">
                                    <option value="">-- Chọn danh mục --</option>
                                    <option v-for="dm in list_danh_muc" :key="dm.id" :value="dm.id">{{ dm.ten_danh_muc }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Mùa Hoa</label>
                                <select class="form-select" v-model="form.id_mua">
                                    <option value="">-- Chọn mùa --</option>
                                    <option v-for="m in list_mua" :key="m.id" :value="m.id">{{ m.ten_mua }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Dịp Lễ</label>
                                <select class="form-select" v-model="form.id_dip_le">
                                    <option value="">-- Chọn dịp lễ --</option>
                                    <option v-for="d in list_dip_le" :key="d.id" :value="d.id">{{ d.ten_dip }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label"><i class="fab fa-facebook text-primary"></i> Facebook</label>
                                <input type="text" class="form-control" v-model="form.facebook" placeholder="Link/Username Facebook">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label"><i class="fa fa-phone text-success"></i> Số Điện Thoại</label>
                                <input type="text" class="form-control" v-model="form.so_dien_thoai" placeholder="0912345678">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label"><i class="fa fa-comment text-info"></i> Zalo</label>
                                <input type="text" class="form-control" v-model="form.zalo" placeholder="Số Zalo">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Mô Tả</label>
                                <textarea class="form-control" v-model="form.mo_ta" rows="3" placeholder="Mô tả chi tiết về bó hoa..."></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">📷 Hình Ảnh (Tối đa 5 ảnh)</label>
                                <input type="file" class="form-control" @change="chonNhieuAnh" accept="image/*" multiple ref="fileInput">
                                <small class="text-muted">
                                    <span v-if="isEdit">Chọn ảnh mới sẽ thay thế tất cả ảnh cũ. </span>
                                    Ảnh đầu tiên sẽ là ảnh chính.
                                </small>
                                
                                <!-- Preview ảnh -->
                                <div class="preview-images mt-2" v-if="previewImages.length > 0">
                                    <div class="preview-item" v-for="(img, index) in previewImages" :key="index">
                                        <img :src="img" class="preview-img">
                                        <span class="preview-badge" v-if="index === 0">Chính</span>
                                        <span class="preview-badge-old" v-if="isOldImage(index)">Cũ</span>
                                        <button type="button" class="preview-remove" @click="removeImage(index)">×</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label">Tình Trạng</label>
                                <select class="form-select" v-model="form.tinh_trang">
                                    <option value="1">Còn hàng</option>
                                    <option value="0">Hết hàng</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-10 d-flex align-items-end">
                            <button class="btn btn-success me-2" @click="save" :disabled="saving">
                                <i class="fa fa-save"></i> {{ saving ? 'Đang lưu...' : (isEdit ? 'Cập nhật' : 'Thêm mới') }}
                            </button>
                            <button class="btn btn-secondary" @click="resetForm" v-if="isEdit">
                                <i class="fa fa-times"></i> Hủy
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Danh sách -->
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <i class="fa fa-list"></i> Danh Sách Bó Hoa ({{ list_data.length }})
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th width="50">STT</th>
                                    <th width="120">Ảnh</th>
                                    <th>Tên Bó Hoa</th>
                                    <th>Giá</th>
                                    <th>Giảm Giá</th>
                                    <th>Danh Mục</th>
                                    <th>Mùa</th>
                                    <th>Dịp</th>
                                    <th width="80">Nổi Bật</th>
                                    <th width="80">Trạng Thái</th>
                                    <th width="120">Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in list_data" :key="item.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>
                                        <div class="table-images">
                                            <img :src="getImageUrl(item.hinh_anh)" class="main-thumb">
                                            <span v-if="countImages(item) > 1" class="image-count">+{{ countImages(item) - 1 }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <strong>{{ item.ten_bo_hoa }}</strong>
                                        <br><small class="text-muted">{{ item.mo_ta?.substring(0, 50) }}...</small>
                                    </td>
                                    <td>{{ formatPrice(item.gia) }}đ</td>
                                    <td>
                                        <span v-if="item.phan_tram_giam" class="badge bg-danger">-{{ item.phan_tram_giam }}%</span>
                                        <span v-if="item.gia_giam"><br>{{ formatPrice(item.gia_giam) }}đ</span>
                                    </td>
                                    <td>{{ item.danh_muc?.ten_danh_muc }}</td>
                                    <td>{{ item.mua_hoa?.ten_mua }}</td>
                                    <td>{{ item.dip_le?.ten_dip }}</td>
                                    <td>
                                        <span class="badge" :class="item.noi_bat ? 'bg-warning' : 'bg-secondary'">
                                            {{ item.noi_bat ? '⭐' : '-' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge" :class="item.tinh_trang == 1 ? 'bg-success' : 'bg-danger'">
                                            {{ item.tinh_trang == 1 ? 'Còn' : 'Hết' }}
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
                                    <td colspan="11" class="text-center">Chưa có bó hoa nào</td>
                                </tr>
                            </tbody>
                        </table>
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
            list_danh_muc: [],
            list_mua: [],
            list_dip_le: [],
            form: {
                id: null,
                ten_bo_hoa: '',
                gia: '',
                gia_giam: '',
                phan_tram_giam: '',
                mo_ta: '',
                facebook: '',
                so_dien_thoai: '',
                zalo: '',
                id_danh_muc: '',
                id_mua: '',
                id_dip_le: '',
                noi_bat: false,
                tinh_trang: 1
            },
            selectedFiles: [],
            previewImages: [],
            oldImageCount: 0, // Số lượng ảnh cũ khi edit
            isEdit: false,
            saving: false
        }
    },
    methods: {
        loadData() {
            axios.get('http://127.0.0.1:8000/api/admin/bo-hoa/get-data')
                .then((res) => {
                    if (res.data.status) {
                        this.list_data = res.data.data;
                    }
                });
        },
        loadDanhMuc() {
            axios.get('http://127.0.0.1:8000/api/admin/danh-muc/get-data')
                .then((res) => {
                    if (res.data.status) {
                        this.list_danh_muc = res.data.data;
                    }
                });
        },
        loadMua() {
            axios.get('http://127.0.0.1:8000/api/admin/mua-hoa/get-data')
                .then((res) => {
                    if (res.data.status) {
                        this.list_mua = res.data.data;
                    }
                });
        },
        loadDipLe() {
            axios.get('http://127.0.0.1:8000/api/admin/dip-le/get-data')
                .then((res) => {
                    if (res.data.status) {
                        this.list_dip_le = res.data.data;
                    }
                });
        },
        tinhGiaGiam() {
            if (this.form.gia && this.form.phan_tram_giam) {
                this.form.gia_giam = Math.round(this.form.gia * (1 - this.form.phan_tram_giam / 100));
            } else {
                this.form.gia_giam = '';
            }
        },
        chonNhieuAnh(event) {
            const files = Array.from(event.target.files);
            
            // Nếu đang edit và chọn ảnh mới, xóa hết ảnh cũ preview
            if (this.isEdit && this.oldImageCount > 0) {
                this.previewImages = [];
                this.selectedFiles = [];
                this.oldImageCount = 0;
            }
            
            const totalImages = this.previewImages.length + files.length;
            
            if (totalImages > 5) {
                alert('Chỉ được chọn tối đa 5 ảnh!');
                return;
            }
            
            files.forEach(file => {
                this.selectedFiles.push(file);
                this.previewImages.push(URL.createObjectURL(file));
            });
        },
        removeImage(index) {
            this.previewImages.splice(index, 1);
            
            // Nếu là ảnh cũ (khi edit)
            if (index < this.oldImageCount) {
                this.oldImageCount--;
            } else {
                // Nếu là ảnh mới
                const newIndex = index - this.oldImageCount;
                this.selectedFiles.splice(newIndex, 1);
            }
        },
        isOldImage(index) {
            return this.isEdit && index < this.oldImageCount;
        },
        countImages(item) {
            let count = item.hinh_anh ? 1 : 0;
            if (item.hinh_anh_phu) {
                try {
                    const extra = JSON.parse(item.hinh_anh_phu);
                    if (Array.isArray(extra)) count += extra.length;
                } catch (e) {
                    if (item.hinh_anh_phu) count += 1;
                }
            }
            return count;
        },
        save() {
            if (!this.form.ten_bo_hoa || !this.form.gia) {
                alert('Vui lòng nhập tên bó hoa và giá!');
                return;
            }
            
            this.saving = true;
            const formData = new FormData();
            
            // Append form fields
            formData.append('ten_bo_hoa', this.form.ten_bo_hoa);
            formData.append('gia', this.form.gia);
            if (this.form.gia_giam) formData.append('gia_giam', this.form.gia_giam);
            if (this.form.phan_tram_giam) formData.append('phan_tram_giam', this.form.phan_tram_giam);
            if (this.form.mo_ta) formData.append('mo_ta', this.form.mo_ta);
            if (this.form.facebook) formData.append('facebook', this.form.facebook);
            if (this.form.so_dien_thoai) formData.append('so_dien_thoai', this.form.so_dien_thoai);
            if (this.form.zalo) formData.append('zalo', this.form.zalo);
            if (this.form.id_danh_muc) formData.append('id_danh_muc', this.form.id_danh_muc);
            if (this.form.id_mua) formData.append('id_mua', this.form.id_mua);
            if (this.form.id_dip_le) formData.append('id_dip_le', this.form.id_dip_le);
            formData.append('noi_bat', this.form.noi_bat ? 1 : 0);
            formData.append('tinh_trang', this.form.tinh_trang);
            
            if (this.isEdit) {
                formData.append('id', this.form.id);
                // Nếu không chọn ảnh mới, giữ ảnh cũ
                formData.append('keep_old_images', this.selectedFiles.length === 0 ? 1 : 0);
            }
            
            // Append tất cả ảnh mới
            this.selectedFiles.forEach((file, index) => {
                formData.append('images[]', file);
            });
            
            const url = this.isEdit 
                ? 'http://127.0.0.1:8000/api/admin/bo-hoa/update-data'
                : 'http://127.0.0.1:8000/api/admin/bo-hoa/add-data';
            
            axios.post(url, formData, {
                headers: { 'Content-Type': 'multipart/form-data' }
            })
                .then((res) => {
                    this.saving = false;
                    if (res.data.status) {
                        alert(res.data.message);
                        this.resetForm();
                        this.loadData();
                    } else {
                        alert(res.data.message || 'Có lỗi xảy ra!');
                    }
                })
                .catch((err) => {
                    this.saving = false;
                    alert('Có lỗi xảy ra khi lưu!');
                    console.error(err);
                });
        },
        edit(item) {
            this.form = { ...item };
            this.isEdit = true;
            this.previewImages = [];
            this.selectedFiles = [];
            this.oldImageCount = 0;
            
            // Load ảnh chính
            if (item.hinh_anh) {
                this.previewImages.push(this.getImageUrl(item.hinh_anh));
                this.oldImageCount++;
            }
            
            // Load ảnh phụ
            if (item.hinh_anh_phu) {
                try {
                    const extra = JSON.parse(item.hinh_anh_phu);
                    if (Array.isArray(extra)) {
                        extra.forEach(img => {
                            this.previewImages.push(this.getImageUrl(img));
                            this.oldImageCount++;
                        });
                    }
                } catch (e) {
                    if (item.hinh_anh_phu) {
                        this.previewImages.push(this.getImageUrl(item.hinh_anh_phu));
                        this.oldImageCount++;
                    }
                }
            }
            
            // Scroll to form
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },
        deleteItem(id) {
            if (confirm('Bạn có chắc muốn xóa bó hoa này?')) {
                axios.post('http://127.0.0.1:8000/api/admin/bo-hoa/delete-data', { id })
                    .then((res) => {
                        if (res.data.status) {
                            alert(res.data.message);
                            this.loadData();
                        }
                    });
            }
        },
        resetForm() {
            this.form = {
                id: null,
                ten_bo_hoa: '',
                gia: '',
                gia_giam: '',
                phan_tram_giam: '',
                mo_ta: '',
                facebook: '',
                so_dien_thoai: '',
                zalo: '',
                id_danh_muc: '',
                id_mua: '',
                id_dip_le: '',
                noi_bat: false,
                tinh_trang: 1
            };
            this.selectedFiles = [];
            this.previewImages = [];
            this.oldImageCount = 0;
            this.isEdit = false;
            if (this.$refs.fileInput) {
                this.$refs.fileInput.value = '';
            }
        },
        formatPrice(price) {
            return new Intl.NumberFormat('vi-VN').format(price);
        },
        getImageUrl(path) {
            if (!path) return 'https://via.placeholder.com/60x60?text=🌸';
            if (path.startsWith('http')) return path;
            return 'http://127.0.0.1:8000' + path;
        }
    },
    mounted() {
        this.loadData();
        this.loadDanhMuc();
        this.loadMua();
        this.loadDipLe();
    },
}
</script>
<style>
/* Preview Images */
.preview-images {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}
.preview-item {
    position: relative;
    width: 80px;
    height: 80px;
}
.preview-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 10px;
    border: 2px solid #ddd;
}
.preview-badge {
    position: absolute;
    bottom: 5px;
    left: 5px;
    background: #e91e63;
    color: white;
    font-size: 10px;
    padding: 2px 6px;
    border-radius: 10px;
}
.preview-badge-old {
    position: absolute;
    top: 5px;
    left: 5px;
    background: #6c757d;
    color: white;
    font-size: 9px;
    padding: 2px 5px;
    border-radius: 8px;
}
.preview-remove {
    position: absolute;
    top: -8px;
    right: -8px;
    background: #dc3545;
    color: white;
    border: none;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 14px;
    line-height: 1;
}
.preview-remove:hover {
    background: #c82333;
}

/* Table Images */
.table-images {
    position: relative;
    display: inline-block;
}
.main-thumb {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 8px;
}
.image-count {
    position: absolute;
    bottom: 2px;
    right: 2px;
    background: rgba(0,0,0,0.7);
    color: white;
    font-size: 11px;
    padding: 2px 6px;
    border-radius: 10px;
}
</style>
