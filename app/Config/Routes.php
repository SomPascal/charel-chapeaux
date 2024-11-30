<?php

use App\Controllers\Admin\ChangePasswordController;
use App\Controllers\CookieController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\ErrorController;
use App\Controllers\HomeController;
use App\Controllers\ItemController;
use App\Controllers\Admin\LoginController;
use App\Controllers\Admin\RegisterController;
use App\Controllers\DraftController;
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
    $routes->post('register', [RegisterController::class, 'attemptRegister'], ['as' => 'admin.att-register']);
    
    $routes->get('{locale}/change-password', [ChangePasswordController::class, 'changePswd'], ['as' => 'admin.change-pswd']);
    $routes->post('change-password', [ChangePasswordController::class, 'attemptChangePswd'], ['as' => 'admin.att-change-pswd']);

    $routes->get('logout', [LoginController::class, 'logoutAction'], ['as' => 'admin.logout']);

    $routes->get('/', [DashboardController::class, 'index'], ['as' => 'admin.index']);

    $routes->group('{locale}', function(RouteCollection $routes) {
        $routes->get('/', [DashboardController::class, 'home'], ['as' => 'admin.home']);
        $routes->get('stats', [DashboardController::class, 'stats'], ['as' => 'admin.stats']);
        $routes->get('manage', [DashboardController::class, 'manage'], ['as' => 'admin.manage']);
        $routes->get('items', [DashboardController::class, 'items'], ['as' => 'admin.items']);
    
        $routes->get('content', [DashboardController::class, 'content'], ['as' => 'admin.content']);
        $routes->get('(:num)', [DashboardController::class, 'show'], ['as' => 'admin.show']);
    });
});

$routes->get('/', [HomeController::class, 'index'], ['as' => 'index']);
$routes->get('{locale}', [HomeController::class, 'home'], ['as' => 'home']);
$routes->post('accept-cookie', [CookieController::class, 'accept'], ['as' => 'cookie.accept']);

$routes->group('item', function(RouteCollection $routes) {
    $routes->get('{locale}/item/(:hash)', [ItemController::class, 'show'], ['as' => 'item.show']);
    $routes->get('like', [ItemController::class, 'like'], ['as' => 'item.like']);
    $routes->get('unlike', [ItemController::class, 'unlike'], ['as' => 'item.unlike']);
});

$routes->set404Override(sprintf('%s::%s', ErrorController::class, 'pageNotFound'));
