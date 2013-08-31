<?php

$maxTraceLength = 500;
$trace = '';
if (isset($_REQUEST['errorMessage']) && isset($_REQUEST['lineNumber']) && isset($_REQUEST['file'])) {
        $trace = sprintf("Line Number: %d\n File: %s\n Message: %s", $_REQUEST['lineNumber'], $_REQUEST['file'], $_REQUEST['errorMessage']);
}
$trace = substr($trace, 0, $maxTraceLength);

if (extension_loaded('newrelic')) {
        newrelic_start_transaction('AppName');
        if (isset($_REQUEST['url'])) {
            newrelic_add_custom_parameter('url', $_REQUEST['url']);
        }
        newrelic_notice_error($trace);
        newrelic_end_transaction();
} else {
    throw new Exception('newrelic not loaded');
}
