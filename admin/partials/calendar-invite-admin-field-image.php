<?php
/**
 * @var $this \Calendar_Invite_Admin
 */
if( !empty( $atts['value'] ) ) {
    // Change with the image size you want to use
    $image = wp_get_attachment_image( $$atts['value'], 'medium', false, array( 'id' => $this->plugin_name . '-preview-image' ) );
} else {
    // Some default image
    $image = '<img id="' . $this->plugin_name . '-preview-image" src="' . $atts['image'] . '" />';
}
?>
<?php echo $image; ?>
<input type="hidden" name="<?php echo $this->plugin_name ?>_image_id" id="<?php echo $this->plugin_name ?>_image_id" value="<?php echo esc_attr( $atts['value'] ); ?>" class="regular-text" /><br>
<input type='button' class="button-primary" value="<?php esc_attr_e( 'Select an image', $this->plugin_name ); ?>" id="<?php echo $this->plugin_name ?>_media_manager"/>