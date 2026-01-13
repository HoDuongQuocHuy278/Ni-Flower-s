# 🚀 Hướng Dẫn Cài Đặt Trên Máy Khác (Deployment Guide)

Tài liệu này hướng dẫn cách mang dự án **QuocHuy** sang chạy trên một máy tính mới hoàn toàn.

---

## 1. Yêu Cầu Cần Có (Prerequisites)
Trên máy mới, bạn chỉ cần cài đặt 2 thứ:
1.  **Docker Desktop**: [Tải tại đây](https://www.docker.com/products/docker-desktop/) (Bắt buộc).
2.  **Git**: [Tải tại đây](https://git-scm.com/downloads) (Để tải code về).

*Lưu ý: Không cần cài PHP, Node.js, MySQL hay XAMPP. Docker sẽ lo hết.*

---

## 2. Các Bước Cài Đặt

### Bước 1: Tải Code Về
Mở Terminal (hoặc CMD/PowerShell) và chạy:
```bash
git clone https://github.com/HoDuongQuocHuy278/Ni-Flower-s.git
cd Ni-Flower-s
```

### Bước 2: Cấu Hình Môi Trường
Dự án đã có sẵn file cấu hình Docker. Bạn chỉ cần đảm bảo file `.env` tồn tại (nếu chưa có thì tạo mới):
```bash
# Windows (PowerShell)
echo "COMPOSE_PROJECT_NAME=quochuy" > .env
```

### Bước 3: Khởi Chạy Docker
Chạy lệnh sau để Docker tự động tải, build và chạy mọi thứ:
```bash
docker-compose up -d --build
```
*Lần đầu chạy sẽ mất khoảng 5-10 phút để tải và build.*

### Bước 4: Cài Đặt Dữ Liệu (Chỉ chạy lần đầu)
Sau khi các container đã chạy (kiểm tra bằng `docker ps`), bạn cần tạo bảng và dữ liệu mẫu:

```bash
# 1. Cấp quyền cho thư mục storage (để upload ảnh không lỗi)
docker exec QuocHuy-backend chmod -R 775 storage bootstrap/cache
docker exec QuocHuy-backend chown -R www-data:www-data storage bootstrap/cache

# 2. Tạo shortcut cho thư mục ảnh
docker exec QuocHuy-backend php artisan storage:link

# 3. Chạy migration và seed dữ liệu mẫu
docker exec QuocHuy-backend php artisan migrate --seed
```

---

## 3. Truy Cập Sử Dụng
Sau khi cài đặt xong, bạn có thể truy cập ngay:

- **Trang Khách:** [http://localhost:3000](http://localhost:3000)
- **Trang Admin:** [http://localhost:3000/admin](http://localhost:3000/admin)
- **API Backend:** [http://localhost:8000](http://localhost:8000)
- **Quản lý Database (PHPMyAdmin):** [http://localhost:8080](http://localhost:8080)

**Tài khoản Admin mặc định:**
- Email: `admin@shophoa.com`
- Password: `123456`

---

## 4. Troubleshooting (Gỡ Lỗi)

**Q: Tôi không vào được localhost:3000?**
A: Kiểm tra xem Docker có đang chạy không. Thử tắt Skype hoặc các phần mềm chiếm port 80/443/3000.

**Q: Database trống trơn?**
A: Hãy chắc chắn bạn đã chạy lệnh `php artisan migrate --seed` ở Bước 4.

**Q: Upload ảnh bị lỗi?**
A: Chạy lại lệnh cấp quyền `chmod` và `chown` ở Bước 4.
