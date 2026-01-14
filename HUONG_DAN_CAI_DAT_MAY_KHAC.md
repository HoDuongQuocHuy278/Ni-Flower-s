# 🚀 Hướng Dẫn Cài Đặt Dự Án Trên Máy Khác

Tài liệu này hướng dẫn chi tiết cách cài đặt dự án **Flowershop** trên một máy tính mới.

---

## 📋 Yêu Cầu Hệ Thống

### Phần Cứng Tối Thiểu:
- **RAM**: 4GB (khuyến nghị 8GB)
- **Ổ cứng trống**: 10GB
- **CPU**: 2 cores trở lên

### Phần Mềm Cần Cài:
1. **Docker Desktop** (Bắt buộc)
   - Download: https://www.docker.com/products/docker-desktop/
   - Phiên bản: 4.0 trở lên
   
2. **Git** (Để tải code)
   - Download: https://git-scm.com/downloads
   - Phiên bản: 2.0 trở lên

---

## 🎯 Có 2 Cách Cài Đặt

### **Cách 1: Chạy Độc Lập** (Khuyến nghị)
Máy mới sẽ có bản Docker riêng, hoàn toàn độc lập.

### **Cách 2: Truy Cập Qua Mạng LAN**
Máy mới chỉ cần trình duyệt, truy cập vào máy chủ đang chạy Docker.

---

## 📦 CÁCH 1: CÀI ĐẶT ĐỘC LẬP

### Bước 1: Cài Đặt Docker Desktop

1. Tải Docker Desktop từ link trên
2. Chạy file cài đặt
3. Khởi động lại máy tính (nếu yêu cầu)
4. Mở Docker Desktop và đợi khởi động hoàn tất

**Kiểm tra Docker đã cài đúng:**
```powershell
docker --version
docker-compose --version
```

Kết quả mong đợi:
```
Docker version 24.x.x
Docker Compose version v2.x.x
```

---

### Bước 2: Tải Code Về Máy

**Option A: Từ GitHub (Nếu có Internet)**
```powershell
# Di chuyển đến thư mục muốn lưu dự án
cd C:\

# Clone repository
git clone https://github.com/HoDuongQuocHuy278/Ni-Flower-s.git

# Di chuyển vào thư mục dự án
cd Ni-Flower-s
```

**Option B: Từ USB/Ổ cứng (Nếu không có Internet)**
1. Copy toàn bộ thư mục dự án từ USB
2. Paste vào `C:\` hoặc thư mục bất kỳ
3. Mở PowerShell tại thư mục dự án

---

### Bước 3: Cấu Hình IP Máy Chủ

#### 3.1. Tìm IP của máy hiện tại
```powershell
ipconfig | Select-String "IPv4"
```

Ghi nhớ IP, ví dụ: `192.168.1.100`

#### 3.2. Cấu hình Frontend

**Mở file:** `FE_Flowershop/src/config/api.js`

**Tìm dòng 6 và sửa:**
```javascript
// 🔧 ĐỔI IP MÁY CHỦ Ở ĐÂY:
const ipbe = 'http://192.168.1.100:8000';  // Thay bằng IP của bạn
```

#### 3.3. Cấu hình Backend

**Mở file:** `BE_Flowershop/.env`

**Tìm dòng 5 và sửa:**
```env
APP_URL=http://192.168.1.100:8000  # Thay bằng IP của bạn
```

**Lưu cả 2 file (Ctrl + S)**

---

### Bước 4: Khởi Động Docker

```powershell
# Build và khởi động tất cả containers
docker-compose up -d --build
```

**Lần đầu chạy sẽ mất 5-10 phút** để:
- Tải các Docker images
- Build Frontend và Backend
- Khởi tạo database

**Kiểm tra containers đang chạy:**
```powershell
docker ps
```

Phải thấy 5 containers:
```
QuocHuy-frontend
QuocHuy-backend
QuocHuy-nginx-backend
QuocHuy-mysql
QuocHuy-phpmyadmin
```

---

### Bước 5: Cài Đặt Database (Chỉ Lần Đầu)

```powershell
# Cấp quyền cho thư mục storage
docker exec QuocHuy-backend chmod -R 775 storage bootstrap/cache
docker exec QuocHuy-backend chown -R www-data:www-data storage bootstrap/cache

# Tạo symlink cho storage
docker exec QuocHuy-backend php artisan storage:link

