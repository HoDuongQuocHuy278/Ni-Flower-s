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

                    <!-- MULTI-SELECT: Danh Mục, Mùa Hoa, Dịp Lễ -->
                    <div class="row">
                        <!-- Danh Mục (Nhiều danh mục) -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label fw-bold mb-0">📁 Danh Mục (Chọn nhiều)</label>
                                    <span class="badge bg-danger rounded-pill">{{ form.danh_muc_ids.length }} đã chọn</span>
                                </div>
                                <div class="multi-select-box p-2 border rounded bg-light" style="max-height: 150px; overflow-y: auto;">
                                    <div v-for="dm in list_danh_muc" :key="dm.id" class="form-check form-check-inline me-1 mb-1">
                                        <input class="btn-check" type="checkbox" :id="'dm-' + dm.id" :value="dm.id" v-model="form.danh_muc_ids">
                                        <label class="btn btn-sm" 
                                            :class="form.danh_muc_ids.includes(dm.id) ? 'btn-danger' : 'btn-outline-secondary'" 
                                            :for="'dm-' + dm.id">
                                            {{ dm.ten_danh_muc }}
                                        </label>
                                    </div>
                                    <div v-if="list_danh_muc.length === 0" class="text-muted small">Đang tải danh mục...</div>
                                </div>
                            </div>
                        </div>

                        <!-- Mùa Hoa (Nhiều mùa) -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label fw-bold mb-0">🍂 Mùa Hoa (Chọn nhiều)</label>
                                    <span class="badge bg-success rounded-pill">{{ form.mua_ids.length }} đã chọn</span>
                                </div>
                                <div class="multi-select-box p-2 border rounded bg-light" style="max-height: 150px; overflow-y: auto;">
                                    <div v-for="m in list_mua" :key="m.id" class="form-check form-check-inline me-1 mb-1">
                                        <input class="btn-check" type="checkbox" :id="'mua-' + m.id" :value="m.id" v-model="form.mua_ids">
                                        <label class="btn btn-sm" 
                                            :class="form.mua_ids.includes(m.id) ? 'btn-success' : 'btn-outline-secondary'" 
                                            :for="'mua-' + m.id">
                                            {{ m.ten_mua }}
                                        </label>
                                    </div>
                                    <div v-if="list_mua.length === 0" class="text-muted small">Đang tải mùa hoa...</div>
                                </div>
                            </div>
                        </div>

                        <!-- Dịp Lễ (Nhiều dịp) -->
                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <label class="form-label fw-bold mb-0">🎉 Dịp Lễ (Chọn nhiều)</label>
                                    <span class="badge bg-primary rounded-pill">{{ form.dip_le_ids.length }} đã chọn</span>
                                </div>
                                <div class="multi-select-box p-2 border rounded bg-light" style="max-height: 150px; overflow-y: auto;">
                                    <div v-for="d in list_dip_le" :key="d.id" class="form-check form-check-inline me-1 mb-1">
                                        <input class="btn-check" type="checkbox" :id="'dip-' + d.id" :value="d.id" v-model="form.dip_le_ids">
                                        <label class="btn btn-sm" 
                                            :class="form.dip_le_ids.includes(d.id) ? 'btn-primary' : 'btn-outline-secondary'" 
                                            :for="'dip-' + d.id">
                                            {{ d.ten_dip }}
                                        </label>
                                    </div>
                                    <div v-if="list_dip_le.length === 0" class="text-muted small">Đang tải dịp lễ...</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label"><i class="fab fa-facebook text-primary"></i> Facebook</label>
                                <input type="text" class="form-control" v-model="form.facebook" placeholder="Link/Username Facebook">
                                <!-- Gợi ý Facebook -->
                                <div class="suggestion-box mt-2" v-if="recentFacebooks.length > 0">
                                    <small class="text-muted d-block mb-1">
                                        <i class="fa fa-history me-1"></i> Đã dùng gần đây (bấm để chọn):
                                    </small>
                                    <div class="d-flex flex-wrap gap-1">
                                        <button type="button" 
                                            v-for="(fb, i) in recentFacebooks" :key="'fb-' + i" 
                                            class="btn btn-sm btn-outline-primary suggestion-btn text-truncate"
                                            :class="{ active: form.facebook === fb }"
                                            @click="form.facebook = fb"
                                            :title="fb">
                                            <i class="fab fa-facebook me-1"></i> {{ formatSuggestion(fb) }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label"><i class="fa fa-phone text-success"></i> Số Điện Thoại</label>
                                <input type="text" class="form-control" v-model="form.so_dien_thoai" placeholder="0912345678">
                                <!-- Gợi ý SĐT -->
                                <div class="suggestion-box mt-2" v-if="recentPhones.length > 0">
                                    <small class="text-muted d-block mb-1">
                                        <i class="fa fa-history me-1"></i> Đã dùng gần đây (bấm để chọn):
                                    </small>
                                    <div class="d-flex flex-wrap gap-1">
                                        <button type="button" 
                                            v-for="(phone, i) in recentPhones" :key="'phone-' + i" 
                                            class="btn btn-sm btn-outline-success suggestion-btn"
                                            :class="{ active: form.so_dien_thoai === phone }"
                                            @click="form.so_dien_thoai = phone">
                                            <i class="fa fa-phone me-1"></i> {{ phone }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="form-label mb-0"><i class="fa fa-comment text-info"></i> Zalo</label>
                                    <button v-if="form.so_dien_thoai && form.zalo !== form.so_dien_thoai" 
                                        type="button" 
                                        class="btn btn-link btn-sm p-0 text-info text-decoration-none small"
                                        @click="form.zalo = form.so_dien_thoai">
                                        <i class="fa fa-copy"></i> Dùng SĐT này
                                    </button>
                                </div>
                                <input type="text" class="form-control mt-1" v-model="form.zalo" placeholder="Số Zalo">
                                <!-- Gợi ý Zalo -->
                                <div class="suggestion-box mt-2" v-if="recentZalos.length > 0">
                                    <small class="text-muted d-block mb-1">
                                        <i class="fa fa-history me-1"></i> Đã dùng gần đây (bấm để chọn):
                                    </small>
                                    <div class="d-flex flex-wrap gap-1">
                                        <button type="button" 
                                            v-for="(z, i) in recentZalos" :key="'zalo-' + i" 
                                            class="btn btn-sm btn-outline-info suggestion-btn"
                                            :class="{ active: form.zalo === z }"
                                            @click="form.zalo = z">
                                            <i class="fa fa-comment me-1"></i> {{ z }}
                                        </button>
                                    </div>
                                </div>
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
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th width="40">STT</th>
                                    <th width="100">Ảnh</th>
                                    <th>Tên Bó Hoa</th>
                                    <th>Giá</th>
                                    <th>Giảm Giá</th>
                                    <th>Danh Mục</th>
                                    <th>Mùa</th>
                                    <th>Dịp</th>
                                    <th width="70">Nổi Bật</th>
                                    <th width="70">Trạng Thái</th>
                                    <th width="110">Hành Động</th>
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
                                        <br><small class="text-muted">{{ item.mo_ta?.substring(0, 45) }}...</small>
                                    </td>
                                    <td>{{ formatPrice(item.gia) }}đ</td>
                                    <td>
                                        <span v-if="item.phan_tram_giam" class="badge bg-danger">-{{ item.phan_tram_giam }}%</span>
                                        <span v-if="item.gia_giam"><br>{{ formatPrice(item.gia_giam) }}đ</span>
                                    </td>
                                    <!-- Danh mục (Nhiều danh mục) -->
                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                            <span v-for="dm in getDanhMucs(item)" :key="'tdm-' + dm.id" class="badge bg-secondary">
                                                {{ dm.ten_danh_muc }}
                                            </span>
                                            <span v-if="getDanhMucs(item).length === 0" class="text-muted small">-</span>
                                        </div>
                                    </td>
                                    <!-- Mùa (Nhiều mùa) -->
                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                            <span v-for="m in getMuas(item)" :key="'tm-' + m.id" class="badge bg-success">
                                                {{ m.ten_mua }}
                                            </span>
                                            <span v-if="getMuas(item).length === 0" class="text-muted small">-</span>
                                        </div>
                                    </td>
                                    <!-- Dịp (Nhiều dịp) -->
                                    <td>
                                        <div class="d-flex flex-wrap gap-1">
                                            <span v-for="d in getDips(item)" :key="'td-' + d.id" class="badge bg-info text-dark">
                                                {{ d.ten_dip }}
                                            </span>
                                            <span v-if="getDips(item).length === 0" class="text-muted small">-</span>
                                        </div>
                                    </td>
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
                                    <td colspan="11" class="text-center py-4">Chưa có bó hoa nào</td>
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
import axios from 'axios';
import { ipbe } from '@/config/api';

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
                danh_muc_ids: [],
                mua_ids: [],
                dip_le_ids: [],
                noi_bat: false,
                tinh_trang: 1
            },
            selectedFiles: [],
            previewImages: [],
            oldImageCount: 0,
            isEdit: false,
            saving: false
        };
    },
    computed: {
        recentFacebooks() {
            const set = new Set();
            this.list_data.forEach(item => {
                if (item.facebook && item.facebook.trim()) {
                    set.add(item.facebook.trim());
                }
            });
            set.add('https://www.facebook.com/profile.php?id=100095340766977');
            return Array.from(set);
        },
        recentPhones() {
            const set = new Set();
            this.list_data.forEach(item => {
                if (item.so_dien_thoai && item.so_dien_thoai.trim()) {
                    set.add(item.so_dien_thoai.trim());
                }
            });
            set.add('0905999276');
            return Array.from(set);
        },
        recentZalos() {
            const set = new Set();
            this.list_data.forEach(item => {
                if (item.zalo && item.zalo.trim()) {
                    set.add(item.zalo.trim());
                }
            });
            set.add('0905999276');
            return Array.from(set);
        }
    },
    methods: {
        loadData() {
            axios.get(ipbe + '/api/admin/bo-hoa/get-data')
                .then((res) => {
                    if (res.data.status) {
                        this.list_data = res.data.data;
                    }
                });
        },
        loadDanhMuc() {
            axios.get(ipbe + '/api/admin/danh-muc/get-data')
                .then((res) => {
                    if (res.data.status) {
                        this.list_danh_muc = res.data.data;
                    }
                });
        },
        loadMua() {
            axios.get(ipbe + '/api/admin/mua-hoa/get-data')
                .then((res) => {
                    if (res.data.status) {
                        this.list_mua = res.data.data;
                    }
                });
        },
        loadDipLe() {
            axios.get(ipbe + '/api/admin/dip-le/get-data')
                .then((res) => {
                    if (res.data.status) {
                        this.list_dip_le = res.data.data;
                    }
                });
        },
        getDanhMucs(item) {
            if (item.danh_mucs && item.danh_mucs.length > 0) return item.danh_mucs;
            if (item.danh_muc) return [item.danh_muc];
            return [];
        },
        getMuas(item) {
            if (item.mua_hoas && item.mua_hoas.length > 0) return item.mua_hoas;
            if (item.mua_hoa) return [item.mua_hoa];
            return [];
        },
        getDips(item) {
            if (item.dip_les && item.dip_les.length > 0) return item.dip_les;
            if (item.dip_le) return [item.dip_le];
            return [];
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
            if (index < this.oldImageCount) {
                this.oldImageCount--;
            } else {
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
            
            formData.append('ten_bo_hoa', this.form.ten_bo_hoa);
            formData.append('gia', this.form.gia);
            if (this.form.gia_giam) formData.append('gia_giam', this.form.gia_giam);
            if (this.form.phan_tram_giam) formData.append('phan_tram_giam', this.form.phan_tram_giam);
            if (this.form.mo_ta) formData.append('mo_ta', this.form.mo_ta);
            if (this.form.facebook) formData.append('facebook', this.form.facebook);
            if (this.form.so_dien_thoai) formData.append('so_dien_thoai', this.form.so_dien_thoai);
            if (this.form.zalo) formData.append('zalo', this.form.zalo);

            // Gửi mảng danh mục, mùa, dịp lễ
            this.form.danh_muc_ids.forEach(id => {
                formData.append('danh_muc_ids[]', id);
            });
            this.form.mua_ids.forEach(id => {
                formData.append('mua_ids[]', id);
            });
            this.form.dip_le_ids.forEach(id => {
                formData.append('dip_le_ids[]', id);
            });

            // Backward compat
            if (this.form.danh_muc_ids.length > 0) formData.append('id_danh_muc', this.form.danh_muc_ids[0]);
            if (this.form.mua_ids.length > 0) formData.append('id_mua', this.form.mua_ids[0]);
            if (this.form.dip_le_ids.length > 0) formData.append('id_dip_le', this.form.dip_le_ids[0]);

            formData.append('noi_bat', this.form.noi_bat ? 1 : 0);
            formData.append('tinh_trang', this.form.tinh_trang);
            
            if (this.isEdit) {
                formData.append('id', this.form.id);
                formData.append('keep_old_images', this.selectedFiles.length === 0 ? 1 : 0);
            }
            
            this.selectedFiles.forEach((file) => {
                formData.append('images[]', file);
            });
            
            const url = this.isEdit 
                ? ipbe + '/api/admin/bo-hoa/update-data'
                : ipbe + '/api/admin/bo-hoa/add-data';
            
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
            // Trích xuất danh sách ID danh mục, mùa, dịp từ quan hệ
            let danh_muc_ids = [];
            if (item.danh_mucs && Array.isArray(item.danh_mucs)) {
                danh_muc_ids = item.danh_mucs.map(d => d.id);
            } else if (item.id_danh_muc) {
                danh_muc_ids = [Number(item.id_danh_muc)];
            }

            let mua_ids = [];
            if (item.mua_hoas && Array.isArray(item.mua_hoas)) {
                mua_ids = item.mua_hoas.map(m => m.id);
            } else if (item.id_mua) {
                mua_ids = [Number(item.id_mua)];
            }

            let dip_le_ids = [];
            if (item.dip_les && Array.isArray(item.dip_les)) {
                dip_le_ids = item.dip_les.map(d => d.id);
            } else if (item.id_dip_le) {
                dip_le_ids = [Number(item.id_dip_le)];
            }

            this.form = {
                id: item.id,
                ten_bo_hoa: item.ten_bo_hoa,
                gia: item.gia,
                gia_giam: item.gia_giam,
                phan_tram_giam: item.phan_tram_giam,
                mo_ta: item.mo_ta,
                facebook: item.facebook || '',
                so_dien_thoai: item.so_dien_thoai || '',
                zalo: item.zalo || '',
                danh_muc_ids: danh_muc_ids,
                mua_ids: mua_ids,
                dip_le_ids: dip_le_ids,
                noi_bat: Boolean(item.noi_bat),
                tinh_trang: item.tinh_trang
            };

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
            
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },
        deleteItem(id) {
            if (confirm('Bạn có chắc muốn xóa bó hoa này?')) {
                axios.post(ipbe + '/api/admin/bo-hoa/delete-data', { id })
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
                danh_muc_ids: [],
                mua_ids: [],
                dip_le_ids: [],
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
        formatSuggestion(val) {
            if (!val) return '';
            if (val.length > 28) {
                return val.substring(0, 25) + '...';
            }
            return val;
        },
        getImageUrl(path) {
            if (!path) return 'https://via.placeholder.com/60x60?text=🌸';
            if (path.startsWith('http')) return path;
            return ipbe + '' + path;
        }
    },
    mounted() {
        this.loadData();
        this.loadDanhMuc();
        this.loadMua();
        this.loadDipLe();
    },
};
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
    width: 55px;
    height: 55px;
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

.multi-select-box {
    border-color: #e0e0e0;
    scrollbar-width: thin;
}

.suggestion-box {
    background: #fbfbfd;
    padding: 7px 10px;
    border-radius: 10px;
    border: 1px dashed #d5d8dc;
}

.suggestion-btn {
    border-radius: 20px;
    font-size: 0.76rem;
    padding: 3px 10px;
    transition: all 0.2s ease;
    max-width: 100%;
    white-space: nowrap;
}

.suggestion-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
}
</style>
