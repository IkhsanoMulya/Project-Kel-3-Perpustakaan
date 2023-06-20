<script lang="ts">
	import { TableBody } from 'flowbite-svelte';
	import type { PageData } from './$types';

	//export let data: PageData;

	const today = new Date();
	const currY = today.getFullYear();
	const currM = today.getMonth() + 1; // currMs are zero-based, so we add 1
	const currD = today.getDate();

	// Format the date as desired (e.g., YYYY-MM-DD)
	const formattedDate = `${currY}-${currM.toString().padStart(2, '0')}-${currD
		.toString()
		.padStart(2, '0')}`;

	const futureDate = new Date(today.getTime() + 14 * 24 * 60 * 60 * 1000);

	const year = futureDate.getFullYear();
	const month = futureDate.getMonth() + 1;
	const day = futureDate.getDate();

	const nextDate = `${year}-${month.toString().padStart(2, '0')}-${day
		.toString()
		.padStart(2, '0')}`;
</script>

<main>
	<div class="container my-5">
		<h2 class=" text-4xl font-semibold leading-7 text-gray-900">Tambahkan Peminjaman</h2>
		<form action="">
			<div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
				<div class="sm:col-span-4">
					<label
						for="first-name"
						class="block text-sm font-medium leading-6 text-gray-900"
					>
						Nomor Peminjaman
					</label>
					<div class="mt-2">
						<input
							type="text"
							name="first-name"
							id="first-name"
							autocomplete="given-name"
							class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
						/>
					</div>
				</div>
				<div class="sm:col-span-4">
					<label
						for="first-name"
						class="block text-sm font-medium leading-6 text-gray-900"
					>
						ID Peminjam
					</label>
					<div class="mt-2">
						<input
							type="text"
							name="first-name"
							id="first-name"
							autocomplete="given-name"
							class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
						/>
					</div>
				</div>
				<!-- <div class="sm:col-span-6">
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
									
								</TableBodyRow>
							{/each}
						</TableBody>
					</TableSearch>
				</div> -->
				<br />
				<div class="sm:col-span-2">
					<label for="alamat" class="block text-sm font-medium leading-6 text-gray-900">
						Tanggal Pinjam
					</label>
					<div class="mt-2">
						<input
							id="alamat"
							name="alamat"
							type="date"
							autocomplete="alamat"
							value={formattedDate}
							class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
						/>
					</div>
				</div>
				<div class="sm:col-span-2">
					<label for="telepon" class="block text-sm font-medium leading-6 text-gray-900">
						Tanggal Kembali
					</label>
					<div class="mt-2">
						<input
							id="telepon"
							name="telepon"
							type="date"
							value={nextDate}
							autocomplete=""
							class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
						/>
					</div>
				</div>
			</div>
			<div class="mt-6">
				<button
					type="submit"
					class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
				>
					Save
				</button>
				<button type="button" class="text-sm font-semibold leading-6 text-gray-900">
					Cancel
				</button>
			</div>
		</form>
	</div>
</main>
