<?php

$router->get('/users/{username}', 'UserController@show');
$router->get('/users/addFriend/{username}/{friendUsername}', 'UserController@addFriend');
$router->get('/users/friendList/{username}', 'UserController@getFriends');
$router->post('/users/auth', 'UserController@login');
$router->post('/users', 'UserController@create');
$router->get('/users', 'UserController@index');