
<ul class="clearfix entry-masonry-list">
    <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post();
        $post_class = 'entry-item clearfix';
        if ( !has_post_thumbnail()){
            $post_class .= ' blog-no-thumbnail';
        }
        ?>
        <li class="masonry-item">
            <article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
                <?php if ( has_post_thumbnail()) : ?>
                <div class="entry-thumb">
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php kopa_the_image(get_the_ID(), get_the_title(), 265, 215); ?></a>
                </div>
                <?php endif; ?>
                <!-- entry-thumb -->

                <div class="entry-content">
                    <header>
                        <h6 class="entry-title" itemscope="" itemtype="http://schema.org/Event">
                            <a itemprop="name" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                        </h6>
                        <span class="entry-date pull-left"><i class="fa fa-pencil-square-o"></i><?php echo  get_the_date( 'j')." de ".get_the_date( 'F')." de ".get_the_date( 'Y'); ?></span>
                        <span class="entry-meta pull-left">&nbsp;/&nbsp;</span>
                        <span class="entry-author pull-left"><?php _e('Por ', 'newsmaxx');?><?php
						$autor=get_field("name_author");
						if($autor!=""){
							echo $autor;
						}else{
							the_author_posts_link();
						}
						 ?></span>
                    </header>
                    <p><?php the_excerpt(); ?></p>
                    <?php if ( 'show' === get_option( 'kopa_theme_options_blog_readmore_status', 'show' ) ) : ?>
                        <i class="fa fa-external-link search-icon"></i>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="more-link"><span>Leer más</span></a>
                    <?php endif; ?>
                </div>
                <!-- entry-content -->

            </article>
            <!-- entry-item -->
        </li>
        <?php endwhile; ?>
    <?php else: ?>
        <blockquote class="kopa-blockquote-1">No hay resultados</blockquote>
    <?php endif; ?>
</ul>
<div class="pagination clearfix">
    <?php get_template_part('library/templates/template', 'pagination'); ?>
</div>
