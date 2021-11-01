<?php
include '../apps/bootstrap.php';

$a = new Apps_Models_Users();
$result = $a->buildQueryParams([
    "field"=>"(username,password) values (?,?)",
            "value"=>["admin",md5("admin")]
])->insert();
var_dump($result);
// foreach ($result as $key => $value) {
//     foreach ($value as $key => $field) {
//         echo $key.': '.$field.'<br>';
//     }
// }