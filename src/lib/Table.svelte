<script>
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

	export const headings = [];
	export const query = '';
	import sql from '../koneksi';
	let searchTerm = '';
	let items = sql(query);
	$: filteredItems = items.filter(
		(item) => item.nama.toLowerCase().indexOf(searchTerm.toLowerCase()) !== -1,
	);
</script>

<div class="container">
	<TableSearch placeholder="Search" hoverable={true} bind:inputValue={searchTerm}>
		<TableHead>
			{#each headings as heading}
				<TableHeadCell>{heading}</TableHeadCell>
			{/each}
			<TableHeadCell>Aksi</TableHeadCell>
		</TableHead>
		<TableBody class="divide-y">
			{#each filteredItems as item}
				<TableBodyRow>
					<TableBodyCell>{item}</TableBodyCell>
					<TableBodyCell>
						<Button color="yellow" href="/edit">
							<svg
								width="15px"
								height="15px"
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
						<Button color="red" href="/hapus">
							<svg
								width="15px"
								height="15px"
								viewBox="0 0 24 24"
								fill="none"
								xmlns="http://www.w3.org/2000/svg"
							>
								<path
									d="M16 8L8 16M8.00001 8L16 16M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
									stroke="#000000"
									stroke-width="1.5"
									stroke-linecap="round"
									stroke-linejoin="round"
								/>
							</svg>
						</Button>
						<Button color="blue" href="/details">
							<svg
								fill="#000000"
								height="15px"
								width="15px"
								id="Layer_1"
								data-name="Layer 1"
								xmlns="http://www.w3.org/2000/svg"
								viewBox="0 0 16 16"
							>
								<path
									class="cls-1"
									d="M8,6.5A1.5,1.5,0,1,1,6.5,8,1.5,1.5,0,0,1,8,6.5ZM.5,8A1.5,1.5,0,1,0,2,6.5,1.5,1.5,0,0,0,.5,8Zm12,0A1.5,1.5,0,1,0,14,6.5,1.5,1.5,0,0,0,12.5,8Z"
								/>
							</svg>
						</Button>
					</TableBodyCell>
				</TableBodyRow>
			{/each}
		</TableBody>
	</TableSearch>
</div>
