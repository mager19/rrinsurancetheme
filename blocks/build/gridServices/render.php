<?php
$block_wrapper_attributes = get_block_wrapper_attributes([
	'class' => 'pb-12 lg:pb-16'
]);
// wp_send_json($attributes);

?>
<div <?php echo $block_wrapper_attributes; ?>>
	<div class="container px-4">
		<div class="gap-8 columns-1 md:columns-2">
			<?php echo $content;
			?>
		</div>
	</div>
</div>