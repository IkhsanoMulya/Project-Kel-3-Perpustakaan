<script>
	import Button from '$lib/Button.svelte';
	import Table from '$lib/Table.svelte';
	const headings = ['No', 'Nomor Buku', 'Nama Buku', 'Detail'];
</script>

<div class="inline">
	<h1 align="center">Buku</h1>
	<Button>+ Tambah Buku</Button>
	<Table {headings} />
</div>
