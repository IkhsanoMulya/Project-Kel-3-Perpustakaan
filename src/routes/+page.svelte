<script lang="ts">
	import Signin from '$lib/Signin.svelte';

	let desktop: string;

	const agent = window.electron ? 'Electron' : 'Browser';
</script>

<style>
</style>
