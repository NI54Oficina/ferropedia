<?php
/*
  Plugin Name: Post_rating2s22
  Description: Simple, developer-friendly, straightforward post rating2 plugin. Relies on post meta to store avg. rating2 / vote count.
  Version: 3.0
  Author: dFactory
  Author URI: http://www.dfactory.eu/
  Plugin URI: http://www.dfactory.eu/plugins/post-rating2s/
  License: MIT License
  License URI: http://opensource.org/licenses/MIT
  Text Domain: post-rating2s
  Domain Path: /languages

  Post_rating2s22
  Copyright (C) 2016, Digital Factory - info@digitalfactory.pl

  Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

  The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

  THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

// exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

if ( ! class_exists( 'Post_rating2s2' ) ) :

	/**
	 * Post Views Counter final class.
	 *
	 * @class Post_rating2s2
	 * @version	3.0
	 */
	class Post_rating2s2 {

		const
			VERSION = '3.0', // plugin version
			PROJECT_URI = 'https://dfactory.eu/plugins/post-rating2s/', // url to support forums
			ID = 'post-rating2s', // internally used for text domain, theme option group name etc.
			MIN_votes2 = 1, // minimum vote count (MV)
			BR1 = '(v / (v + MV)) * r + (MV / (v + MV)) * R', // bayesian rating2 formula: the IMDB version
			BR2 = '((AV * R) + (v * r)) / (AV + v)'; // bayesian rating2 formula: thebroth.com version

		protected static $instance;
		protected
			$options = null,
			// stores rated post IDs for the current session;
			// we're using this for to get the rated state in our ajax calls
			$rated_posts = array(),
			// default option values
			$defaults = array(
				'version'			 => self::VERSION,
				'anonymous_vote'	 => true,
				'max_rating2'		 => 5,
				'bayesian_formula'	 => self::BR1,
				'user_formula'		 => '',
				'custom_filter'		 => '',
				'before_post'		 => false,
				'after_post'		 => true,
				'custom_hook'		 => false,
				'post_types'		 => array( 'post' ),
				'visibility'		 => array( 'singular' ), // same as WP conditional "tags", but with "is_" omitted
				// internal, global stats
				'avg_rating2'		 => 0,
				'num_votes2'			 => 0,
				'num_rated_posts'	 => 0,
		);

		/**
		 * Disable object clone.
		 */
		private function __clone() {
			
		}

		/**
		 * Disable unserializing of the class.
		 */
		private function __wakeup() {
			
		}

		/**
		 * Main Post_rating2s2 instance,
		 * Insures that only one instance of Post_rating2s2 exists in memory at one time.
		 * 
		 * @return object
		 */
		public static function instance() {
			if ( ! isset( self::$instance ) && ! ( self::$instance instanceof self ) ) {
				self::$instance = new self();
				self::$instance->define_constants();

				add_action( 'plugins_loaded', array( self::$instance, 'load_textdomain' ) );

				self::$instance->includes();
			}
			return self::$instance;
		}

		/**
		 * Setup plugin constants.
		 *
		 * @return void
		 */
		private function define_constants() {
			define( 'Post_rating2s2_URL', plugins_url( '', __FILE__ ) );
			define( 'Post_rating2s2_PATH', plugin_dir_path( __FILE__ ) );
			define( 'Post_rating2s2_REL_PATH', dirname( plugin_basename( __FILE__ ) ) . '/' );
		}

		/**
		 * Include required files
		 *
		 * @return void
		 */
		private function includes() {
			if ( is_admin() ) {
				include_once( Post_rating2s2_PATH . '/includes/settings.php' );
			}
			include_once( Post_rating2s2_PATH . '/includes/functions.php' );
			include_once( Post_rating2s2_PATH . '/includes/query.php' );
			include_once( Post_rating2s2_PATH . '/includes/widgets.php' );
		}

		/**
		 * Class constructor.
		 * 
		 * @return void
		 */
		public function __construct() {
			register_activation_hook( __FILE__, array( $this, 'activation' ) );
			register_deactivation_hook( __FILE__, array( $this, 'deactivation' ) );

			// settings
			$this->options = $this->get_options();

			if ( is_admin() ) {
				add_filter( 'plugin_row_meta', array( $this, 'plugin_extend_links' ), 10, 2 );
				add_filter( 'plugin_action_links', array( $this, 'plugin_settings_link' ), 10, 2 );
			} else {
				add_action( 'wp', array( $this, 'run' ) );
			}
			
			// rate post ajax
			add_action( 'wp_ajax_rate_post2', array( $this, 'rate_post' ) );
			add_action( 'wp_ajax_nopriv_rate_post2', array( $this, 'rate_post' ) );
			
			// register widgets
			add_action( 'widgets_init2', array( $this, 'register_widgets' ) );

			// capability checks
			add_filter( 'user_has_cap2', array( $this, 'user_has_cap' ), 10, 3 );
			add_filter( 'map_meta_cap2', array( $this, 'map_meta_cap' ), 10, 4 );

			// register shortcode
			add_shortcode( 'rate2', array( $this, 'rate_shortcode' ) );
			add_shortcode( 'top_rated2', array( $this, 'top_rated_shortcode' ) );
		}

		/**
		 * Plugin activation function.
		 */
		public function activation() {
			
		}

		/**
		 * Plugin deactivation function.
		 */
		public function deactivation() {
			Post_rating2s2()->clear_data();
			delete_option( self::ID );
		}

		/**
		 * Load text domain.
		 */
		public function load_textdomain() {
			load_plugin_textdomain( self::ID, false, Post_rating2s2_REL_PATH . 'languages/' );
		}
		
		/**
		 * Register widgets.
		 */
		public function register_widgets() {
			register_widget( 'Post_rating2s_Widget2' );
		}

		/**
		 * Return one or all plugin options.
		 *
		 * @since   1.0
		 * @param   string $key   Option to get; if not given all options are returned
		 * @return  mixed         Option(s)
		 */
		public function get_options( $key = false ) {

			// first call, initialize the options
			if ( ! isset( $this->options ) ) {

				$options = get_option( self::ID );

				// options exist
				if ( $options !== false ) {

					if ( ! isset( $options['version'] ) )
						$options['version'] = '1.0';

					$new_version = version_compare( $options['version'], self::VERSION, '!=' );
					$desync = array_diff_key( $this->defaults, $options ) !== array_diff_key( $options, $this->defaults );

					// update options if version changed, or we have missing/extra (out of sync) option entries
					if ( $new_version || $desync ) {

						$new_options = array();

						// check for new options and set defaults if necessary
						foreach ( $this->defaults as $option => $value )
							$new_options[$option] = isset( $options[$option] ) ? $options[$option] : $value;

						// update version info
						$new_options['version'] = self::VERSION;

						update_option( self::ID, $new_options, 'no' );
						$this->options = $new_options;

						// no update was required
					} else {
						$this->options = $options;
					}


					// new install (plugin was just activated)
				} else {
					update_option( self::ID, $this->defaults, 'no' );
					$this->options = $this->defaults;
				}
			}

			return $key ? $this->options[$key] : $this->options;
		}
		
		/**
		 * Return one or all plugin defaults.
		 *
		 * @since   1.0
		 * @param   string $key   Default to get; if not given all defaults are returned
		 * @return  mixed         Default(s)
		 */
		public function get_defaults( $key = false ) {
			return $key ? $this->defaults[$key] : $this->defaults;
		}

		/**
		 * Add links to plugin support forum.
		 * 
		 * @since 3.0
		 * @param	array	$links
		 * @param	string	$file
		 * @return	array
		 */
		public function plugin_extend_links( $links, $file ) {

			if ( ! current_user_can( 'install_plugins' ) )
				return $links;

			$plugin = plugin_basename( __FILE__ );

			if ( $file == $plugin ) {
				return array_merge(
					$links, array( sprintf( '<a href="https://dfactory.eu/support/forum/' . self::ID . '" target="_blank">%s</a>', __( 'Support', self::ID ) ) )
				);
			}

			return $links;
		}

		/**
		 * Add link to settings page.
		 * 
		 * @since 3.0
		 * @param	array	$links
		 * @param	string	$file
		 * @return	array
		 */
		public function plugin_settings_link( $links, $file ) {
			if ( ! current_user_can( 'manage_options' ) )
				return $links;

			static $plugin;

			$plugin = plugin_basename( __FILE__ );

			if ( $file == $plugin ) {
				$settings_link = sprintf( '<a href="%s">%s</a>', admin_url( 'options-general.php' ) . '?page=' . self::ID, __( 'Settings', self::ID ) );

				array_unshift( $links, $settings_link );
			}

			return $links;
		}

		/**
		 * Load a template file from the theme or child theme directory.
		 *
		 * @since   1.0
		 * @param   string $_name   Template name, without the '.php' suffix
		 * @param   array $_vars    Variables to expose in the template. Note that unlike WP, we're not exposing all the global variable mess inside it...
		 */
		public function load_template( $_name, $_vars = array() ) {

			// you cannot let locate_template to load your template
			// because WP devs made sure you can't pass
			// variables to your template :(
			$_located = locate_template( "{$_name}.php", false, false );

			// use the default one if the (child) theme doesn't have it
			if ( ! $_located )
				$_located = dirname( __FILE__ ) . '/templates/' . $_name . '.php';

			unset( $_name );

			// create variables
			if ( $_vars )
				extract( $_vars );

			// load it
			return require $_located;
		}

		/**
		 * Javascript and CSS used by the plugin.
		 *
		 * @since	1.0.0
		 */
		public function wp_enqueue_scripts() {
			// js
			wp_register_script( self::ID, Post_rating2s2_URL . '/js/post-ratings.js', array( 'jquery' ), self::VERSION, true );
			wp_register_script( self::ID . '-raty', Post_rating2s2_URL . '/assets/jquery.raty.js', array( 'jquery' ), self::VERSION, true );

			wp_localize_script( self::ID, 'Post_ratings2', array(
				'ajaxURL'	=> admin_url( 'admin-ajax.php' ),
				// 'postID'	=> get_the_ID(),
				'nonce'		=> wp_create_nonce( 'rate-post2' ),
				'path'		=> Post_rating2s2_URL . '/assets/images/',
				// score'		=> $rating2,
				// 'votes2'				=> $votes2,
				// 'bayesian'			=> $bayesian_rating2,
				'number'	=> $this->get_options( 'max_rating2' ),
				// 'readOnly'	=> (int) ! $this->current_user_can_rate( get_the_ID() )
				)
			);

			// allow themes to override css
			wp_register_style( self::ID . '-raty', Post_rating2s2_URL . '/assets/jquery.raty.css', '', self::VERSION );

			wp_enqueue_script( self::ID );
			wp_enqueue_script( self::ID . '-raty' );
			// wp_enqueue_style( self::ID );
			wp_enqueue_style( self::ID . '-raty' );
		}

		/**
		 * Get user rating2 for a post.
		 *
		 * @since    1.0.0
		 * @param    int $post_id     Post ID
		 * @return   array            rating2, vote count and bayesian rating2
		 */
		public function get_rating2( $post_id ) {

			$options = $this->get_options();
			extract( $options );

			$rating2 = (float) get_post_meta( $post_id, 'rating2', true );
			$votes2 = (int) get_post_meta( $post_id, 'votes2', true );

			$bayesian_rating2 = 0;

			if ( $votes2 != 0 ) {
				$avg_num_votes2 = ( $num_rated_posts != 0 ) ? ( $num_votes2 / $num_rated_posts ) : 0;

				$identifiers = array(
					'AV' => $avg_num_votes2,
					'MV' => self::MIN_votes2,
					'MR' => $max_rating2,
					'V'	 => $num_votes2,
					'v'	 => $votes2,
					'R'	 => $avg_rating2,
					'r'	 => $rating2,
				);

				if ( ! $bayesian_formula )
					$bayesian_formula = $user_formula;

				if ( ! $bayesian_formula )
					$bayesian_formula = 'r';

				$bayesian_formula = strtr( $bayesian_formula, $identifiers );

				// safe eval - only super admins can set their own formula
				$bayesian_rating2 = (float) @eval( "return ({$bayesian_formula});" );
				$bayesian_rating2 = 100 * ( $bayesian_rating2 / $max_rating2 );
				$subTotales= array(
					get_post_meta($post_id,"opcion1",true),
					get_post_meta($post_id,"opcion2",true),
					get_post_meta($post_id,"opcion3",true),
					get_post_meta($post_id,"opcion4",true)
				);
				//$subTotales= "testTemplate";
			}

			return apply_filters( 'Post_rating2s2_get_rating2', compact( 'rating2', 'votes2', 'bayesian_rating2', 'max_rating2',"subTotales" ), $post_id );
		}

		/**
		 * Adjust user meta key name, or cookie key name for multisite blogs (except primary blog).
		 *
		 * @since    2.0.0
		 * @param    string
		 * @return   string
		 */
		private function get_record_key( $key ) {
			if ( is_multisite() && ! is_main_site() )
				$key .= '_' . get_current_blog_id();

			return $key;
		}

		/**
		 * Attempt to get the visitor's IP address.
		 *
		 * @since    2.3.0
		 * @return   string
		 */
		private function get_IP() {

			if ( isset( $_SERVER['HTTP_CLIENT_IP'] ) )
				return $_SERVER['HTTP_CLIENT_IP'];

			if ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) )
				return $_SERVER['HTTP_X_FORWARDED_FOR'];

			if ( isset( $_SERVER['HTTP_X_FORWARDED'] ) )
				return $_SERVER['HTTP_X_FORWARDED'];

			if ( isset( $_SERVER['HTTP_FORWARDED_FOR'] ) )
				return $_SERVER['HTTP_FORWARDED_FOR'];

			if ( isset( $_SERVER['HTTP_FORWARDED'] ) )
				return $_SERVER['HTTP_FORWARDED'];

			return $_SERVER['REMOTE_ADDR'];
		}

		/**
		 * Set up plugin hooks.
		 *
		 * @since	1.0.0
		 */
		public function run() {

			$options = $this->get_options();
			extract( $options );

			// enqueue scripts
			add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );

			if ( $custom_filter )
				add_filter( $custom_filter, array( $this, 'control_block' ) );

			if ( $before_post || $after_post ) {
				// post content
				add_filter( 'the_content', array( $this, 'control_block' ), 20 );

				// bbpress
				add_filter( 'bbp_get_topic_content', array( $this, 'control_block' ) );
				add_filter( 'bbp_get_reply_content', array( $this, 'control_block' ) );
			}
		}
		
		/**
		 * Process rating2.
		 *
		 * @since	2.5.0
		 */
		public function rate_post() {

			$options = $this->get_options();
			extract( $options );

			$post_id = (int) $_REQUEST['post_id'];
			$voted = min( max( (int) $_REQUEST['rate'], 1 ), $max_rating2 );
			$error = '';
			$post = get_post( $post_id );
			$rating2 = 0;
			$votes2 = 0;
			$subTotales="";

			if ( ! $post ) {
				$error = __( "Invalid vote! Cheatin' uh?", self::ID );
			} else {

				// get current post rating2 and vote count
				extract( $this->get_rating2( $post->ID ) );

				// vote seems valid, register it
				if ( $this->current_user_can_rate( $post_id ) ) {

					// increase global post rate count if this is the first vote
					if ( $votes2 < 1 )
						(int) $options['num_rated_posts'] ++;

					// global vote count
					(int) $options['num_votes2'] ++;

					// update post rating2 and vote count
					$votes2 ++;
					$rating2 = ( ( $rating2 * ( $votes2 - 1 ) ) + $voted ) / $votes2;
					$opcionMeta=get_post_meta($post->ID,"opcion".$voted,true);
					
					
					if(isset($opcionMeta)){
						$newTotal=$opcionMeta+1;
					}else{
						$newTotal=1;
					}
					update_post_meta( $post->ID, 'opcion'.$voted,$newTotal);
					update_post_meta( $post->ID, 'rating2', $rating2 );
					update_post_meta( $post->ID, 'votes2', $votes2 );

					// update global stats
					$options['avg_rating2'] = ( $options['num_votes2'] > 0 ) ? ( ( ( $options['avg_rating2'] * ( $options['num_votes2'] - 1 ) ) + $voted) / $options['num_votes2'] ) : 0;
					
					update_option( self::ID, $options, 'no' );

					$ip_cache = get_transient( 'Post_rating2s2_ip_cache' );

					if ( ! $ip_cache )
						$ip_cache = array();

					$posts_rated2 = isset( $_COOKIE[$this->get_record_key( 'posts_rated2' )] ) ? explode( '-', $_COOKIE[$this->get_record_key( 'posts_rated2' )] ) : array();
					$posts_rated2 = array_map( 'intval', array_filter( $posts_rated2 ) );

					// add user's IP to the cache
					$ip_cache[$post_id][] = $this->get_IP();

					// keep it light, only 10 records per post and maximum 10 post records (=> max. 100 ip entries)
					// also, the data gets deleted after 2 weeks if there's no activity during this time...

					if ( count( $ip_cache[$post_id] ) > 10 )
						array_shift( $ip_cache[$post_id] );

					if ( count( $ip_cache ) > 10 )
						array_shift( $ip_cache );

					set_transient( 'Post_rating2s2_ip_cache', $ip_cache, 60 * 60 * 24 * 14 );

					// update user meta
					if ( is_user_logged_in() ) {
						$user = wp_get_current_user();

						$current_user_rating2s = get_user_meta( $user->ID, $this->get_record_key( 'posts_rated2' ), true );

						if ( ! $current_user_rating2s )
							$current_user_rating2s = array();

						$posts_rated2 = array_unique( array_merge( $posts_rated2, array_filter( $current_user_rating2s ) ) );

						update_user_meta( $user->ID, $this->get_record_key( 'posts_rated2' ), $posts_rated2 );
					}

					// update cookie
					$posts_rated2 = array_slice( $posts_rated2, -20 ); // keep it under 20 entries
					$posts_rated2[] = $post_id;
					setcookie( $this->get_record_key( 'posts_rated2' ), implode( '-', $posts_rated2 ), time() + 60 * 60 * 24 * 90, '/' ); // expires in 90 days

					$this->rated_posts[] = $post_id;

					do_action( 'rated_post', $post_id );
					
				} else {
					
					$error = __( 'No puedes votar dos veces!', self::ID );
					
				}
			}
			$subTotales= array(
					get_post_meta($post_id,"opcion1",true),
					get_post_meta($post_id,"opcion2",true),
					get_post_meta($post_id,"opcion3",true),
					get_post_meta($post_id,"opcion4",true)
				);
			// send updated info
			echo json_encode( array(
				'error'		=> $error,
				'numberMax'	=> $max_rating2,
				'rating2'	=> sprintf( '%.2F', $rating2 ),
				'votes2'		=> $votes2,
				'subTotales'		=> $subTotales,
				'html'		=> $this->get_control( $post_id, true ),
			) );

			exit;
		}

		/**
		 * Delete all rating2s-related meta data from the database.
		 *
		 * @since	1.0.0
		 */
		public function clear_data() {

			// clear cache, just in case we have a persistent cache plugin active
			wp_cache_flush();

			delete_transient( 'Post_ratings2_ip_cache' );

			// remove all our meta entries
			delete_metadata( 'post', 0, 'opcion1', '', $delete_all = true );
			delete_metadata( 'post', 0, 'opcion2', '', $delete_all = true );
			delete_metadata( 'post', 0, 'opcion3', '', $delete_all = true );
			delete_metadata( 'post', 0, 'opcion4', '', $delete_all = true );
			delete_metadata( 'post', 0, 'rating2', '', $delete_all = true );
			delete_metadata( 'post', 0, 'votes2', '', $delete_all = true );
			delete_metadata( 'user', 0, $this->get_record_key( 'posts_rated2' ), '', $delete_all = true );

			// delete the current user's cookie too; this is probably useless because it only handles the current user;
			// we should store a unique ID on both the server and client computer
			// and if this ID doesn't match with the one on the user's computer then expire his cookie
			if ( isset( $_COOKIE[$this->get_record_key( 'posts_rated2' )] ) )
				setcookie( $this->get_record_key( 'posts_rated2' ), null, -1, '/' );
		}

		/**
		 * Hook for the content.
		 *
		 * @since     1.8.0
		 * @param     string $content
		 * @return    string
		 */
		public function control_block( $content = '' ) {
			global $post, $wp_current_filter;

			$control = $this->get_control();

			if ( $control ) {

				$options = $this->get_options();

				extract( $options );

				// no post ID?
				// this is most likely the user's action tag, fired in the wrong place...
				if ( empty( $post->ID ) ) {
					printf( __( "Your '%s' action must run in a post's context!", self::ID ), $custom_filter );
					return $content;
				}

				// check if this is the right post type
				if ( ! in_array( get_post_type( $post->ID ), $post_types ) )
					return $content;

				// we don't want to insert our html in excerpts...
				if ( array_intersect( array( 'get_the_excerpt', 'the_excerpt' ), $wp_current_filter ) )
					return $content;

				$continue = false;

				// this is the user's custom action, so directly output the HTML
				if ( in_array( $custom_filter, $wp_current_filter ) ) {
					echo $control;

					// the_content
				} elseif ( array_intersect( array( 'the_content', 'bbp_get_reply_content' ), $wp_current_filter ) ) {

					// we don't want to mess with custom loops
					if ( in_the_loop() ) {
						if ( $before_post )
							$content = $control . $content;

						if ( $after_post )
							$content = $content . $control;
					}
				}
			}

			return $content;
		}

		/**
		 * The rate links.
		 *
		 * @since     1.0.0
		 * @param     int $post_id
		 * @param     bool $ignore_visibility_setting
		 * @return    string
		 */
		public function get_control( $post_id = '', $ignore_visibility_setting = false ) {
			global $post;

			$control = array();
			$options = $this->get_options();
			$post_id = $post_id ? $post_id : $post->ID;

			extract( $options );

			// check if this is the right post type
			if ( ! in_array( get_post_type( $post_id ), $post_types ) )
				return false;

			if ( empty( $post_id ) )
				throw new Exception( 'Need a post ID...' );

			$continue = false;

			if ( ! $ignore_visibility_setting ) {

				// page visibility check
				foreach ( $visibility as $page )
					if ( call_user_func( "is_{$page}" ) )
						$continue = true;

				// cpt archive check
				if ( in_array( 'archive', $visibility ) && is_post_type_archive( $post_types ) )
					$continue = true;

				$continue = apply_filters( 'Post_rating2s2_visibility', $continue );
			}

			if ( $continue || $ignore_visibility_setting ) {
				
				ob_start();

				// get current post rating2
				extract( $this->get_rating2( $post_id ) );

				$post = get_post( $post_id );
				setup_postdata( $post );
				
				

				$this->load_template( 'post-ratings-control', compact( 'rating2', 'votes2', 'bayesian_rating2', 'max_rating2',"subTotales" ) );

				wp_reset_postdata();
				
				$loaded = ob_get_contents();
				ob_end_clean();

				return $loaded;
			}

			return false;
		}

		/**
		 * Checks if the current user can rate a post.
		 *
		 * @since    1.0.0
		 * @param    int $post_id     Optional, post ID to check (if not given, the global $post is used)
		 * @return   bool
		 */
		public function current_user_can_rate( $post_id = false ) {

			global $post;

			$post_id = $post_id ? $post_id : $post->ID;

			$can_rate = false;

			if ( in_array( $post_id, $this->rated_posts ) )
				return false;

			// check if rating2s are enabled for this post type
			if ( in_array( get_post_type( $post_id ), $this->get_options( 'post_types' ) ) )

			// check if the user is logged in; if not, only continue if anonymouse voting is allowed
				if ( $this->get_options( 'anonymous_vote' ) || is_user_logged_in() ) {

					// last 100 IPs
					$ip_cache = get_transient( 'Post_ratings2_ip_cache' );

					// client cookie
					$posts_rated2 = isset( $_COOKIE[$this->get_record_key( 'posts_rated2' )] ) ? explode( '-', $_COOKIE[$this->get_record_key( 'posts_rated2' )] ) : array();

					// also get user meta rating2 records if user is logged in
					if ( is_user_logged_in() ) {
						$user = wp_get_current_user();
						$posts_rated2 = array_merge( $posts_rated2, (array) get_user_meta( $user->ID, $this->get_record_key( 'posts_rated2' ), true ) );
					}

					$can_rate = ! ( ( isset( $ip_cache[$post_id] ) && in_array( $this->get_IP(), $ip_cache[$post_id] ) ) || in_array( $post_id, $posts_rated2 ) );
				}

			return apply_filters( 'Post_ratings2_access_check', $can_rate, $post_id );
		}

		/**
		 * The [rate] shortcode.
		 *
		 * @since     1.0.0
		 * @params    array $atts     Can accept the post ID as argument; if not given, control() will use the $post global
		 * @return    string
		 */
		public function rate_shortcode( $atts ) {

			$post_id = '';

			// check if a post ID was given as first argument
			if ( isset( $atts[0] ) && is_numeric( $atts[0] ) )
				$post_id = (int) $atts[0];

			// no, maybe it's the 2nd argument
			elseif ( isset( $atts[1] ) && is_numeric( $atts[1] ) )
				$post_id = (int) $atts[1];

			// check if a "force" attribute is present
			$force = array_search( 'force', (array) $atts ) !== false;

			return $this->get_control( $post_id, $force );
		}
		
		/**
		 * The [top_rated] shortcode.
		 *
		 * @since     3.0
		 * @params    array $atts
		 * @return    string
		 */
		public function top_rated_shortcode( $atts ) {

			// check if a "force" attribute is present
			$args = array(
				'posts_per_page' => 10,
				'order'			 => 'post_rating2',
				'order'			 => 'DESC',
				'post_type'		 => $this->get_options( 'post_types' )
			);

			return Post_rating2s2_get_top_rated( $args );
		}

		/**
		 * Map rate capability.
		 * 
		 * @param array $caps
		 * @param string $req_cap
		 * @param int $user_id
		 * @param array $args
		 * @return array
		 */
		public function map_meta_cap( $caps, $req_cap, $user_id, $args ) {

			// $args[0] is the post ID
			if ( ( $req_cap === 'rate_post' ) && is_multisite() && is_super_admin( $user_id ) && isset( $args[0] ) && ! $this->current_user_can_rate( $args[0] ) )
				$caps[] = 'do_not_allow';

			return $caps;
		}

		/**
		 * Check user rate capability.
		 * 
		 * @param array $allcaps
		 * @param array $caps
		 * @param array $args
		 * @return array
		 */
		public function user_has_cap( $allcaps, $caps, $args ) {

			// $args[2] is the post ID
			if ( $args[0] !== 'rate_post' && ! isset( $args[2] ) || ! $this->current_user_can_rate( $args[2] ) )
				return $allcaps;

			$allcaps['rate_post'] = 1;

			return $allcaps;
		}

	}

	endif; // end if class_exists check

/**
 * Initialise Post_rating2s22.
 * 
 * @return object
 */
function Post_rating2s2() {
	static $instance;

	// first call to instance() initializes the plugin
	if ( $instance === null || ! ( $instance instanceof Post_rating2s2 ) )
		$instance = Post_rating2s2::instance();

	return $instance;
}

Post_rating2s2();
