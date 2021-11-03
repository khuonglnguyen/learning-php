<?php
$router = new Apps_Libs_Router();

$account = trim($router->getPOST('account'));
$password = trim($router->getPOST('password'));
$identity = new Apps_Libs_UserIdentity();
if ($identity->isLogin()) {
    $router->homePage();
}

if ($router->getPOST('submit') && $account && $password) {
    $identity->username = $account;
    $identity->password = $password;
    if ($identity->login()) {
        $router->homePage();
    } else {
        echo 'Username or Password is incorret';
    }
}
?>
<html lang="en">

<body>
    <h1>Login</h1>
    <form action="<?php echo $router->createUrl('login') ?>" method="POST">
        Account: <br>
        <input type="text" name="account"><br>
        Password <br>
        <input type="password" name="password"><br>
        <input type="submit" value="Login" name="submit">
    </form>
</body>

</html>