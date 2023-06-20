<script lang="ts">
	import type { PageData } from './$types';

	export let data: PageData;
</script>

<main>
	<div class="container my-5">
		<h2 class=" text-4xl font-semibold leading-7 text-gray-900">Tambahkan Petugas</h2>
		<form action="">
			<div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
				<div class="sm:col-span-4">
					<label
						for="first-name"
						class="block text-sm font-medium leading-6 text-gray-900"
					>
						Nama
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

				<div class="sm:col-span-3">
					<label
						for="jenis_Kelamin"
						class="block text-sm font-medium leading-6 text-gray-900"
					>
						Jenis Kelamin
					</label>
					<div class="mt-2">
						<select
							id="jenis_kelamin"
							name="jenis_kelamin"
							autocomplete="jenis_kelamin"
							class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6"
						>
							<option>Laki-laki</option>
							<option>Perempuan</option>
						</select>
					</div>
				</div>
				<div class="sm:col-span-4">
					<label for="alamat" class="block text-sm font-medium leading-6 text-gray-900">
						Alamat
					</label>
					<div class="mt-2">
						<input
							id="alamat"
							name="alamat"
							type="text"
							autocomplete="alamat"
							class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
						/>
					</div>
				</div>
				<div class="sm:col-span-4">
					<label for="telepon" class="block text-sm font-medium leading-6 text-gray-900">
						No. Telepon
					</label>
					<div class="mt-2">
						<input
							id="telepon"
							name="telepon"
							type="text"
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
