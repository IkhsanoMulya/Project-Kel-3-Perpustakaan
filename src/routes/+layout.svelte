<script lang="ts">
	import Close from './../lib/Close.svelte';
	import Sidebar from '$lib/Sidebar.svelte';
	import '../app.postcss';
	import { onMount } from 'svelte';
	let ready: boolean = false;
	onMount(() => (ready = true));
</script>

{#if ready}
	<div class="m-0 p-0 bg-art bg-cover">
		<div class="container flex">
			<Sidebar />

			<div class="w-screen my-16 ml-60">
				<slot />
			</div>
		</div>
		<div class="absolute top-0 right-0">
			<Close />
		</div>
	</div>
{/if}

<style></style>
