<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://tripturbine.com/
 * @since      1.0.0
 *
 * @package    Calendar_Invite
 * @subpackage Calendar_Invite/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Calendar_Invite
 * @subpackage Calendar_Invite/admin
 * @author     Marius Bezuidenhout <marius.bezuidenhout@gmail.com>
 */
class Calendar_Invite_Admin {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/calendar-invite-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/calendar-invite-admin.js', array( 'jquery' ), $this->version, false );

	}

    /**
     * Check installation dependencies
     *
     * @since    1.0.0
     */
	public function calendar_invite_install() {
        if ( ! function_exists( 'is_plugin_active' ) ) {
            require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
        }
        if ( ! function_exists( 'WC' ) ) {
            add_action( 'admin_notices', array( $this, 'calendar_invite_install_woocommerce_admin_notice' ) );
        }
    }

    public function calendar_invite_install_woocommerce_admin_notice() {
        ?>
        <div class="error">
            <p><?php _e( 'Calendar Invite is enabled but not effective. It requires WooCommerce in order to work.', 'calendar-invite' ); ?></p>
        </div>
        <?php
    }

    /**
     * Add extra fields to user account details page
     *
     * @since    1.0.0
     * @param WP_User $user
     */
    public function extra_user_profile_fields($user) {
        include(plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/calendar-invite-user-options.php');
    }

    /**
     * Save extra fields
     *
     * @since    1.0.0
     * @param WP_User $user
     */
    public function save_extra_user_profile_fields($user) {

    }

}
