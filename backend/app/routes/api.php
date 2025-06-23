<?php

	use App\Controllers\AuthController;
	use App\Controllers\CustomerController;
	use App\Controllers\ProductController;
	use app\Controllers\OrderController;
	use App\Controllers\PurchaseController;
	use App\Controllers\VendorController;
	
	$router = new Router(); // Custom or 3rd-party
	
	/* Auth Routes  */
	$router->post('/api/login', [AuthConroller::class,'login']);
	$router->post('/api/register',[AuthController::class,'register']);
	
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
	$router->('/api/orders/report/[from}{to}', [OrderController::class,'salesReport']);
	$router->('/api/orders/top-items', [OrderController::class,'topItems']);
	
	/* Purchase Routes */
	$router->get('/api/purchases/report/{from}/{to}', [PurchaseController::class, 'purchaseReport']);
	
	/* Vendor Routes  */
	$router->get('/api/vendors', [VendorController::class, 'index']);
	$router->get('/api/vendors/{id}', [VendorController::class, 'show']);
