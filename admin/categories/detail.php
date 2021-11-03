<?php
$user = new Apps_Libs_UserIdentity();
$router = new Apps_Libs_Router();

$categories = new Apps_Models_Categories();

$id = intval($router->getGET('id'));

if ($id) {
    $cateDetail = $categories->buildQueryParams([
        'where' => 'id=:id',
        'params' => [':id' => $id]
    ])->selectOne();
    if (!$cateDetail) {
        $router->pageNotFound();
    }
} else {
    $cateDetail = [
        'id' => '',
        'name' => ''
    ];
}

if ($router->getPOST('submit') && $router->getPOST('name')) {
    $params = [
        ':name' => $router->getPOST('name')
    ];
    $result = false;
    if ($id) {
        $params[':id'] = $id;
        $result = $categories->buildQueryParams([
            'value' => 'name=:name',
            'where' => 'id=:id',
            'params' => $params
        ])->update();
    } else {
        $result = $categories->buildQueryParams([
            'field' => '(name,created_by,created_time) VALUES (?,?,now())',
            'value' => [$params[':name'], $user->getId()]
        ])->insert();
    }

    if ($result) {
        $router->redirect('categories/index');
    } else {
        $router->errorPage('Can not update database');
    }
}
?>
<html lang="en">

<body>
    <div>
        <p>Hi <?= $user->getSESSION('username') ?><a href="<?= $router->createUrl('post') ?>">Logout</a>, Welcome</p>
        <h1><?= !$id ? 'Create new' : 'Viewing' ?>Category: <?= $cateDetail['name'] ?></h1>
    </div>
    <div class="show-data">
        <form action="<?php echo $router->createUrl('categories/detail', ['id' => $cateDetail['id']]) ?>" method="post">
            Title <br>
            <input type="text" name="name" value="<?= $cateDetail['name'] ?>"><br>
            <input type="submit" name="submit" value="Post">
            <input type="button" onclick="window.location.href='<?= $router->createUrl('categories/index') ?>'" value="Cancel">
        </form>
    </div>
</body>

</html>