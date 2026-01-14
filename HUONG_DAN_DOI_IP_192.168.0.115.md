# 🔄 Hướng Dẫn Đổi IP Máy Chủ - 192.168.0.115

**Ngày cập nhật:** 14/01/2026  
**IP mới:** `192.168.0.115`  
**IP cũ:** `192.168.1.61`

---

## 📝 Tóm Tắt Nhanh

Khi IP máy chủ thay đổi, bạn cần cập nhật **2 file** sau:

1. ✅ **Frontend:** `FE_Flowershop/src/config/api.js` (dòng 6)
2. ✅ **Backend:** `BE_Flowershop/.env` (dòng 5)

---

## 🎯 CÁCH ĐỔI IP - CHỈ 3 BƯỚC

### Bước 1: Tìm IP Máy Hiện Tại

Mở **PowerShell** và chạy:

```powershell
ipconfig | Select-String "IPv4"
```

**Kết quả:**
```
IPv4 Address. . . . . . . . . . . : 192.168.0.115
```

✅ **IP hiện tại của bạn:** `192.168.0.115`

---

### Bước 2: Cập Nhật File Frontend

**📂 Mở file:** `FE_Flowershop/src/config/api.js`

**🔍 Tìm dòng 6:**
```javascript
const ipbe = 'http://192.168.1.61:8000';
```

**✏️ Sửa thành:**
```javascript
const ipbe = 'http://192.168.0.115:8000';
```

**💾 Lưu file:** `Ctrl + S`

---

### Bước 3: Cập Nhật File Backend

**📂 Mở file:** `BE_Flowershop/.env`

**🔍 Tìm dòng 5:**
```env
APP_URL=http://192.168.1.61:8000
```

**✏️ Sửa thành:**
```env
APP_URL=http://192.168.0.115:8000
```

**💾 Lưu file:** `Ctrl + S`

---

## 🚀 Rebuild Docker (Bắt Buộc)

Sau khi đổi IP, **PHẢI rebuild** Docker để áp dụng thay đổi:

```powershell
# Di chuyển vào thư mục dự án
cd c:\xampp\htdocs\FLowershop

# Dừng containers hiện tại
docker-compose down

# Rebuild Frontend (vì đã đổi IP trong api.js)
docker-compose build frontend --no-cache

# Khởi động lại tất cả
docker-compose up -d
```

**⏱️ Thời gian:** Khoảng 2-3 phút

---

## ✅ Kiểm Tra Sau Khi Đổi

### 1. Kiểm tra containers đang chạy:
```powershell
docker ps
```

Phải thấy 5 containers:
- QuocHuy-frontend
- QuocHuy-backend
- QuocHuy-nginx-backend
- QuocHuy-mysql
- QuocHuy-phpmyadmin

### 2. Test truy cập từ máy chủ:
```
http://localhost:3000
http://localhost:8000/api/client/home-page
```

### 3. Test từ máy khác (cùng WiFi):
```
http://192.168.0.115:3000
http://192.168.0.115:8000/api/client/home-page
```

### 4. Kiểm tra API trong Console:

Mở trang web → F12 (Developer Tools) → Console

Không được thấy lỗi:
- ❌ `ERR_CONNECTION_REFUSED`
- ❌ `Failed to fetch`
- ❌ `CORS error`

---

## 🔥 Xử Lý Lỗi Thường Gặp

### Lỗi 1: Máy khác không truy cập được

**Nguyên nhân:** Firewall chặn

**Giải pháp:** Mở PowerShell **với quyền Administrator**

```powershell
# Mở port 3000 (Frontend)
New-NetFirewallRule -DisplayName "Flowershop Frontend" -Direction Inbound -LocalPort 3000 -Protocol TCP -Action Allow

# Mở port 8000 (Backend)
New-NetFirewallRule -DisplayName "Flowershop Backend" -Direction Inbound -LocalPort 8000 -Protocol TCP -Action Allow
```

---

