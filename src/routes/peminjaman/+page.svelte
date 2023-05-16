<script lang="ts">
	import Button from '$lib/Button.svelte';
	import Table from '$lib/Table.svelte';
	const headings = ['No', 'Nomor Peminjaman', 'Nama Peminjam', 'Detail'];
</script>

<div class="inline">
	<h1 class="center">Peminjaman</h1>
	<Button>+ Tambah Peminjaman</Button>
	<Table {headings} />
</div>
