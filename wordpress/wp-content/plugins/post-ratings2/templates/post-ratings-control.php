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

<div class="post-ratings2 votos col-lg-12 col-md-12 col-sm-12 col-xs-12 informacion-dinamica" data-post="<?php the_ID(); ?>">
	<script>
	subTotales= new Array(
		<?php if(isset($subTotales)){ foreach($subTotales as $sub){ ?>
		"<?php if(isset($sub)&&$sub!=""){echo $sub;}else{ echo '0';} ?>",
		<?php }}else{ ?> 
		"0","0","0","0"
		<?php } ?>
	);
	</script>
	<div class="rating2" data-post="<?php the_ID(); ?>" data-rating="<?php echo $rating2; ?>" data-readonly="<?php echo (int) ! $this->current_user_can_rate( get_the_ID() ); ?>"></div>

	<div class="rating-meta">
		<?php
		//printf( _n( '%2$s avg. rating (%3$s%% score) - %1$s vote', '%2$s avg. rating (%3$s%% score) - %1$s votes', $votes2, 'post-ratings' ), sprintf( '<strong class="votes">%d</strong>', $votes2 ), sprintf( '<strong>%.2F</strong>', $rating2 ), sprintf( '<strong>%d</strong>', $bayesian_rating2 ) );
		?>
	</div>
	

</div>