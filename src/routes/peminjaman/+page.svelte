<script lang="ts">
	import { index } from './../../../.svelte-kit/output/server/nodes/8.js';
	const headings = [
		'No',
		'ID Peminjaman',
		'Nama Peminjam',
		'Tanggal Pinjam',
		'Tanggal Kembali',
		'Detail',
		'Aksi',
	];

	import Aksi from '$lib/Aksi.svelte';
	import {
		Button,
		Table,
		TableBody,
		TableBodyCell,
		TableBodyRow,
		TableHead,
		TableHeadCell,
		TableSearch,
	} from 'flowbite-svelte';
	let searchTerm = '';
	export let peminjaman = [
		{ id_peminjaman: 1, id_anggota: 1001, tgl_pinjam: '2023-06-01', tgl_kembali: '2023-06-08' },
		{ id_peminjaman: 2, id_anggota: 1002, tgl_pinjam: '2023-06-02', tgl_kembali: '2023-06-09' },
		{ id_peminjaman: 3, id_anggota: 1003, tgl_pinjam: '2023-06-03', tgl_kembali: '2023-06-10' },
		{ id_peminjaman: 4, id_anggota: 1004, tgl_pinjam: '2023-06-04', tgl_kembali: '2023-06-11' },
		{ id_peminjaman: 5, id_anggota: 1005, tgl_pinjam: '2023-06-05', tgl_kembali: '2023-06-12' },
	];
	$: filteredItems = peminjaman.filter(
		(item) =>
			item.id_peminjaman.toString().toLowerCase().indexOf(searchTerm.toLowerCase()) !== -1,
	);
</script>

<div class="inline gap-10">
	<h1 class="text-4xl text-center font-semibold">Peminjaman</h1>
	<Button color="green" href="/peminjaman/create">+ Tambah Peminjaman</Button>
	<TableSearch placeholder="Search by maker name" hoverable={true} bind:inputValue={searchTerm}>
		<TableHead>
			{#each headings as heading}
				<TableHeadCell>{heading}</TableHeadCell>
			{/each}
		</TableHead>
		<TableBody>
			{#each filteredItems as item, index}
				<TableBodyRow>
					<TableBodyCell>{index + 1}</TableBodyCell>
					<TableBodyCell>{item.id_peminjaman}</TableBodyCell>
					<TableBodyCell>{item.id_anggota}</TableBodyCell>
					<TableBodyCell>{item.tgl_pinjam}</TableBodyCell>
					<TableBodyCell>{item.tgl_kembali}</TableBodyCell>
					<TableBodyCell>
						<a href="/peminjaman/detail" class="text-blue-600">View</a>
					</TableBodyCell>
					<TableBodyCell>
						<div class="container">
							<Button class="bg-yellow-300 rounded-lg p-2" href="/peminjaman/edit/">
								<svg
									width="20px"
									height="20px"
									viewBox="0 0 24 24"
									xmlns="http://www.w3.org/2000/svg"
								>
									<title />

									<g id="Complete">
										<g id="edit">
											<g>
												<path
													d="M20,16v4a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V6A2,2,0,0,1,4,4H8"
													fill="none"
													stroke="#000000"
													stroke-linecap="round"
													stroke-linejoin="round"
													stroke-width="2"
												/>

												<polygon
													fill="none"
													points="12.5 15.8 22 6.2 17.8 2 8.3 11.5 8 16 12.5 15.8"
													stroke="#000000"
													stroke-linecap="round"
													stroke-linejoin="round"
													stroke-width="2"
												/>
											</g>
										</g>
									</g>
								</svg>
							</Button>
							<Button class="bg-red-600 rounded-lg p-2" href="/peminjaman/delete">
								<svg
									width="20px"
									height="20px"
									viewBox="0 0 24 24"
									fill="none"
									xmlns="http://www.w3.org/2000/svg"
								>
									<path
										d="M10 12V17"
										stroke="#000000"
										stroke-width="2"
										stroke-linecap="round"
										stroke-linejoin="round"
									/>
									<path
										d="M14 12V17"
										stroke="#000000"
										stroke-width="2"
										stroke-linecap="round"
										stroke-linejoin="round"
									/>
									<path
										d="M4 7H20"
										stroke="#000000"
										stroke-width="2"
										stroke-linecap="round"
										stroke-linejoin="round"
									/>
									<path
										d="M6 10V18C6 19.6569 7.34315 21 9 21H15C16.6569 21 18 19.6569 18 18V10"
										stroke="#000000"
										stroke-width="2"
										stroke-linecap="round"
										stroke-linejoin="round"
									/>
									<path
										d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z"
										stroke="#000000"
										stroke-width="2"
										stroke-linecap="round"
										stroke-linejoin="round"
									/>
								</svg>
							</Button>
						</div>
					</TableBodyCell>
				</TableBodyRow>
			{/each}
		</TableBody>
	</TableSearch>
</div>
