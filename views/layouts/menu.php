<?php 

$menu = [];
if(\Yii::$app->user->can('dashboard/index'))
{
    $menu[] = ["label" => "Dashboard", "url" => "/mub-admin", "icon" => "home"];        
}
if(\Yii::$app->user->can('user/index'))
{
    $menu[] = ["label" => "Patients", "url" => ["/mub-admin/users/patient"], "icon" => "users"];
    $menu[] = ["label" => "Reports", "url" => ["/mub-admin/users/report"], "icon" => "folder-open"];
}