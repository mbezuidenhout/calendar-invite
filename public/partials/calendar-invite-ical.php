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

/** @var \Calendar_Invite_Calendar_Data $calendar_invite_data */
?>
BEGIN:VCALENDAR
PRODID:-//Marius Bezuidenhout//Calendar Invite <?php echo $this->get_version() ?>//EN
VERSION:2.0
CALSCALE:GREGORIAN
METHOD:PUBLISH
BEGIN:VEVENT
ORGANIZER:MAILTO:<?php echo get_option('admin_email') . "\n" ?>
DTSTART:<?php echo $calendar_invite_data->get_event_dtstart() . "\n" ?>
DTEND:<?php echo $calendar_invite_data->get_event_dtend() . "\n" ?>
LOCATION:<?php echo $calendar_invite_data->get_place() . "\n" ?>
TRANSP:OPAQUE
SEQUENCE:0
UID:<?php echo $calendar_invite_data->get_uid() . "\n" ?>
DTSTAMP:<?php echo $calendar_invite_data->get_dtstamp() . "\n" ?>
DESCRIPTION:<?php echo $calendar_invite_data->get_description() . "\n" ?>
SUMMARY:<?php echo $calendar_invite_data->get_subject() . "\n" ?>
PRIORITY:5
CLASS:PUBLIC
END:VEVENT
END:VCALENDAR