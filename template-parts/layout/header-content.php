<?php

/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rrinsurancegroup
 */

?>


<header id="masthead" class="nav__sticky">
	<div class="container px-4">
		<div class="relative flex items-center justify-between">
			<div>
				<?php
				$logoMobile = get_field('logo', 'option');
				if ($logoMobile) { ?>
					<a href="<?php echo esc_url(get_bloginfo('url')); ?>">
						<?php
						echo wp_get_attachment_image($logoMobile['id'], 'full', false, array('class' => 'main__logo'));
						?>
					</a>
				<?php
				}
				?>
			</div>

			<nav class="hidden lg:flex" id="site-navigation" aria-label="<?php esc_attr_e('Main Navigation', 'rrinsurancegroup'); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'items_wrap'     => '<ul id="%1$s" class="%2$s" aria-label="submenu">%3$s</ul>',
					)
				);
				?>
			</nav><!-- #site-navigation -->

			<button class="lg:hidden" id="menumobile" data-izimodal-open="#modal-custom-1b">
				<svg width="48" height="48" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
					<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
					<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
					<g id="SVGRepo_iconCarrier">
						<path d="M5.5 11.75C5.08579 11.75 4.75 12.0858 4.75 12.5C4.75 12.9142 5.08579 13.25 5.5 13.25V11.75ZM19.5 13.25C19.9142 13.25 20.25 12.9142 20.25 12.5C20.25 12.0858 19.9142 11.75 19.5 11.75V13.25ZM5.5 7.75C5.08579 7.75 4.75 8.08579 4.75 8.5C4.75 8.91421 5.08579 9.25 5.5 9.25V7.75ZM14.833 9.25C15.2472 9.25 15.583 8.91421 15.583 8.5C15.583 8.08579 15.2472 7.75 14.833 7.75V9.25ZM5.5 15.75C5.08579 15.75 4.75 16.0858 4.75 16.5C4.75 16.9142 5.08579 17.25 5.5 17.25V15.75ZM14.833 17.25C15.2472 17.25 15.583 16.9142 15.583 16.5C15.583 16.0858 15.2472 15.75 14.833 15.75V17.25ZM5.5 13.25H19.5V11.75H5.5V13.25ZM5.5 9.25H14.833V7.75H5.5V9.25ZM5.5 17.25H14.833V15.75H5.5V17.25Z" fill="#fff"></path>
					</g>
				</svg>
			</button>
		</div>
	</div>


</header><!-- #masthead -->