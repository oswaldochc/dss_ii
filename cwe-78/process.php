<?php
    require "../include/util.php";
    initSession();
    $ds = DIRECTORY_SEPARATOR;
    $userName = getUserNameFromSession();
    $path = 'C:'.$ds.'Users'.$ds;
    //$path = '/home/';
    //$command = 'ls -l ' .$path.$userName;
    $command = 'DIR '.$path.$userName;
    $listDirectory = shell_exec($command);
?>
<!DOCTYPE html>
<html>
<head>
<title>CWE-78</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<style type="text/css">
    .pre {
        background-color: black;
        color: white;
        padding: 5px;
        width: 100%;
        height:200px;
    }
</style>
</head>
<body>
    <h1>Welcome, <?php echo $userName ?> </h1>
    <textarea class="pre" readonly="true">
        <?php
            if (empty($listDirectory)) {
                echo 'Empty Directory';
            } else {
                echo html_entity_decode($listDirectory);
            }
        ?>
    </textarea>
<a href="logout.php">Cerrar Sesión</a>
</body>
</html>