<?php
$template = 'blue.php';
if (isset( $_COOKIE['TEMPLATE'] ) ) {
    if(in_array($_COOKIE['TEMPLATE'], array('blue.php', 'red.php'))) {
        $template = $_COOKIE['TEMPLATE'];
    } else {
        header("HTTP/1.1 401 Unauthorized");
        exit;
    }
} else {
    setcookie("TEMPLATE", 'blue.php', time()+3600);
}
include ( getcwd().DIRECTORY_SEPARATOR . $template );
?>