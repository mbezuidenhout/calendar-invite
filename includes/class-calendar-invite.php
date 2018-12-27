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
        /* @see Calendar_Invite::send_calendar_invites() */
        $this->loader->add_action( 'woocommerce_order_status_processing', $this, 'send_calendar_invites', 1, 1);

        /* @see Calendar_Invite::send_calendar_invites_ajax() */
        $this->loader->add_action( 'wp_ajax_' . $this->plugin_name . '_send_invite', $this, 'send_calendar_invites_ajax');
        /* @see Calendar_Invite::set_custom_mailer() */
        $this->loader->add_action( 'plugins_loaded', $this, 'set_custom_mailer', 20);
        /* @see Calendar_Invite::add_ical_mail_parts() */
        $this->loader->add_action( 'phpmailer_init', $this, 'add_ical_mail_parts', 1, 1);
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
        if ( ! empty( $_POST['account_email_invites'] ) ) {
            $_POST['account_email_invites'] = (int) isset( $_POST['account_email_invites'] ); // Sanitize field
            add_user_meta( $user_id, 'email_invites', 'true');
        } else
            delete_user_meta( $user_id, 'email_invites');
    }

    /**
     * Sets the class variable $options
     */
    public function set_options() {
        return get_option( $this->plugin_name . '-options' );
    }

    public function send_calendar_invites_ajax() {
        if(empty($_REQUEST['order_id']))
            return 'Error obtaining order_id is REQUEST variables';
        $order_id = $_REQUEST['order_id'];
        $this->send_calendar_invites($order_id);
        wp_die();
    }

    public function send_calendar_invites($order_id) {
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
                $customer = new WC_Customer($order->get_customer_id());
                $dtstart = strtotime($date . ' ' . $time);
                $eventuid = md5($order_id . '-' . $item->get_name() . '-' . $order->get_customer_id() . '-' . $date . '-' . $time);

                // Set the correct headers for this file
                ob_start();
                /* @see ../public/partials/calendar-invite-ical.php */
                include(plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/calendar-invite-ical.php');
                //Collect output and echo
                $ical = ob_get_contents();
                ob_end_clean();
                // Set content-type
                // Set own boundary

                $message = 'Calendar Invite HTML version';

                wp_mail($customer->get_email(), $item->get_name(),  $message);
            }

        }
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
        $phpmailer->addStringAttachment(base64_encode('BEGIN:VCALENDAR
PRODID:-//Google Inc//Google Calendar 70.9054//EN
VERSION:2.0
CALSCALE:GREGORIAN
METHOD:REQUEST
BEGIN:VEVENT
DTSTART:20181229T120000Z
DTEND:20181229T130000Z
DTSTAMP:20181219T152216Z
ORGANIZER;CN=Black Horse Brewery:mailto:p42g4ia1s85n2gm526qkrg80cs@group.ca
 lendar.google.com
UID:F8E65F33-AA5F-4313-A9A3-25339C7FE6A1
ATTENDEE;CUTYPE=INDIVIDUAL;ROLE=REQ-PARTICIPANT;PARTSTAT=NEEDS-ACTION;RSVP=
 TRUE;CN=marius@tripturbine.com;X-NUM-GUESTS=0:mailto:marius@tripturbine.com
ATTENDEE;CUTYPE=INDIVIDUAL;ROLE=REQ-PARTICIPANT;PARTSTAT=ACCEPTED;RSVP=TRUE
 ;CN=Black Horse Brewery;X-NUM-GUESTS=0:mailto:p42g4ia1s85n2gm526qkrg80cs@gr
 oup.calendar.google.com
URL:message:%3C1ca6be9ab3f8223f7e691f5373c7078f@blackhorsedistillery.co.za%
 3E
CREATED:20181219T152157Z
DESCRIPTION:Full tour x 2 Alfred Mukudu\n\n\n-::~:~::~:~:~:~:~:~:~:~:~:~:~:
 ~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~::~:~::-\nPlease do not ed
 it this section of the description.\n\nView your event at https://www.googl
 e.com/calendar/event?action=VIEW&eid=XzhvczRhZGhsOG9wajZiYTE4NHFrY2I5azZjb2
 o2YmExNzUwajZiOWk2a3BqNmVhMzZ0MzRhZGkxNjQgbWFyaXVzQHRyaXB0dXJiaW5lLmNvbQ&to
 k=NTIjcDQyZzRpYTFzODVuMmdtNTI2cWtyZzgwY3NAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvb
 TYzYjdkZDk0YTM3NDI2ZmFhYzRhNmM1YjRjZGYxNDVmMTQwZjhiZWU&ctz=Africa%2FJohanne
 sburg&hl=en&es=1.\n-::~:~::~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:
 ~:~:~:~:~:~:~:~:~:~:~:~::~:~::-
LAST-MODIFIED:20181219T152214Z
LOCATION:Black Horse Brewery\n32 Seekoeihoek / Bekker Schools Road\, Magali
 esburg\, 1791\, South Africa
SEQUENCE:0
STATUS:CONFIRMED
SUMMARY:Brewery & Distillery tours
TRANSP:OPAQUE
END:VEVENT
END:VCALENDAR'), 'invite.ics');
        $phpmailer->AltBody = 'Calendar Invite Text Version'; // Needed in order to include the ical part

        $phpmailer->Ical = 'BEGIN:VCALENDAR
PRODID:-//Google Inc//Google Calendar 70.9054//EN
VERSION:2.0
CALSCALE:GREGORIAN
METHOD:REQUEST
BEGIN:VEVENT
DTSTART:20181229T120000Z
DTEND:20181229T130000Z
DTSTAMP:20181219T152216Z
ORGANIZER;CN=Black Horse Brewery:mailto:p42g4ia1s85n2gm526qkrg80cs@group.ca
 lendar.google.com
UID:F8E65F33-AA5F-4313-A9A3-25339C7FE6A1
ATTENDEE;CUTYPE=INDIVIDUAL;ROLE=REQ-PARTICIPANT;PARTSTAT=NEEDS-ACTION;RSVP=
 TRUE;CN=marius@tripturbine.com;X-NUM-GUESTS=0:mailto:marius@tripturbine.com
ATTENDEE;CUTYPE=INDIVIDUAL;ROLE=REQ-PARTICIPANT;PARTSTAT=ACCEPTED;RSVP=TRUE
 ;CN=Black Horse Brewery;X-NUM-GUESTS=0:mailto:p42g4ia1s85n2gm526qkrg80cs@gr
 oup.calendar.google.com
URL:message:%3C1ca6be9ab3f8223f7e691f5373c7078f@blackhorsedistillery.co.za%
 3E
CREATED:20181219T152157Z
DESCRIPTION:Full tour x 2 Alfred Mukudu\n\n\n-::~:~::~:~:~:~:~:~:~:~:~:~:~:
 ~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~::~:~::-\nPlease do not ed
 it this section of the description.\n\nView your event at https://www.googl
 e.com/calendar/event?action=VIEW&eid=XzhvczRhZGhsOG9wajZiYTE4NHFrY2I5azZjb2
 o2YmExNzUwajZiOWk2a3BqNmVhMzZ0MzRhZGkxNjQgbWFyaXVzQHRyaXB0dXJiaW5lLmNvbQ&to
 k=NTIjcDQyZzRpYTFzODVuMmdtNTI2cWtyZzgwY3NAZ3JvdXAuY2FsZW5kYXIuZ29vZ2xlLmNvb
 TYzYjdkZDk0YTM3NDI2ZmFhYzRhNmM1YjRjZGYxNDVmMTQwZjhiZWU&ctz=Africa%2FJohanne
 sburg&hl=en&es=1.\n-::~:~::~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:~:
 ~:~:~:~:~:~:~:~:~:~:~:~::~:~::-
LAST-MODIFIED:20181219T152214Z
LOCATION:Black Horse Brewery\n32 Seekoeihoek / Bekker Schools Road\, Magali
 esburg\, 1791\, South Africa
SEQUENCE:0
STATUS:CONFIRMED
SUMMARY:Brewery & Distillery tours
TRANSP:OPAQUE
END:VEVENT
END:VCALENDAR
';
        $phpmailer = '';
    }

}
