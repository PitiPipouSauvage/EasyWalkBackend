<?php

$router->get('/users/{username}', 'UserController@show');
$router->get('/users/addFriend/{username}', 'UserController@addFriend');
$router->get('/users/friendList/{username}', 'UserController@getFriends');
$router->post('/users/auth/{username}/{password}', 'UserController@login');
$router->post('/users', 'UserController@store');
$router->get('/users', 'UserController@index');