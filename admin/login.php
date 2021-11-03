<?php

?>
<html lang="en">
<body>
    <h1>Login</h1>
    <form action="<?php echo $router->createUrl('login') ?>" method="post">
        Account: <br>
        <input type="text" name="account"><br>
        Password <br>
        <input type="password" name="password"><br>
        <input type="submit" value="Login">
    </form>
</body>

</html>