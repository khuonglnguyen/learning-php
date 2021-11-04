<?php
$user = new Apps_Libs_UserIdentity();
$router = new Apps_Libs_Router();

$post = new Apps_Models_Posts();
$category = new Apps_Models_Categories();

$id = intval($router->getGET('id'));

if ($id) {
    $postDetail = $post->buildQueryParams([
        'where' => 'id=:id',
        'params' => [':id' => $id]
    ])->selectOne();
    if (!$postDetail) {
        $router->pageNotFound();
    }
} else {
    $postDetail = [
        'id' => '',
        'name' => '',
        'content' => '',
        'name' => '',
        'description' => '',
        'cate_id' => ''
    ];
}

if (
    $router->getPOST('submit')
    && $router->getPOST('name')
    && $router->getPOST('content')
    && $router->getPOST('category')
) {
    $params = [
        ':name' => $router->getPOST('name'),
        ':content' => $router->getPOST('content'),
        ':description' => $router->getPOST('description'),
        ':cate_id' => $router->getPOST('category')
    ];
    $result = false;
    if ($id) {
        $params[':id'] = $id;
        $result = $post->buildQueryParams([
            'value' => 'name=:name, content=:content, description=:description, cate_id=:cate_id',
            'where' => 'id=:id',
            'params' => $params
        ])->update();
    } else {
        $result = $post->buildQueryParams([
            'field' => '(cate_id,name,content,description,created_by,created_time) VALUES (?,?,?,?,?,now())',
            'value' => [$params[':cate_id'], $params[':name'], $params[':description'], $params[':content'], $user->getId()]
        ])->insert();
    }

    if ($result) {
        $router->redirect('posts/index');
    } else {
        $router->errorPage('Can not update database');
    }
}
?>
<html lang="en">

<body>
    <div>
        <p>Hi <?= $user->getSESSION('username') ?><a href="<?= $router->createUrl('post') ?>">Logout</a>, Welcome</p>
        <h1><?= !$id ? 'Create new ' : 'Viewing ' ?>Category: <?= $postDetail['name'] ?></h1>
    </div>
    <div class="show-data">
        <form action="<?php echo $router->createUrl('posts/detail', ['id' => $postDetail['id']]) ?>" method="post">
            Title <br>
            <input type="text" name="name" value="<?= $postDetail['name'] ?>"><br>
            Category: <br>  
            <select name="category">
                <?php
                    $listCategory=$category->buildSelectBox();
                    foreach ($listCategory as $key=>$value) {?>
                    <option <?= $key == $postDetail['cate_id'] ? 'selected' : '' ?> value="<?= $key ?>"><?= $value ?></option>
                    <?php }?>
            </select> <br>
            Description: <br>
            <textarea name="descrtiption" cols="30" rows="5"><?= $postDetail['description'] ?></textarea> <br>
            Content: <br>
            <textarea name="content" cols="30" rows="10"><?= $postDetail['content'] ?></textarea> <br>
            <input type="submit" name="submit" value="Post">
            <input type="button" onclick="window.location.href='<?= $router->createUrl('posts/index') ?>'" value="Cancel">
        </form>
    </div>
</body>

</html>