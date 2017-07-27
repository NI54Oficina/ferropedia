
<section id="post-<?php the_ID(); ?>" <?php post_class('entry-box'); ?>>
    <header>
        <h2 class="entry-title"><?php the_title(); ?></h2>
        <?php if ( 'show' === get_option('kopa_theme_options_view_date_status', 'show') && 'post' === get_post_type() ) :?>
            <span class="entry-date pull-left"><i class="fa fa-pencil-square-o"></i><?php the_time(get_option('date_format')); ?></span>
        <?php endif; ?>

        <span class="entry-meta pull-left">&nbsp;/&nbsp;</span>
        <span class="entry-author pull-left"><?php _e('Por', 'newsmaxx');?> <?php the_author_posts_link(); ?></span>

    </header>

    <?php if ( has_post_thumbnail() && get_option('kopa_theme_options_featured_image_status', 'show') == 'show') : ?>
    <div class="entry-thumb">
        <?php kopa_the_image(get_the_ID(), get_the_title(), 866, 428,false); ?>
    </div>
    <?php endif; ?>
    <!-- entry-thumb -->

    <div class="entry-content clearfix">
        <div class="left-col pull-left">
              <?php kopa_related_articles(); // def in library/front.php ?>
              <!-- related-post -->
        </div><!-- left-col -->
        <?php the_content(); ?>
    </div>
    <?php
    $args = array(
        'before'           => '<div class="page-links-wrapper"><div class="page-links">',
        'after'            => '</div></div>',
        'link_before'      => '<span>',
        'link_after'       => '</span>',
        'next_or_number'   => 'number',
        'separator'        => ' ',
        'nextpagelink'     => __( 'Next page', 'newsmaxx' ),
        'previouspagelink' => __( 'Previous page', 'newsmaxx' ),
        'pagelink'         => '%',
        'echo'             => 1
    );
    wp_link_pages($args);
    ?><!-- pagination in post -->

    <?php the_tags( '<div class="tag-box"><strong>' . __( 'Tags: ', 'newsmaxx' ) . ' </strong>', ', ', '</div>' ); ?>
    <!-- tag box-->
    <?php
    $prev_post = get_previous_post();
    $next_post = get_next_post();
    ?>
    <?php if ( 'show' === get_option('kopa_theme_options_post_navigation_status', 'show') && ( get_next_post() || get_previous_post() ) ) :?>
        <footer class="entry-box-footer clearfix">
            <div class="article-directnav clearfix">
                <?php if (!empty( $prev_post )):?>
                    <p class="prev-post pull-left clearfix">
                        <a class="clearfix" href="<?php echo get_permalink( $prev_post->ID ); ?>"><i class="fa fa-angle-double-left"></i><?php echo __('Previous article', 'newsmaxx');?></a>
                    </p>
                <?php endif; ?>
                <?php if (!empty($next_post)) : ?>
                    <p class="next-post pull-right clearfix">
                        <a class="clearfix" href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo __('Next article', 'newsmaxx');?><i class="fa fa-angle-double-right"></i></a>
                    </p>
                <?php endif; ?>
            </div>

            <div class="article-title clearfix">
                <?php if (!empty( $prev_post )):?>
                    <p class="prev-post pull-left clearfix">
                        <a href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php echo $prev_post->post_title;?></a>
                        <span class="entry-date"><i class="fa fa-pencil-square-o"></i><?php echo get_the_time( get_option('date_format'), $prev_post->ID ); ?></span>
                        <span class="entry-meta">&nbsp;/&nbsp;</span>
                        <span class="entry-author"><?php _e('By', 'newsmaxx'); ?> <?php the_author_posts_link(); ?></span>
                    </p>
                <?php endif; ?>
                <?php if (!empty($next_post)) : ?>
                    <p class="next-post pull-right clearfix">
                        <a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo $next_post->post_title;?></a>
                        <span class="entry-date"><i class="fa fa-pencil-square-o"></i><?php echo get_the_time( get_option('date_format'), $next_post->ID ); ?></span>
                        <span class="entry-meta">&nbsp;/&nbsp;</span>
                        <span class="entry-author"><?php _e('By', 'newsmaxx'); ?> <?php the_author_posts_link(); ?></span>
                    </p>
                <?php endif; ?>
            </div>

        </footer>
    <?php endif; ?>
    <!-- kopa navigation -->
</section><!-- entry-box -->

<?php kopa_about_author(); ?><!-- kopa author -->
