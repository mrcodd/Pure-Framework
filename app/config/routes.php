<?php

route::add('/', 'Home@Index', 'GET');
route::add('404', 'Error@Index', 'GET');

route::error(function(){
    $uri = $GLOBALS['path']['base'] . '/404';
    header("Location:{$uri}");
});

?>