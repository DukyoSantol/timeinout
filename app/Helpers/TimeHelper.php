<?php

if (!function_exists('formatTimeWithPH')) {
    function formatTimeWithPH($dateTime) {
        $timeString = $dateTime->format('h:i A');
        return str_replace(['AM', 'PM'], ['PH', 'PH'], $timeString);
    }
}
