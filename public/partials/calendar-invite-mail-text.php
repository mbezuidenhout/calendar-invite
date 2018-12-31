<?php
/** @var \Calendar_Invite_Calendar_Data $calendar_invite_data */
?>
Subject: <?php echo $calendar_invite_data->get_subject() . "\n" ?>
Event start: <?php echo $calendar_invite_data->get_event_start()->format(get_option('date_format') . ' ' . get_option('time_format')) . "\n" ?>
Event end: <?php echo $calendar_invite_data->get_event_end()->format(get_option('date_format') . ' ' . get_option('time_format')) . "\n" ?>
Place: <?php echo $calendar_invite_data->get_place() . "\n" ?>
Description: <?php echo $calendar_invite_data->get_description() . "\n" ?>
