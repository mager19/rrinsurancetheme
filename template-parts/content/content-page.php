<?php

/**
 * Template part for displaying pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rrinsurancegroup
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	if (!is_front_page()) {

		if (has_post_thumbnail()) {
			$background = get_the_post_thumbnail_url();
		} else {
			$image = get_field('hero_default', 'option');
			$background = $image['url'];
		}

	?>
		<div class="relative text-white bg-center bg-no-repeat bg-cover hero__page" style="background-image:url(<?php echo $background; ?>)">
			<div class="absolute top-0 left-0 bg-black bg-opacity-50 overlay size-full"></div>
			<div class="container px-4">
				<div class="flex items-center justify-center h-80">
					<h1 class="tracking-wide uppercase hero__page__title"><?php the_title(); ?></h1>
				</div>
			</div>
		</div>
	<?php
	}
	?>

	<?php
	$shortcode = get_field('slider_shortcode', 'option');
	if ($shortcode && is_front_page()) {
		echo do_shortcode($shortcode);
	}
	?>

	<div class="content__wrapper">
		<?php
		the_content();

		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->