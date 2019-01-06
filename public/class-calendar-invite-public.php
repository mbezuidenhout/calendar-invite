<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://tripturbine.com/
 * @since      1.0.0
 *
 * @package    Calendar_Invite
 * @subpackage Calendar_Invite/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Calendar_Invite
 * @subpackage Calendar_Invite/public
 * @author     Marius Bezuidenhout <marius.bezuidenhout@gmail.com>
 */
class Calendar_Invite_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

    /**
     * Plugin options
     *
     * @since   1.0.0
     * @access  private
     * @var     array
     */
    private $options;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
     * @param       array    $options   Plugin options.
	 */
	public function __construct( $plugin_name, $version, $options ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
        $this->options = $options;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Calendar_Invite_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Calendar_Invite_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/calendar-invite-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Calendar_Invite_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Calendar_Invite_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/calendar-invite-public.js', array( 'jquery' ), $this->version, false );

	}

    /**
     * Add extra fields to woocommerce user account details page
     *
     * @since    1.0.0
     * @param WP_User $user
     */
	public function extra_user_profile_fields($user) {

	    if( ! $user instanceof WP_User )
	        $user = wp_get_current_user();

	    /** @see ./partials/calendar-invite-user-options.php */
	    include(plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/calendar-invite-user-options.php');
    }

}
