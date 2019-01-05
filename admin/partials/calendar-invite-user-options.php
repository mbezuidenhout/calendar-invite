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

<h2>Calendar Invites</h2>

<table class="form-table">
    <tbody><tr class="user-send-invites-wrap">
        <th scope="row">Calendar Invites</th>
        <td><label for="account_email_invites"><input type="checkbox" name="account_email_invites" id="account_email_invites" value="1" <?php echo ($user->email_invites != 'false')?"checked=\"checked\"":""; ?>> Send calendar invites via Email</label>
        </td>
    </tr>
    </tbody></table>