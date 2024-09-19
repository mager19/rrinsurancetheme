<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package rrinsurancegroup
 */

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function rrinsurancegroup_pingback_header()
{
	if (is_singular() && pings_open()) {
		printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
	}
}
add_action('wp_head', 'rrinsurancegroup_pingback_header');

/**
 * Changes comment form default fields.
 *
 * @param array $defaults The default comment form arguments.
 *
 * @return array Returns the modified fields.
 */
function rrinsurancegroup_comment_form_defaults($defaults)
{
	$comment_field = $defaults['comment_field'];

	// Adjust height of comment form.
	$defaults['comment_field'] = preg_replace('/rows="\d+"/', 'rows="5"', $comment_field);

	return $defaults;
}
add_filter('comment_form_defaults', 'rrinsurancegroup_comment_form_defaults');

/**
 * Filters the default archive titles.
 */
function rrinsurancegroup_get_the_archive_title()
{
	if (is_category()) {
		$title = __('Category Archives: ', 'rrinsurancegroup') . '<span>' . single_term_title('', false) . '</span>';
	} elseif (is_tag()) {
		$title = __('Tag Archives: ', 'rrinsurancegroup') . '<span>' . single_term_title('', false) . '</span>';
	} elseif (is_author()) {
		$title = __('Author Archives: ', 'rrinsurancegroup') . '<span>' . get_the_author_meta('display_name') . '</span>';
	} elseif (is_year()) {
		$title = __('Yearly Archives: ', 'rrinsurancegroup') . '<span>' . get_the_date(_x('Y', 'yearly archives date format', 'rrinsurancegroup')) . '</span>';
	} elseif (is_month()) {
		$title = __('Monthly Archives: ', 'rrinsurancegroup') . '<span>' . get_the_date(_x('F Y', 'monthly archives date format', 'rrinsurancegroup')) . '</span>';
	} elseif (is_day()) {
		$title = __('Daily Archives: ', 'rrinsurancegroup') . '<span>' . get_the_date() . '</span>';
	} elseif (is_post_type_archive()) {
		$cpt   = get_post_type_object(get_queried_object()->name);
		$title = sprintf(
			/* translators: %s: Post type singular name */
			esc_html__('%s Archives', 'rrinsurancegroup'),
			$cpt->labels->singular_name
		);
	} elseif (is_tax()) {
		$tax   = get_taxonomy(get_queried_object()->taxonomy);
		$title = sprintf(
			/* translators: %s: Taxonomy singular name */
			esc_html__('%s Archives', 'rrinsurancegroup'),
			$tax->labels->singular_name
		);
	} else {
		$title = __('Archives:', 'rrinsurancegroup');
	}
	return $title;
}
add_filter('get_the_archive_title', 'rrinsurancegroup_get_the_archive_title');

/**
 * Determines whether the post thumbnail can be displayed.
 */
function rrinsurancegroup_can_show_post_thumbnail()
{
	return apply_filters('rrinsurancegroup_can_show_post_thumbnail', ! post_password_required() && ! is_attachment() && has_post_thumbnail());
}

/**
 * Returns the size for avatars used in the theme.
 */
function rrinsurancegroup_get_avatar_size()
{
	return 60;
}

/**
 * Create the continue reading link
 *
 * @param string $more_string The string shown within the more link.
 */
function rrinsurancegroup_continue_reading_link($more_string)
{

	if (! is_admin()) {
		$continue_reading = sprintf(
			/* translators: %s: Name of current post. */
			wp_kses(__('Continue reading %s', 'rrinsurancegroup'), array('span' => array('class' => array()))),
			the_title('<span class="sr-only">"', '"</span>', false)
		);

		$more_string = '<a href="' . esc_url(get_permalink()) . '">' . $continue_reading . '</a>';
	}

	return $more_string;
}

// Filter the excerpt more link.
add_filter('excerpt_more', 'rrinsurancegroup_continue_reading_link');

// Filter the content more link.
add_filter('the_content_more_link', 'rrinsurancegroup_continue_reading_link');

/**
 * Outputs a comment in the HTML5 format.
 *
 * This function overrides the default WordPress comment output in HTML5
 * format, adding the required class for Tailwind Typography. Based on the
 * `html5_comment()` function from WordPress core.
 *
 * @param WP_Comment $comment Comment to display.
 * @param array      $args    An array of arguments.
 * @param int        $depth   Depth of the current comment.
 */
