<script lang="ts">
	import { Input, Label, Button, Card } from 'flowbite-svelte';
	let desktop: string;
	const agent = window.electron ? 'Electron' : 'Browser';
</script>

<main>
	<div class="container">
		<div class="container">
			<Card>
				<h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
					Jumlah Pengunjung Hari Ini
				</h5>
				<p class="font-normal text-gray-700 dark:text-gray-400 leading-tight">127</p>
			</Card>
			<Card>
				<h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
					Jumlah Peminjaman Hari Ini
				</h5>
				<p class="font-normal text-gray-700 dark:text-gray-400 leading-tight">127</p>
			</Card>
			<Card>
				<h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
					Quotes Hari Ini
				</h5>
				<p class="font-normal text-gray-700 dark:text-gray-400 leading-tight">127</p>
			</Card>
			<form>
				<Label for="search" class="block mb-2">Absensi Pengunjung</Label>
				<Input id="search" placeholder="Masukkan Nomor Anggota" size="lg">
					<svg
						slot="left"
						aria-hidden="true"
						class="w-6 h-6 text-gray-500 dark:text-gray-400"
						fill="none"
						stroke="currentColor"
						viewBox="0 0 24 24"
						xmlns="http://www.w3.org/2000/svg"
					>
						<path
							stroke-linecap="round"
							stroke-linejoin="round"
							stroke-width="2"
							d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
						/>
					</svg>
					<Button slot="right" size="sm" type="submit">Submit</Button>
				</Input>
			</form>
		</div>
	</div>
</main>

<style>
</style>
