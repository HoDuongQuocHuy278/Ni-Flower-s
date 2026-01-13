# 📘 Hướng Dẫn Phát Triển & Cập Nhật Docker (Dev Guide)

Tài liệu này hướng dẫn cách làm việc với dự án **QuocHuy** trên môi trường Docker.

---

## 1. Cấu Trúc Docker Hiện Tại
Dự án bao gồm 4 containers chính:
- **`QuocHuy-frontend`**: Chạy VueJS (Port 3000).
- **`QuocHuy-backend`**: Chạy Laravel PHP (Port 9000 nội bộ).
- **`QuocHuy-nginx-backend`**: Server Nginx để chạy Laravel (Port 8000).
- **`QuocHuy-mysql`**: Database MySQL 8.0 (Port 3307).

---

## 2. Quy Trình Cập Nhật Code (Quan Trọng)

### 🟢 Trường hợp 1: Sửa code Frontend (VueJS)
Vì Frontend được build ra file tĩnh (HTML/CSS/JS), nên mỗi khi sửa code Vue, bạn **BẮT BUỘC PHẢI BUILD LẠI** container.

**Ví dụ:** Bạn sửa màu nút bấm, sửa lỗi hiển thị, thêm component mới...

**Lệnh thực hiện:**
```bash
# 1. Build lại riêng frontend (thêm --no-cache để chắc chắn nhận code mới)
docker-compose build frontend --no-cache

# 2. Chạy lại container frontend để áp dụng thay đổi
docker-compose up -d frontend
```
*Mẹo: Nếu trình duyệt vẫn hiện cũ, hãy nhấn `Ctrl + Shift + R` để xóa cache trình duyệt.*

---

### 🔵 Trường hợp 2: Sửa code Backend (Laravel/PHP)
Backend được cấu hình "mount volume" (ánh xạ thư mục), nghĩa là file trên máy thật và trong Docker là một.
- **Sửa code logic (Controller, Model, Route):** -> **KHÔNG CẦN LÀM GÌ CẢ**. Lưu file là chạy luôn.
- **Thêm thư viện mới (Composer):** -> Cần chạy lệnh cài đặt trong container.
- **Sửa file cấu hình (.env, config):** -> Cần restart container.

**Ví dụ 1: Sửa logic Controller**
- Bạn sửa file `BoHoaController.php`.
- -> Chỉ cần lưu file, F5 trình duyệt là nhận ngay.

**Ví dụ 2: Sửa file .env hoặc config**
```bash
# Restart backend để nhận cấu hình mới
docker-compose restart backend
```

**Ví dụ 3: Cài thêm thư viện mới**
```bash
# Chạy lệnh composer bên trong container đang chạy
docker exec QuocHuy-backend composer require ten-goi-thu-vien
```

---

## 3. Các Lệnh Thường Dùng

### Khởi động dự án
```bash
docker-compose up -d
```

### Dừng dự án
```bash
docker-compose down
```

### Xem danh sách container đang chạy
```bash
docker ps
```

### Xem log lỗi (Rất quan trọng khi debug)
```bash
# Xem log của backend
docker logs -f QuocHuy-backend

# Xem log của frontend
docker logs -f QuocHuy-frontend

# Xem log của Nginx (lỗi 404, 500, 413...)
docker logs -f QuocHuy-nginx-backend
```

### Chạy lệnh Artisan (Laravel)
Thay vì gõ `php artisan ...`, bạn gõ:
```bash
docker exec QuocHuy-backend php artisan <tên-lệnh>
```
Ví dụ:
- `docker exec QuocHuy-backend php artisan migrate`
- `docker exec QuocHuy-backend php artisan make:controller AbcController`

---

## 4. Xử Lý Sự Cố Thường Gặp

**Lỗi: Upload ảnh bị lỗi 413 (Too Large)**
- Đã được cấu hình sẵn lên 50MB. Nếu muốn tăng thêm, sửa file `uploads.ini` và `nginx/backend.conf`, sau đó restart.

**Lỗi: Không kết nối được Database**
- Kiểm tra xem container `QuocHuy-mysql` có đang chạy không (`docker ps`).
- Đảm bảo `.env` backend cấu hình `DB_HOST=mysql`.
