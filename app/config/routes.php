<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 *
 * Copyright (c) 2020 Ronald M. Marasigan
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package LavaLust
 * @author Ronald M. Marasigan <ronald.marasigan@yahoo.com>
 * @since Version 1
 * @link https://github.com/ronmarasigan/LavaLust
 * @license https://opensource.org/licenses/MIT MIT License
 */

/*
| -------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------
| Here is where you can register web routes for your application.
|
|
*/
/** @var object $router **/

$router->get('/', 'Welcome::index');

/*
| -------------------------------------------------------------------
| Student Information Page Routes
| -------------------------------------------------------------------
*/
$router->get('/student', 'StudentController::index');

$router->get('/student/profile', 'StudentController::profile')
	   ->middleware('student.access');

/*
| -------------------------------------------------------------------
| Users Page Route
| -------------------------------------------------------------------
*/
$router->get('/users', 'UsersController::usertable');
<<<<<<< HEAD

/*
| -------------------------------------------------------------------
| Authentication Routes (Laboratory Exercise No. 5)
| -------------------------------------------------------------------
*/
$router->get('/login', 'AuthController::login');
$router->post('/login', 'AuthController::login');
$router->get('/register', 'AuthController::register');
$router->post('/register', 'AuthController::register');
$router->get('/logout', 'AuthController::logout');

/*
| -------------------------------------------------------------------
| Product Management Routes (Laboratory Exercise No. 5)
| -------------------------------------------------------------------
| Authenticated users may view /products. Only administrators may access
| /products/create, /products/edit/{id} and /products/delete/{id}.
*/
$router->group(['prefix' => 'products', 'middleware' => 'auth.access'], function ($router) {
	$router->get('/', 'ProductController::index');
	$router->group(['middleware' => 'admin.access'], function ($router) {
		$router->get('/create', 'ProductController::create');
		$router->post('/create', 'ProductController::create');
		$router->get('/edit/{id}', 'ProductController::edit');
		$router->post('/edit/{id}', 'ProductController::edit');
		$router->post('/delete/{id}', 'ProductController::delete');
	});
});
=======
>>>>>>> 701aab6aad5a1b25657c38ecb3e3f03579662e8b
