// Kiểm tra quyền Admin (chỉ Admin mới vào được)
// id_chuc_vu = 1 là Admin, còn lại là Nhân viên
export default function (to, from, next) {
    var adminData = localStorage.getItem("key_admin");

    if (!adminData) {
        alert("Vui lòng đăng nhập!");
        next("/admin/dang-nhap");
        return;
    }

    try {
        const admin = JSON.parse(adminData);
        // Kiểm tra: id_chuc_vu = 1 là Admin
        if (admin.id_chuc_vu == 1) {
            // Là Admin, cho phép truy cập
            next();
        } else {
            alert("Bạn không có quyền truy cập chức năng này! Chỉ Admin mới được phép.");
            next("/admin");
        }
    } catch (e) {
        // Nếu không parse được, chặn luôn
        alert("Vui lòng đăng nhập lại!");
        next("/admin/dang-nhap");
    }
}
