<?php

/**
 * Calendar invite my account dashboard user options
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://tripturbine.com/
 * @since      1.0.0
 *
 * @package    Calendar_Invite
 * @subpackage Calendar_Invite/public/partials
 */
?>

<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
    <label class="woocommerce-form__label woocommerce-form__label-for-checkbox" for="account_email_invites">
        <input type="checkbox" class="woocommerce-Checkbox woocommerce-Input--checkbox input-checkbox" name="account_email_invites" id="account_email_invites" value="1" <?php echo ($user->email_invites != 'false')?"checked=\"checked\"":""; ?> />
        <?php esc_html_e( 'Send calendar invites via Email', 'calendar-invite' ); ?>
    </label>
</p>
<div class="clear"></div>