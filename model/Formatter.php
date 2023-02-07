<?php

class Formatter {

    public static function formatTime($time) {
        return date('h:i:s a', $time);
    }
}