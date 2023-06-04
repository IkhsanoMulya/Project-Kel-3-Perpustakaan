<script>
	import { ButtonGroup, Button } from 'flowbite-svelte';
</script>

<div class="container">
	<ButtonGroup>
		<Button on:click={window.resizeTo(800, 600)}>-</Button>
		<Button on:click={window.close}>X</Button>
	</ButtonGroup>
</div>
