import { createRouter, createWebHistory } from "vue-router";
import checkAdmin from "./checkAdmin.js";
import checkAdminOnly from "./checkAdminOnly.js";

const routes = [
    // ============= Client Routes ==================
    {
        path: "/",
        component: () => import("../components/Client/TrangChu/index.vue"),
        meta: { layout: "client" },
    },
    {
        path: "/danh-muc",
        component: () => import("../components/Client/DanhMuc/index.vue"),
        meta: { layout: "client" },
    },
    {
        path: "/mua/:id",
        component: () => import("../components/Client/DanhMuc/index.vue"),
        meta: { layout: "client" },
    },
    {
        path: "/dip-le/:id",
        component: () => import("../components/Client/DanhMuc/index.vue"),
        meta: { layout: "client" },
    },
    {
        path: "/chi-tiet/:id",
        component: () => import("../components/Client/ChiTietBoHoa/index.vue"),
        meta: { layout: "client" },
        props: true,
    },
    {
        path: "/bai-viet",
        component: () => import("../components/Client/BaiViet/index.vue"),
        meta: { layout: "client" },
    },
    {
        path: "/chi-tiet-bai-viet/:id_bai_viet",
        component: () => import("../components/Client/ChiTietBaiViet/index.vue"),
        meta: { layout: "client" },
        props: true,
    },

    // ============= Admin Routes ==================
    {
        path: "/admin",
        component: () => import("../components/Admin/Dashboard/index.vue"),
        beforeEnter: checkAdmin
    },
    {
        path: "/admin/dang-nhap",
        component: () => import("../components/Admin/DangNhap/index.vue"),
        meta: { layout: "blank" },
    },
    {
        path: "/admin/bo-hoa",
        component: () => import("../components/Admin/BoHoa/index.vue"),
        beforeEnter: checkAdmin,
    },
    {
        path: "/admin/danh-muc",
        component: () => import("../components/Admin/DanhMuc/index.vue"),
        beforeEnter: checkAdmin,
    },
    {
        path: "/admin/mua-hoa",
        component: () => import("../components/Admin/MuaHoa/index.vue"),
        beforeEnter: checkAdmin,
    },
    {
        path: "/admin/dip-le",
        component: () => import("../components/Admin/DipLe/index.vue"),
        beforeEnter: checkAdmin,
    },
    {
        path: "/admin/nhan-vien",
        component: () => import("../components/Admin/NhanVien/index.vue"),
        beforeEnter: checkAdminOnly, // Chỉ Admin mới vào được
    },
    {
        path: "/admin/chuc-vu",
        component: () => import("../components/Admin/ChucVu/index.vue"),
        beforeEnter: checkAdminOnly, // Chỉ Admin mới vào được
    },
    {
        path: "/admin/bai-viet",
        component: () => import("../components/Admin/BaiViet/index.vue"),
        beforeEnter: checkAdmin,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
