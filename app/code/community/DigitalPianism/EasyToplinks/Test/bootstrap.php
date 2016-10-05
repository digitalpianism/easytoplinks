<?php

ini_set('display_errors', 1);
error_reporting(E_ALL | E_STRICT);

require __DIR__ . '/../../../../../../app/Mage.php';

function fix_error_handler()
{
    $mageErrorHandler = set_error_handler(function () {
        return false;
    });
    set_error_handler(function ($errno, $errstr, $errfile) use ($mageErrorHandler) {
        if (substr($errfile, -19) === 'Varien/Autoload.php') {
            return null;
        }
        return is_callable($mageErrorHandler) ?
            call_user_func_array($mageErrorHandler, func_get_args()) :
            false;
    });
}
fix_error_handler();
Mage::app();
Mage::setIsDeveloperMode(true);
fix_error_handler();
$_SESSION = [];