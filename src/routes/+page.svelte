<script lang="ts">
	import { Input, Label, Button, Card } from 'flowbite-svelte';
	let desktop: string;
	const agent = window.electron ? 'Electron' : 'Browser';
</script>

<main>
	<div class="container">
		<div class="flex justify-center text-center items-center my-5">
			<div class="grid grid-cols-1 md:grid-cols-3 gap-10">
				<div class="bg-red-400 p-8 rounded-lg shadow-lg">
					<h2 class="text-white text-2xl mb-4">Pengunjung Hari Ini</h2>
					<p class="text-white text-4xl">100</p>
				</div>
				<div class="bg-yellow-300 p-8 rounded-lg shadow-lg">
					<h2 class="text-white text-2xl mb-4">Peminjaman Hari Ini</h2>
					<p class="text-white text-4xl">50</p>
				</div>
				<div class="bg-green-400 p-8 rounded-lg shadow-lg">
					<h2 class="text-white text-2xl mb-4">Jam</h2>
					<p class="text-white text-4xl">12:00 PM</p>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="my-5 p-5 text-black bg-gray-200 font-serif text-center rounded-lg">
				<p class="text-4xl my-2">"Kosong adalah isi, isi adalah kosong"</p>
				<p class="text-2xl my-2">~ Saya ~</p>
			</div>
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
