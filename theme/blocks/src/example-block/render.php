<?php
$block_wrapper_attributes = get_block_wrapper_attributes([
	'class' => ''
]);
// wp_send_json($attributes);

?>
<div <?php echo $block_wrapper_attributes; ?>>
	<div class="container">
		<div class="w-1/2 bg-slate-400">
			<span>Example block</span>
		</div>
	</div>
</div>
