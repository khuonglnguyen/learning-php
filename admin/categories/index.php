<?php
$categories = new Apps_Models_Categories();
$user = new Apps_Libs_UserIdentity();
$query = $categories->buildQueryParams([])->select();
$router = new Apps_Libs_Router();
?>

<!DOCTYPE html>
<html lang="en">

<body>
    <div>
        <p>Hi <?= $user->getSESSION('username') ?>
            <a href="<?= $router->createUrl('logout') ?>">Logout</a>, Welcome to News
        </p>
        <a href="<?= $router->createUrl('categories/detail') ?>">Add new</a>
    </div>
    <div class="show-data">
        <table style="width: 100%;" border="1">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            <?php foreach($query as $row) {?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><a href="<?= $router->createUrl('categories/detail', ['id' => $row['id']]) ?>"><?= $row['name'] ?></a></td>
                    <td><?= $row['created_time'] ?></td>
                    <td><a href="<?= $router->createUrl('categories/delete',['id'=>$row['id']]) ?>">Delete</a></td>
                </tr>
                <?php }?>
        </table>
    </div>
</body>

</html>