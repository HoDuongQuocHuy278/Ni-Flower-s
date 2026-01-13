# 📦 Hướng Dẫn Đóng Gói & Chuyển Docker Sang Máy Khác

Tài liệu này hướng dẫn cách **đóng gói toàn bộ dự án Docker** thành file để chuyển sang máy khác **KHÔNG cần Internet**.

---

## 🎯 Khi Nào Dùng Cách Này?

### ✅ Nên dùng khi:
- Máy đích **không có Internet** hoặc Internet chậm
- Muốn **triển khai nhanh** mà không cần build lại
- Cần **bản sao hoàn toàn độc lập** (không phụ thuộc máy chủ)
- Chuyển dự án qua **USB/ổ cứng ngoài**

### ❌ Không cần dùng khi:
- Máy đích có Internet tốt → Dùng `git clone` + `docker-compose up`
- Muốn nhiều máy cùng truy cập 1 server → Xem file `HuongDan_Docker_ChayChung.md`

---

## 📋 So Sánh 3 Phương Pháp

| Phương Pháp | Kích Thước | Tốc Độ | Yêu Cầu Internet | Độc Lập |
|-------------|------------|--------|------------------|---------|
| **1. Git Clone** | ~50MB | Chậm (build lại) | ✅ Cần | ✅ Hoàn toàn |
| **2. Export Images** | ~2-3GB | Nhanh | ❌ Không cần | ✅ Hoàn toàn |
| **3. Truy cập LAN** | 0 (không copy) | Rất nhanh | ❌ Không cần | ❌ Phụ thuộc host |

---

## 🔧 PHƯƠNG ÁN 1: Export Docker Images (Khuyên Dùng)

### Bước 1: Trên Máy Nguồn (Máy có Docker đang chạy)

#### 1.1. Kiểm tra các images hiện có
```bash
docker images
```

Bạn sẽ thấy danh sách như:
```
REPOSITORY              TAG       IMAGE ID       SIZE
flowershop-frontend     latest    abc123def456   500MB
flowershop-backend      latest    def789ghi012   800MB
mysql                   8.0       ghi345jkl678   600MB
nginx                   alpine    jkl901mno234   50MB
phpmyadmin              latest    mno567pqr890   200MB
```

#### 1.2. Export từng image ra file .tar

```bash
# Tạo thư mục chứa các file export
mkdir docker_export
cd docker_export

# Export Frontend
docker save -o frontend.tar flowershop-frontend:latest

# Export Backend
docker save -o backend.tar flowershop-backend:latest

# Export MySQL
docker save -o mysql.tar mysql:8.0

# Export Nginx
docker save -o nginx.tar nginx:alpine

# Export PHPMyAdmin (nếu cần)
docker save -o phpmyadmin.tar phpmyadmin:latest
```

> 📝 **Lưu ý**: Mỗi file .tar sẽ rất lớn (500MB - 1GB). Tổng cộng khoảng **2-3GB**.

#### 1.3. Copy thêm các file cấu hình

```bash
# Copy toàn bộ thư mục dự án (không bao gồm node_modules, vendor)
# Tạo file zip/rar chứa:
# - docker-compose.yml
# - Dockerfile (frontend, backend)
# - nginx/
# - .env.example
# - BE_Flowershop/ (không bao gồm vendor/)
# - FE_Flowershop/ (không bao gồm node_modules/)
```

**Cách nhanh (PowerShell):**
```powershell
# Nén toàn bộ dự án (loại trừ thư mục lớn)
Compress-Archive -Path C:\xampp\htdocs\FLowershop\* `
  -DestinationPath docker_export\project_source.zip `
  -Force
```

#### 1.4. Cấu trúc thư mục cuối cùng

```
docker_export/
├── frontend.tar          (500MB)
├── backend.tar           (800MB)
├── mysql.tar             (600MB)
├── nginx.tar             (50MB)
├── phpmyadmin.tar        (200MB)
├── project_source.zip    (50MB - code nguồn)
└── HUONG_DAN_CAI_DAT.txt (file hướng dẫn)
```

#### 1.5. Tạo file hướng dẫn cài đặt

Tạo file `HUONG_DAN_CAI_DAT.txt` trong thư mục `docker_export`:

```txt
=== HƯỚNG DẪN CÀI ĐẶT DỰ ÁN FLOWERSHOP ===

YÊU CẦU:
- Docker Desktop đã cài đặt
- Ít nhất 4GB RAM trống
- 10GB ổ cứng trống

BƯỚC 1: Giải nén project_source.zip vào thư mục bất kỳ
BƯỚC 2: Mở PowerShell/Terminal tại thư mục chứa các file .tar
BƯỚC 3: Chạy lệnh import images:
  docker load -i frontend.tar
  docker load -i backend.tar
  docker load -i mysql.tar
  docker load -i nginx.tar
  docker load -i phpmyadmin.tar

BƯỚC 4: Di chuyển vào thư mục dự án đã giải nén
BƯỚC 5: Chạy: docker-compose up -d
BƯỚC 6: Truy cập: http://localhost:3000

Chi tiết xem file HuongDan_CaiDat_MayKhac.md
```

