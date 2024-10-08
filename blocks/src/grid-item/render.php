<?php
$block_wrapper_attributes = get_block_wrapper_attributes([
	'class' => 'my-8'
]);

$title = $attributes['title'] ?? 'Title Services';
$description = $attributes['content'] ?? 'Et et nisi culpa ipsum occaecat sint sit fugiat ipsum elit. Occaecat proident sit aliquip consectetur.';

?>
<div <?php echo $block_wrapper_attributes; ?>>
	<?php echo $content; ?>
	<div class="p-4 text-gray-900 transition-all duration-200 ease-linear border border-gray-200 cursor-pointer rounded-b-2xl info hover:text-white hover:bg-rrRed hover:bg-opacity-80">
		<h3 class="font-semibold text-title-4 font-base">
			<?php echo $title; ?>
		</h3>
		<p class="text-base">
			<?php echo $description; ?>
		</p>
	</div>
</div>