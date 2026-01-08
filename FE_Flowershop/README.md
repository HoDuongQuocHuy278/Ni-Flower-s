<div align="center">

# 🌸 Flowershop Frontend

<img src="https://img.shields.io/badge/Vue.js-3.3.4-4FC08D?style=for-the-badge&logo=vue.js&logoColor=white" alt="Vue.js"/>
<img src="https://img.shields.io/badge/Vite-4.4.5-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite"/>
<img src="https://img.shields.io/badge/JavaScript-ES6+-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript"/>

<p align="center">
  <strong>🌺 Website bán hoa trực tuyến hiện đại với giao diện đẹp mắt và trải nghiệm người dùng tuyệt vời</strong>
</p>

<p align="center">
  <a href="#-tính-năng">Tính năng</a> •
  <a href="#-công-nghệ">Công nghệ</a> •
  <a href="#-cài-đặt">Cài đặt</a> •
  <a href="#-cấu-trúc-dự-án">Cấu trúc</a> •
  <a href="#-đóng-góp">Đóng góp</a>
</p>

---

</div>

## ✨ Tính năng

### 🛒 Khách hàng (Client)
| Tính năng | Mô tả |
|-----------|-------|
| 🏠 **Trang chủ** | Giao diện chính với banner, sản phẩm nổi bật |
| 📂 **Danh mục** | Xem hoa theo danh mục, mùa, dịp lễ |
| 💐 **Chi tiết bó hoa** | Xem thông tin chi tiết, hình ảnh, giá cả |
| 📰 **Bài viết** | Tin tức, hướng dẫn chăm sóc hoa |
| 🎉 **Dịp lễ** | Bộ sưu tập hoa theo các dịp đặc biệt |

### ⚙️ Quản trị viên (Admin)
| Tính năng | Mô tả |
|-----------|-------|
| 📊 **Dashboard** | Tổng quan thống kê, biểu đồ |
| 🌹 **Quản lý bó hoa** | Thêm, sửa, xóa sản phẩm |
| 📁 **Quản lý danh mục** | Phân loại sản phẩm |
| 🌷 **Quản lý mùa hoa** | Cập nhật hoa theo mùa |
| 🎊 **Quản lý dịp lễ** | Thiết lập bộ sưu tập theo sự kiện |
| 👨‍💼 **Quản lý nhân viên** | Phân quyền, quản lý tài khoản |
| 🏷️ **Quản lý chức vụ** | Thiết lập vai trò & quyền hạn |
| 📝 **Quản lý bài viết** | Đăng tin, cập nhật nội dung |

---

## 🛠️ Công nghệ

<div align="center">

| Công nghệ | Phiên bản | Mô tả |
|:---------:|:---------:|:-----:|
| <img src="https://vuejs.org/images/logo.png" width="40"/> | 3.3.4 | Framework JavaScript |
| <img src="https://vitejs.dev/logo.svg" width="40"/> | 4.4.5 | Build tool siêu nhanh |
| <img src="https://router.vuejs.org/logo.svg" width="40"/> | 4.0.13 | Vue Router |
| <img src="https://axios-http.com/assets/logo.svg" width="40"/> | 1.13.2 | HTTP Client |

</div>

### 📦 Dependencies chính
```json
{
  "vue": "^3.3.4",
  "vue-router": "^4.0.13",
  "axios": "^1.13.2",
  "v-calendar": "^3.1.2",
  "@meforma/vue-toaster": "^1.3.0",
  "@popperjs/core": "^2.11.8"
}
```

---

## 🚀 Cài đặt

### Yêu cầu hệ thống
- **Node.js** >= 16.x
- **npm** >= 8.x hoặc **yarn** >= 1.22.x

### Các bước cài đặt

```bash
# 1️⃣ Clone repository
git clone https://github.com/HoDuongQuocHuy278/Flowershop-FE.git

# 2️⃣ Di chuyển vào thư mục dự án
cd Flowershop-FE

# 3️⃣ Cài đặt dependencies
npm install

# 4️⃣ Chạy development server
npm run dev

# 5️⃣ Build production
npm run build

# 6️⃣ Preview production build
npm run preview
```

### 🌐 Truy cập ứng dụng
- **Development**: `http://localhost:5173`
- **Admin Panel**: `http://localhost:5173/admin`

---

## 📁 Cấu trúc dự án

