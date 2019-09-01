<?php
use LSYS\PostService\KuaiDi100Free;
include_once __DIR__."/../vendor/autoload.php";
$kuaidi=new KuaiDi100Free();
$data=$kuaidi->query("shentong", "3370493125180");
var_dump($data);
