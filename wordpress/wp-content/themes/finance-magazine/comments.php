<?php
/**
 * The template for displaying comments
 * @package Finance Magazine
 */
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
if ( comments_open()) : ?>
<div id="comments" class="comments-area">
	<?php // You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php $finance_magazine_comments_number = get_comments_number();
				if ( '1' === $finance_magazine_comments_number ) {
					/* translators: %s: post title */
					printf( esc_html(_x( 'One Reply to &ldquo;%s&rdquo;', 'comments title', 'finance-magazine' )), esc_html(get_the_title()) );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						esc_html(_nx(
							'%1$s Reply to &ldquo;%2$s&rdquo;',
							'%1$s Replies to &ldquo;%2$s&rdquo;',
							$finance_magazine_comments_number,
							'comments title',
							'finance-magazine'
						)),
						absint(number_format_i18n( $finance_magazine_comments_number )),
						esc_html(get_the_title())
					);
				} ?>
		</h2>
		<ol class="comment-list">
			<?php wp_list_comments( array(
				'avatar_size' => 100,
				'style'       => 'ol',
				'short_ping'  => true,
				'reply_text'  => esc_html__( 'Reply', 'finance-magazine' ),
			) ); ?>
		</ol>
		<?php the_comments_pagination( array(
			'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous', 'finance-magazine' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next', 'finance-magazine' ) . '</span>',
		) );
	endif; // Check for have_comments().
	comment_form(); ?>
</div>
<?php endif;