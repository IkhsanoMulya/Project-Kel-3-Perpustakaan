<script>
	import Button from '$lib/Button.svelte';
	import Table from '$lib/Table.svelte';
	const headings = ['No', 'Nomor Anggota', 'Nama Anggota', 'Detail'];
</script>

<div class="inline">
	<h1 align="center">Anggota</h1>
	<Button>+ Tambah Anggota</Button>
	<Table {headings} />
</div>
