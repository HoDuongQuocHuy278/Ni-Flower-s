# 🌐 Hướng Dẫn Cho Nhiều Máy Truy Cập Chung Docker

Tài liệu này hướng dẫn cách cho **nhiều máy tính khác** truy cập vào dự án **QuocHuy** đang chạy trên Docker của máy chủ (máy chính).

---

## 📋 Tổng Quan

### Mô Hình Hoạt Động
```
┌─────────────────────────────────────────────────────┐
│           Máy Chủ (Host Machine)                    │
│  - Chạy Docker Desktop                              │
│  - IP: 192.168.1.100 (ví dụ)                       │
│  - Các containers:                                  │
│    • Frontend (Port 3000)                           │
│    • Backend API (Port 8000)                        │
│    • MySQL (Port 3307)                              │
│    • PHPMyAdmin (Port 8080)                         │
└─────────────────────────────────────────────────────┘
                        ▲
                        │
        ┌───────────────┼───────────────┐
        │               │               │
┌───────▼──────┐ ┌──────▼──────┐ ┌─────▼──────┐
│   Máy A      │ │   Máy B     │ │   Máy C    │
│ (Client)     │ │ (Client)    │ │ (Client)   │
│ Truy cập:    │ │ Truy cập:   │ │ Truy cập:  │
│ 192.168.1    │ │ 192.168.1   │ │ 192.168.1  │
│ .100:3000    │ │ .100:3000   │ │ .100:3000  │
└──────────────┘ └─────────────┘ └────────────┘
```

### Yêu Cầu
- ✅ Tất cả các máy phải **cùng mạng LAN** (cùng WiFi/cùng mạng công ty)
- ✅ Máy chủ phải **mở Firewall** cho các port cần thiết
- ✅ Docker trên máy chủ phải được cấu hình đúng

---

## 🖥️ PHẦN 1: Cấu Hình Trên Máy Chủ (Host)

### Bước 1: Kiểm Tra Docker Đang Chạy
Đảm bảo tất cả containers đang hoạt động:
```bash
docker ps
```

Bạn phải thấy 4 containers:
- `QuocHuy-frontend`
- `QuocHuy-backend`
- `QuocHuy-nginx-backend`
- `QuocHuy-mysql`

### Bước 2: Tìm Địa Chỉ IP Của Máy Chủ

#### Trên Windows:
```bash
ipconfig
```
Tìm dòng **IPv4 Address** trong phần **Wireless LAN adapter Wi-Fi** hoặc **Ethernet adapter**.

Ví dụ:
```
IPv4 Address. . . . . . . . . . . : 192.168.1.100
```

#### Trên macOS/Linux:
```bash
ifconfig
```
hoặc
```bash
ip addr show
```

> 📝 **Ghi chú lại IP này**, ví dụ: `192.168.1.100`

### Bước 3: Mở Firewall Cho Các Port

#### Trên Windows (Quan Trọng!)

**Cách 1: Sử dụng PowerShell (Khuyên dùng)**

Mở **PowerShell với quyền Administrator** và chạy:

```powershell
# Mở port 3000 (Frontend)
New-NetFirewallRule -DisplayName "QuocHuy Frontend" -Direction Inbound -LocalPort 3000 -Protocol TCP -Action Allow

# Mở port 8000 (Backend API)
New-NetFirewallRule -DisplayName "QuocHuy Backend API" -Direction Inbound -LocalPort 8000 -Protocol TCP -Action Allow

# Mở port 8080 (PHPMyAdmin - tùy chọn)
New-NetFirewallRule -DisplayName "QuocHuy PHPMyAdmin" -Direction Inbound -LocalPort 8080 -Protocol TCP -Action Allow
```

**Cách 2: Sử dụng Windows Defender Firewall (Giao diện)**

1. Mở **Windows Defender Firewall with Advanced Security**
2. Click **Inbound Rules** → **New Rule**
3. Chọn **Port** → Next
4. Chọn **TCP** → Nhập port: `3000` → Next
5. Chọn **Allow the connection** → Next
6. Chọn tất cả profiles (Domain, Private, Public) → Next
7. Đặt tên: `QuocHuy Frontend` → Finish
8. **Lặp lại** cho port `8000` và `8080`

#### Trên macOS:
```bash
# macOS thường mở sẵn, nhưng nếu cần:
sudo /usr/libexec/ApplicationFirewall/socketfilterfw --add /Applications/Docker.app
```

#### Trên Linux (Ubuntu/Debian):
```bash
sudo ufw allow 3000/tcp
sudo ufw allow 8000/tcp
sudo ufw allow 8080/tcp
sudo ufw reload
```

### Bước 4: Kiểm Tra Cấu Hình Docker Compose

Mở file `docker-compose.yml` và đảm bảo các port được bind đúng:

```yaml
services:
  frontend:
    ports:
      - "3000:80"  # ✅ Đúng: 0.0.0.0:3000 -> container:80
  
  nginx-backend:
    ports:
      - "8000:80"  # ✅ Đúng: 0.0.0.0:8000 -> container:80
  
  mysql:
    ports:
      - "3307:3306"  # ✅ Đúng
```

> ⚠️ **Lưu ý**: Nếu thấy `127.0.0.1:3000:80` thì phải đổi thành `3000:80` hoặc `0.0.0.0:3000:80`

Nếu có thay đổi, restart Docker:
```bash
docker-compose down
docker-compose up -d
```

### Bước 5: Test Trên Chính Máy Chủ

Trước khi cho máy khác truy cập, test trên chính máy chủ:
```
http://localhost:3000        # Frontend
http://localhost:8000        # Backend API
http://localhost:8080        # PHPMyAdmin
```

