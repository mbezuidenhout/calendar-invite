<?php
/** @var Calendar_Invite_Calendar_Data $calendar_invite_data */
?>
<style>
    .calendar-invite-content {
        display: flex;
    }

    .invite-row {
        display: block;
        flex-basis: auto;
        padding-bottom: 14px;
    }

    .invite-left-column-cell {
        display: flex;
        width: 40px;
        padding-left: 28px;
        max-height: 36px;
    }
</style>
<div class="calendar-invite-content">
    <div class="invite-row">
        <div class="invite-left-column-cell"><span><svg height="24" width="24" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg"><circle cx="12" cy="12" r="22" stroke="black" stroke-width="3" fill="none" /></svg></span></div>
        <div class="invite-right-column-cell"><span><h2 id="calendar-invite-subject"><?php echo htmlentities($calendar_invite_data->get_subject()) ?></h2></span></div>
    </div>
    <div class="invite-row">
        <div class="invite-left-column-cell"><span><svg height="24" width="24" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg"><circle cx="12" cy="12" r="22" stroke="black" stroke-width="3" fill="none" /></svg></span></div>
        <div class="invite-right-column-cell"><span id="calendar-invite-start"><?php echo $calendar_invite_data->get_event_start()->format(get_option('date_format') . ' ' . get_option('time_format')) ?></span></div>
    </div>
    <div class="invite-row">
        <div class="invite-left-column-cell"><span><svg height="24" width="24" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg"><circle cx="12" cy="12" r="22" stroke="black" stroke-width="3" fill="none" /></svg></span></div>
        <div class="invite-right-column-cell"><span id="calendar-invite-end"><?php echo $calendar_invite_data->get_event_end()->format(get_option('date_format') . ' ' . get_option('time_format')) ?></span></div>
    </div>
    <div class="invite-row">
        <div class="invite-left-column-cell"><span><svg height="24" width="24" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg"><circle cx="12" cy="12" r="22" stroke="black" stroke-width="3" fill="none" /></svg></span></div>
        <div class="invite-right-column-cell"><span id="calendar-invite-place"><?php echo htmlentities($calendar_invite_data->get_place()) ?></span></div>
    </div>
    <div class="invite-row">
        <div class="invite-left-column-cell"><span><svg height="24" width="24" viewBox="0 0 24 24" xmlns="https://www.w3.org/2000/svg"><circle cx="12" cy="12" r="22" stroke="black" stroke-width="3" fill="none" /></svg></span></div>
        <div class="invite-right-column-cell"><span id="calendar-invite-description"><?php echo htmlentities($calendar_invite_data->get_description()) ?></span></div>
    </div>
</div>