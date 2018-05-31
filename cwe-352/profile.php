<?php
// Set session variables
session_start();
$_SESSION["username"] = "oswaldo";
$_SESSION["token"] = md5(uniqid(mt_rand(), true));
?>
<!DOCTYPE html>
<html>
<head>
<title>CWE-352</title>
</head>

<body>
<h1>Welcome <?php echo $_SESSION["username"];?></h1>
<form action="update.php" method="post">
    <label>Nombre</label>
    <input type="text" name="firstname"/>
    <label>Apellido</label>
    <input type="text" name="lastname"/>
    <br/>
    <label>Email</label>
    <input type="text" name="email"/>
    <input type="hidden" name="csrf" value="<?php echo $_SESSION["token"]; ?>">
    <input type="submit" name="submit" value="Actualizar"/>
</form>
<a href="logout.php">Cerrar Sesión</a>
</body>
</html>