---

## 💻 PHẦN 2: Cấu Hình Trên Máy Client (Máy Khác)

### Bước 1: Kết Nối Cùng Mạng
Đảm bảo máy client kết nối **cùng WiFi/mạng LAN** với máy chủ.

### Bước 2: Truy Cập Ứng Dụng

Thay `192.168.1.100` bằng IP thực của máy chủ:

- **Trang Web Khách Hàng:**  
  `http://192.168.1.100:3000`

- **Trang Admin:**  
  `http://192.168.1.100:3000/admin`

- **API Backend:**  
  `http://192.168.1.100:8000`

- **PHPMyAdmin:**  
  `http://192.168.1.100:8080`

### Bước 3: Kiểm Tra Kết Nối

Nếu không truy cập được, thử ping máy chủ:

#### Trên Windows:
```bash
ping 192.168.1.100
```

#### Trên macOS/Linux:
```bash
ping 192.168.1.100
```

Nếu ping **không thành công** → Vấn đề về mạng hoặc firewall.

---

## 🔧 PHẦN 3: Xử Lý Sự Cố

### ❌ Lỗi: Không Truy Cập Được Từ Máy Khác

**Nguyên nhân 1: Firewall chặn**
```bash
# Kiểm tra lại firewall rules (Windows PowerShell)
Get-NetFirewallRule -DisplayName "QuocHuy*"
```

**Nguyên nhân 2: Docker bind sai địa chỉ**
```bash
# Kiểm tra port binding
docker ps --format "table {{.Names}}\t{{.Ports}}"
```
Phải thấy `0.0.0.0:3000->80/tcp` chứ KHÔNG phải `127.0.0.1:3000->80/tcp`

**Nguyên nhân 3: Máy client không cùng mạng**
- Kiểm tra IP của máy client có cùng dải với máy chủ không
- Ví dụ: Máy chủ `192.168.1.100`, máy client phải `192.168.1.xxx`

**Nguyên nhân 4: Antivirus/Security Software**
- Tạm tắt antivirus và thử lại
- Nếu được, thêm exception cho Docker

### ❌ Lỗi: API Không Hoạt Động Từ Máy Khác

**Giải pháp: Cập nhật URL API trong Frontend**

Nếu Frontend gọi API bằng `localhost:8000`, cần đổi thành IP máy chủ:

1. Mở file `.env` trong thư mục `FE_Flowershop`:
```env
# Thay đổi từ:
VITE_API_URL=http://localhost:8000

# Thành (thay IP thật):
VITE_API_URL=http://192.168.1.100:8000
```

2. Build lại Frontend:
```bash
docker-compose build frontend --no-cache
docker-compose up -d frontend
```

### ❌ Lỗi: Trang Web Chậm Hoặc Timeout

**Nguyên nhân**: Mạng WiFi yếu hoặc quá tải

**Giải pháp**:
- Dùng dây LAN thay vì WiFi
- Nâng cấp router
- Giảm số lượng người dùng đồng thời

---

## 🔒 PHẦN 4: Bảo Mật (Quan Trọng!)

### ⚠️ Lưu Ý Bảo Mật

Khi mở port cho máy khác truy cập, cần chú ý:

1. **Chỉ mở trong mạng LAN nội bộ**
   - KHÔNG expose ra Internet công cộng
   - Chỉ cho phép máy trong cùng mạng công ty/gia đình

2. **Đổi mật khẩu mặc định**
   - Admin: `admin@shophoa.com` / `123456` → Đổi ngay!
   - MySQL root password

3. **Tắt PHPMyAdmin khi không dùng**
   ```bash
   # Comment dòng này trong docker-compose.yml
   # phpmyadmin:
   #   ...
   ```

4. **Sử dụng HTTPS nếu có thể**
   - Cài đặt SSL certificate
   - Dùng Nginx reverse proxy với SSL

---

## 📊 PHẦN 5: Giám Sát & Quản Lý

### Xem Số Lượng Kết Nối

```bash
# Xem log realtime của Nginx
docker logs -f QuocHuy-nginx-backend

# Xem số lượng request
docker exec QuocHuy-nginx-backend cat /var/log/nginx/access.log | wc -l
```

### Giới Hạn Số Lượng Kết Nối (Nếu Cần)

Chỉnh sửa file `nginx/backend.conf`:
```nginx
http {
    limit_conn_zone $binary_remote_addr zone=addr:10m;
    
    server {
        limit_conn addr 10;  # Giới hạn 10 kết nối/IP
        ...
    }
}
```

---

## 🎯 Tóm Tắt Nhanh

### Trên Máy Chủ:
1. ✅ Tìm IP: `ipconfig`
2. ✅ Mở Firewall: Port 3000, 8000, 8080
3. ✅ Kiểm tra Docker: `docker ps`
4. ✅ Test: `http://localhost:3000`

### Trên Máy Client:
1. ✅ Cùng mạng WiFi/LAN
2. ✅ Truy cập: `http://[IP-MÁY-CHỦ]:3000`
3. ✅ Nếu lỗi API: Cập nhật `VITE_API_URL` trong Frontend

---

## 📞 Hỗ Trợ

Nếu gặp vấn đề, kiểm tra theo thứ tự:
1. Ping được máy chủ chưa?
2. Firewall đã mở chưa?
3. Docker containers đang chạy chưa?
4. Port binding đúng chưa? (`0.0.0.0` không phải `127.0.0.1`)
5. Frontend có gọi đúng IP API chưa?

---

**Chúc bạn triển khai thành công! 🚀**
