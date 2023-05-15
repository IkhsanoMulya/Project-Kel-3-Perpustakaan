<script>
	/* global bootstrap: false */
	(() => {
		'use strict';
		const tooltipTriggerList = Array.from(
			document.querySelectorAll('[data-bs-toggle="tooltip"]'),
		);
		tooltipTriggerList.forEach((tooltipTriggerEl) => {
			new bootstrap.Tooltip(tooltipTriggerEl);
		});
	})();
</script>

<div class="d-flex flex-column flex-shrink-0 bg-body-tertiary border-right" style="width: 6rem;">
	<a
		href="/"
		class="d-block p-3 link-body-emphasis text-decoration-none"
		title="Scientia"
		data-bs-toggle="tooltip"
		data-bs-placement="right"
	>
		<!-- LOGO <svg class="bi pe-none" width="40" height="32"><use xlink:href="#bootstrap" /></svg> -->
		<img src="src/lib/img/open-book.png" alt="Logo" width="30" aria-label="Scientia" />
		<span class="visually-hidden">Scientia</span>
	</a>
	<ul class="nav nav-pills nav-flush flex-column mb-auto text-center bg-white">
		<li class="nav-item">
			<a
				href="/"
				class="simbol nav-link py-3 rounded-0"
				aria-current="page"
				title="Home"
				data-bs-toggle="tooltip"
				data-bs-placement="right"
			>
				<!-- <svg class="bi pe-none" width="24" height="24" role="img" aria-label="Home">
					<use xlink:href="#home" />
				</svg> -->
				<img
					src="src/lib/img/home.png"
					alt="home"
					width="27"
					height="27"
					aria-label="Home"
				/>
			</a>
		</li>

		<li>
			<a
				href="/peminjaman"
				class="simbol nav-link py-3 rounded-0"
				title="Peminjaman"
				data-bs-toggle="tooltip"
				data-bs-placement="right"
			>
				<!-- HOME <svg class="bi pe-none" width="27" height="27" role="img" aria-label="Orders">
					<use xlink:href="#table" />
				</svg> -->
				<img
					src="src/lib/img/borrow.png"
					alt="home"
					width="27"
					height="27"
					aria-label="Peminjaman"
				/>
			</a>
		</li>
		<li>
			<a
				href="/pengembalian"
				class="simbol nav-link py-3 rounded-0"
				title="Pengembalian"
				data-bs-toggle="tooltip"
				data-bs-placement="right"
			>
				<!-- PEMINJAMAN <svg class="bi pe-none" width="27" height="27" role="img" aria-label="Products">
					<use xlink:href="#grid" />
				</svg> -->
				<img
					src="src/lib/img/return.png"
					alt="home"
					width="27"
					height="27"
					aria-label="Pengembalian"
				/>
			</a>
		</li>
		<li>
			<a
				href="/anggota"
				class="simbol nav-link py-3 rounded-0"
				title="Anggota"
				data-bs-toggle="tooltip"
				data-bs-placement="right"
			>
				<!-- PENGEMBALIAN <svg class="bi pe-none" width="27" height="27" role="img" aria-label="Customers">
					<use xlink:href="#people-circle" />
				</svg> -->
				<img
					src="src/lib/img/group.png"
					alt="home"
					width="27"
					height="27"
					aria-label="Anggota"
				/>
			</a>
		</li>
		<li>
			<a
				href="/buku"
				class="simbol nav-link py-3 rounded-0"
				title="Buku"
				data-bs-toggle="tooltip"
				data-bs-placement="right"
			>
				<!-- ANGGOTA <svg class="bi pe-none" width="27" height="27" role="img" aria-label="Customers">
					<use xlink:href="#people-circle" />
				</svg> -->
				<img
					src="src/lib/img/book.png"
					alt="home"
					width="27"
					height="27"
					aria-label="Buku"
				/>
			</a>
		</li>
	</ul>
	<div class="dropdown">
		<a
			href="#top"
			class="d-flex align-items-center justify-content-center p-3 link-body-emphasis text-decoration-none dropdown-toggle"
			data-bs-toggle="dropdown"
			aria-expanded="false"
		>
			<h6>User</h6>
		</a>
		<ul class="dropdown-menu text-small shadow">
			<li><a class="dropdown-item" href="#top">Settings</a></li>
			<li><hr class="dropdown-divider" /></li>
			<li><a class="dropdown-item" href="#bottom">Sign out</a></li>
		</ul>
	</div>
</div>

<style>
	.simbol:hover {
		transform: scale(1.1);
		background-color: rgb(31, 104, 214);
		transition: background-color 0.3s ease-in-out;
	}
</style>
