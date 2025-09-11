<?php

$router->get('/users/{username}', 'UserController@show');
$router->get('/users/addFriend/{username}/{friendUsername}', 'UserController@addFriend');
$router->get('/users/friendList/{username}', 'UserController@getFriends');
$router->post('/users/auth', 'UserController@login');
$router->post('/users', 'UserController@create');
$router->get('/users', 'UserController@index');
$router->get('/walks/{username}/{steps}/{walkDate}/{points}/{distance}', 'WalkController@add');
$router->get('/walks/{username}/{ammount}', 'WalkController@getWalks');
$router->get('/medals', 'MedalController@index');
$router->get('/medals/{username}', 'MedalController@listMedals');
$router->get('/medals/get/{medalId}', 'MedalController@get');
$router->get('/medals/grant/{medalId}/{username}', 'MedalController@grant');