```
FE_Flowershop/
├── 📂 public/                  # Static assets
├── 📂 src/
│   ├── 📂 assets/              # Hình ảnh, fonts, styles
│   ├── 📂 components/
│   │   ├── 📂 Admin/           # Components quản trị
│   │   │   ├── 📂 BaiViet/     # Quản lý bài viết
│   │   │   ├── 📂 BoHoa/       # Quản lý bó hoa
│   │   │   ├── 📂 ChucVu/      # Quản lý chức vụ
│   │   │   ├── 📂 DangNhap/    # Đăng nhập admin
│   │   │   ├── 📂 DanhMuc/     # Quản lý danh mục
│   │   │   ├── 📂 Dashboard/   # Bảng điều khiển
│   │   │   ├── 📂 DipLe/       # Quản lý dịp lễ
│   │   │   ├── 📂 MuaHoa/      # Quản lý mùa hoa
│   │   │   └── 📂 NhanVien/    # Quản lý nhân viên
│   │   └── 📂 Client/          # Components khách hàng
│   │       ├── 📂 BaiViet/     # Trang bài viết
│   │       ├── 📂 ChiTietBaiViet/
│   │       ├── 📂 ChiTietBoHoa/
│   │       ├── 📂 DanhMuc/     # Trang danh mục
│   │       └── 📂 TrangChu/    # Trang chủ
│   ├── 📂 layout/              # Layout components
│   │   ├── 📂 components/      # Header, Footer, Sidebar
│   │   └── 📂 wrapper/         # Layout wrappers
│   ├── 📂 router/              # Vue Router config
│   ├── 📄 App.vue              # Root component
│   ├── 📄 main.js              # Entry point
│   └── 📄 style.css            # Global styles
├── 📄 index.html               # HTML template
├── 📄 package.json             # Dependencies
├── 📄 vite.config.js           # Vite configuration
└── 📄 README.md                # Documentation
```

---

## 🔗 API Routes

### 👥 Client Routes
| Route | Mô tả |
|-------|-------|
| `/` | Trang chủ |
| `/danh-muc` | Danh sách sản phẩm |
| `/mua/:id` | Sản phẩm theo mùa |
| `/dip-le/:id` | Sản phẩm theo dịp lễ |
| `/chi-tiet/:id` | Chi tiết bó hoa |
| `/bai-viet` | Danh sách bài viết |
| `/chi-tiet-bai-viet/:id` | Chi tiết bài viết |

### 🔐 Admin Routes
| Route | Mô tả | Quyền |
|-------|-------|-------|
| `/admin` | Dashboard | Staff + Admin |
| `/admin/dang-nhap` | Đăng nhập | Public |
| `/admin/bo-hoa` | Quản lý bó hoa | Staff + Admin |
| `/admin/danh-muc` | Quản lý danh mục | Staff + Admin |
| `/admin/mua-hoa` | Quản lý mùa hoa | Staff + Admin |
| `/admin/dip-le` | Quản lý dịp lễ | Staff + Admin |
| `/admin/bai-viet` | Quản lý bài viết | Staff + Admin |
| `/admin/nhan-vien` | Quản lý nhân viên | **Admin only** |
| `/admin/chuc-vu` | Quản lý chức vụ | **Admin only** |

---

## 🎨 Screenshots

<div align="center">

| Trang chủ | Danh mục | Chi tiết sản phẩm |
|:---------:|:--------:|:-----------------:|
| 🏠 | 📂 | 💐 |

| Admin Dashboard | Quản lý sản phẩm | Quản lý nhân viên |
|:---------------:|:----------------:|:-----------------:|
| 📊 | 🌹 | 👨‍💼 |

</div>

---

## 📝 Scripts

```bash
# Chạy development server với hot-reload
npm run dev

# Build production
npm run build

# Preview bản build production
npm run preview
```

---

## 🤝 Đóng góp

Mọi đóng góp đều được chào đón! Hãy làm theo các bước sau:

1. **Fork** repository này
2. **Tạo branch** mới (`git checkout -b feature/TinhNangMoi`)
3. **Commit** thay đổi (`git commit -m 'Thêm tính năng mới'`)
4. **Push** lên branch (`git push origin feature/TinhNangMoi`)
5. **Tạo Pull Request**

---

## 👨‍💻 Tác giả

<div align="center">

**Hồ Dương Quốc Huy**

[![GitHub](https://img.shields.io/badge/GitHub-HoDuongQuocHuy278-181717?style=for-the-badge&logo=github)](https://github.com/HoDuongQuocHuy278)

</div>

---

## 📄 License

<div align="center">

Dự án này được cấp phép theo **MIT License**.

---

<p align="center">
  <sub>Made with ❤️ and Vue.js</sub>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Status-Active-success?style=flat-square" alt="Status"/>
  <img src="https://img.shields.io/badge/PRs-Welcome-brightgreen?style=flat-square" alt="PRs Welcome"/>
</p>

</div>
