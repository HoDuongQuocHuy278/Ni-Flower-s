# 🎯 Hướng Dẫn Đổi IP Máy Chủ - Chỉ 1 Chỗ Duy Nhất

## 📍 Khi Nào Cần Đổi IP?

- Router cấp IP mới cho máy chủ
- Chuyển sang mạng WiFi khác
- Triển khai trên máy chủ khác

---

## ✅ Cách Đổi IP - Chỉ 3 Bước

### Bước 1: Tìm IP Mới

**Trên máy chủ, chạy:**
```powershell
ipconfig | Select-String "IPv4"
```

**Ví dụ kết quả:**
```
IPv4 Address. . . . . . . . . . . : 192.168.1.100
```

Ghi nhớ IP này: `192.168.1.100`

---

### Bước 2: Đổi IP Trong 2 File

#### 📁 File 1: Frontend Config
**Đường dẫn:** `FE_Flowershop/src/config/api.js`

**Mở file và tìm dòng 6:**
```javascript
// 🔧 ĐỔI IP MÁY CHỦ Ở ĐÂY:
const DEFAULT_API_URL = 'http://192.168.1.61:8000';
```

**Đổi thành IP mới:**
```javascript
// 🔧 ĐỔI IP MÁY CHỦ Ở ĐÂY:
const DEFAULT_API_URL = 'http://192.168.1.100:8000';
```

**Lưu file (Ctrl + S)**

---

#### 📁 File 2: Backend Config
**Đường dẫn:** `BE_Flowershop/.env`

**Mở file và tìm dòng 5:**
```env
APP_URL=http://192.168.1.61:8000
```

**Đổi thành IP mới:**
```env
APP_URL=http://192.168.1.100:8000
```

**Lưu file (Ctrl + S)**

---

### Bước 3: Rebuild và Restart

```powershell
# Rebuild Frontend
docker-compose build frontend --no-cache

# Restart tất cả
docker-compose restart

# Hoặc restart từng cái
docker-compose restart backend nginx-backend frontend
```

**Chờ 10-20 giây để containers khởi động**

---

## 🎉 Xong! Test Ngay

### Từ Máy Chủ:
```
http://192.168.1.100:3000
```

### Từ Máy Khác:
```
http://192.168.1.100:3000
```

---

## 📝 Tóm Tắt Nhanh

| Bước | Làm Gì | File Nào |
|------|--------|----------|
| 1 | Tìm IP mới | `ipconfig` |
| 2a | Đổi `DEFAULT_API_URL` | `FE_Flowershop/src/config/api.js` (dòng 6) |
| 2b | Đổi `APP_URL` | `BE_Flowershop/.env` (dòng 5) |
| 3 | Rebuild + Restart | `docker-compose build frontend --no-cache && docker-compose restart` |

---

## ⚠️ Lưu Ý

### Nếu Chỉ Đổi 1 File:
- ❌ Chỉ đổi Frontend → Hình ảnh không load
- ❌ Chỉ đổi Backend → API không hoạt động
- ✅ Phải đổi CẢ 2 FILE

### Nếu Quên Rebuild:
- Frontend vẫn dùng IP cũ
- Máy khác không truy cập được
- → **Nhớ rebuild Frontend!**

---

## 🔍 Kiểm Tra Đã Đổi Đúng Chưa

### Test API:
```powershell
# Thay IP mới vào đây
curl http://192.168.1.100:8000/api/client/home-page
```

**Nếu trả về JSON → Thành công! ✅**

### Test Frontend:
```
http://192.168.1.100:3000
```

**Nếu hiển thị trang → Thành công! ✅**

---

## 📞 Script Tự Động (Nâng Cao)

Tạo file `doi-ip.ps1`:

```powershell
# Script đổi IP tự động
param(
    [Parameter(Mandatory=$true)]
    [string]$NewIP
)

Write-Host "Đang đổi IP sang: $NewIP" -ForegroundColor Green

# Đổi Frontend
$frontendFile = "FE_Flowershop\src\config\api.js"
(Get-Content $frontendFile) -replace "http://\d+\.\d+\.\d+\.\d+:8000", "http://${NewIP}:8000" | Set-Content $frontendFile

# Đổi Backend
$backendFile = "BE_Flowershop\.env"
(Get-Content $backendFile) -replace "APP_URL=http://\d+\.\d+\.\d+\.\d+:8000", "APP_URL=http://${NewIP}:8000" | Set-Content $backendFile

Write-Host "Đã đổi IP xong!" -ForegroundColor Green
Write-Host "Bây giờ chạy: docker-compose build frontend --no-cache && docker-compose restart" -ForegroundColor Yellow
```

**Cách dùng:**
```powershell
.\doi-ip.ps1 -NewIP "192.168.1.100"
```

---

## ✅ Checklist

- [ ] Tìm IP mới: `ipconfig`
- [ ] Đổi `FE_Flowershop/src/config/api.js` (dòng 6)
- [ ] Đổi `BE_Flowershop/.env` (dòng 5)
- [ ] Rebuild Frontend: `docker-compose build frontend --no-cache`
- [ ] Restart: `docker-compose restart`
- [ ] Test từ máy chủ: `http://[IP-MỚI]:3000`
- [ ] Test từ máy khác: `http://[IP-MỚI]:3000`

---

**Chúc bạn đổi IP thành công! 🚀**

*Chỉ cần nhớ 2 file:*
1. *`FE_Flowershop/src/config/api.js` - Dòng 6*
2. *`BE_Flowershop/.env` - Dòng 5*
