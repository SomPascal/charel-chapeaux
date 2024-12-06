<?php

use App\Controllers\Admin\ChangeController;
use App\Controllers\Admin\ChangePasswordController;
use App\Controllers\Admin\ChangeUsernameController;
use App\Controllers\Admin\ContactController;
use App\Controllers\CookieController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\ErrorController;
use App\Controllers\HomeController;
use App\Controllers\ItemController;
use App\Controllers\Admin\LoginController;
use App\Controllers\Admin\RegisterController;
use App\Controllers\DraftController;
use App\Controllers\InviteAdminController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->environment('development', function(RouteCollection $routes){
    $routes->get('draft', [DraftController::class, 'index']);
});

service('auth')->routes($routes);

$routes->group('admin', function(RouteCollection $routes) {
    $routes->get('{locale}/login', [LoginController::class, 'login'], ['as' => 'admin.login']);
    $routes->post('login', [LoginController::class, 'attemptLogin'], ['as' => 'admin.att-login']);

    $routes->get('{locale}/register', [RegisterController::class, 'register'], ['as' => 'admin.register']);
    $routes->post('att-register', [RegisterController::class, 'attemptRegister'], ['as' => 'admin.att-register']);
    
    $routes->get('{locale}/change-password', [ChangePasswordController::class, 'changePswd'], ['as' => 'admin.change-pswd']);
    $routes->post('change-password', [ChangePasswordController::class, 'attemptChangePswd'], ['as' => 'admin.att-change-pswd']);
    
    $routes->get('{locale}/change-username', [ChangeUsernameController::class, 'changeUsername'], ['as' => 'admin.change-username']);
    $routes->post('change-username', [ChangeUsernameController::class, 'attemptChangeUsername'], ['as' => 'admin.att-change-username']);

    $routes->get('/', [DashboardController::class, 'index'], ['as' => 'admin.index']);

    $routes->group('{locale}', function(RouteCollection $routes) {
        $routes->get('/', [DashboardController::class, 'home'], ['as' => 'admin.home']);
        $routes->get('stats', [DashboardController::class, 'stats'], ['as' => 'admin.stats']);
        $routes->get('manage', [DashboardController::class, 'manage'], ['as' => 'admin.manage']);
        $routes->get('items', [DashboardController::class, 'items'], ['as' => 'admin.items']);
    
        $routes->get('content', [DashboardController::class, 'content'], ['as' => 'admin.content']);
        $routes->get('(:num)', [DashboardController::class, 'show'], ['as' => 'admin.show']);
    });

    $routes->group('change', ['filter' => 'group:superadmin'], function(RouteCollection $routes){
        $routes->post('role', [ChangeController::class, 'role'], ['as' => 'admin.change.role']);
        $routes->post('ban', [ChangeController::class, 'ban'], ['as' => 'admin.change.ban']);
        $routes->post('contact', [ContactController::class, 'change'], ['as' => 'admin.change.contact']);
    });
});

$routes->get('/', [HomeController::class, 'index'], ['as' => 'index']);
$routes->get('{locale}', [HomeController::class, 'home'], ['as' => 'home']);
$routes->post('accept-cookie', [CookieController::class, 'accept'], ['as' => 'cookie.accept']);

$routes->group('invite', function(RouteCollection $routes){
    $routes->get('use/(:hash)', [InviteAdminController::class, 'use'], ['as' => 'invite.use']);
    $routes->post('get', [InviteAdminController::class, 'get'], ['as' => 'invite.get', 'filter' => 'group:superadmin']);
});

$routes->get('{locale}/item/(:hash)', [ItemController::class, 'show'], ['as' => 'item.show']);

$routes->group('item', function(RouteCollection $routes) {
    $routes->post('like', [ItemController::class, 'like'], ['as' => 'item.like']);
    $routes->post('unlike', [ItemController::class, 'unlike'], ['as' => 'item.unlike']);
});

$routes->set404Override(sprintf('%s::%s', ErrorController::class, 'pageNotFound'));
