<?php
require "../include/util.php";
$token = generateSessionToken();
?>
<!DOCTYPE html>
<html>
<head>
<title>CWE-285</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type="text/css">
.error {
    color: red;
}
.info_message {
    border: 1px solid blue;
}
</style>
</head>
<body>
<h1>CWE-285</h1>
<?php
    $messagesHtml = getFlashMessageToHtml();
    if( $messagesHtml ) {
        echo "<div class=\"info_message\">{$messagesHtml}</div>";
    }
?>
<a href="process.php?role=public">Iniciar Sesión (Rol public)</a><br/>
<a href="process.php?role=admin">Iniciar Sesión (Rol admin)</a>
</body>
</html>