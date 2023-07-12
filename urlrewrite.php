<?php
$arUrlRewrite=array (
  13 => 
  array (
    'CONDITION' => '#^/courses/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)/module/([0-9]+)/#',
    'RULE' => 'course=$1&moduleId=$4',
    'ID' => '',
    'PATH' => '/courses/module/index.php',
    'SORT' => 100,
  ),
  7 => 
  array (
    'CONDITION' => '#^/courses/([\\.\\-0-9a-zA-Z]+)(/?)([^/]*)/test/#',
    'RULE' => 'course=$1',
    'ID' => '',
    'PATH' => '/courses/test/index.php',
    'SORT' => 100,
  ),
  0 => 
  array (
    'CONDITION' => '#^\\/?\\/mobileapp/jn\\/(.*)\\/.*#',
    'RULE' => 'componentName=$1',
    'ID' => NULL,
    'PATH' => '/bitrix/services/mobileapp/jn.php',
    'SORT' => 100,
  ),
  10 => 
  array (
    'CONDITION' => '#^/blog/?page=([0-9]+)#',
    'RULE' => 'PAGEN_15=$1',
    'ID' => 'bitrix:news',
    'PATH' => '/blog/',
    'SORT' => 100,
  ),
  14 => 
  array (
    'CONDITION' => '#^/personal/test/#',
    'RULE' => '',
    'ID' => 'aelita:test.profile',
    'PATH' => '/personal/test/index.php',
    'SORT' => 100,
  ),
  3 => 
  array (
    'CONDITION' => '#^/solutions/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/solutions/index.php',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^/insights/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/insights/index.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^/project/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/project/index.php',
    'SORT' => 100,
  ),
  15 => 
  array (
    'CONDITION' => '#^/courses/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/courses/index.php',
    'SORT' => 100,
  ),
  8 => 
  array (
    'CONDITION' => '#^/events/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/events/index.php',
    'SORT' => 100,
  ),
  9 => 
  array (
    'CONDITION' => '#^/cases/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/cases/index.php',
    'SORT' => 100,
  ),
  12 => 
  array (
    'CONDITION' => '#^/media/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/media/index.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
  5 => 
  array (
    'CONDITION' => '#^/test/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/test/index.php',
    'SORT' => 100,
  ),
  11 => 
  array (
    'CONDITION' => '#^/blog/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/blog/index.php',
    'SORT' => 100,
  ),
);
