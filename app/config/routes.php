<?php

$router->get('iMAG', 'DefaultController:index');

$router->get('iMAG/register', 'SecurityController:register');

$router->get('iMAG/users', 'SecurityController:saveUser');

$router->post('iMAG/users', 'SecurityController:saveUser');

$router->get('iMAG/login', 'SecurityController:login');

$router->post('iMAG/login', 'SecurityController:signIn');

$router->get('iMAG/tableUsers', 'UsersController:tableUsers');

$router->get('iMAG/logout', 'SecurityController:logout');

$router->get('iMAG/view', 'UsersController:viewUser');

$router->post('iMAG/addProduct', 'ProductController:addProduct');

$router->get('iMAG/updateProduct', 'ProductController:updateProduct');

$router->post('iMAG/updateProduct', 'ProductController:saveProduct');

$router->get('iMAG/delete', 'UsersController:deleteUser');

$router->get('iMAG/edit', 'UsersController:updateUser');

$router->post('iMAG/update', 'UsersController:saveUser');

$router->get('iMAG/viewProduct', 'ProductController:viewProduct');

$router->get('iMAG/search', 'ProductController:searchProduct');

$router->post('iMAG/filters', 'DefaultController:filters');

$router->post('iMAG/addToCart', 'CartController:add');

$router->get('iMAG/cart', 'CartController:viewCart');

$router->post('iMAG/ajax-remove-from-cart', 'CartController:removeFromCart');


