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