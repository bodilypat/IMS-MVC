<?php
    session_start();
    /* Redirect the user to login page  */
    if (!isset($_SESSION['loginId'])) {
        header('Location: login.php');
        exit();
    }
    require_once('api/db.php');
    require_once('outline/header');
?>
<body>
    <?php
        require 'include/navigation.php';
    ?>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <h1 class="my-4"></h1>
                <div class="nav" id="tab" role="tablist">
                    <a class="nav-link" id="customer-tab">Customers</a>
                    <a class="nav-link" id="order-tab">Orders</a>
                    <a class="nav-link" id="order-item-tab">Itemss</a>
                    <a class="nav-link" id="products-tab">Puurchase</a>
                    <a class="nav-link" id="stock">Suppliers</a>
                    <a class="nav-link" id="purchase-tab">Vendors</a>
                    <a class="nav-link" id="subpplier-tab">Products</a>
                    <a class="nav-link" id="category-tab">Categories</a>
                    <a class="nav-link" id="report-tab">Reports</a>
                    <a class="nav-link" id="settings">Setting</a>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="tab-conten">
                    <div class="tab-panel-fade" id="panel_customer" role="tabpanel">
                            <div class="card-outline">
                                <div class="card-header">Customer Detail</div>
                                <div class="card-body">
                                    <div id="customerMessage"></div>
                                    <form id="customerForm">
                                        <!-- Full Name, Status, and Customer ID -->
                                        <fieldset>
                                            <legend>Customer Information</legend>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="customer_name">Full Name</label>
                                                    <input type="text" class="form-control" id="customer_name" name="customer_name" required placeholder="Enter Full Name">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="status">Status</label>
                                                    <select id="status" name="status" class="form-control chosenSeelected" required>
                                                        <option value="Active">Active</option>
                                                        <option value="Inactive">Inactive</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="customer_id">Customer ID</label>
                                                    <input type="text" class="form-control" id="customer_id" name="customer_id" title="Auto generated new customer" autocomplete="off" readonly>
                                                </div>
                                            </div>
                                        </fieldset>

                                        <!-- Mobile Phone, Phone, and Email -->
                                        <fieldset>
                                            <legend>Contact Information</legend>
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <label for="customer_mobile">Mobile Phone</label>
                                                    <input type="tel" class="form-control" id="customer_mobile" name="customer_mobile" required placeholder="Enter Mobile Phone">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="customer_phone">Phone</label>
                                                    <input type="tel" class="form-control" id="customer_phone" name="customer_phone" placeholder="Enter Phone">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="customer_email">Email</label>
                                                    <input type="email" class="form-control" id="customer_email" name="customer_email" placeholder="Enter Email">
                                                </div>
                                            </div>
                                        </fieldset>

                                        <!-- Address Section -->
                                        <fieldset>
                                            <legend>Address</legend>
                                            <div class="form-row">
                                                <label for="customer_address">Address</label>
                                                <textarea class="form-control" id="customer_address" name="customer_address" placeholder="Enter Address" rows="3"></textarea>
                                            </div>
                                        </fieldset>

                                        <!-- Location Information: City, State, and Zipcode -->
                                        <fieldset>
                                            <legend>Location</legend>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="city">City</label>
                                                    <input type="text" class="form-control" id="city" name="city" placeholder="Enter City">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="state">State</label>
                                                    <select class="form-control" id="state" name="state" required>
                                                        <?php include('include/stateList.html'); ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="zipcode">Zipcode</label>
                                                    <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Enter Zipcode" pattern="\d{5}" title="5-digit Zipcode">
                                                </div>
                                            </div>
                                        </fieldset>

                                        <!-- Action Buttons -->
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-success" id="add_customer" name="add_customer">Add Customer</button>
                                                <button type="button" class="btn btn-primary">Update Customer</button>
                                                <button type="button" class="btn btn-danger">Delete Customer</button>
                                                <button type="reset" class="btn btn-secondary">Clear</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-panel-fade" id="panel_items" role="tabpanel">
                            <div class="card-outline">
                                <div class="card-header">Items</div>
                                <div class="card-body">
                                    <!-- Area to show the ajax message from validations/db submission -->
                                    <div id="ordersMessage"></div>
                                    <form>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="itemID">Item ID:</label>
                                                <input type="text" id="item_id" name="item_id" class="form-control" autocomplete="off">
                                                <div id="itemNumberSuggestions" class="customList"></div>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="customerID">Customer ID:</label>
                                                <input type="number" class="form-control" id="customer_id" name="customer_id" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="orderDate">Order Date:</label>
                                                <input type="date" class="form-control" id="order_date" name="order_date" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="status">Status:</label>
                                                <select id="status" name="status" class="form-control">
                                                    <option value="Pending" selected>Pending</option>
                                                    <option value="Completed">Completed</option>
                                                    <option value="Cancelled">Cancelled</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="quantity">Quantity</label>
                                                <input type="number" id="quantity" name="quantity" class="form-control" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="price">Price ($):</label>
                                                <input type="number" id="price" name="price" class="form-control" step="0.01" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="subtotal">Subtotal ($):</label>
                                                <input type="number" id="subtotal" name="subtotal" class="form-control" step="0.01" required disabled>
                                            </div>
                                        </div>
                                        <button type="button" id="addSaleButton" class="btn btn-success">Add Order</button>
                                        <button type="button" id="updateOrderItems" class="btn btn-primary">Update Order</button>
                                        <button type="button" id="orderClear" class="btn btn-secondary">Clear</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-panel fade" id="panel_items" role="tabpanel" aria-labelledby="itemTab">
                            <div class="card-outline">
                                <div class="card-header">Item Details</div>
                                <div class="card-body">
                                <!-- Navigation for tabs -->
                                    <ul class="nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="product-tab" data-toggle="tab" href="#itemTab" aria-controls="itemTab" role="tab" aria-selected="true">Product</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="image-tab" data-toggle="tab" href="#itemImageTab" aria-controls="itemImageTab" role="tab" aria-selected="false">Upload Image</a>
                                        </li>
                                    </ul>

                                    <!-- Tab content -->
                                    <div class="tab-content">
                                    <!-- Product Details Tab -->
                                        <div id="itemTab" class="container tab-pane fade show active" role="tabpanel" aria-labelledby="product-tab">
                                            <div id="itemMessage"></div>
                                                <form id="productForm" novalidate>
                                                    <fieldset>
                                                        <legend>Product Information</legend>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-3">
                                                                <label for="ItemNumber">Item Number:</label>
                                                                <input type="text" id="Item_number" name="Item_number" class="form-control" required>
                                                            <div id="itemNumberSuggestion" class="customList"></div>
                                                            <div class="form-group col-md-3">
                                                                <label for="product-id">Product ID:</label>
                                                                <input type="number" class="form-control" id="product_id" name="product_id">
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-4">
                                                                <label for="discount">Discount %:</label>
                                                                <input type="text" class="form-control" name="discount" id="discount">
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="stock">Quantity:</label>
                                                                <input type="number" id="stock" name="stock" class="form-control" required>
                                                            </div>
                                                            <div class="form-group col-md-4">
                                                                <label for="Unit_price">Unit Price:</label>
                                                                <input type="number" id="unit_price" name="unit_price" class="form-control" required>
                                                            </div>
                                                        </div>
                                                    <div class="form-actions">
                                                    <button type="submit" id="addProduct" class="btn btn-success">Add Product</button>
                                                    <button type="button" id="updateProduct" class="btn btn-primary">Update</button>
                                                    <button type="button" id="deleteProduct" class="btn btn-danger">Delete</button>
                                                    <button type="reset" id="productClear" class="btn btn-secondary">Clear</button>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>
                                    <!-- Image Upload Tab -->
                                    <div id="itemImageTab" class="container tab-pane fade" role="tabpanel" aria-labelledby="image-tab">
                                        <div id="itemImageMessage"></div>
                                        <p>Please ensure the product is already added before uploading the image.</p>
                                        <form id="imageForm" method="post" enctype="multipart/form-data">
                                            <fieldset>
                                                <legend>Upload Product Image</legend>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="itemImageNumber">Item Number<span class="requiredIcon">*</span></label>
                                                        <input type="text" class="form-control" name="itemImageNumber" id="itemImageNumber" autocomplete="off" required>
                                                        <div id="itemImageNumberSuggestions" class="customList"></div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="itemImageName">Item Name</label>
                                                        <input type="text" class="form-control" name="itemImageName" id="itemImageName" readonly>
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="itemImageFile">Select Image (jpg, jpeg, gif, png only):</label>
                                                        <input type="file" class="form-control" id="itemImageFile" name="itemImageFile" accept="image/*">
                                                    </div>
                                                </div>

                                            <div class="form-actions">
                                                <button type="submit" id="updateImage" class="btn btn-primary">Upload Image</button>
                                                <button type="button" id="deleteImage" class="btn btn-danger">Delete Image</button>
                                                <button type="reset" class="btn btn-secondary">Clear</button>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-panel fade" id="panel_supplier" role="tabpanel">
                            <div class="card-outline">
                                <div class="card-header">Supplier Details</div>
                                <div class="card-body">
                                    <!-- Div to show the ajax message from validations/db submission -->
                                    <div id="supplierMessage"></div>
                                    <form id="supplierForm">
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="supplier_name">Supplier Name:</label>
                                                <input type="text" id="supplier_name" name="supplier_name" class="form-control" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="phone">Contact Phone:</label>
                                                <input type="text" id="phone" name="phone" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="contact_email">Contact Email:</label>
                                                <input type="email" id="contact_email" name="contact_email" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="address">Address:</label>
                                                <textarea id="address" name="address" class="form-control" required></textarea>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="city">City:</label>
                                                <input type="text" id="city" name="city" class="form-control" required>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="state">State:</label>
                                                <select id="state" name="state" class="form-control chosenSelect" required>
                                                    <?php include('include/stateList.html'); ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="zipcode">Zipcode:</label>
                                                <input type="text" id="zipcode" name="zipcode" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <button type="button" id="addSupplier" class="btn btn-success">Add Supplier</button>
                                            <button type="button" id="updateSupplier" class="btn btn-primary">Update</button>
                                            <button type="button" id="deleteSupplier" class="btn btn-danger">Delete</button>
                                            <button type="reset" id="clear" class="btn btn-secondary">Clear</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-panel fade" id="panel_vendors" role="tabpanel"> 
                            <div class="card-outline">
                                <div class="card-header">Vendor Details</div>
                                <div class="card-body">
                                    <!-- Div to show AJAX message from validations/db submission -->
                                    <div class="vendorMessage"></div>
                                    
                                    <form>
                                        <!-- Vendor Name and Email -->
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="vendor_name">Vendor Name</label>
                                                <input type="text" class="form-control" id="vendor_name" name="vendor_name" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" required>
                                            </div>
                                        </div>
                                        
                                        <!-- Status, Mobile, and Phone -->
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="status">Status</label>
                                                <input type="text" class="form-control" id="status" name="status" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="mobile">Mobile</label>
                                                <input type="tel" class="form-control" id="mobile" name="mobile" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="phone">Phone</label>
                                                <input type="tel" class="form-control" id="phone" name="phone" required>
                                            </div>
                                        </div>
                                        
                                        <!-- Address, City, State, Zipcode -->
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="address">Address</label>
                                                <textarea class="form-control" id="address" name="address" required></textarea>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="city">City</label>
                                                <input type="text" class="form-control" id="city" name="city" required>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="state">State</label>
                                                <select id="state" name="state" class="form-control chosenSelect">
                                                    <?php include('include/stateList.html'); ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="zipcode">Zipcode</label>
                                                <input type="text" class="form-control" id="zipcode" name="zipcode" required>
                                            </div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="form-row">
                                            <div class="col">
                                                <button type="button" id="add-vendor" name="addVendor" class="btn btn-success">Add Vendor</button>
                                                <button type="button" id="update-vendor" class="btn btn-primary">Update</button>
                                                <button type="button" id="delete-vendor" class="btn btn-danger">Delete</button>
                                                <button type="reset" class="btn btn-secondary">Clear</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-panel fade" id="panel_product" role="tablist">
                            <div class="card-outline">
                                <div class="card-header">Product Details</div>
                                <div class="card-body">
                                    <div id="productMessage"></div>
                                    <form>
                                        <div class="form-row">
                                            <div class="form-group">
                                                <label for="product-name">Product Name:</label>
                                                <input type="type" class="form-contrpl" id="product_name" name="product_name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="descript">Description: </label>
                                                <textarea id="description" name="description"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group">
                                                <label for="price">Price: </label>
                                                <input type="number" class="form-control" id="price" name="price">
                                            </div>
                                            <div class="form-group">
                                                <label for="quantity">Quantity: </label>
                                                <input type="number" class="form-control" id="quantity" name="quantity">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group">
                                                <label for="vendor-id">Vendor ID: </label>
                                                <input type="number" class="form-control" id="vendor_id" name="vendor_id" required>
                                            </div>
                                            <div class="form-group"></div>
                                        </div>
                                        <button type="button" id="add_product" class="btn-primary">Add Product</button>
                                        <button type="button" id="update_product" class="btn-primary">Update</button>
                                        <button type="button" id="delete_product" class="btn-danger">Delte</button>
                                        <button type="reset" id="clear" class="btn">Clear</button>
                                    </form>
                                </div>
                            </div>
                        </div>       
                </div>
            </div>                     
        </div>
    </div> 
</body>