<?php

/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rrinsurancegroup
 */

?>

<footer class="bg-gray-900" id="colophon">
	<div class="container px-4 pt-12 pb-2 mx-auto lg:pt-16">
		<div class="flex flex-wrap mx-auto lg:w-10/12">
			<div class="flex flex-wrap justify-center w-full lg:w-2/12">
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

				<?php
				$facebook = get_field('facebook_link', 'option');
				$instagram = get_field('instagram_link', 'option');
				$twitter = get_field('x_link', 'option');
				?>
				<ul class="flex justify-center w-full gap-4 mt-6 items lg:justify-start">
					<?php if ($facebook) { ?>
						<li>
							<a href="<?php echo $facebook; ?>">
								<svg class="size-5" fill="#fff" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" stroke="#fff">
									<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
									<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
									<g id="SVGRepo_iconCarrier">
										<path d="M20.9,2H3.1A1.1,1.1,0,0,0,2,3.1V20.9A1.1,1.1,0,0,0,3.1,22h9.58V14.25h-2.6v-3h2.6V9a3.64,3.64,0,0,1,3.88-4,20.26,20.26,0,0,1,2.33.12v2.7H17.3c-1.26,0-1.5.6-1.5,1.47v1.93h3l-.39,3H15.8V22h5.1A1.1,1.1,0,0,0,22,20.9V3.1A1.1,1.1,0,0,0,20.9,2Z"></path>
									</g>
								</svg>
							</a>
						</li>
					<?php } ?>

					<?php
					if ($instagram) {
					?>
						<li>
							<a href="<?php echo $facebook; ?>">
								<svg class="size-5" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000">
									<g id="SVGRepo_bgCarrier" stroke-width="0"></g>
									<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
									<g id="SVGRepo_iconCarrier">
										<title>instagram [#167]</title>
										<desc>Created with Sketch.</desc>
										<defs> </defs>
										<g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<g id="Dribbble-Light-Preview" transform="translate(-340.000000, -7439.000000)" fill="#fff">
												<g id="icons" transform="translate(56.000000, 160.000000)">
													<path d="M289.869652,7279.12273 C288.241769,7279.19618 286.830805,7279.5942 285.691486,7280.72871 C284.548187,7281.86918 284.155147,7283.28558 284.081514,7284.89653 C284.035742,7285.90201 283.768077,7293.49818 284.544207,7295.49028 C285.067597,7296.83422 286.098457,7297.86749 287.454694,7298.39256 C288.087538,7298.63872 288.809936,7298.80547 289.869652,7298.85411 C298.730467,7299.25511 302.015089,7299.03674 303.400182,7295.49028 C303.645956,7294.859 303.815113,7294.1374 303.86188,7293.08031 C304.26686,7284.19677 303.796207,7282.27117 302.251908,7280.72871 C301.027016,7279.50685 299.5862,7278.67508 289.869652,7279.12273 M289.951245,7297.06748 C288.981083,7297.0238 288.454707,7296.86201 288.103459,7296.72603 C287.219865,7296.3826 286.556174,7295.72155 286.214876,7294.84312 C285.623823,7293.32944 285.819846,7286.14023 285.872583,7284.97693 C285.924325,7283.83745 286.155174,7282.79624 286.959165,7281.99226 C287.954203,7280.99968 289.239792,7280.51332 297.993144,7280.90837 C299.135448,7280.95998 300.179243,7281.19026 300.985224,7281.99226 C301.980262,7282.98483 302.473801,7284.28014 302.071806,7292.99991 C302.028024,7293.96767 301.865833,7294.49274 301.729513,7294.84312 C300.829003,7297.15085 298.757333,7297.47145 289.951245,7297.06748 M298.089663,7283.68956 C298.089663,7284.34665 298.623998,7284.88065 299.283709,7284.88065 C299.943419,7284.88065 300.47875,7284.34665 300.47875,7283.68956 C300.47875,7283.03248 299.943419,7282.49847 299.283709,7282.49847 C298.623998,7282.49847 298.089663,7283.03248 298.089663,7283.68956 M288.862673,7288.98792 C288.862673,7291.80286 291.150266,7294.08479 293.972194,7294.08479 C296.794123,7294.08479 299.081716,7291.80286 299.081716,7288.98792 C299.081716,7286.17298 296.794123,7283.89205 293.972194,7283.89205 C291.150266,7283.89205 288.862673,7286.17298 288.862673,7288.98792 M290.655732,7288.98792 C290.655732,7287.16159 292.140329,7285.67967 293.972194,7285.67967 C295.80406,7285.67967 297.288657,7287.16159 297.288657,7288.98792 C297.288657,7290.81525 295.80406,7292.29716 293.972194,7292.29716 C292.140329,7292.29716 290.655732,7290.81525 290.655732,7288.98792" id="instagram-[#167]"> </path>
												</g>
											</g>
										</g>
									</g>
								</svg>
							</a>
						</li>
					<?php
					}
					?>

					<?php
					if ($twitter) { ?>
						<li>
							<a href="<?php echo $twitter; ?>">
								<svg class="size-5" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M17.244 0.25H20.552L13.325 8.51L21.827 19.75H15.17L9.956 12.933L3.99 19.75H0.679998L8.41 10.915L0.253998 0.25H7.08L11.793 6.481L17.244 0.25ZM16.083 17.77H17.916L6.084 2.126H4.117L16.083 17.77Z" fill="white" />
								</svg>

							</a>
						</li>
					<?php
					}
					?>
			</div>

			<div class="flex flex-wrap justify-center gap-12 mx-auto mt-12 space-y-4 text-center lg:space-y-0 lg:mt-0 lg:w-10/12 lg:text-left lg:justify-end">
				<div class="w-full lg:w-4/12">
					<h3 class="w-full mb-2 text-white text-opacity-50 uppercase lg:mb-4 text-title-4">Company</h3>

					<nav class="text-white" aria-label="<?php esc_attr_e('Footer Menu', 'rrinsurancegroup'); ?>">
						<!-- show menu footer -->
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-2',
								'menu_id'        => 'footer-menu',
								'menu_class'	=> 'flex flex-col gap-4',
								'items_wrap'     => '<ul id="%1$s" class="%2$s" aria-label="submenu">%3$s</ul>',
							)
						);
						?>
					</nav>
				</div>

				<div class="w-full mt-0 lg:w-4/12">
					<h3 class="w-full mb-2 text-white text-opacity-50 uppercase lg:mb-4 text-title-4">LAKE OCONEE
					</h3>

					<?php
					$footerMessage = get_field('footer_message', 'option');

					if ($footerMessage) { ?>
						<div class="text-white">
							<?php echo $footerMessage; ?>
						</div>
					<?php } ?>

				</div>
			</div>
		</div>

		<?php
		$copyright = get_field('copyright', 'option');
		if ($copyright) { ?>
			<div class="flex justify-center w-full pt-4 mt-8 text-center text-white border-t border-white text-opacity-30 font-base border-opacity-30 [_p]:opacity-20">

				<?php echo $copyright; ?>

			</div>
		<?php
		} ?>

	</div>
</footer><!-- #colophon -->