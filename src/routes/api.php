<?php

$router->get('/users', 'UserController@index');
$router->post('/users', 'UserController@store');
$router->get('/users/{username}', 'UserController@show');
$router->get('/users/addFriend/{username}', 'UserController@addFriend');
$router->get('/users/friendList/{username}', 'UserController@getFriends');