# Chạy migration và seed dữ liệu mẫu
docker exec QuocHuy-backend php artisan migrate --seed
```

**Chờ khoảng 30 giây để database khởi tạo xong**

---

### Bước 6: Truy Cập Và Sử Dụng

#### Từ Máy Hiện Tại:
- **Trang Web**: http://localhost:3000
- **Trang Admin**: http://localhost:3000/admin
- **API Backend**: http://localhost:8000
- **PHPMyAdmin**: http://localhost:8080

#### Từ Máy Khác (Cùng WiFi):
- **Trang Web**: http://192.168.1.100:3000 (thay IP của bạn)
- **Trang Admin**: http://192.168.1.100:3000/admin
- **API Backend**: http://192.168.1.100:8000

#### Tài Khoản Admin Mặc Định:
```
Email: admin@shophoa.com
Password: 123456
```

⚠️ **Nhớ đổi mật khẩu sau khi đăng nhập lần đầu!**

---

### Bước 7: Mở Firewall (Nếu Muốn Máy Khác Truy Cập)

**Mở PowerShell với quyền Administrator:**

```powershell
# Mở port 3000 (Frontend)
New-NetFirewallRule -DisplayName "Flowershop Frontend" -Direction Inbound -LocalPort 3000 -Protocol TCP -Action Allow

# Mở port 8000 (Backend API)
New-NetFirewallRule -DisplayName "Flowershop Backend" -Direction Inbound -LocalPort 8000 -Protocol TCP -Action Allow

# Mở port 8080 (PHPMyAdmin - tùy chọn)
New-NetFirewallRule -DisplayName "Flowershop PHPMyAdmin" -Direction Inbound -LocalPort 8080 -Protocol TCP -Action Allow
```

---

## 🌐 CÁCH 2: TRUY CẬP QUA MẠNG LAN

Nếu đã có máy chủ chạy Docker, máy khác **KHÔNG cần cài gì cả**.

### Yêu Cầu:
- Máy chủ đã chạy Docker (theo Cách 1)
- Cùng mạng WiFi/LAN với máy chủ
- Biết IP của máy chủ

### Các Bước:

1. **Kết nối cùng WiFi** với máy chủ

2. **Mở trình duyệt** (Chrome, Edge, Firefox...)

3. **Truy cập:**
   ```
   http://[IP-MÁY-CHỦ]:3000
   ```
   Ví dụ: `http://192.168.1.61:3000`

4. **Sử dụng bình thường!**

**Không cần:**
- ❌ Cài Docker
- ❌ Clone code
- ❌ Cài bất kỳ thứ gì

---

## 🔧 Các Lệnh Quản Lý Docker

### Khởi động dự án:
```powershell
docker-compose up -d
```

### Dừng dự án:
```powershell
docker-compose down
```

### Restart dự án:
```powershell
docker-compose restart
```

### Xem log lỗi:
```powershell
# Log Frontend
docker logs -f QuocHuy-frontend

# Log Backend
docker logs -f QuocHuy-backend

# Log Nginx
docker logs -f QuocHuy-nginx-backend
```

### Rebuild sau khi sửa code:
```powershell
# Rebuild Frontend
docker-compose build frontend --no-cache
docker-compose up -d frontend

# Rebuild Backend
docker-compose build backend --no-cache
docker-compose up -d backend
```

---

## ⚠️ Xử Lý Sự Cố

### Lỗi: Port đã được sử dụng

**Triệu chứng:**
```
Error: bind: address already in use
```

**Giải pháp:**
```powershell
# Kiểm tra port nào đang dùng
netstat -ano | findstr :3000
netstat -ano | findstr :8000

# Tắt ứng dụng đang dùng port đó
# Hoặc đổi port trong docker-compose.yml
```

---

### Lỗi: Docker không khởi động

**Giải pháp:**
1. Mở Docker Desktop
2. Chờ Docker khởi động hoàn tất (icon Docker màu xanh)
3. Thử lại lệnh `docker-compose up -d`

---

### Lỗi: Database trống

**Triệu chứng:** Trang web không có sản phẩm

**Giải pháp:**
```powershell
# Chạy lại migration và seed
docker exec QuocHuy-backend php artisan migrate:fresh --seed
```

---

### Lỗi: Upload ảnh bị lỗi

**Giải pháp:**
```powershell
# Cấp lại quyền storage
docker exec QuocHuy-backend chmod -R 775 storage bootstrap/cache
docker exec QuocHuy-backend chown -R www-data:www-data storage bootstrap/cache
docker exec QuocHuy-backend php artisan storage:link
```

---

### Lỗi: Không truy cập được từ máy khác

**Kiểm tra:**

