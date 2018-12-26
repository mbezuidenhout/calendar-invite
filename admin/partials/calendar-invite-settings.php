<?php
/**
 * Admin area settings page
 *
 * @since       1.0.0
 * @package     Calendar_Invite
 * @subpackage  Calendar_Invite/admin/partials
 */
?>
<div class="wrap">
    <form method="post" id="mainform" action="options.php" enctype="multipart/form-data">
    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
        <?php settings_fields( $this->plugin_name . '-basic-settings-group' ); ?>
        <?php do_settings_sections( $this->plugin_name . '-basic-settings-page'); ?>
        <?php submit_button(); ?>
    </form>
</div>
