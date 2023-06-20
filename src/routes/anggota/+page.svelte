<script lang="ts">
	import Aksi from '$lib/Aksi.svelte';
	import {
		Button,
		ButtonGroup,
		Table,
		TableBody,
		TableBodyCell,
		TableBodyRow,
		TableHead,
		TableHeadCell,
		TableSearch,
	} from 'flowbite-svelte';
	const headings = [
		'No',
		'ID Anggota',
		'Nama Anggota',
		'Jenis Kelamin',
		'Alamat',
		'No. Telepon',
		'Aksi',
	];

	let searchTerm = '';
	$: filteredItems = anggota.filter(
		(item) => item.nama.toLowerCase().indexOf(searchTerm.toLowerCase()) !== -1,
	);
</script>

<div class="inline gap-10">
	<h1 class="text-4xl text-center font-semibold font-serif">Anggota</h1>
	<Button color="green" href="/anggota/create">+ Tambah Anggota</Button>
	<TableSearch placeholder="Search by name" hoverable={true} bind:inputValue={searchTerm}>
		<TableHead>
			{#each headings as heading}
				<TableHeadCell>{heading}</TableHeadCell>
			{/each}
		</TableHead>
		<TableBody>
			{#each filteredItems as item}
				<TableBodyRow>
					<TableBodyCell>{item.nama}</TableBodyCell>
					<TableBodyCell>{item.alamat}</TableBodyCell>
					<TableBodyCell>{item.tanggal_lahir}</TableBodyCell>
					<TableBodyCell>{item.jenis_kelamin}</TableBodyCell>
					<TableBodyCell>{item.telepon}</TableBodyCell>
					<TableBodyCell>
						<div class="container">
							<Button
								class="bg-yellow-300 rounded-lg p-2"
								href="/anggota/edit/{item.id_anggota}"
							>
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
							<Button
								class="bg-red-600 rounded-lg p-2"
								href="/anggota/delete/{item.id_anggota}"
							>
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
	<!-- <div class="pagination">
		<ButtonGroup>
			{#each Array.from({ length: Math.ceil(filteredItems.length / itemsPerPage) }, (_, index) => index + 1) as number}
				<Button>
					{number}
				</Button>
			{/each}
		</ButtonGroup>
	</div> -->
</div>
