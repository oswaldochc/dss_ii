<?php
require "../include/util.php";
require "Connection.php";
require "Employee.php";
$session =& getSessionApp();
checkRole('admin', 'index.php');

function runEmployeeQuery(){
    $db = new Connection();
    $employee = new Employee($db);
    return $employee->getEmployees();
}

$aEmployee = runEmployeeQuery();
?>
<!DOCTYPE html>
<html>
<head>
<title>CWE-285</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<h1>CWE-285</h1>
 <h1>Welcome, <?php echo $session['username'] ?> </h1>
<a href="logout.php">Cerrar Sesión</a><br/><br/>
<?php
    if(count($aEmployee) > 0) {
?>
<table>
    <tr>
        <td>Nombres</td>
        <td>Apellidos</td>
        <td>Email</td>
        <td>Salario</td>
    </tr>
    <?php
    foreach($aEmployee as $employee) {
    ?>
    <tr>
    <td><?php echo $employee['first_name']; ?></td>
    <td><?php echo $employee['last_name']; ?></td>
    <td><?php echo $employee['email']; ?></td>
    <td><?php echo $employee['salary']; ?></td>
    </tr>
    <?php
    }
    ?>

</table>
<?php
    }
?>
</body>
</html>