<script lang="ts" src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js">
	import Sidebar from '$lib/Sidebar.svelte';
	import { onMount } from 'svelte';
	let ready: boolean = false;
	onMount(() => (ready = true));
</script>

{#if ready}
	<div class="d-flex">
		<Sidebar />
		<div class="w-100 m-0 p-0">
			<slot />
		</div>
	</div>
{/if}

<style></style>
