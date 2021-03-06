<?php
/**
 * Text fields
 *
 * @since       1.0.0
 *
 * @package     Calendar_Invite
 * @subpackage  Calendar_Invite/admin/partials
 */
/** @see \Calendar_Invite_Admin::settings_text_field() */
if ( ! empty($atts['label'])) {
    ?><label for="<?php echo esc_attr( $atts['id'] ); ?>"><?php esc_html_e( $atts['label'], 'calendar-invite' ); ?>: </label><?php
}

?><input
    class="<?php echo esc_attr( $atts['class'] ); ?>"
    id="<?php echo esc_attr( $atts['id'] ); ?>"
    name="<?php echo esc_attr( $atts['name'] ); ?>"
    placeholder="<?php echo esc_attr( $atts['placeholder'] ); ?>"
    type="<?php echo esc_attr( $atts['type'] ); ?>"
    value="<?php echo esc_attr( $atts['value'] ); ?>"
<?php echo esc_attr( $atts['attribute'] ); ?> /><?php

if ( ! empty( $atts['description'] ) ) {

    ?><span class="description"><?php esc_html_e( $atts['description'], 'calendar-invite' ); ?></span><?php

}