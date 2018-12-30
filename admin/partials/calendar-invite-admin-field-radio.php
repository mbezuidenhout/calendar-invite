<fieldset>
<?php
$now = new DateTime();
foreach($atts['options'] as $option) {
    echo "<label>";
    echo sprintf('<input type="radio" name="%s" value="%s" %s>', $atts['name'], $option, checked($option, $atts['value'], true));
    if($option == '\c\u\s\t\o\m') {
        echo sprintf('<span class="date-time-text date-time-custom-text">Custom:</span>');
        echo '<input type="text" name="date_format_custom" id="date_format_custom" value="F j, Y" class="small-text">';
    } else {
        echo sprintf('<span class="date-time-text format-i18n">%s</span>', $now->format($option));
        echo sprintf('<code>%s</code>', $option);
    }
    echo "</label>";
    echo "<br>";
}
?>

</fieldset>