function rrinsurancegroup_html5_comment($comment, $args, $depth)
{
	$tag = ('div' === $args['style']) ? 'div' : 'li';

	$commenter          = wp_get_current_commenter();
	$show_pending_links = ! empty($commenter['comment_author']);

	if ($commenter['comment_author_email']) {
		$moderation_note = __('Your comment is awaiting moderation.', 'rrinsurancegroup');
	} else {
		$moderation_note = __('Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.', 'rrinsurancegroup');
	}
?>
	<<?php echo esc_attr($tag); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class($comment->has_children ? 'parent' : '', $comment); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
					if (0 !== $args['avatar_size']) {
						echo get_avatar($comment, $args['avatar_size']);
					}
					?>
					<?php
					$comment_author = get_comment_author_link($comment);

					if ('0' === $comment->comment_approved && ! $show_pending_links) {
						$comment_author = get_comment_author($comment);
					}

					printf(
						/* translators: %s: Comment author link. */
						wp_kses_post(__('%s <span class="says">says:</span>', 'rrinsurancegroup')),
						sprintf('<b class="fn">%s</b>', wp_kses_post($comment_author))
					);
					?>
				</div><!-- .comment-author -->

				<div class="comment-metadata">
					<?php
					printf(
						'<a href="%s"><time datetime="%s">%s</time></a>',
						esc_url(get_comment_link($comment, $args)),
						esc_attr(get_comment_time('c')),
						esc_html(
							sprintf(
								/* translators: 1: Comment date, 2: Comment time. */
								__('%1$s at %2$s', 'rrinsurancegroup'),
								get_comment_date('', $comment),
								get_comment_time()
							)
						)
					);

					edit_comment_link(__('Edit', 'rrinsurancegroup'), ' <span class="edit-link">', '</span>');
					?>
				</div><!-- .comment-metadata -->

				<?php if ('0' === $comment->comment_approved) : ?>
					<em class="comment-awaiting-moderation"><?php echo esc_html($moderation_note); ?></em>
				<?php endif; ?>
			</footer><!-- .comment-meta -->

			<div <?php rrinsurancegroup_content_class('comment-content'); ?>>
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<?php
			if ('1' === $comment->comment_approved || $show_pending_links) {
				comment_reply_link(
					array_merge(
						$args,
						array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<div class="reply">',
							'after'     => '</div>',
						)
					)
				);
			}
			?>
		</article><!-- .comment-body -->
	<?php
}

add_action('acf/include_fields', function () {
	if (!function_exists('acf_add_local_field_group')) {
		return;
	}

	acf_add_local_field_group(array(
		'key' => 'group_663d0aefb72ae',
		'title' => 'General',
		'fields' => array(
			array(
				'key' => 'field_663d0aefa9c38',
				'label' => 'General',
				'name' => '',
				'aria-label' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'left',
				'endpoint' => 0,
			),
			array(
				'key' => 'field_663d0b1fa9c39',
				'label' => 'Logo',
				'name' => 'logo',
				'aria-label' => '',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
				'preview_size' => 'medium',
			),
			array(
				'key' => 'field_663d1bfd42421',
				'label' => 'Logo Mobile',
				'name' => 'logo_mobile',
				'aria-label' => '',
				'type' => 'image',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'library' => 'all',
				'min_width' => '',
				'min_height' => '',
				'min_size' => '',
				'max_width' => '',
				'max_height' => '',
				'max_size' => '',
				'mime_types' => '',
				'preview_size' => 'medium',
			),
			array(
				'key' => 'field_6643620117071',
				'label' => 'Footer',
				'name' => '',
				'aria-label' => '',
				'type' => 'tab',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'placement' => 'left',
				'endpoint' => 0,
			),
			array(
				'key' => 'field_6643621f17072',
				'label' => 'Footer Message',
				'name' => 'footer_message',
				'aria-label' => '',
				'type' => 'textarea',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'maxlength' => '',
				'rows' => '',
				'placeholder' => '',
				'new_lines' => '',
			),
			array(
				'key' => 'field_6643622b17073',
				'label' => 'Contact mail',
				'name' => 'contact_mail',
				'aria-label' => '',
				'type' => 'email',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array(
				'key' => 'field_6643624417074',
				'label' => 'Copyright',
				'name' => 'copyright',
				'aria-label' => '',
				'type' => 'wysiwyg',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'tabs' => 'all',
				'toolbar' => 'full',
				'media_upload' => 1,
				'delay' => 0,
			),
			array(
				'key' => 'field_6643735e9bf96',
				'label' => 'Facebook Link',
				'name' => 'facebook_link',
				'aria-label' => '',
				'type' => 'url',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
			array(
				'key' => 'field_664373779bf97',
				'label' => 'Instagram Link',
				'name' => 'instagram_link',
				'aria-label' => '',
				'type' => 'url',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
			array(
				'key' => 'field_664373819bf98',
				'label' => 'x Link',
				'name' => 'x_link',
				'aria-label' => '',
				'type' => 'url',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'general-options',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
		'show_in_rest' => 0,
	));
});

add_action('acf/init', function () {
	acf_add_options_page(array(
		'page_title' => 'General Options',
		'menu_slug' => 'general-options',
		'menu_title' => 'General Options',
		'position' => '',
		'redirect' => false,
	));
});
