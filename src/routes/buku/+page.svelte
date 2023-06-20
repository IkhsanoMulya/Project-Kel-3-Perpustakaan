<script>
	const headings = [
		'No',
		'ID Buku',
		'Judul Buku',
		'Penulis',
		'Penerbit',
		'Tahun Terbit',
		'Stok',
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
	export let buku = [
		{
			No: 1,
			id: 'BKI001',
			judul: 'Kamus Bahasa Indonesia',
			penulis: 'Ahmad Rizky',
			penerbit: 'Gramedia Pustaka Utama',
			tahun: 2017,
			stok: 10,
		},
		{
			No: 2,
			id: 'BKI002',
			judul: 'Panduan Tatabahasa Indonesia',
			penulis: 'Dewi Rahmawati',
			penerbit: 'Erlangga',
			tahun: 2018,
			stok: 5,
		},
		{
			No: 3,
			id: 'BKI003',
			judul: 'Cerita Rakyat Indonesia',
			penulis: 'Siti Nurhayati',
			penerbit: 'GagasMedia',
			tahun: 2019,
			stok: 8,
		},
		{
			No: 4,
			id: 'BKI004',
			judul: 'Sejarah Indonesia',
			penulis: 'Budi Santoso',
			penerbit: 'Pustaka Larasan',
			tahun: 2020,
			stok: 12,
		},
		{
			No: 5,
			id: 'BKI005',
			judul: 'Kumpulan Puisi Indonesia',
			penulis: 'Rina Sari',
			penerbit: 'Gramedia Pustaka Utama',
			tahun: 2019,
			stok: 7,
		},
		{
			No: 6,
			id: 'BKI006',
			judul: 'Novel Romantis',
			penulis: 'Andre Setiawan',
			penerbit: 'Erlangga',
			tahun: 2021,
			stok: 15,
		},
		{
			No: 7,
			id: 'BKI007',
			judul: 'Ensiklopedia Indonesia',
			penulis: 'Fitriani R.',
			penerbit: 'GagasMedia',
			tahun: 2016,
			stok: 3,
		},
		{
			No: 8,
			id: 'BKI008',
			judul: 'Filsafat Hidup',
			penulis: 'Adi Nugroho',
			penerbit: 'Pustaka Larasan',
			tahun: 2022,
			stok: 9,
		},
		{
			No: 9,
			id: 'BKI009',
			judul: 'Kisah Inspiratif',
			penulis: 'Lina Wijaya',
			penerbit: 'Gramedia Pustaka Utama',
			tahun: 2020,
			stok: 4,
		},
		{
			No: 10,
			id: 'BKI010',
			judul: 'Fiksi Ilmiah',
			penulis: 'Ryan Hartono',
			penerbit: 'Erlangga',
			tahun: 2019,
			stok: 11,
		},
		{
			No: 11,
			id: 'BKI011',
			judul: 'Buku Makanan Tradisional',
			penulis: 'Anita Wijaya',
			penerbit: 'Pustaka Larasan',
			tahun: 2021,
			stok: 6,
		},
		// Tambahkan data buku lainnya di sini
	];
	$: filteredItems = buku.filter(
		(item) => item.judul.toLowerCase().indexOf(searchTerm.toLowerCase()) !== -1,
	);
</script>

<div class="inline gap-10">
	<h1 class="text-4xl text-center font-semibold">Buku</h1>
	<Button color="green" href="/buku/create">+ Tambah Buku</Button>
	<TableSearch placeholder="Search by judul" hoverable={true} bind:inputValue={searchTerm}>
		<TableHead>
			{#each headings as heading}
				<TableHeadCell>{heading}</TableHeadCell>
			{/each}
		</TableHead>
		<TableBody class="divide-y">
			{#each filteredItems as item}
				<TableBodyRow>
					<TableBodyCell>{item.No}</TableBodyCell>
					<TableBodyCell>{item.id}</TableBodyCell>
					<TableBodyCell>{item.judul}</TableBodyCell>
					<TableBodyCell>{item.penulis}</TableBodyCell>
					<TableBodyCell>{item.penerbit}</TableBodyCell>
					<TableBodyCell>{item.tahun}</TableBodyCell>
					<TableBodyCell>{item.stok}</TableBodyCell>
					<TableBodyCell>
						<div class="container">
							<Button class="bg-yellow-300 rounded-lg p-2" href="/buku/edit/">
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
							<Button class="bg-red-600 rounded-lg p-2" href="/buku/delete">
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
