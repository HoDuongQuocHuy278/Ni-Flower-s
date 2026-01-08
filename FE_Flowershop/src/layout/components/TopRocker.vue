<template>
	<div class="topbar d-flex align-items-center">
		<nav class="navbar navbar-expand">
			<div class="topbar-logo-header">
				<div class="">
					<img src="../../assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
				</div>
				<div class="">
					<h4 class="logo-text">🌸 Ni Flower's</h4>
				</div>
			</div>
			<div class="mobile-toggle-menu"><i class='bx bx-menu'></i></div>
			<div class="search-bar flex-grow-1">
				<div class="position-relative search-bar-box">
					<input type="text" class="form-control search-control" placeholder="Tìm Kiếm?">
					<span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
					<span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
				</div>
			</div>
			<div class="top-menu ms-auto">
				<ul class="navbar-nav align-items-center">
					<li class="nav-item">
						<router-link to="/" class="nav-link text-primary" title="Xem trang chủ">
							<i class='bx bx-home-circle'></i> Trang Chủ
						</router-link>
					</li>
				</ul>
			</div>
			<div class="user-box dropdown">
				<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
					role="button" data-bs-toggle="dropdown" aria-expanded="false">
					<div class="user-info ps-3">
						<p class="user-name mb-0">{{ adminName }}</p>
						<p class="designattion mb-0">{{ adminRole }}</p>
					</div>
				</a>
				<ul class="dropdown-menu dropdown-menu-end">
					<li>
						<a class="dropdown-item" href="javascript:;" @click="dangXuat">
							<i class='bx bx-log-out-circle text-danger'></i>
							<span>Đăng Xuất</span>
						</a>
					</li>
				</ul>
			</div>
		</nav>
	</div>
</template>
<script>
export default {
	data() {
		return {
			adminName: 'Admin',
			adminRole: 'Quản trị'
		}
	},
	mounted() {
		this.loadAdminInfo();
	},
	methods: {
		loadAdminInfo() {
			const adminData = localStorage.getItem("key_admin");
			if (adminData) {
				try {
					const admin = JSON.parse(adminData);
					this.adminName = admin.ho_va_ten || 'Admin';
					// id_chuc_vu = 1 là Admin, còn lại là Nhân viên
					this.adminRole = admin.id_chuc_vu == 1 ? '👑 Admin' : '👤 Nhân viên';
				} catch (e) {
					this.adminName = 'Admin';
					this.adminRole = 'Quản trị';
				}
			}
		},
		dangXuat() {
			if (confirm('Bạn có chắc muốn đăng xuất?')) {
				// Xóa tất cả dữ liệu đăng nhập
				localStorage.removeItem('key_admin');
				localStorage.removeItem('ho_va_ten');
				
				alert('Đăng xuất thành công!');
				this.$router.push('/admin/dang-nhap');
			}
		}
	}
}
</script>
<style></style>