### Bước 2: Chuyển Sang Máy Đích

#### 2.1. Copy toàn bộ thư mục `docker_export` qua máy mới
- Dùng USB/ổ cứng ngoài
- Hoặc chia sẻ qua mạng LAN
- Hoặc dùng Google Drive/OneDrive

#### 2.2. Trên máy mới, import các images

```bash
# Di chuyển vào thư mục chứa các file .tar
cd docker_export

# Import từng image
docker load -i frontend.tar
docker load -i backend.tar
docker load -i mysql.tar
docker load -i nginx.tar
docker load -i phpmyadmin.tar
```

**Kiểm tra đã import thành công:**
```bash
docker images
```

#### 2.3. Giải nén code nguồn

```bash
# Giải nén project_source.zip ra thư mục mong muốn
# Ví dụ: C:\Projects\Flowershop
```

#### 2.4. Chạy Docker Compose

```bash
# Di chuyển vào thư mục dự án
cd C:\Projects\Flowershop

# Khởi động containers
docker-compose up -d
```

#### 2.5. Cài đặt lần đầu (nếu cần)

```bash
# Cấp quyền storage
docker exec QuocHuy-backend chmod -R 775 storage bootstrap/cache
docker exec QuocHuy-backend chown -R www-data:www-data storage bootstrap/cache

# Tạo symlink
docker exec QuocHuy-backend php artisan storage:link

# Chạy migration (nếu database trống)
docker exec QuocHuy-backend php artisan migrate --seed
```

---

## 🚀 PHƯƠNG ÁN 2: Export Cả Containers Đang Chạy (Nâng Cao)

### Ưu điểm:
- Giữ nguyên **dữ liệu** trong database
- Không cần chạy migration lại

### Nhược điểm:
- File rất lớn (có thể 5-10GB)
- Phức tạp hơn

### Các bước:

#### Bước 1: Export containers thành images mới

```bash
# Commit container đang chạy thành image mới (bao gồm cả data)
docker commit QuocHuy-mysql flowershop-mysql-with-data:latest
docker commit QuocHuy-backend flowershop-backend-with-data:latest
docker commit QuocHuy-frontend flowershop-frontend-with-data:latest
```

#### Bước 2: Export images mới

```bash
docker save -o mysql_with_data.tar flowershop-mysql-with-data:latest
docker save -o backend_with_data.tar flowershop-backend-with-data:latest
docker save -o frontend_with_data.tar flowershop-frontend-with-data:latest
```

#### Bước 3: Trên máy mới, import và chạy

```bash
# Import
docker load -i mysql_with_data.tar
docker load -i backend_with_data.tar
docker load -i frontend_with_data.tar

# Sửa docker-compose.yml để dùng images mới
# Sau đó:
docker-compose up -d
```

---

## 📦 PHƯƠNG ÁN 3: Sử dụng Docker Registry Nội Bộ (Cho Nhiều Máy)

Nếu bạn cần triển khai cho **nhiều máy trong cùng mạng LAN**, nên dùng Docker Registry.

### Bước 1: Tạo Registry trên máy chủ

```bash
# Chạy Docker Registry
docker run -d -p 5000:5000 --name registry registry:2

# Tag lại images
docker tag flowershop-frontend:latest localhost:5000/flowershop-frontend:latest
docker tag flowershop-backend:latest localhost:5000/flowershop-backend:latest

# Push lên registry
docker push localhost:5000/flowershop-frontend:latest
docker push localhost:5000/flowershop-backend:latest
```

### Bước 2: Trên máy khác (cùng mạng LAN)

```bash
# Pull từ registry (thay 192.168.1.100 bằng IP máy chủ)
docker pull 192.168.1.100:5000/flowershop-frontend:latest
docker pull 192.168.1.100:5000/flowershop-backend:latest

# Chạy docker-compose
docker-compose up -d
```

---

## 🛠️ Script Tự Động Export (Windows PowerShell)

Tạo file `export_docker.ps1`:

```powershell
# Script tự động export Docker images

Write-Host "=== BẮT ĐẦU EXPORT DOCKER IMAGES ===" -ForegroundColor Green

# Tạo thư mục
$exportDir = "docker_export_$(Get-Date -Format 'yyyyMMdd_HHmmss')"
New-Item -ItemType Directory -Path $exportDir -Force
Set-Location $exportDir

# Export từng image
Write-Host "Đang export Frontend..." -ForegroundColor Yellow
docker save -o frontend.tar flowershop-frontend:latest

Write-Host "Đang export Backend..." -ForegroundColor Yellow
docker save -o backend.tar flowershop-backend:latest

Write-Host "Đang export MySQL..." -ForegroundColor Yellow
docker save -o mysql.tar mysql:8.0

Write-Host "Đang export Nginx..." -ForegroundColor Yellow
docker save -o nginx.tar nginx:alpine

Write-Host "Đang export PHPMyAdmin..." -ForegroundColor Yellow
docker save -o phpmyadmin.tar phpmyadmin:latest

# Nén code nguồn
Write-Host "Đang nén code nguồn..." -ForegroundColor Yellow
Set-Location ..
Compress-Archive -Path .\* -DestinationPath "$exportDir\project_source.zip" `
  -Exclude node_modules,vendor,docker_export*,.git

