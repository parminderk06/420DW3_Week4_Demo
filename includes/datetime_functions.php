<?php
declare(strict_types=1);

/*
 * 420DW3_Week4_Demo datetime_functions.php
 * 
 * @author Marc-Eric Boury (MEbou)
 * @since 2/2/2023
 * (c) Copyright 2023 Marc-Eric Boury 
 */

require_once "includes/debug_functions.php";

/**
 * This is the date string format used in outputting dates and times.
 */
const DATE_DISPLAY_FORMAT = "Y-m-d H:i:s.u";

/**
 * Analyzes the request partameters looking for an <code>"action"</code> parameter
 * and calls appropriate functions if one is specified.
 *
 * @return void
 *
 * @author Marc-Eric Boury
 * @since  2/2/2023
 */
function analyze_request() : void {
    if (isset($_REQUEST["action"])) {
        do_action($_REQUEST["action"]);
    } else {
        show_menu();
    }
}

/**
 * @param string $actionString
 *
 * @return void
 *
 * @author Marc-Eric Boury
 * @since  2/2/2023
 */
function do_action(string $actionString) : void {
    switch ($actionString) {
        case "showCurrentTime":
            show_current_time();
            break;
        case "showContestEndTime":
            show_contest_end_time();
            break;
        default:
            show_menu();
    }
}

/**
 * @return void
 *
 * @author Marc-Eric Boury
 * @since  2/2/2023
 */
function show_menu() : void {
    include "menu.php";
}

/**
 * @return void
 *
 * @author Marc-Eric Boury
 * @since  2/2/2023
 */
function show_current_time() : void {
    $current_date_time = new DateTime();
    if (isset($_REQUEST["timezone"])) {
        $timezone_string = $_REQUEST["timezone"];
        $timezone_object = new DateTimeZone($timezone_string);
        $current_date_time->setTimezone($timezone_object);
        echo "<h2>The time in $timezone_string is: ".$current_date_time->format(DATE_DISPLAY_FORMAT)."</h2>";
        show_menu();
    } else {
        echo "<h2>The Server time is: ".$current_date_time->format(DATE_DISPLAY_FORMAT)."</h2>";
        show_menu();
    }
}

/**
 * @return void
 *
 * @author Marc-Eric Boury
 * @since  2/2/2023
 */
function show_contest_end_time() : void {
    $contest_end_time = DateTime::createFromFormat("Y-m-d H:i:s", "2023-02-09 11:00:00");
    if (isset($_REQUEST["timezone"])) {
        $timezone_string = $_REQUEST["timezone"];
        $timezone_object = new DateTimeZone($timezone_string);
        $contest_end_time->setTimezone($timezone_object);
    }
    echo "<h2>The contest ends on: ".$contest_end_time->format(DATE_DISPLAY_FORMAT)."</h2>";
    show_menu();
}