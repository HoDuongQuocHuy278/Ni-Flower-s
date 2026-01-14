# 🔍 Debug: Máy Khác Không Hiển Thị

## ✅ Đã Kiểm Tra (Trên Máy Chủ)

- ✅ IP máy chủ: **192.168.1.61**
- ✅ Containers đang chạy: 5/5
- ✅ Firewall đã mở: Port 3000, 8000, 8080
- ✅ Port 3000 có thể kết nối được

---

## ❓ Câu Hỏi Quan Trọng

### 1. Máy khác đang làm GÌ?

**Option A: Chỉ dùng trình duyệt**
```
Máy khác:
- Mở Chrome/Edge/Firefox
- Gõ: http://192.168.1.61:3000
- Kết quả: ???
```

**Option B: Có chạy Docker + Code**
```
Máy khác:
- Có Docker Desktop
- Có clone code
- Chạy: docker-compose up -d
- Truy cập: http://localhost:3000
- Kết quả: ???
```

### 2. Triệu chứng cụ thể là gì?

**A. Trang trắng / Không load được?**
- [ ] Trang hoàn toàn trắng
- [ ] Loading mãi không xong
- [ ] Báo lỗi "Cannot connect"

**B. Trang hiển thị nhưng thiếu dữ liệu?**
- [ ] Trang hiển thị nhưng không có sản phẩm
- [ ] Hình ảnh không load (icon broken image)
- [ ] Báo lỗi 404/500 trong Console

**C. Báo lỗi cụ thể?**
- [ ] ERR_CONNECTION_REFUSED
- [ ] ERR_CONNECTION_TIMED_OUT
- [ ] 404 Not Found
- [ ] 500 Internal Server Error

---

## 🔧 Các Bước Kiểm Tra

### Bước 1: Kiểm Tra Trên Máy Chủ Trước

**Trên máy chủ (192.168.1.61), mở trình duyệt:**

```
http://192.168.1.61:3000
```

**Kết quả:**
- [ ] ✅ Hiển thị bình thường
- [ ] ❌ Không hiển thị

**Nếu không hiển thị trên máy chủ → Vấn đề ở Docker, không phải mạng**

---

### Bước 2: Kiểm Tra Kết Nối Từ Máy Khác

**Trên máy khác, mở PowerShell/CMD:**

```powershell
# Test 1: Ping máy chủ
ping 192.168.1.61

# Test 2: Test port 3000
Test-NetConnection -ComputerName 192.168.1.61 -Port 3000

# Test 3: Test port 8000 (API)
Test-NetConnection -ComputerName 192.168.1.61 -Port 8000
```

**Kết quả:**
- Ping: [ ] Thành công / [ ] Thất bại
- Port 3000: [ ] Mở / [ ] Đóng
- Port 8000: [ ] Mở / [ ] Đóng

---

### Bước 3: Kiểm Tra Trình Duyệt Trên Máy Khác

**Mở Developer Tools (F12) → Tab Console**

```
http://192.168.1.61:3000
```

**Xem có lỗi gì không? Ví dụ:**
```
❌ Failed to load resource: net::ERR_CONNECTION_REFUSED
❌ Access to XMLHttpRequest blocked by CORS
❌ 404 Not Found
```

**Chụp màn hình lỗi và gửi cho tôi!**

---

### Bước 4: Kiểm Tra API Trực Tiếp

**Trên máy khác, mở trình duyệt:**

```
http://192.168.1.61:8000/api/client/home-page
```

**Kết quả mong đợi:**
```json
{
  "data": {
    "bo_hoa": [...],
    "danh_muc": [...]
  }
}
```

**Kết quả thực tế:**
- [ ] Hiển thị JSON
- [ ] Báo lỗi
- [ ] Không load được

---

## 🎯 Các Trường Hợp Thường Gặp

### Trường Hợp 1: Máy Khác Có Docker + Code

**Vấn đề:** Máy khác đang chạy Frontend riêng, gọi API localhost

**Giải pháp:**

**Option A: Xóa Docker (Khuyên dùng)**
```powershell
# Trên máy khác
docker-compose down
# Sau đó chỉ dùng trình duyệt: http://192.168.1.61:3000
```

**Option B: Cấu hình Frontend gọi API máy chủ**
```powershell
# Trên máy khác, sửa file .env
notepad FE_Flowershop\.env
```

Thêm:
```env
VITE_API_URL=http://192.168.1.61:8000
```

Rebuild:
```powershell
docker-compose build frontend --no-cache
docker-compose up -d frontend
```

---

### Trường Hợp 2: Firewall Máy Khác Chặn

**Kiểm tra:**
```powershell
# Trên máy khác
Get-NetFirewallProfile | Select-Object Name, Enabled
```

**Giải pháp:** Tạm tắt firewall để test
```powershell
# Tắt tạm thời (cần Admin)
Set-NetFirewallProfile -Profile Domain,Public,Private -Enabled False

# Test xem có vào được không
# Sau đó bật lại
Set-NetFirewallProfile -Profile Domain,Public,Private -Enabled True
```

---

### Trường Hợp 3: Không Cùng Mạng

**Kiểm tra:**
```powershell
# Trên máy khác
ipconfig | Select-String "IPv4"
```

**Kết quả:**
- Máy chủ: 192.168.1.61
- Máy khác: 192.168.1.??? (phải cùng dải 192.168.1.x)

**Nếu khác dải → Không cùng mạng → Không kết nối được**

---

### Trường Hợp 4: Antivirus/Security Software

**Các phần mềm thường gây vấn đề:**
- Kaspersky
- Norton
- McAfee
- Windows Defender (hiếm)

**Giải pháp:** Tạm tắt để test

---

## 🚀 Giải Pháp Nhanh

### Nếu Máy Khác CHỈ Cần Xem/Sử Dụng:

```powershell
# Trên máy khác:
# 1. Dừng Docker (nếu có)
docker-compose down

# 2. Mở trình duyệt
# 3. Truy cập: http://192.168.1.61:3000
```

### Nếu Vẫn Không Được:

**Kiểm tra từng bước:**

1. **Trên máy chủ:**
   ```powershell
   # Restart tất cả
   docker-compose restart
   
   # Kiểm tra
   docker ps
   ```

2. **Test trên chính máy chủ:**
   ```
   http://192.168.1.61:3000
   ```

3. **Trên máy khác:**
   ```powershell
   ping 192.168.1.61
   ```

4. **Nếu ping được, test port:**
   ```powershell
   Test-NetConnection -ComputerName 192.168.1.61 -Port 3000
   ```

5. **Nếu port mở, test trình duyệt:**
   ```
   http://192.168.1.61:3000
   ```

---

## 📞 Thông Tin Cần Cung Cấp

Để tôi giúp bạn debug, vui lòng cho biết:

1. **Máy khác đang làm gì?**
   - Chỉ dùng trình duyệt?
   - Hay có chạy Docker?

2. **Triệu chứng cụ thể:**
   - Trang trắng?
   - Báo lỗi gì?
   - Chụp màn hình Console (F12)

3. **Kết quả test:**
   - Ping 192.168.1.61: Thành công/Thất bại?
   - Test port 3000: Mở/Đóng?
   - Truy cập API trực tiếp: Có dữ liệu/Lỗi?

4. **Môi trường:**
   - Máy khác dùng Windows/Mac/Linux?
   - Cùng WiFi với máy chủ?
   - Có antivirus gì đang chạy?

---

**Hãy cung cấp thông tin trên để tôi giúp bạn giải quyết chính xác! 🔍**
