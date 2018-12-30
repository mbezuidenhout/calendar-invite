<fieldset>
<?php
$now = new DateTime();
$custom_value_checked = '';
if( ! in_array($atts['value'], $atts['options']));
    $custom_value_checked = 'checked="checked"';
foreach($atts['options'] as $option) {
    echo "<label>";
    if($option == '\c\u\s\t\o\m') {
        echo sprintf('<input type="radio" name="%s" %s>', $atts['name'], $custom_value_checked);
        echo sprintf('<span class="date-time-text date-time-custom-text">Custom:</span>');
        echo sprintf('<input type="text" name="%s" id="date_format_custom" value="%s" class="small-text">', $atts['name'], $atts['value']);
    } else {
        echo sprintf('<input type="radio" name="%s" value="%s" %s>', $atts['name'], $option, checked($option, $atts['value'], false));
        echo sprintf('<span class="date-time-text format-i18n">%s</span>', $now->format($option));
        echo sprintf('<code>%s</code>', $option);
    }
    echo "</label>";
    echo "<br>";
}
?>

</fieldset>
