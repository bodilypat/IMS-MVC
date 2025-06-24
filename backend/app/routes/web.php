<?php
	
	use App\Controllers\AuthController;
	use App\Controllers\CustomerController;
	use App\Controllers\ProductController;
	use App\Controllers\OrderController;
	use App\Controllers\PurchaseController;
	use App\Controllers\VendorControllers;
	
	$router = new Router();
	
	/* Web Home and Dashboard Routers */
	$router->get('/', function () {
		header('Location: /dashboard');
		exit;
	});
	
	$router->get('/dashboard', function() {
		/* Render dashboard view  */
		include __DIR__ .'/../views/dashboard.php';
	});
	
	/* Auth Routes (web) */
	$router->get('/login', function() {
		include __DIR__ .'/../views/login.php';
	});
	
	$router->post('/login', [AuthController::class,'login']);
	$router->get('/logout', function () {
		
		/* Destroy session and redirect to login */
		session_start();
		session_destroy();
		header('Location: /login');
		exit;
	});
	
	/* Customers web routes */
	$router->get('/customers', [CustomerController::class,'index']);
	$router->get('/customers/create', function () {
		include __DIR__ .'/../views/customers/create.php';
	});
	$router->post('/customers', [CustomerController::class,'store']);
	$router->get('/customers/{id}', [CustomerController::class,'show']);
	$router->get('/customers/{id}/edit', [CustomerController::class, 'edit']);
	$router->post('/customers/{id}/update' , [CustomerController::class, 'update']);
	$router->post->'/customers/{id}/delete', [CustomerController::class, 'destroy']);
	
	/* Products Web routes */
	$router->get('/products', [ProductController::class, 'index']);
	$router->get('/products/create', function() {
		include __DIR__ . '/../views/products/create.php';
	});
	$router->post('/products', [ProductController::class, 'store']);
	$router->get('/products/{id}', [ProductController::class, 'show']);
	$router->get('/products/{id}/edit', [ProductControoller::class,'edit']);
	$router->post('/products/{id}/update', [ProductController::class, 'update']);
	$router->post('/products/{id}/delete', [ProductController::class, 'destroy']);
	
	/* Order Web Routes */
	$router->get('/order', function() {
		/* Possibly render orders list view */
		include __DIR__ . '/../views/orders/index.php';
	});
	
	/* Add more web routes as needed, Vendor Web Routes */
	$router->get('/vendors', [VendorController::class, 'index']);
	$router->get('/vendors/{id}', [VendorController::class, 'show']);
	
	