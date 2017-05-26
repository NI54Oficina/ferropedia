<?php
if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
    die(__('Please do not load this page directly. Thanks!', 'newsmaxx'));
}

// check if post is pwd protected
if ( post_password_required() )
    return;

if (is_singular() && 'open' != get_option('default_comment_status', 'open'))
    return;

if ( have_comments() ) { ?>
<section id="comments">
    <h4><?php comments_number(__('No Comment', 'newsmaxx'), __('1 Comment', 'newsmaxx'), __('% Comments', 'newsmaxx')); ?></h4>
    <ol class="comments-list clearfix">
        <?php
        wp_list_comments(array(
            'walker' => null,
            'style' => 'ul',
            'callback' => 'kopa_comments_callback',
            'end-callback' => null,
            'type' => 'all'
        ));
        ?>
    </ol>

    <?php
    // whether or not display paginate comments link
    $prev_comments_link = get_previous_comments_link();
    $next_comments_link = get_next_comments_link();

    if ( '' !== $prev_comments_link . $next_comments_link ) { ?>

        <div class="pagination kopa-comment-pagination">
            <?php paginate_comments_links(); ?>
        </div>
        <!-- pagination -->
        <?php } // endif ?>
</section>
<?php } elseif ( ! comments_open() && post_type_supports(get_post_type(), 'comments') ) {
    return;
} // endif
ob_start();
comment_form(kopa_comment_form_args());
echo str_replace('class="comment-form"','class="comments-form clearfix"',ob_get_clean());

/*
 * Comments call back function
 */
function kopa_comments_callback($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;

    if ( 'pingback' == get_comment_type() || 'trackback' == get_comment_type() ) { ?>

    <li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'comment clearfix' ); ?>>
        <article class="comment-wrap clearfix">
            <div class="comment-avatar">
                <?php echo get_avatar( $comment, 50 ); ?>
            </div>
            <div class="comment-body clearfix">
                <header class="clearfix">
                    <h6><?php _e( 'Pingback', 'newsmaxx' ); ?></h6>
                    <span class="entry-date pull-left"><?php comment_date( get_option( 'date_format' ) ); ?></span>
                    <div class="comment-button pull-right">
                        <?php if ( current_user_can( 'moderate_comments' ) ) {
                            edit_comment_link( __( 'Edit', 'newsmaxx' ) );
                        } ?>
                    </div>
                    <div class="clear"></div>
                </header>
                <p><a href="<?php if ( get_comment_author_url() ) { echo get_comment_author_url(); }?>" target="_blank" title="<?php _e('Pingback', 'newsmaxx');?>"><?php if ( get_comment_author_url() ) { echo get_comment_author_url(); }?></a></p>
            </div><!--comment-body -->
        </article>
    </li>

    <?php } elseif ( 'comment' == get_comment_type() ) { ?>

    <li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'comment clearfix' ); ?>>
        <article class="comment-wrap clearfix">
            <div class="comment-avatar">
                <?php echo get_avatar( $comment->comment_author_email, 50 ); ?>
            </div>
            <div class="comment-body clearfix">
                <header class="clearfix">
                    <h6>
                        <?php //echo get_comment_author_link();?>
                        <?php if ( get_comment_author_url() ) { ?>
                            <a href="<?php comment_author_url(); ?>">
                        <?php } ?>

                        <?php echo get_comment_author_link(); ?>

                        <?php if ( get_comment_author_url() ) { ?>
                        </a>
                    <?php } ?>
                    </h6>
                    <span class="entry-date pull-left"><?php comment_date( get_option( 'date_format' ) ); ?></span>
                    <div class="comment-button pull-right">
                        <?php if ( current_user_can( 'moderate_comments' ) ) {
                            edit_comment_link( __( 'Edit', 'newsmaxx' ) );
                        } ?>

                        <span>&nbsp;/&nbsp;</span>
                        <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                    </div>
                    <div class="clear"></div>
                </header>
                <?php comment_text(); ?>
            </div><!--comment-body -->
        </article>
    </li>

    <?php
    } // endif check comment type
}

function kopa_comment_form_args() {
    global $user_identity;
    $commenter = wp_get_current_commenter();

    $commeter_author = esc_attr($commenter['comment_author']);
    $commenter_author_email = esc_attr($commenter['comment_author_email']);
    $commenter_author_url = esc_attr($commenter['comment_author_url']);

    $fields = array(
        'author' => '<div class="comment-left pull-left">
                    <p class="input-block">
                        <label for="comment_name" class="required">Name <span>*</span></label>
                        <input id="comment_name" name="author" value="'. $commeter_author . '" placeholder="' . __('Name *', 'newsmaxx') . '" type="text" class="valid">
                    </p>',
        'email' => '<p class="input-block">
                        <label for="comment_email" class="required">Email <span>*</span></label>
                        <input id="comment_email" name="email" value="'. $commenter_author_email . '"  type="email" placeholder="' . __('Email *', 'newsmaxx') .'" class="valid">
                    </p>',
        'url'   => '<p class="input-block">
                        <label for="comment_url" class="required">Website</label>
                        <input id="comment_url" type="text" name="url" value="' . $commenter_author_url .'" placeholder="' . __('Website', 'newsmaxx') . '" class="valid">
                    </p></div>'
    );

    if ( ! is_user_logged_in() ) {
        $comment_field = '<div class="comment-right pull-right">'.
            '<p class="textarea-block">'.
            '<textarea id="comment_message" name="comment" style="overflow:auto;resize:vertical ;" placeholder="' . __('Your comment *', 'newsmaxx') . '"></textarea>'.
            '</p>'.
            '</div><div class="clear"></div>';
    } else {
        $comment_field = '<p class="textarea-block"><textarea id="comment_message" name="comment" style="overflow:auto;resize:vertical ;" placeholder="' . __('Your comment *', 'newsmaxx') . '"></textarea></p><div class="clear"></div><div class="clear"></div>';
    }

    $args = array(
        'fields' => apply_filters('comment_form_default_fields', $fields),
        'comment_field' => $comment_field,
        'comment_notes_before' => '<span class="c-note">'.__('Your email address will not be published. Required fields are marked', 'newsmaxx').' <span>*</span></span>',
        'comment_notes_after' => '',
        'id_form' => 'comments-form ',
        'id_submit' => 'submit-comment',
        'title_reply' => '<h4>'.__('POST YOUR COMMENTS', 'newsmaxx').'</h4>',
        // 'title_reply_to' => __('Reply to %s', 'newsmaxx'),
        // 'cancel_reply_link' => '<span class="title-text">'.__('Cancel', 'newsmaxx').'</span>',
        'label_submit' =>__('Post Comment', 'newsmaxx'),
    );

    return $args;
}
