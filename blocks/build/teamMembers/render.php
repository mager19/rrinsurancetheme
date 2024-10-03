<?php
$block_wrapper_attributes = get_block_wrapper_attributes([
	'class' => 'team__members bg-gray-900 px-4 py-8 lg:py-16'
]);

$args = [
	'post_type' => 'members',
	'posts_per_page' => 10,
	'orderby' => 'date',
	'order' => 'ASC',
	'status' => 'publish'
];


$loop = new WP_Query($args);
if ($loop->have_posts()) : ?>

	<div <?php echo $block_wrapper_attributes; ?>>
		<div class="container">
			<div class="flex flex-col items-center justify-center w-full mx-auto text-center lg:w-8/12">
				<h4 class="mb-0 text-white text-title-3 lg:text-title-2 sectionTitle">
					<?php echo $attributes['subtitle'] ? $attributes['subtitle'] : 'Meet our experts'; ?>
				</h4>
				<p class="prose-2xl text-white uppercase text-title-6">
					<?php echo $attributes['title'] ? $attributes['title']  :  'Get to Know Us'; ?>
				</p>
			</div>

			<div class="flex flex-wrap justify-center gap-4 mt-4 lg:gap-8 lg:mt-7">
				<?php
				while ($loop->have_posts()) : $loop->the_post(); ?>
					<div class="relative flex flex-col items-center justify-center w-full cursor-pointer team__members__item md:w-1/2 lg:w-1/4">
						<a class="w-full" href="<?php the_permalink(); ?>">
							<div class="overlay rounded-xl"></div>
							<div class="w-full overflow-hidden rounded-xl h-80">
								<?php the_post_thumbnail('medium', ['class' => 'w-full h-full object-cover']); ?>
							</div>
							<div class="absolute px-4 content bottom-5 left-2">
								<h4 class="mt-4 text-white text-title-4 item__name"><?php the_title(); ?></h4>
								<p class="mt-2 text-sm text-white uppercase item__position"><?php the_field('position'); ?></p>
							</div>
						</a>
					</div>

				<?php endwhile; ?>
				<!-- post navigation -->
			</div>
		</div>
	</div>
<?php else: ?>
	<!-- no posts found -->
<?php endif; ?>