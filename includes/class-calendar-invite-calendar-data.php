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

    public function get_subject() {
        return $this->subject;
    }

    public function get_event_dtstart() {
        return $this->start;
    }

    public function get_event_start() {
        return $this->start;
    }

    public function get_event_dtend() {
        return $this->end;
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
        $now = new DateTime;
        return $now;
    }
}