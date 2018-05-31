<?php
class Log {
    const USER_ERROR_DIR = 'errors.log';
    const GENERAL_ERROR_DIR = 'general_errors.log';

    public function user($msg, $username) {
        $date = date('d.m.Y h:i:s');
        $log = $msg."   |  Date:  ".$date."  |  User:  ".$username."\n";
        error_log($log, 3, self::USER_ERROR_DIR);
    }

    public function general($msg)  {
        $date = date('d.m.Y h:i:s');
        $log = $msg."   |  Date:  ".$date."\n";
        error_log($msg."   |  General:  ".$date, 3, self::GENERAL_ERROR_DIR);
    }
}