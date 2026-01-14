// ========================================
// CẤU HÌNH API - CHỈ ĐỔI IP Ở ĐÂY THÔI!
// ========================================

// 🔧 ĐỔI IP MÁY CHỦ Ở ĐÂY:
const ipbe = 'http://192.168.1.61:8000';

// ========================================
// KHÔNG CẦN SỬA GÌ BÊN DƯỚI
// ========================================

// Lấy từ biến môi trường hoặc dùng giá trị mặc định
export const API_URL = import.meta.env.VITE_API_URL || ipbe;

// Helper function để tạo URL API đầy đủ
export const getApiUrl = (endpoint) => {
    // Loại bỏ dấu / ở đầu nếu có
    const cleanEndpoint = endpoint.startsWith('/') ? endpoint : `/${endpoint}`;
    return `${API_URL}${cleanEndpoint}`;
};

// Helper function để tạo URL hình ảnh
export const getImageUrl = (path) => {
    if (!path) return '';
    if (path.startsWith('http')) return path;
    return API_URL + path;
};

// Export ipbe để dùng trong components
export { ipbe };

// Export default
export default {
    ipbe,
    API_URL,
    getApiUrl,
    getImageUrl
};