1. **Ping máy chủ:**
   ```powershell
   ping [IP-MÁY-CHỦ]
   ```

2. **Kiểm tra firewall:**
   ```powershell
   Get-NetFirewallRule -DisplayName "Flowershop*"
   ```

3. **Kiểm tra Docker:**
   ```powershell
   docker ps
   ```

4. **Test port:**
   ```powershell
   Test-NetConnection -ComputerName [IP-MÁY-CHỦ] -Port 3000
   ```

---

## 📊 Cấu Trúc Dự Án

```
Ni-Flower-s/
├── BE_Flowershop/          # Laravel Backend
│   ├── .env                # Cấu hình Backend (IP ở dòng 5)
│   └── Dockerfile
├── FE_Flowershop/          # Vue.js Frontend
│   ├── src/
│   │   └── config/
│   │       └── api.js      # Cấu hình API (IP ở dòng 6)
│   └── Dockerfile
├── nginx/                  # Nginx config
├── docker-compose.yml      # Docker orchestration
└── README.md
```

---

## 🔒 Bảo Mật

### Sau Khi Cài Đặt Xong:

1. **Đổi mật khẩu Admin:**
   - Login: admin@shophoa.com / 123456
   - Vào trang quản lý → Đổi mật khẩu

2. **Đổi mật khẩu MySQL:**
   - Sửa file `BE_Flowershop/.env`
   - Đổi `DB_PASSWORD=root` thành mật khẩu mạnh
   - Rebuild: `docker-compose down && docker-compose up -d`

3. **Tắt PHPMyAdmin khi không dùng:**
   ```powershell
   docker stop QuocHuy-phpmyadmin
   ```

4. **Chỉ mở trong mạng LAN:**
   - KHÔNG expose ra Internet công cộng
   - Chỉ cho máy trong cùng mạng WiFi/công ty

---

## 📝 Checklist Cài Đặt

- [ ] Cài Docker Desktop
- [ ] Cài Git
- [ ] Clone/Copy code về máy
- [ ] Sửa IP trong `FE_Flowershop/src/config/api.js` (dòng 6)
- [ ] Sửa IP trong `BE_Flowershop/.env` (dòng 5)
- [ ] Chạy `docker-compose up -d --build`
- [ ] Chờ 5-10 phút để build xong
- [ ] Chạy migration: `docker exec QuocHuy-backend php artisan migrate --seed`
- [ ] Cấp quyền storage
- [ ] Test truy cập: `http://localhost:3000`
- [ ] Mở firewall (nếu cần máy khác truy cập)
- [ ] Test từ máy khác: `http://[IP]:3000`
- [ ] Đổi mật khẩu Admin
- [ ] Backup database

---

## 🎯 Tóm Tắt Nhanh

### Cài Mới (5 Lệnh Chính):
```powershell
# 1. Clone code
git clone https://github.com/HoDuongQuocHuy278/Ni-Flower-s.git
cd Ni-Flower-s

# 2. Sửa IP trong 2 file (thủ công)
# - FE_Flowershop/src/config/api.js (dòng 6)
# - BE_Flowershop/.env (dòng 5)

# 3. Build và chạy
docker-compose up -d --build

# 4. Cài database
docker exec QuocHuy-backend chmod -R 775 storage bootstrap/cache
docker exec QuocHuy-backend php artisan storage:link
docker exec QuocHuy-backend php artisan migrate --seed

# 5. Truy cập
# http://localhost:3000
```

---

## 📞 Hỗ Trợ

Nếu gặp vấn đề, kiểm tra theo thứ tự:

1. ✅ Docker Desktop đã chạy chưa?
2. ✅ Đã sửa IP trong 2 file chưa?
3. ✅ Tất cả 5 containers đang chạy? (`docker ps`)
4. ✅ Database đã có dữ liệu? (PHPMyAdmin: localhost:8080)
5. ✅ Firewall đã mở? (nếu cần máy khác truy cập)

---

## 📚 Tài Liệu Liên Quan

- `HUONG_DAN_DOI_IP.md` - Hướng dẫn đổi IP khi cần
- `HuongDan_Docker_Dev.md` - Hướng dẫn phát triển với Docker
- `HuongDan_Docker_ChayChung.md` - Hướng dẫn cho nhiều máy truy cập chung
- `IP_TAP_TRUNG.md` - Giải thích về biến ipbe

---

**Chúc bạn cài đặt thành công! 🎉**

*Thời gian cài đặt ước tính: 15-20 phút*  
*Yêu cầu Internet: Lần đầu cần tải Docker images (~2GB)*
