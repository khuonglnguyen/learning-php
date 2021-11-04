<?php
$categories = new Apps_Models_Posts();
$user = new Apps_Libs_UserIdentity();
$listPost = $categories->buildQueryParams([
    'select'=>'posts.id, posts.name, posts.description, posts.created_time, categories.name as cate_name',
    'join'=>'INNER JOIN categories ON categories.id = posts.cate_id'
])->select();
$router = new Apps_Libs_Router();
?>

<html lang="en">
<body>
    <div>
        <p>Hi <?= $user->getSESSION('username') ?>
            <a href="<?= $router->createUrl('logout') ?>">Logout</a>, Welcome to News
        </p>
        <h2>POSTS MANAGE</h2>
        <a href="<?= $router->createUrl('posts/post') ?>">Add new</a>
    </div>
    <div class="show-data">
        <table style="width: 100%;" border="1">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Category</th>
                <th>Description</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            <?php foreach($listPost as $row) {?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><a href="<?= $router->createUrl('posts/detail', ['id' => $row['id']]) ?>"><?= $row['name'] ?></a></td>
                    <td><?= $row['cate_name'] ?></td>
                    <td><?= $row['description'] ?></td>
                    <td><?= $row['created_time'] ?></td>
                    <td><a href="<?= $router->createUrl('posts/delete',['id'=>$row['id']]) ?>">Delete</a></td>
                </tr>
                <?php }?>
        </table>
    </div>
</body>

</html>