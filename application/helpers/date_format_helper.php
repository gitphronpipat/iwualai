<?php

defined('BASEPATH') or exit('No direct script access allowed');

//                         input     format   พ.ศ/ค.ศ 
// ตัวอย่างการใช้ format_datetime('2025-08-15', 'd-m-Y', 'th,en');
function format_datetime($datetime = false, $format = 'Y-m-d', $lang = 'en')
{
    if (!$datetime) {
        return '';
    }

    $datetime = trim($datetime);

    if (preg_match('/^(\d{1,2})-(\d{1,2})-(\d{4})(.*)$/', $datetime, $m)) {
        $day = (int) $m[1];
        $month = (int) $m[2];
        $year = (int) $m[3];
        $time = trim($m[4]);
    } elseif (preg_match('/^(\d{4})-(\d{1,2})-(\d{1,2})(.*)$/', $datetime, $m)) {
        $year = (int) $m[1];
        $month = (int) $m[2];
        $day = (int) $m[3];
        $time = trim($m[4]);
    } else {
        $timestamp = strtotime($datetime);
        if ($timestamp === false) return '';
        return date($format, $timestamp);
    }

    if ($year > 2400) {
        $year -= 543;
    }

    $timestamp = strtotime("$year-$month-$day $time");

    if (!$timestamp) return '';

    if (strtolower($lang) === 'th') {
        $year_th = date('Y', $timestamp) + 543;
        $format = str_replace('Y', $year_th, $format);
        $format = str_replace('y', substr($year_th, -2), $format);
        return date($format, $timestamp);
    }

    return date($format, $timestamp);
}
