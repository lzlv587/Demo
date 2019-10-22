<?php
$config=require './config.php';
$index_config=array(
    'DEFAULT_THEME'=>'default',
    'TMPL_PARSE_STRING'=>array(
        '__PUBLIC__'=>__ROOT__.'/'.APP_NAME.'/Tpl/default/Public',
    ),
);
return array_merge($config,$index_config);
?>