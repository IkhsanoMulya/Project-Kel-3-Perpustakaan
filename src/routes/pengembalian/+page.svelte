<script>
	import {
		Table,
		TableBody,
		TableBodyCell,
		TableBodyRow,
		TableHead,
		TableHeadCell,
		TableSearch,
	} from 'flowbite-svelte';
	let searchTerm = '';
	let pengembalian = [
		{ id_pengembalian: 1, id_peminjaman: 1, tgl_kembali: '2023-06-08', denda: 0 },
		{ id_pengembalian: 2, id_peminjaman: 2, tgl_kembali: '2023-06-09', denda: 0 },
		{ id_pengembalian: 3, id_peminjaman: 3, tgl_kembali: '2023-06-10', denda: 0 },
		{ id_pengembalian: 4, id_peminjaman: 4, tgl_kembali: '2023-06-11', denda: 0 },
		{ id_pengembalian: 5, id_peminjaman: 5, tgl_kembali: '2023-06-12', denda: 0 },
	];
	$: filteredItems = pengembalian.filter(
		(item) =>
			item.id_pengembalian.toString().toLowerCase().indexOf(searchTerm.toLowerCase()) !== -1,
	);
	const headings = [
		'No',
		'Nomor Pengembalian',
		'Nama Pengembalian',
		'Tanggal Kembali',
		'Denda',
		'Detail',
	];
</script>

<div class="inline gap-10">
	<h1 class="text-4xl text-center font-semibold">Pengembalian</h1>
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
					<TableBodyCell>{item.id_pengembalian}</TableBodyCell>
					<TableBodyCell>{item.id_peminjaman}</TableBodyCell>
					<TableBodyCell>{item.tgl_kembali}</TableBodyCell>
					<TableBodyCell>{item.denda}</TableBodyCell>
					<TableBodyCell>
						<a class="text-blue-600" href="/peminjaman/detail">View</a>
					</TableBodyCell>
				</TableBodyRow>
			{/each}
		</TableBody>
	</TableSearch>
</div>
