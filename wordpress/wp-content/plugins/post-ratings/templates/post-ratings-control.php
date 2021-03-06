<?php
/**
 * @template	Post Ratings Control
 * @revised		December 21, 2015
 * @author		Digital Factory, http://www.dfactory.eu/
 * @license		MIT License, http://opensource.org/licenses/MIT
 */

/*
  This is the HTML template for the ratings control/info block.
  You can override it by creating your own template with the same name, inside your theme / child theme folder.

  The mark-up can be almost entirely changed, the only things required are the "post-ratings" class for the wrapper div, 
  the "data-post" attribute on it, containing the ID of the current post and "rating" div wrapper.

  Available variables inside this template:
  $rating           - real, rating of the current post
  $votes            - integer, number of votes the post has
  $bayesian_rating  - real, weighted rating (score)
  $max_rating       - integer, maximum possible rating
 */

if ( ! defined( 'ABSPATH' ) )
	exit; // exit if accessed directly

// local variable, we will make this the title of the html block
$current_rating = apply_filters( 'post_ratings_current_rating', sprintf( '%.2F / %d', $rating, $max_rating ), $rating, $max_rating );
?>


<div class="post-ratings votos col-lg-12 col-md-12 col-sm-12 col-xs-12 informacion-dinamica votos-container-1" data-post="<?php the_ID(); ?>">
	<span class="promedio-votos">
	<?php
		//printf( _n( '%2$s avg. rating (%3$s%% score) - %1$s vote', '%2$s avg. rating (%3$s%% score) - %1$s votes', $votes, 'post-ratings' ), sprintf( '<strong class="votes">%d</strong>', $votes ), sprintf( '<strong>%.2F</strong>', $rating ), sprintf( '<strong>%d</strong>', $bayesian_rating ) );
		printf( _n( '%2$s pts', '%2$s pts', $votes, 'post-ratings' ), sprintf( '<strong class="votes">%d</strong>', $votes ), sprintf( '<strong>%.2F</strong>', $rating ), sprintf( '<strong>%d</strong>', $bayesian_rating ) );
		?>
		</span>
	<div class="rating" data-post="<?php the_ID(); ?>" data-rating="<?php echo $rating; ?>" data-readonly="1"></div>
	

	<div class="rating-meta">
		
	</div>
	<?php if($this->current_user_can_rate( get_the_ID() )){ ?>
	<div class="votar"><span>¡Votá!</span><div class="rating" data-post="<?php the_ID(); ?>" data-rating="<?php echo $rating; ?>" data-readonly="<?php echo (int) ! $this->current_user_can_rate( get_the_ID() ); ?>"></div></div>
	<?php }else{ ?>
	<br><br>
	<?php } ?>
	

</div>