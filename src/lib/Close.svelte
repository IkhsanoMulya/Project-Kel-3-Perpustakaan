<script>
	import { ButtonGroup, Button } from 'flowbite-svelte';
	function resize() {
		window.resizeTo(800, 600);
	}
</script>

<div class="container">
	<ButtonGroup>
		<Button outline color="yellow" on:click={resize()}>-</Button>
		<Button outline color="red" on:click={window.close}>X</Button>
	</ButtonGroup>
</div>
