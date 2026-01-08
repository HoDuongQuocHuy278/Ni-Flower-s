export default function (to, from, next) {
    var admin = localStorage.getItem("key_admin");

    if (admin) {
        // Đã đăng nhập
        next();
    } else {
        // Chưa đăng nhập, chuyển đến trang login
        alert("Vui lòng đăng nhập!");
        next("/admin/dang-nhap");
    }
}