Write-Host "=== HOÀN THÀNH! ===" -ForegroundColor Green
Write-Host "Thư mục export: $exportDir" -ForegroundColor Cyan
Write-Host "Tổng dung lượng:" -ForegroundColor Cyan
Get-ChildItem $exportDir | Measure-Object -Property Length -Sum | 
  Select-Object @{Name="Size(GB)";Expression={[math]::Round($_.Sum/1GB, 2)}}
```

**Cách chạy:**
```powershell
.\export_docker.ps1
```

---

## 🛠️ Script Tự Động Import (Windows PowerShell)

Tạo file `import_docker.ps1` trong thư mục `docker_export`:

```powershell
# Script tự động import Docker images

Write-Host "=== BẮT ĐẦU IMPORT DOCKER IMAGES ===" -ForegroundColor Green

$tarFiles = Get-ChildItem -Filter *.tar

foreach ($file in $tarFiles) {
    Write-Host "Đang import $($file.Name)..." -ForegroundColor Yellow
    docker load -i $file.FullName
}

Write-Host "=== HOÀN THÀNH! ===" -ForegroundColor Green
Write-Host "Kiểm tra images đã import:" -ForegroundColor Cyan
docker images
```

**Cách chạy:**
```powershell
.\import_docker.ps1
```

---

## ⚠️ Lưu Ý Quan Trọng

### 1. Dung Lượng File
- Tổng dung lượng: **2-5GB**
- Cần USB/ổ cứng đủ lớn
- Nén bằng 7-Zip/WinRAR có thể giảm 20-30%

### 2. Phiên Bản Docker
- Máy nguồn và máy đích nên dùng **cùng phiên bản Docker**
- Kiểm tra: `docker --version`

### 3. Kiến Trúc CPU
- Images build trên **Windows** có thể không chạy trên **Linux** (và ngược lại)
- Nếu cần đa nền tảng, dùng `docker buildx`

### 4. Dữ Liệu Database
- Phương án 1 (Export images): **Không bao gồm dữ liệu**
- Phương án 2 (Commit containers): **Bao gồm dữ liệu**
- Nếu cần backup DB riêng:
  ```bash
  docker exec QuocHuy-mysql mysqldump -u root -p123456 flowershop > backup.sql
  ```

### 5. File .env
- **KHÔNG** nên đưa file `.env` chứa password vào package
- Dùng `.env.example` và hướng dẫn người dùng tự tạo

---

## 📊 Bảng So Sánh Chi Tiết

| Tiêu Chí | Git Clone | Export Images | Export Containers | Docker Registry |
|----------|-----------|---------------|-------------------|-----------------|
| **Dung lượng** | 50MB | 2-3GB | 5-10GB | 0 (pull qua mạng) |
| **Tốc độ cài đặt** | Chậm (build) | Nhanh | Rất nhanh | Trung bình |
| **Yêu cầu Internet** | ✅ Cần | ❌ Không | ❌ Không | ✅ Cần (LAN) |
| **Bao gồm data** | ❌ | ❌ | ✅ | ❌ |
| **Phù hợp cho** | Dev mới | Triển khai offline | Backup toàn bộ | Nhiều máy LAN |

---

## 🎯 Khuyến Nghị

### Dùng **Phương Án 1 (Export Images)** khi:
- ✅ Cần chuyển qua USB/ổ cứng
- ✅ Máy đích không có Internet
- ✅ Muốn triển khai nhanh

### Dùng **Git Clone** khi:
- ✅ Có Internet tốt
- ✅ Muốn code luôn mới nhất
- ✅ Nhiều người cùng phát triển

### Dùng **Docker Registry** khi:
- ✅ Có nhiều máy trong cùng mạng LAN
- ✅ Cần cập nhật thường xuyên
- ✅ Môi trường doanh nghiệp

---

## 📞 Checklist Trước Khi Chuyển

- [ ] Đã test dự án chạy OK trên máy nguồn
- [ ] Đã export đủ tất cả images cần thiết
- [ ] Đã copy file `docker-compose.yml`
- [ ] Đã tạo file `.env.example`
- [ ] Đã viết hướng dẫn cài đặt
- [ ] Đã kiểm tra dung lượng file export
- [ ] Đã backup database (nếu cần)
- [ ] Đã test import trên máy ảo (nếu có thể)

---

**Chúc bạn đóng gói thành công! 📦🚀**
