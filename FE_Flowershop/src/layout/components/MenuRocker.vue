<template>
	<div class="nav-container primary-menu">
		<div class="mobile-topbar-header">
			<div>
				<img src="../../assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
			</div>
			<div>
				<h4 class="logo-text">🌸 Ni Flower's</h4>
			</div>
			<div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
			</div>
		</div>
		<nav class="navbar navbar-expand-xl w-100">
			<ul class="navbar-nav justify-content-start flex-grow-1 gap-1">
				<!-- Dashboard -->
				<router-link to="/admin">
					<li class="nav-item">
						<a class="nav-link" href="/admin">
							<div class="parent-icon">
								<i class="bx bx-home-circle"></i>
							</div>
							<div class="menu-title">Dashboard</div>
						</a>
					</li>
				</router-link>

				<!-- Quản lý Sản phẩm -->
				<li class="nav-item dropdown">
					<a href="javascript:;" class="nav-link dropdown-toggle dropdown-toggle-nocaret show"
						data-bs-toggle="dropdown" aria-expanded="true">
						<div class="parent-icon"><i class="fa-solid fa-leaf"></i></div>
						<div class="menu-title">Quản lý Sản Phẩm</div>
					</a>
					<ul class="dropdown-menu show" data-bs-popper="static">
						<router-link to="/admin/bo-hoa">
							<li>
								<a class="dropdown-item" href="/admin/bo-hoa">
									<i class="bx bx-right-arrow-alt"></i>Bó Hoa
								</a>
							</li>
						</router-link>
						<router-link to="/admin/danh-muc">
							<li>
								<a class="dropdown-item" href="/admin/danh-muc">
									<i class="bx bx-right-arrow-alt"></i>Danh Mục
								</a>
							</li>
						</router-link>
					</ul>
				</li>

				<!-- Phân loại -->
				<li class="nav-item dropdown">
					<a href="javascript:;" class="nav-link dropdown-toggle dropdown-toggle-nocaret show"
						data-bs-toggle="dropdown" aria-expanded="true">
						<div class="parent-icon"><i class="fa-solid fa-tags"></i></div>
						<div class="menu-title">Phân Loại</div>
					</a>
					<ul class="dropdown-menu show" data-bs-popper="static">
						<router-link to="/admin/mua-hoa">
							<li>
								<a class="dropdown-item" href="/admin/mua-hoa">
									<i class="bx bx-right-arrow-alt"></i>Theo Mùa
								</a>
							</li>
						</router-link>
						<router-link to="/admin/dip-le">
							<li>
								<a class="dropdown-item" href="/admin/dip-le">
									<i class="bx bx-right-arrow-alt"></i>Theo Dịp Lễ
								</a>
							</li>
						</router-link>
					</ul>
				</li>

				<!-- Quản lý Nhân viên (Admin Only) -->
				<li class="nav-item dropdown" v-if="isAdmin">
					<a href="javascript:;" class="nav-link dropdown-toggle dropdown-toggle-nocaret show"
						data-bs-toggle="dropdown" aria-expanded="true">
						<div class="parent-icon"><i class="fa-solid fa-user-shield"></i></div>
						<div class="menu-title">Phân Quyền</div>
					</a>
					<ul class="dropdown-menu show" data-bs-popper="static">
						<router-link to="/admin/nhan-vien">
							<li>
								<a class="dropdown-item" href="/admin/nhan-vien">
									<i class="bx bx-right-arrow-alt"></i>Nhân Viên
								</a>
							</li>
						</router-link>
						<router-link to="/admin/chuc-vu">
							<li>
								<a class="dropdown-item" href="/admin/chuc-vu">
									<i class="bx bx-right-arrow-alt"></i>Chức Vụ
								</a>
							</li>
						</router-link>
					</ul>
				</li>

				<!-- Bài viết -->
				<router-link to="/admin/bai-viet">
					<li class="nav-item">
						<a class="nav-link" href="/admin/bai-viet">
							<div class="parent-icon">
								<i class="fa-solid fa-newspaper"></i>
							</div>
							<div class="menu-title">Bài Viết</div>
						</a>
					</li>
				</router-link>
			</ul>
		</nav>
	</div>
</template>
<script>
export default {
	data() {
		return {
			isAdmin: false
		}
	},
	mounted() {
		this.checkPermission();
	},
	methods: {
		checkPermission() {
			const adminData = localStorage.getItem("key_admin");
			if (adminData) {
				try {
					const admin = JSON.parse(adminData);
					// Kiểm tra quyền Admin: id_chuc_vu = 1 là Admin
					this.isAdmin = (admin.id_chuc_vu == 1);
				} catch (e) {
					this.isAdmin = false;
				}
			}
		}
	}
}
</script>
<style></style>
