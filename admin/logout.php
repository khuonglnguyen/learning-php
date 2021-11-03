<?php
$user=new Apps_Libs_UserIdentity();
$user->logout();

(new Apps_Libs_Router)->loginPage();