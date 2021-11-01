<?php
include '../apps/bootstrap.php';

$a = new Apps_Models_Users();
$result = $a->buildQueryParams([
    "select"=>"*",
            "where"=>""
])->select();
foreach ($result as $key => $value) {
    foreach ($value as $key => $field) {
        echo $key.': '.$field.'<br>';
    }
}