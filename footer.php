<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the `#content` element and all content thereafter.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package rrinsurancegroup
 */

?>

</div><!-- #content -->

<?php get_template_part('template-parts/layout/footer', 'content'); ?>

</div><!-- #page -->


<div id="modal-custom-1b" class="modalMenu menuModal">
	<div class="modal__header">
		<button data-iziModal-close class="mb-4 icon-close">
			<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M1 1L15 15M1 15L15 1" stroke="#fc1a12" stroke-width="2" />
			</svg>
		</button>
	</div>

	<div class="relative modal__content">
		<?php
		$logo = get_field('logo', 'option');

		if ($logo) { ?>
			<a href="<?php echo esc_url(get_bloginfo('url')); ?>">
				<?php
				echo wp_get_attachment_image($logo['id'], 'full', false, array('class' => 'main__logo'));
				?>
			</a>
		<?php
		} else {
			echo '<h1 class="site-title">' . get_bloginfo('name') . '</h1>';
		}
		?>
		<div class="flex menuMobileModal">
			<!--Menu-->
			<?php
			if (has_nav_menu('menu-1')) { ?>

				<?php
				wp_nav_menu(array('theme_location' => 'menu-1'));
				?>

			<?php
			}
			?>
			<!--/Menu-->
		</div>
	</div>

</div>

<script>
	jQuery(document).ready(function($) {
		$(".modalMenu").iziModal({
			transitionIn: 'fadeInDown',
			transitionOut: 'fadeOutUp',
		});
	});
</script>

<?php wp_footer(); ?>

</body>

</html>