### Lỗi 2: Trang web hiển thị nhưng không load dữ liệu

**Nguyên nhân:** Chưa rebuild Frontend

**Giải pháp:**
```powershell
docker-compose down
docker-compose build frontend --no-cache
docker-compose up -d
```

---

### Lỗi 3: API trả về 404 hoặc 500

**Nguyên nhân:** Backend chưa cập nhật .env

**Giải pháp:**
```powershell
# Kiểm tra .env đã đổi IP chưa
cat BE_Flowershop/.env | Select-String "APP_URL"

# Nếu chưa đổi, sửa lại rồi restart
docker-compose restart backend
```

---

## 📊 Checklist Đổi IP

- [ ] Tìm IP mới: `ipconfig | Select-String "IPv4"`
- [ ] Sửa `FE_Flowershop/src/config/api.js` (dòng 6)
- [ ] Sửa `BE_Flowershop/.env` (dòng 5)
- [ ] Lưu cả 2 file (Ctrl + S)
- [ ] Chạy `docker-compose down`
- [ ] Chạy `docker-compose build frontend --no-cache`
- [ ] Chạy `docker-compose up -d`
- [ ] Đợi 2-3 phút để build xong
- [ ] Test: `http://localhost:3000`
- [ ] Test từ máy khác: `http://192.168.0.115:3000`
- [ ] Kiểm tra Console không có lỗi API
- [ ] Mở Firewall (nếu cần)

---

## 🎯 Các URL Sau Khi Đổi IP

### Từ Máy Chủ (localhost):
- **Trang Web:** http://localhost:3000
- **Trang Admin:** http://localhost:3000/admin
- **API Backend:** http://localhost:8000
- **PHPMyAdmin:** http://localhost:8080

### Từ Máy Khác (Cùng WiFi):
- **Trang Web:** http://192.168.0.115:3000
- **Trang Admin:** http://192.168.0.115:3000/admin
- **API Backend:** http://192.168.0.115:8000
- **PHPMyAdmin:** http://192.168.0.115:8080

---

## 💡 Lưu Ý Quan Trọng

1. **Mỗi khi IP thay đổi** (đổi WiFi, DHCP cấp IP mới), phải làm lại 3 bước trên

2. **Để IP cố định:**
   - Vào Router → DHCP Settings
   - Bind MAC Address với IP 192.168.0.115
   - Hoặc đặt Static IP trong Windows

3. **Nếu dùng nhiều máy:**
   - Chỉ cần đổi IP trên **máy chủ** (máy chạy Docker)
   - Máy khác chỉ cần truy cập qua trình duyệt

4. **Backup trước khi đổi:**
   ```powershell
   # Backup file cấu hình
   cp FE_Flowershop/src/config/api.js FE_Flowershop/src/config/api.js.backup
   cp BE_Flowershop/.env BE_Flowershop/.env.backup
   ```

---

## 📞 Hỗ Trợ

Nếu gặp vấn đề, kiểm tra theo thứ tự:

1. ✅ Đã sửa đúng 2 file chưa?
2. ✅ Đã lưu file (Ctrl + S) chưa?
3. ✅ Đã rebuild Frontend chưa?
4. ✅ Containers đang chạy? (`docker ps`)
5. ✅ Firewall đã mở? (nếu cần máy khác truy cập)
6. ✅ Cùng mạng WiFi với máy chủ?

---

## 📚 Tài Liệu Liên Quan

- `HUONG_DAN_CAI_DAT_MAY_KHAC.md` - Hướng dẫn cài đặt từ đầu
- `HuongDan_Docker_ChayChung.md` - Hướng dẫn nhiều máy truy cập
- `IP_TAP_TRUNG.md` - Giải thích về biến ipbe

---

**✅ Hoàn tất! Chúc bạn đổi IP thành công! 🎉**

*Thời gian thực hiện: 5-10 phút*  
*Cần Internet: Không (nếu đã có Docker images)*
