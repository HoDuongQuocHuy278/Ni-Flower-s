# 🌸 Ni Flower's - Flowershop Project

Dự án web bán hoa với Laravel Backend và Vue.js Frontend, được dockerize hoàn chỉnh.

## 🚀 Quick Start với Docker

### Yêu cầu
- [Docker Desktop](https://www.docker.com/products/docker-desktop/)
- [Git](https://git-scm.com/)

### Cài đặt

```bash
# 1. Clone repo
git clone https://github.com/HoDuongQuocHuy278/Ni-Flower-s.git
cd Ni-Flower-s

# 2. Build Docker images
docker-compose build

# 3. Khởi động services
docker-compose up -d

# 4. Chạy migrations (lần đầu tiên)
docker exec flowershop-backend php artisan migrate --force
```

### Truy cập
| Service | URL |
|---------|-----|
| 🌐 Frontend | http://localhost:3000 |
| 🔧 Backend API | http://localhost:8000 |
| 📊 PHPMyAdmin | http://localhost:8080 |
| 🗄️ MySQL | localhost:3307 |

**PHPMyAdmin Login:**
- Username: `root`
- Password: `root`

## 📁 Cấu trúc dự án

```
Ni-Flower-s/
├── BE_Flowershop/          # Laravel Backend
│   └── Dockerfile
├── FE_Flowershop/          # Vue.js Frontend
│   ├── Dockerfile
│   └── nginx.conf
├── nginx/
│   └── backend.conf
└── docker-compose.yml
```

## ⚙️ Cấu hình Database

Mặc định kết nối MySQL trên máy host:
- Host: `host.docker.internal`
- Port: `3306`
- Database: `flowershop`
- Username: `root`
- Password: (trống)

Để thay đổi, chỉnh sửa trong `docker-compose.yml`:
```yaml
environment:
  - DB_HOST=host.docker.internal
  - DB_DATABASE=flowershop
  - DB_USERNAME=root
  - DB_PASSWORD=your_password
```

## 🛠️ Docker Commands

```bash
# Xem logs
docker-compose logs -f

# Dừng services
docker-compose down

# Rebuild
docker-compose build --no-cache
docker-compose up -d
```

## 📝 Tech Stack

- **Backend**: Laravel 12, PHP 8.2
- **Frontend**: Vue 3, Vite
- **Database**: MySQL 8.0
- **Server**: Nginx, PHP-FPM
- **Container**: Docker

## 👤 Author

HoDuongQuocHuy278
