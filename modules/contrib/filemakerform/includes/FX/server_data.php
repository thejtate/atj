<?php

/********************************************************************
 * This file is where you set the data related to your server.  In  *
 * order to get these FX.php examples to work on your system, you   *
 * need to set $serverIP to the IP address of your server.  Also,   *
 * be sure to set $webCompanionPort to match the port configured    *
 * for Web Companion (for FileMaker 5/6) or your web server software*
 * (for FileMaker 7 and later.)                                     *
 ********************************************************************/

error_reporting(E_ALL);
if (! defined('DEBUG')) {
    define('DEBUG', true);         // set to true to turn debugging on
}
if (! defined('DEBUG_FUZZY')) {
    define('DEBUG_FUZZY', true);   // set to true to activate the fuzzy debugger
}

$serverIP = '192.168.2.3';
$webCompanionPort = 80;         // for FM 7, 8, or 9, this should we the web server port
$dataSourceType = 'FMPro9';
$webUN = 'Admin';               // defaults for Book_List in FM7; both should be blank for Book_List in FM5/6
$webPW = '';
if (strtolower($dataSourceType) == 'fmpro9') {
    $bookListFile = 'Book_List.fp7';
} else {
    $bookListFile = 'Book_List.fp5';
}
$scheme = 'http';               // generally this will be 'http'; 'https' for SSL connections to FileMaker

?>