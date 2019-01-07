<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://tripturbine.com/
 * @since      1.0.0
 *
 * @package    Calendar_Invite
 * @subpackage Calendar_Invite/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Calendar_Invite
 * @subpackage Calendar_Invite/includes
 * @author     Marius Bezuidenhout <marius.bezuidenhout@gmail.com>
 */
class Calendar_Invite {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Calendar_Invite_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

    /**
     * Plugin options
     *
     * @since   1.0.0
     * @access  private
     * @var     array
     */
    private $options;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'CALENDAR_INVITE' ) ) {
			$this->version = CALENDAR_INVITE;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'calendar-invite';
        $this->options = $this->set_options();

        $this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Calendar_Invite_Loader. Orchestrates the hooks of the plugin.
	 * - Calendar_Invite_i18n. Defines internationalization functionality.
	 * - Calendar_Invite_Admin. Defines all hooks for the admin area.
	 * - Calendar_Invite_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-calendar-invite-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-calendar-invite-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-calendar-invite-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-calendar-invite-public.php';

		$this->loader = new Calendar_Invite_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Calendar_Invite_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Calendar_Invite_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Calendar_Invite_Admin( $this->get_plugin_name(), $this->get_version(), $this->options );

        /* @see Calendar_Invite_Admin::enqueue_styles() */
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
        /* @see Calendar_Invite_Admin::enqueue_scripts() */
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

        /* @see Calendar_Invite_Admin::add_options_page() */
        $this->loader->add_action( 'admin_menu', $plugin_admin, 'add_options_page');
        /* @see Calendar_Invite_Admin::settings_init() */
        $this->loader->add_action( 'admin_init', $plugin_admin, 'settings_init');
        /* @see Calendar_Invite_Admin::settings_sections_init() */
		$this->loader->add_action( 'admin_init', $plugin_admin, 'settings_sections_init');
        /* @see Calendar_Invite_Admin::settings_fields_init() */
        $this->loader->add_action( 'admin_init', $plugin_admin, 'settings_fields_init');

        /* @see Calendar_Invite_Admin::add_calendar_invite_order_actions() */
        $this->loader->add_filter( 'woocommerce_admin_order_actions', $plugin_admin, 'add_calendar_invite_order_actions', 10, 2 );

        /* @see Calendar_Invite_Admin::extra_user_profile_fields() */
        $this->loader->add_action( 'show_user_profile', $plugin_admin, 'extra_user_profile_fields' , 10, 1);
        $this->loader->add_action( 'edit_user_profile', $plugin_admin, 'extra_user_profile_fields' , 10, 1);
        /* @see Calendar_Invite::save_extra_user_profile_fields() */
        $this->loader->add_action( 'personal_options_update', $this, 'save_extra_user_profile_fields' );
        $this->loader->add_action( 'edit_user_profile_update', $this, 'save_extra_user_profile_fields' );

        /* @see Calendar_Invite_Admin::calendar_invite_install() */
        $this->loader->add_action( 'plugins_loaded', $plugin_admin, 'calendar_invite_install', 11);
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Calendar_Invite_Public( $this->get_plugin_name(), $this->get_version(), $this->options );

		/* @see Calendar_Invite_Public::enqueue_styles() */
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
        /* @see Calendar_Invite_Public::enqueue_scripts() */
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

        /* @see Calendar_Invite_Public::extra_user_profile_fields() */
        $this->loader->add_action( 'woocommerce_edit_account_form', $plugin_public, 'extra_user_profile_fields');
        /* @see Calendar_Invite::save_extra_user_profile_fields() */
        $this->loader->add_action( 'woocommerce_save_account_details', $this, 'save_extra_user_profile_fields');

        // Can also use the woocommerce action woocommerce_order_status_pending_to_processing
        /* @see Calendar_Invite::send_calendar_invites() */
        $this->loader->add_action( 'woocommerce_order_status_processing', $this, 'send_calendar_invites', 1, 1);

        /* @see Calendar_Invite::send_calendar_invites_ajax() */
        $this->loader->add_action( 'wp_ajax_' . $this->plugin_name . '_send_invite', $this, 'send_calendar_invites_ajax');
        /* @see \Calendar_Invite::get_image_ajax() */
        $this->loader->add_action( 'wp_ajax_' . $this->plugin_name . '_get_image', $this, 'get_image_ajax');
        /* @see Calendar_Invite::set_custom_mailer() */
        $this->loader->add_action( 'plugins_loaded', $this, 'set_custom_mailer', 20);
        /* @see Calendar_Invite::add_ical_mail_parts() */
        $this->loader->add_action( 'phpmailer_init', $this, 'add_ical_mail_parts', 1, 1);
    }

    function get_image_ajax() {
        if(isset($_GET['id']) ){
            $image = wp_get_attachment_image( filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT ), 'medium', false, array( 'id' => $this->plugin_name.'-preview-image' ) );
            $data = array(
                'image'    => $image,
            );
            wp_send_json_success( $data );
        } else {
            wp_send_json_error();
        }
    }

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Calendar_Invite_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

    /**
     * Save extra user fields
     *
     * @since    1.0.0
     * @param int $user_id
     * @return bool
     */
    public function save_extra_user_profile_fields($user_id) {
        if ( !current_user_can( 'edit_user', $user_id ) ) {
            return false;
        }
        if ( empty( $_POST['account_email_invites'] )) {
            $_POST['account_email_invites'] = (int) isset( $_POST['account_email_invites'] ); // Sanitize field
            if(get_user_meta( $user_id, 'email_invites'))
                update_user_meta( $user_id, 'email_invites', 'false');
            else
                add_user_meta( $user_id, 'email_invites', 'false');
        } else {
            if(get_user_meta( $user_id, 'email_invites'))
                update_user_meta( $user_id, 'email_invites', 'true');
            else
                add_user_meta( $user_id, 'email_invites', 'true');
        }
    }

    /**
     * Sets the class variable $options
     */
    public function set_options() {
        return get_option( $this->plugin_name . '-options' );
    }

    /**
     * Handles the ajax request to send the calendar invite
     *
     */
    public function send_calendar_invites_ajax() {
        if ( wp_verify_nonce( $_REQUEST['nonce'], "calendar-invite-send-invite")) {
            if(empty($_REQUEST['order_id'])) {
                wp_send_json_error(array('type' => 'error', 'message' => 'Error obtaining order_id is REQUEST variables'));
            }
            $order_id = $_REQUEST['order_id'];
            $message = $this->send_calendar_invites($order_id);
            wp_send_json_success(array('type' => 'success', 'message' => 'Order #' . $order_id . ' invite successfully sent to ' . $message));
        }
    }

    /**
     * @param $order_id
     * @return string
     * @throws \Exception
     */
    public function send_calendar_invites($order_id) {
        $message = '';
        $order = new WC_Order($order_id);
        $order_items = $order->get_items();

        foreach ($order_items as $item) {
            /* @var WC_Meta_Data[] $item_meta_data */
            $item_meta_data = $item->get_meta_data();
            $date = null;
            $time = null;

            foreach($item_meta_data as $meta) {
                $data = $meta->get_data();
                if($data['key'] == $this->options[$this->plugin_name . '-date-field']) {
                    $date = $data['value'];
                }
                if($data['key'] == $this->options[$this->plugin_name . '-time-field']) {
                    $time = $data['value'];
                }
            }

            if(!empty($date) && !empty($time)) {
                // Send e-mail with ical invite
                // $locale = get_locale();
                $customer = new WC_Customer($order->get_customer_id());
                $user = get_user_by( 'login', $customer->get_username());
                $event_start = DateTime::createFromFormat($this->options[$this->plugin_name . '-date-format-options'] . ' ' . $this->options[$this->plugin_name . '-time-format-options'], $date . ' ' . $time, new DateTimeZone(get_option('timezone_string')));
                $event_end = DateTime::createFromFormat($this->options[$this->plugin_name . '-date-format-options'] . ' ' . $this->options[$this->plugin_name . '-time-format-options'], $date . ' ' . $time, new DateTimeZone(get_option('timezone_string')));

                if($event_start instanceof DateTime && $event_end instanceof DateTime && $event_start->diff($event_end)->format('s') == 0)
                    $event_end->add(DateInterval::createFromDateString('1 hour'));

                $calendar_invite_data = new Calendar_Invite_Calendar_Data();
                $calendar_invite_data->set_subject(html_entity_decode($item->get_name()))
                    ->set_organizer_email(get_option('admin_email'))
                    ->set_event_start($event_start)
                    ->set_event_end($event_end)
                    ->set_place('')
                    ->set_description( "Customer name: " . $customer->get_first_name() . " " . $customer->get_last_name() . "\n " .
                        "Order nr.: " . $order->get_order_number() . "\n" .
                        "Quantity: " . $item->get_quantity())
                    ->set_uid(md5($order_id . '-' . $item->get_name() . '-' . $order->get_customer_id() . '-' . $date . '-' . $time));

                ob_start();
                /* @see ../public/partials/calendar-invite-mail.php */
                include(plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/calendar-invite-mail-html.php');
                //Collect output and echo
                $html_invite = ob_get_contents();
                ob_end_clean();

                $html_invite = apply_filters($this->plugin_name . '-mail-html', $calendar_invite_data, $html_invite);

                $html_invite = '<!-- ' . $this->plugin_name . ' ' . serialize($calendar_invite_data) . ' -->' . $html_invite;

                if($user->email_invites != 'false') {
                    if(wp_mail($customer->get_email(), html_entity_decode($item->get_name()), $html_invite))
                        $message = $customer->get_email();
                }

                if(wp_mail($calendar_invite_data->get_organizer_email(), html_entity_decode($item->get_name()), $html_invite)) {
                    if(!empty($message))
                        $message .= " and ";
                    $message .= $calendar_invite_data->get_organizer_email();
                }

            }

        }
        return $message;
    }

    public function set_custom_mailer() {
        global $phpmailer;

        return $this->calendar_invite_mailer( $phpmailer );
    }

    protected function calendar_invite_mailer( &$obj = null ) {
        if( ! is_object($obj) )
            require_once plugin_dir_path( dirname( __FILE__ ) ) . '/includes/class-calendar-invite-mailer-phpmailer.php';
        elseif($obj instanceof \WPMailSMTP\MailCatcher)
            require_once plugin_dir_path( dirname( __FILE__ ) ) . '/includes/class-calendar-invite-mailer-mailcatcher.php';
        else
            return $obj;
        $obj = new Calendar_Invite_Mailer();

        return $obj;
    }

    /**
     * Adds the ical message part to an outgoing e-mail
     *
     * @param $phpmailer \Calendar_Invite_Mailer
     */
    public function add_ical_mail_parts(\Calendar_Invite_Mailer $phpmailer) {
        $body = $phpmailer->Body;

        $var_string_start_pos = strpos( $body, '<!-- ' . $this->plugin_name . ' ') + strlen('<!-- ' . $this->plugin_name . ' ');

        $calendar_invite_data = unserialize(substr( $body, $var_string_start_pos, strpos( $body, ' -->', $var_string_start_pos) ));

        if(!empty($calendar_invite_data) && $calendar_invite_data instanceof Calendar_Invite_Calendar_Data) {
            ob_start();
            /* @see ../public/partials/calendar-invite-ical.php */
            include(plugin_dir_path(dirname(__FILE__)) . 'public/partials/calendar-invite-ical.php');
            //Collect output and echo
            $ical = ob_get_contents();
            ob_end_clean();
            $ical = apply_filters($this->plugin_name . '-mail-ical', $calendar_invite_data, $ical);

            $phpmailer->addStringAttachment($ical, 'invite.ics', 'base64', 'application/ics');

            ob_start();
            /* @see ../public/partials/calendar-invite-mail-text.php */
            include(plugin_dir_path(dirname(__FILE__)) . 'public/partials/calendar-invite-mail-text.php');
            //Collect output and echo
            $text_invite = ob_get_contents();
            ob_end_clean();
            $text_invite = apply_filters($this->plugin_name . '-mail-text', $calendar_invite_data, $text_invite);


            $phpmailer->AltBody = $text_invite; // Needed in order to include the ical part

            $phpmailer->Ical = $ical;
        }
    }

}
