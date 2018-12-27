<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 * Lines limited to 75 characters and new-line starting with single space
 *
 * @link        https://tripturbine.com/
 * @since       1.0.0
 *
 * @package     Calendar_Invite
 * @subpackage  Calendar_Invite/public/partials
 */
?>
BEGIN:VCALENDAR
PRODID:-//Marius Bezuidenhout//Calendar Invite <?php echo $this->get_version() ?>//EN
VERSION:2.0
CALSCALE:GREGORIAN
METHOD:PUBLISH
BEGIN:VEVENT
ORGANIZER:MAILTO:<?php echo get_option('admin_email') ?>
DTSTART:<?php echo $dtstart ?>
DTEND:<?php echo $dtend ?>
LOCATION:<?php echo $dtlocation ?>
TRANSP:OPAQUE
SEQUENCE:0
UID:<?php echo $eventuid ?>
DTSTAMP:<?php echo $todaystamp ?>
DESCRIPTION:<?php echo $description ?>
SUMMARY:<?php echo $subject ?>
PRIORITY:5
CLASS:PUBLIC
END:VEVENT
END:VCALENDAR