<ul class="clearfix">
    <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post();
        $post_class = 'entry-item clearfix';
        if ( !has_post_thumbnail()){
            $post_class .= ' blog-no-thumbnail';
        }
        ?>
        <li>
            <article id="post-<?php the_ID(); ?>" <?php post_class($post_class); ?>>
                <?php if ( has_post_thumbnail()) : ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                    <div class="entry-thumb" style="background-image:url(<?php echo the_post_thumbnail_url("medium"); ?>);">
                        <?php //kopa_the_image(get_the_ID(), get_the_title(), 265, 215); ?>
                    </div>
					</a>
                <?php endif; ?>
                <!-- entry-thumb -->

                <div class="entry-content">
                    <header>
						<p><?php echo get_field("volanta"); ?></p>
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
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" ><p><?php
					$myexcerpt = apply_filters('the_excerpt', get_the_excerpt());
					$main= substr($myexcerpt,0,140);
					$main= substr($main,0,strrpos($main," "));

					// Output part before <!--more--> tag
					echo $main.'... ';
					?> <i class="leer-mas">Leer más</i></p></a>
                    <?php if ( 'show' === get_option( 'kopa_theme_options_blog_readmore_status', 'show' ) ) : ?>
                        <i class="fa fa-external-link search-icon"></i>
                        <!--<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="more-link"><span>Leer más</span></a>!-->
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
