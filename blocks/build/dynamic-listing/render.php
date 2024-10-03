<?php
$block_wrapper_attributes = get_block_wrapper_attributes([
	'class' => 'py-8 lg:py-16'
]);

?>
<div <?php echo $block_wrapper_attributes; ?>>
	<div class="container px-4">
		<?php
		if ($attributes['showHeader']) { ?>
			<div class="w-full">
				<h3 class="prose-2xl text-black uppercase text-title-3 sectionTitle">
					<?php echo $attributes['headerText']; ?>
				</h3>
			</div>
		<?php
		}
		?>

		<?php
		$args = array('post_type' => $attributes['selectedPostType'], 'posts_per_page' => $attributes['postsToShow']);
		$loop = new WP_Query($args);

		if ($loop->have_posts()) : ?>
			<div class="grid w-full grid-cols-1 gap-4 mt-4 md:grid-cols-2 lg:grid-cols-3 lg:gap-8 lg:mt-7">
				<?php
				while ($loop->have_posts()) : $loop->the_post(); ?>
					<div class="flex flex-wrap items-center p-8 transition-all duration-300 ease-linear bg-gray-500 cursor-pointer rounded-xl item__post hover:bg-rrRed hover:bg-opacity-80">
						<?php
						if (has_post_thumbnail()) {
							the_post_thumbnail('medium', ['class' => 'w-full h-full object-cover']);
						}
						?>
						<div class="content">
							<h3 class="text-xl font-semibold font-base">
								<a href="<?php the_permalink(); ?>">
									<?php
									the_title();
									?>
								</a>
							</h3>
							<span class="flex mb-2 text-sm text-gray-900">
								<?php
								echo get_the_date();
								?>
							</span>

							<p class="text-gray-800">
								<?php
								echo wp_trim_words(get_the_content(), 14, '...');
								?>
							</p>
						</div>
					</div>
				<?php endwhile; ?>
				<!-- post navigation -->
			</div>
		<?php else : ?>
			<h3>No posts found</h3>
			<!-- no posts found -->

		<?php endif; ?>
	</div>
</div>