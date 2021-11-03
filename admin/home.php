<?php
$user = new Apps_Libs_UserIdentity();
$router = new Apps_Libs_Router();
?>
<!DOCTYPE html>
<html lang="en">

<body>
    <div>
        <p>Hi <?= $user->getSESSION('username') ?> <a href="<?= $router->createUrl('logout') ?>">Logout</a>, Welcome to News</p>
        <h1>ADMIN PAGE</h1>
    </div>
    <div class="show-data">
        <ul>
            <li><a href="<?= $router->createUrl('post/post') ?>">Manage Posts</a></li>
            <li><a href="<?= $router->createUrl('category/cate') ?>">Manage Category</a></li>
            <li><a href="<?= $router->createUrl('user/users') ?>">Manage Users</a></li>
        </ul>
    </div>
</body>

</html>