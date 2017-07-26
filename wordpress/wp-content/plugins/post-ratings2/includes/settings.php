<?php
// exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

/**
 * Post_rating2s2_Settings2 class.
 * 
 * @since	3.0
 */
class Post_rating2s2_Settings2 {

	public function __construct() {
		// actions
		add_action( 'admin_menu', array( $this,  'options_page' ) );
		add_action( 'admin_init', array( $this,  'register_settings' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
	}
	
	/**
	 * Hook our plugin options menu / page
	 *
	 * @since	1.0
	 */
	public function options_page() {
		add_options_page( __( 'Post Ratings2', Post_rating2s2::ID ), __( 'Post Ratings2', Post_rating2s2::ID ), 'manage_options', Post_rating2s2::ID, array( $this, 'settings_page' ) );
	}
	
	/**
	 * Register our settings with the Settings API.
	 *
	 * @since	1.0
	 */
	public function register_settings() {
		// fix for rate post ajax request update_option returning false
		if ( ( defined( 'DOING_AJAX' ) && DOING_AJAX ) && isset( $_REQUEST[ 'action' ] ) && $_REQUEST[ 'action' ] === 'rate_post2' )
			return;
		
		register_setting( Post_rating2s2::ID, Post_rating2s2::ID, array( $this, 'validate_settings' ) );
		add_settings_section( Post_rating2s2::ID . '_general', '', array( $this, 'Post_rating2s2_section' ), Post_rating2s2::ID );

		add_settings_field( 'max_rating2', __( 'Maximum rating', Post_rating2s2::ID ), array( $this, 'max_rating_field' ), Post_rating2s2::ID, Post_rating2s2::ID . '_general' );
		add_settings_field( 'bayesian_formula', __( 'Bayesian score formula', Post_rating2s2::ID ), array( $this, 'bayesian_formula_field' ), Post_rating2s2::ID, Post_rating2s2::ID . '_general' );
		add_settings_field( 'allow_ratings_on', __( 'Allow ratings on', Post_rating2s2::ID ), array( $this, 'allow_ratings_on_field' ), Post_rating2s2::ID, Post_rating2s2::ID . '_general' );
		add_settings_field( 'ratings_visibility', __( 'Ratings visibility', Post_rating2s2::ID ), array( $this, 'ratings_visibility_field' ), Post_rating2s2::ID, Post_rating2s2::ID . '_general' );
		add_settings_field( 'access_level', __( 'User access', Post_rating2s2::ID ), array( $this, 'access_level_field' ), Post_rating2s2::ID, Post_rating2s2::ID . '_general' );
		add_settings_field( 'link_location', __( 'Link location', Post_rating2s2::ID ), array( $this, 'link_location_field' ), Post_rating2s2::ID, Post_rating2s2::ID . '_general' );
		add_settings_field( 'remove_ratings', __( 'Remove ratings', Post_rating2s2::ID ), array( $this, 'remove_ratings_field' ), Post_rating2s2::ID, Post_rating2s2::ID . '_general' );
	}
	
	/**
	 * Post Ratings section.
	 */
	public function Post_rating2s2_section() {}
	
	/**
	 * Maximum rating option.
	 * 
	 * @since	3.0
	 */
	public function max_rating_field() {
		echo '
		<div id="pr_max_rating2">
			<input type="number" min="1" max="10" name="' . Post_rating2s2::ID . '[max_rating2]" id="max_rating2" value="' . Post_rating2s2()->get_options( 'max_rating2' ) . '" ' . ' />';
		echo '
			<p class="description">' . __( 'Enter from 1 to 10 (defaults to 5). <strong>Important:</strong> Changing this option will reset existing post rating records.', Post_rating2s2::ID ) . '</p>
		</div>';
	}
	
	/**
	 * Bayesian formula option.
	 * 
	 * @since	3.0
	 */
	public function bayesian_formula_field() {
		$formulas = array(
			'bayesian_formula_1'	=> array( 
				'label'	=>	'<code>(<em>v</em> / (<em>v</em> + <strong>MV</strong>)) * <em>r</em> + (<strong>MV</strong> / (<em>v</em> + <strong>MV</strong>)) * <strong>R</strong></code> (' . sprintf( __( 'from %s', Post_rating2s2::ID ), '<a href="http://en.wikipedia.org/wiki/Internet_Movie_Database#User_ratings_of_films" target="_blank">IMDB</a>' ) . ')',
				'value' => Post_rating2s2::BR1
			),
			'bayesian_formula_2'	=> array(
				'label'	=>	'<code>((<strong>AV</strong> * <strong>R</strong>) + (<em>v</em> * <em>r</em>)) / (<strong>AV</strong> + <em>v</em>)</code> (' . sprintf( __( 'from %s', Post_rating2s2::ID ), '<a href="https://gist.github.com/44522/" target="_blank">thebroth</a>' ) . ')',
				'value'	=> Post_rating2s2::BR2
			),
			'user_formula'			=> array(
				'label'	=>	__( 'I have my own formula', Post_rating2s2::ID ),
				'value'	=>	Post_rating2s2()->get_options( 'user_formula' )
			)
		);

		echo '
		<div id="pr_bayesian_formula">
			<fieldset>';
		
			foreach ( $formulas as $key => $formula ) {
				echo '
				<label for="' . $key . '"><input id="' . $key . '" type="radio" name="' . Post_rating2s2::ID . '[bayesian_formula]" value="' . $formula['value'] . '" ' . checked( (bool) ( Post_rating2s2()->get_options( 'bayesian_formula' ) == $formula['value'] ), true, false ) . '/>' . $formula['label'] . '</label><br />';
			}

		echo '
				<p class="description">' . esc_html__( 'Select the bayesian formula you would like to use.', Post_rating2s2::ID ) . '</p>';
		
		echo '
				<div id="pr_user_formula"' . ( Post_rating2s2()->get_options( 'bayesian_formula' ) != Post_rating2s2()->get_options( 'user_formula' ) ? ' style="display: none;"' : '' ) . '>
					<p>
						<input type="text" name="' . Post_rating2s2::ID . '[user_formula]" class="regular-text" value="' . Post_rating2s2()->get_options( 'user_formula' ) . '" />
						<p class="description">' . esc_html__( 'Enter your custom formula.', Post_rating2s2::ID ) . '</p>
					</p>
					
					<p id="pr_legend">
						<code><strong>AV</strong></code> = ' . __( 'Global average number of votes per post', Post_rating2s2::ID ) . '<br />
						<code><strong>&nbsp;V</strong></code> = ' . __( 'Global number of votes (from all posts)', Post_rating2s2::ID ) . '<br />
						<code><em>&nbsp;v</em></code> = ' . __( 'Number of votes from the current post', Post_rating2s2::ID ) . '<br />
						<code><strong>&nbsp;R</strong></code> = ' . sprintf( __( 'Global average rating per post (from 1 to %d)', Post_rating2s2::ID ), Post_rating2s2()->get_options( 'max_rating2' ) ) . '<br />
						<code><em>&nbsp;r</em></code> = ' . sprintf( __( 'Average rating of the current post (from 1 to %d)', Post_rating2s2::ID ), Post_rating2s2()->get_options( 'max_rating2' ) ) . '<br />
						<code><strong>MV</strong></code> = ' . sprintf( __( 'Minimum vote count per post to consider (%d by default)', Post_rating2s2::ID ), Post_rating2s2::MIN_votes2 ) . '<br />
						<code><strong>MR</strong></code> = ' . sprintf( __( 'Maximum rating, see option above (currently %d)', Post_rating2s2::ID ), Post_rating2s2()->get_options( 'max_rating2' ) ) . '
					</p>
				</div>

			</fieldset>
		</div>';
	}
	
	/**
	 * Allow rating on post types option.
	 * 
	 * @since	3.0
	 */
	public function allow_ratings_on_field() {
		$post_types = apply_filters( 'Post_rating2s2_post_types', get_post_types( array( 'public' => true ) ) );
		
		echo '
		<div id="pr_allow_ratings_on">
			<fieldset>';
		
			foreach ( $post_types as $post_type ) {
				$object = get_post_type_object( $post_type );
				
				echo '
				<label for="allow_on-' . $post_type . '"><input id="allow_on-' . $post_type . '" type="checkbox" name="' . Post_rating2s2::ID . '[post_types][]" value="' . $post_type . '" ' . checked( in_array( $post_type, Post_rating2s2()->get_options( 'post_types' ) ), true, false ) . '/>' . $object->labels->name . '</label>';
			}
			
		echo '
			</fieldset>
		</div>';
	}
	
	/**
	 * Ratings visibility option.
	 * 
	 * @since	3.0
	 */
	public function ratings_visibility_field() {
		$pages = apply_filters( 'Post_rating2s2_page_visibility', array(
			'home'		 => __( 'Home', Post_rating2s2::ID ),
			'archive'	 => __( 'Archives', Post_rating2s2::ID ),
			'singular'	 => __( 'Single pages', Post_rating2s2::ID ),
			'search'	 => __( 'Search results', Post_rating2s2::ID ),
		) );
		
		echo '
		<div id="pr_ratings_visibility">
			<fieldset>';
		
			foreach ( $pages as $key => $label ) {
				echo '
				<label for="visibility-' . $key . '"><input id="visibility-' . $key . '" type="checkbox" name="' . Post_rating2s2::ID . '[visibility][]" value="' . $key . '" ' . checked( in_array( $key, Post_rating2s2()->get_options( 'visibility' ) ), true, false ) . '/>' . $label . '</label>';
			}
			
		echo '
			</fieldset>
		</div>';
	}
	
	/**
	 * Access level option.
	 * 
	 * @since	3.0
	 */
	public function access_level_field() {
		echo '
		<div id="pr_access_level">
			<label for="anonymous_vote"><input type="checkbox" name="' . Post_rating2s2::ID . '[anonymous_vote]" id="anonymous_vote" value="1" ' . checked( Post_rating2s2()->get_options( 'anonymous_vote' ), true, false ) . ' />' . __( 'Allow unregistered users to vote', Post_rating2s2::ID ) . '</label>';
		echo '
		</div>';
	}
	
	/**
	 * Link location option.
	 * 
	 * @since	3.0
	 */
	public function link_location_field() {
		$locations = array(
			'before_post'	 => __( 'Before post content', Post_rating2s2::ID ),
			'after_post'	 => __( 'After post content', Post_rating2s2::ID ),
			'custom_hook'	 => __( 'I have my own action hook', Post_rating2s2::ID )
		);
		
		echo '
		<div id="pr_link_location">
			<fieldset>';
		
			foreach ( $locations as $key => $label ) {
				echo '
				<label for="location-' . $key . '"><input id="location-' . $key . '" type="checkbox" name="' . Post_rating2s2::ID . '[' . $key . ']" value="1" ' . checked(Post_rating2s2()->get_options( $key ), true, false ) . '/>' . $label . '</label><br />';
			}
			
		echo '
				<p class="description">' . sprintf( __( 'Select the location for the rate links. You can also add it manually anywhere by using the %s shortcode', Post_rating2s2::ID ), '<code>[rate]</code>' );
		
		echo '
				<div id="pr_custom_filter"' . ( Post_rating2s2()->get_options( 'custom_hook' ) == '' ? ' style="display: none;"' : '' ) . '>
					<p>
						<input type="text" name="' . Post_rating2s2::ID . '[custom_filter]" class="regular-text" value="' . Post_rating2s2()->get_options( 'custom_filter' ) . '" />
						<p class="description">' . esc_html__( 'Enter your custom action hook.', Post_rating2s2::ID ) . '</p>
					</p>
				</div>';
			
		echo '
			</fieldset>
		</div>';
	}
	
	/**
	 * Access level option.
	 * 
	 * @since	3.0
	 */
	public function remove_ratings_field() {
		echo '
		<div id="pr_remove_ratings">
			<label for="remove_ratings"><input type="checkbox" name="' . Post_rating2s2::ID . '[remove_ratings]" id="remove_ratings" value="1" />' . __( 'Delete rating records from all posts.', Post_rating2s2::ID ) . '</label>';
		echo '
		</div>';
	}

	/**
	 * Validate user input for our settings
	 *
	 * @since    1.0
	 * @param    array	$input
	 * @return   array
	 */
	public function validate_settings( $input ) {
		
		if ( isset( $_POST['save_Post_rating2s2_options'] ) ) {

			extract( $input );

			$options = array(
				'anonymous_vote'	=> isset( $anonymous_vote ) ? true : false,
				'max_rating2'		=> min( max( (int) $max_rating2, 1 ), 10 ),
				'bayesian_formula'	=> wp_filter_nohtml_kses( $bayesian_formula ),
				// only allow super admins to change this, because it's a little sensitive (part of this string is used inside the top rated db query)
				'user_formula'		=> current_user_can( 'edit_plugins' ) ? wp_filter_nohtml_kses( $user_formula ) : Post_rating2s2()->get_options( 'user_formula' ),
				'before_post'		=> isset( $before_post ) ? true : false,
				'after_post'		=> isset( $after_post ) ? true : false,
				'custom_hook'		=> isset( $custom_hook ) ? true : false,
				'custom_filter'		=> wp_filter_nohtml_kses( $custom_filter ),
				'post_types'		=> isset( $post_types ) ? array_filter( $post_types, 'post_type_exists' ) : array(),
				'visibility'		=> isset( $visibility ) ? array_map( 'wp_filter_nohtml_kses', $visibility ) : array(),
				// internal, global stats
				'avg_rating'		=> Post_rating2s2()->get_options( 'avg_rating' ),
				'num_votes'			=> Post_rating2s2()->get_options( 'num_votes' ),
				'num_rated_posts'	=> Post_rating2s2()->get_options( 'num_rated_posts' ),
				'version'			=> Post_rating2s2::VERSION,
			);

			if ( isset( $remove_ratings ) || ($options['max_rating2'] !== Post_rating2s2()->get_options( 'max_rating2' )) ) {
				$options['avg_rating'] = $options['num_votes'] = $options['num_rated_posts'] = 0;
				Post_rating2s2()->clear_data();
			}

			$input = $options;
		
		} elseif ( isset( $_POST['reset_Post_rating2s2_options'] ) ) {
			
			$input = Post_rating2s2()->get_defaults();
			
		}
		
		return $input;
	}
	
	/**
	 * Options page callback.
	 * 
	 * @since	3.0
	 * @return	mixed
	 */
	public function settings_page() {
		echo '
		<div class="wrap">' . screen_icon() . '
			<h1>' . __( 'Post Ratings', Post_rating2s2::ID ) . '</h1>
			<div class="post-ratings-settings">
				<div class="df-credits">
					<h3 class="hndle">' . __( 'Post Ratings', Post_rating2s2::ID ) . ' ' . Post_rating2s2::VERSION . '</h3>
					<div class="inside">
						<h4 class="inner">' . __( 'Need support?', Post_rating2s2::ID ) . '</h4>
						<p class="inner">' . __( 'If you are having problems with this plugin, please talk about them in the', Post_rating2s2::ID ) . ' <a href="https://www.dfactory.eu/support/?utm_source=' . Post_rating2s2::ID . '-settings&utm_medium=link&utm_campaign=support" target="_blank" title="' . __( 'Support forum', Post_rating2s2::ID ) . '">' . __( 'Support forum', Post_rating2s2::ID ) . '</a></p>
						<hr />
						<h4 class="inner">' . __( 'Do you like this plugin?', Post_rating2s2::ID ) . '</h4>
						<p class="inner"><a href="https://wordpress.org/support/view/plugin-reviews/' . Post_rating2s2::ID . '" target="_blank" title="' . __( 'Rate it 5', Post_rating2s2::ID ) . '">' . __( 'Rate it 5', Post_rating2s2::ID ) . '</a> ' . __( 'on WordPress.org', Post_rating2s2::ID ) . '<br />' .
		__( 'Blog about it & link to the', Post_rating2s2::ID ) . ' <a href="http://www.dfactory.eu/plugins/restrict-widgets/?utm_source=' . Post_rating2s2::ID . '-settings&utm_medium=link&utm_campaign=blog-about" target="_blank" title="' . __( 'plugin page', Post_rating2s2::ID ) . '">' . __( 'plugin page', Post_rating2s2::ID ) . '</a><br/>' .
		__( 'Check out our other', Post_rating2s2::ID ) . ' <a href="http://www.dfactory.eu/plugins/?utm_source=' . Post_rating2s2::ID . '-settings&utm_medium=link&utm_campaign=other-plugins" target="_blank" title="' . __( 'WordPress plugins', Post_rating2s2::ID ) . '">' . __( 'WordPress plugins', Post_rating2s2::ID ) . '</a>
						</p>
						<hr />
						<p class="df-link inner">' . __( 'Created by', Post_rating2s2::ID ) . ' <a href="http://www.dfactory.eu/?utm_source=' . Post_rating2s2::ID . '-settings&utm_medium=link&utm_campaign=created-by" target="_blank" title="dFactory - Quality plugins for WordPress"><img src="' . Post_rating2s2_URL . '/images/logo-dfactory.png' . '" title="dFactory - Quality plugins for WordPress" alt="dFactory - Quality plugins for WordPress" /></a></p>
					</div>
				</div>
				<form action="options.php" method="post">';

		settings_fields( Post_rating2s2::ID );
		do_settings_sections( Post_rating2s2::ID );
		
		echo '
					<p class="submit">';

		submit_button( '', 'primary', 'save_Post_rating2s2_options', false );

		echo ' ';

		submit_button( __( 'Reset to defaults', Post_rating2s2::ID ), 'secondary', 'reset_Post_rating2s2_options', false );

		echo '
					</p>
				</form>
			</div>
			<div class="clear"></div>
		</div>';
	}
	
	/**
	 * Load scripts and styles.
	 * 
	 * @since	3.0
	 * @param	string	$page
	 */
	public function admin_enqueue_scripts( $page ) {
		
		if ( $page == 'settings_page_post-ratings' ) {
			
			wp_enqueue_script(
				'post-ratings-admin', Post_rating2s2_URL . '/js/admin.js', array( 'jquery' ), Post_rating2s2::VERSION, true
			);

			wp_enqueue_style(
				'post-ratings-admin', Post_rating2s2_URL . '/css/admin.css'
			);
			
		}
	}
}

new Post_rating2s2_Settings2();