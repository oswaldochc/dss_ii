<?php
require "../include/util.php";
$token = generateSessionToken();
?>
<!DOCTYPE html>
<html>
<head>
<title>CWE-434</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type="text/css">
.success {
    color: green;
}
.error {
    color: red;
}
.warning {
    color: yellow;
}
.info_message {
    border: 1px solid blue;
}
</style>
</head>

<body>
<?php
    $messagesHtml = getFlashMessageToHtml();
    if( $messagesHtml ) {
        echo "<div class=\"info_message\">{$messagesHtml}</div>";
    }
?>
<form action="upload_img.php" method="post" enctype="multipart/form-data">
    Seleccione Imagen de perfil:<br/><br/>
    <input type="file" name="uploadedfile"/><br/><br/>
    <input type="submit" name="upload" value="Subir"/>
    <input type="hidden" name="csrf" value="<?php echo $token; ?>"/>
</form>
</form>
</body>
</html>