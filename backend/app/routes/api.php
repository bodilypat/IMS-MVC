<?php

	use App\Controllers\AuthController;
	use App\Controllers\CustomerController;
	use App\Controllers\ProductController;
	use app\Controllers\OrderController;
	use App\Controllers\PurchaseController;
	use App\Controllers\VendorController;
	
	$router = new Router(); // Custom or 3rd-party
	
	/* Auth Routes  */
	$router->post('/api/login', [AuthController::class,'login']);
	$router->get('/api/verify', [AuthController::class, 'verify']);
	$router->post('/api/register',[AuthController::class,'register']);
	$router->post('/api/logout', [AuthController::class, 'logout']);
	
	/* Customer Router */
	$router->get('/api/customers', [CustomerController::class,'index']);
	$router->get('/api/customers/{id}' ,[CustomerController::class,'show']);
	$router->post('/api/customers', [CustomerController::class,'store']);
	$router->put('/api/customers', [CustomerController::class,'update');
	$router->delete('/api/customers', [CustomerController::class,'destroy');
	
	/* Product router */
	$router->get('/api/products/', [ProductController::class, 'index');
	$router->get(['/api/products/{id}', [ProductController::class, 'show');
	$router->post('/api/products', [ProductController::class, 'store']);
	$router->put('/api/products/{id}', [ProductController::class,'update']);
	$router->delete('/api/products/{id}', [ProductController::class,'destroy']);
	
	/* Order Routes */
	$router->get('/api/orders', [OrderController::class,'index']);
	$router->get('api/orders/{id}' , [OrderController::class, 'show']);
	$router->post('/api/orders', [OrderController::class, 'store']);
	$router->put('/api/orders/{id}', [OrderController::class, 'update']);
	$router->put('/api/orders/{id}', [OrderController::class,'destroy']);
	
	$router->get('/api/orders/report/{from}/{to}', [OrderController::class,'salesReport']);
	$router->get('/api/orders/top-items', [OrderController::class,'topItems']);
	
	/* Purchase Routes */
	$router->get('/api/purchases/report/{from}/{to}', [PurchaseController::class, 'purchaseReport']);
	
	/* Vendor Routes  */
	$router->get('/api/vendors', [VendorController::class, 'index']);
	$router->get('/api/vendors/{id}', [VendorController::class, 'show']);
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	