<?php

class Calendar_Invite_Calendar_Data {

    /** @var string */
    protected $subject;

    /** @var DateTime */
    protected $start;

    /** @var DateTime */
    protected $end;

    /** @var string */
    protected $place;

    /** @var string */
    protected $description;

    /** @var string */
    protected $uid;

    /** @var string */
    protected $organizer_email;

    /** @var string */
    protected $timezone;

    /** @var string */
    private $ical_time_format;

    /** @var string */
    private $ical_timezone;

    public function __construct() {
        $this->timezone = get_option('timezone_string');
        $this->ical_time_format = 'Ymd\THis\Z';
        $this->ical_timezone = 'UTC';
    }

    /**
     * Set event subject
     *
     * @param $subject
     * @return $this
     */
    public function set_subject($subject) {
        $this->subject = $subject;
        return $this;
    }

    public function set_event_start(\DateTime $start_date_time) {
        $this->start = $start_date_time;
        return $this;
    }

    public function set_event_end(\DateTime $end_date_time) {
        $this->end = $end_date_time;
        return $this;
    }

    public function set_place($place) {
        $this->place = $place;
        return $this;
    }

    public function set_description($description) {
        $this->description = $description;
        return $this;
    }

    public function set_uid($uid) {
        $this->uid = $uid;
        return $this;
    }

    public function set_organizer_email($email) {
        $this->organizer_email = $email;
        return $this;
    }

    public function get_subject() {
        return $this->subject;
    }

    public function get_event_dtstart() {
        $dtstart = $this->start;
        $dtstart->setTimezone(new DateTimeZone($this->ical_timezone));
        return $dtstart->format($this->ical_time_format);
    }

    public function get_event_start() {
        return $this->start;
    }

    public function get_event_dtend() {
        $dtend = $this->end;
        $dtend->setTimezone(new DateTimeZone($this->ical_timezone));
        return $dtend->format($this->ical_time_format);
    }

    public function get_event_end() {
        return $this->end;
    }

    public function get_place() {
        return $this->place;
    }

    public function get_description() {
        return $this->description;
    }

    public function get_uid() {
        return $this->uid;
    }

    public function get_dtstamp() {
        $now = new DateTime('now', new DateTimeZone($this->timezone));
        $now->setTimezone(new DateTimeZone($this->ical_timezone));
        return $now->format($this->ical_time_format);
    }

    public function get_organizer_email() {
        return $this->organizer_email;
    }
}