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
     * @param       array    $options   Plugin options
	 */
	public function __construct( $plugin_name, $version, $options ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->options = $options;
	}

    /**
     * Plugin options
     *
     * @since   1.0.0
     * @access  private
     * @var     array
     */
	private $options;

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
     * Add options page
     *
     * @since    1.0.0
     */
    public function add_options_page() {
        add_options_page( 'Calendar Invite', 'Calendar Invite', 'manage_options', 'calendar-invite', array($this, 'options_page') );
    }

    /**
     * Display options page
     *
     * @since    1.0.0
     */
    public function options_page() {
        include('partials/calendar-invite-settings.php');
    }

    public function settings_init() {
        register_setting(
            $this->plugin_name . '-basic-settings-group',
            $this->plugin_name . '-options'
        );
    }

    /**
     * Add sections to options page
     *
     * @since    1.0.0
     */
    public function settings_sections_init() {
        add_settings_section(
            $this->plugin_name . '-basic',
            'Options',
            array( $this, 'settings_section_basic' ),
            $this->plugin_name . '-basic-settings-page'
        );
    }

    public function settings_fields_init() {
        add_settings_field(
            $this->plugin_name . '-date-field',
            'Date Field',
            array( $this, 'settings_text_field' ),
            $this->plugin_name . '-basic-settings-page',
            $this->plugin_name . '-basic',
            array(
                'id'          => $this->plugin_name . '-date-field',
                'description' => 'The order item meta data field to search for',
                'value'       => ''
            )
        );

        add_settings_field(
            $this->plugin_name . '-date-format-options',
            'Date Format',
            array( $this, 'settings_radio_field' ),
            $this->plugin_name . '-basic-settings-page',
            $this->plugin_name . '-basic',
            array(
                    'id'          => $this->plugin_name . '-date-format-options',
                    'options'     => array('jS F Y', 'Y-m-d', 'm/d/Y', 'd/m/Y', '\c\u\s\t\o\m')
            )
        );

        add_settings_field(
            $this->plugin_name . '-date-format-custom',
            'Custom Date Format',
            array( $this, 'settings_format_custom_field' ),
            $this->plugin_name . '-basic-settings-page',
            $this->plugin_name . '-basic',
            array(
                'id'    => $this->plugin_name . '-date-format-custom',
            )
        );

        add_settings_field(
            $this->plugin_name . '-time-field',
            'Time Field',
            array( $this, 'settings_text_field' ),
            $this->plugin_name . '-basic-settings-page',
            $this->plugin_name . '-basic',
            array(
                    'id'          => $this->plugin_name . '-time-field',
                    'description' => 'The order item meta data field to search for',
                    'value'       => ''
            ));

        add_settings_field(
            $this->plugin_name . '-time-format-options',
            'Time Format',
            array( $this, 'settings_radio_field' ),
            $this->plugin_name . '-basic-settings-page',
            $this->plugin_name . '-basic',
            array(
                'id'          => $this->plugin_name . '-time-format-options',
                'options'     => array('g:i a', 'g:i A', 'H:i', '\c\u\s\t\o\m')
            )
        );

        add_settings_field(
            $this->plugin_name . '-time-format-custom',
            'Custom Date Format',
            array( $this, 'settings_format_custom_field' ),
            $this->plugin_name . '-basic-settings-page',
            $this->plugin_name . '-basic',
            array(
                'id'    => $this->plugin_name . '-date-format-custom',
            )
        );

    }

    public function settings_section_basic( $params ) {
        include( plugin_dir_path( __FILE__ ) . 'partials/' . $this->plugin_name . '-admin-section-basic.php' );
    }

    public function settings_text_field($args = array()) {
        $defaults = array(
                'class'         => 'regular-text',
                'description'   => '',
                'label'         => '',
                'name'          => $this->plugin_name . '-options[' . $args['id'] . ']',
                'placeholder'   => '',
                'type'          => 'text',
                'value'         => '',
                'attribute'     => '',
        );
        apply_filters( $this->plugin_name . 'field-text-options-defaults', $defaults );
        $atts = wp_parse_args( $args, $defaults );

        if( ! empty( $this->options[$atts['id']])) {
            $atts['value'] = $this->options[$atts['id']];
        }

        include( plugin_dir_path( __FILE__ ) . 'partials/' . $this->plugin_name . '-admin-field-text.php' );
    }

    public function settings_radio_field($args = array()) {
        $defaults = array(
            'description'   => '',
            'label'         => '',
            'name'          => $this->plugin_name . '-options[' . $args['id'] . ']',
            'placeholder'   => '',
            'type'          => 'radio',
            'value'         => '',
            'attribute'     => '',
        );
        apply_filters( $this->plugin_name . 'field-radio-options-defaults', $defaults );
        $atts = wp_parse_args( $args, $defaults );

        if( ! empty( $this->options[$atts['id']])) {
            $atts['value'] = $this->options[$atts['id']];
        }

        include( plugin_dir_path( __FILE__ ) . 'partials/' . $this->plugin_name . '-admin-field-radio.php' );
    }

    public function settings_format_custom_field($args = array()) {
        include( plugin_dir_path( __FILE__ ) . 'partials/' . $this->plugin_name . '-admin-field-custom-format.php' );
    }

    /**
     * Add new calendar invite order action to admin Woocommerce orders list
     *
     * @param array $actions
     * @param WC_Order $order
     * @return array
     */
    public function add_calendar_invite_order_actions($actions, $order) {
        $items = $order->get_items();
        $date_exists = false;
        $time_exists = false;

        // Only add calendar invite button to order that have associated dates and times
        /* @var \WC_Order_Item_Product $item */
        foreach($items as $item) {
            /* @var WC_Meta_Data[] $item_meta_data */
            $item_meta_data = $item->get_meta_data();

            foreach($item_meta_data as $meta) {
                $data = $meta->get_data();
                if($data['key'] == $this->options[$this->plugin_name . '-date-field'])
                    $date_exists = true;
                if($data['key'] == $this->options[$this->plugin_name . '-time-field'])
                    $time_exists = true;
                if($date_exists && $time_exists)
                    break 2;
            }
        }
        if($date_exists && $time_exists)
            $actions['invite'] = array(
                // adjust URL as needed
                'url'  => wp_nonce_url( admin_url( 'admin-ajax.php?action=' . $this->plugin_name . '_send_invite&order_id=' . $order->get_id() ), 'calendar-invite-send-invite' ),
                'name' => __( 'Send Invite', 'calendar-invite' ),
                'action' => 'invite'
            );
        return $actions;
    }
}
