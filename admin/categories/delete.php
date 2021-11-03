<?php
$user = new Apps_Libs_UserIdentity();
$router = new  Apps_Libs_Router();
$category = new  Apps_Models_Categories();

$id = intval($router->getGET('id'));
$cateDetail = $category->buildQueryParams([
    'where' => 'id=:id',
    'params' => [':id' => $id]
])->selectOne();

if (!$cateDetail) {
    $router->pageNotFound();
}

if ($id && $router->getPOST('submit')) {
    if ($category->delete('id=:id', ['id' => $id])) {
        $router->redirect('categories/index');
    }else {
        $router->errorPage('Can not delete this category');
    }
}
?>
<html lang="en">

<body>
    <div>
        <p>Hi <?= $user->getSESSION('username') ?><a href="<?= $router->createUrl('post') ?>">Logout</a>, Welcome</p>
        <h1>Do you want to delete: <?= $cateDetail['name'] ?>?</h1>
    </div>
    <div class="show-data">
        <form action="<?php echo $router->createUrl('categories/delete', ['id' => $id]) ?>" method="POST">
            <input type="submit" name="submit" value="Yes">
            <input type="button" onclick="window.location.href='<?= $router->createUrl('categories/index') ?>'" value="Cancel">
        </form>
    </div>
</body>

</html>