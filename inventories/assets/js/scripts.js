document.addEventListener('DOMContentLoaded', function () {
    // Fetch and display customers when the page loads
    fetchCustomers();

    // Handle form submission for adding a new customer
    const form = document.getElementById('addCustomerForm');
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(form);

        // Create an object from the form data
        const data = {
            full_name: formData.get('full_name'),
            email: formData.get('email'),
            mobile: formData.get('mobile'),
            phone: formData.get('phone'),
            address: formData.get('address'),
            city: formData.get('city'),
            state: formData.get('state'),
            status: formData.get('status')
        };

        // Send data to backend via API (using fetch)
        fetch('add_customer.php', {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(responseData => {
            if (responseData.success) {
                alert('Customer added successfully!');
                form.reset();
                fetchCustomers(); // Refresh customer list
            } else {
                alert('Error adding customer');
            }
        });
    });
});

// Fetch and display customers
function fetchCustomers() {
    fetch('get_customers.php')  // This PHP endpoint should return all customer data as JSON
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector('#customerTable tbody');
            tableBody.innerHTML = ''; // Clear the table body

            data.forEach(customer => {
                const row = document.createElement('tr');
                
                row.innerHTML = `
                    <td>${customer.full_name}</td>
                    <td>${customer.email || 'N/A'}</td>
                    <td>${customer.mobile}</td>
                    <td>${customer.phone || 'N/A'}</td>
                    <td>${customer.address}</td>
                    <td>${customer.city || 'N/A'}</td>
                    <td>${customer.state}</td>
                    <td>${customer.status}</td>
                    <td>
                        <button class="edit" onclick="editCustomer(${customer.customer_id})">Edit</button>
                        <button class="delete" onclick="deleteCustomer(${customer.customer_id})">Delete</button>
                    </td>
                `;
                
                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error fetching customers:', error));
}

// Edit customer functionality (you can implement a form for editing as needed)
function editCustomer(customerId) {
    alert('Editing customer ID: ' + customerId);
    // Add logic for editing a customer here, maybe redirect to an edit form
}

// Delete customer functionality
function deleteCustomer(customerId) {
    if (confirm('Are you sure you want to delete this customer?')) {
        fetch('delete_customer.php', {
            method: 'POST',
            body: JSON.stringify({ customer_id: customerId }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(responseData => {
            if (responseData.success) {
                alert('Customer deleted successfully!');
                fetchCustomers(); // Refresh customer list
            } else {
                alert('Error deleting customer');
            }
        });
    }
}
$(document).ready(function () {
    // Fetch and display items on page load
    fetchItems();

    // Handle adding a new item
    $('#addItemForm').on('submit', function (event) {
        event.preventDefault();

        const itemData = {
            product_id: $('#product_id').val(),
            item_number: $('#item_number').val(),
            item_name: $('#item_name').val(),
            discount: $('#discount').val(),
            stock: $('#stock').val(),
            unit_price: $('#unit_price').val(),
            imageURL: $('#imageURL').val(),
            description: $('#description').val(),
            status: $('#status').val()
        };

        $.ajax({
            url: 'add_item.php',  // PHP file to handle adding item
            type: 'POST',
            data: JSON.stringify(itemData),
            contentType: 'application/json',
            success: function (response) {
                alert('Item added successfully');
                fetchItems();  // Refresh the items list
            },
            error: function () {
                alert('Error adding item.');
            }
        });
    });

    // Fetch all items from the database and display in table
    function fetchItems() {
        $.ajax({
            url: 'get_items.php',  // PHP file to get items
            type: 'GET',
            success: function (response) {
                const items = JSON.parse(response);
                let rows = '';
                items.forEach(item => {
                    rows += `
                        <tr>
                            <td>${item.item_id}</td>
                            <td>${item.product_id}</td>
                            <td>${item.item_number}</td>
                            <td>${item.item_name}</td>
                            <td>${item.stock}</td>
                            <td>${item.unit_price}</td>
                            <td>${item.status}</td>
                            <td>
                                <button class="delete-btn" onclick="deleteItem(${item.item_id})">Delete</button>
                            </td>
                        </tr>
                    `;
                });
                $('#itemsTable tbody').html(rows);
            },
            error: function () {
                alert('Error fetching items.');
            }
        });
    }

    // Handle deleting an item
    window.deleteItem = function (itemId) {
        if (confirm('Are you sure you want to delete this item?')) {
            $.ajax({
                url: 'delete_item.php',  // PHP file to handle deleting item
                type: 'POST',
                data: JSON.stringify({ item_id: itemId }),
                contentType: 'application/json',
                success: function () {
                    alert('Item deleted successfully');
                    fetchItems();  // Refresh the items list
                },
                error: function () {
                    alert('Error deleting item.');
                }
            });
        }
    };
});
// Fetch existing orders from the server and populate the table
function fetchOrders() {
    $.ajax({
        url: 'get_orders.php',  // API endpoint for getting orders
        method: 'GET',
        success: function(data) {
            const orders = JSON.parse(data);
            let rows = '';
            orders.forEach(order => {
                rows += `
                    <tr>
                        <td>${order.order_id}</td>
                        <td>${order.item_name}</td>
                        <td>${order.customer_name}</td>
                        <td>${order.order_date}</td>
                        <td>${order.quantity}</td>
                        <td>${order.unit_price}</td>
                        <td>${order.total_price}</td>
                        <td>${order.status}</td>
                        <td>
                            <button onclick="deleteOrder(${order.order_id})">Delete</button>
                        </td>
                    </tr>
                `;
            });
            $('#ordersTable tbody').html(rows);
        }
    });
}

// Fetch items and customers to populate the dropdowns
function fetchItemsAndCustomers() {
    // Fetch items
    $.ajax({
        url: 'get_items.php',  // API endpoint for getting items
        method: 'GET',
        success: function(data) {
            const items = JSON.parse(data);
            let options = '';
            items.forEach(item => {
                options += `<option value="${item.item_id}">${item.item_name}</option>`;
            });
            $('#item_id').html(options);
        }
    });

    // Fetch customers
    $.ajax({
        url: 'get_customers.php',  // API endpoint for getting customers
        method: 'GET',
        success: function(data) {
            const customers = JSON.parse(data);
            let options = '';
            customers.forEach(customer => {
                options += `<option value="${customer.customer_id}">${customer.full_name}</option>`;
            });
            $('#customer_id').html(options);
        }
    });
}

// Handle order form submission to create a new order
$('#orderForm').on('submit', function(event) {
    event.preventDefault();

    const orderData = {
        item_id: $('#item_id').val(),
        customer_id: $('#customer_id').val(),
        order_date: $('#order_date').val(),
        quantity: $('#quantity').val(),
        unit_price: $('#unit_price').val(),
        discount: $('#discount').val(),
        status: $('#status').val()
    };

    $.ajax({
        url: 'add_order.php',  // API endpoint for adding an order
        method: 'POST',
        data: JSON.stringify(orderData),
        contentType: 'application/json',
        success: function(response) {
            alert('Order created successfully!');
            fetchOrders();  // Refresh the orders list
        }
    });
});

// Handle deleting an order
function deleteOrder(orderId) {
    if (confirm('Are you sure you want to delete this order?')) {
        $.ajax({
            url: 'delete_order.php',  // API endpoint for deleting an order
            method: 'POST',
            data: JSON.stringify({ order_id: orderId }),
            contentType: 'application/json',
            success: function(response) {
                alert('Order deleted successfully!');
                fetchOrders();  // Refresh the orders list
            }
        });
    }
}

// Initialize page by fetching orders and items/customers
$(document).ready(function() {
    fetchOrders();
    fetchItemsAndCustomers();
});
$(document).ready(function () {
    // Fetch and display purchases on page load
    fetchPurchases();

    // Handle adding a new purchase
    $('#addPurchaseForm').on('submit', function (event) {
        event.preventDefault();

        const purchaseData = {
            item_id: $('#item_id').val(),
            purchase_date: $('#purchase_date').val(),
            unit_price: $('#unit_price').val(),
            quantity: $('#quantity').val(),
            vendor_id: $('#vendor_id').val(),
        };

        $.ajax({
            url: 'add_purchase.php',
            type: 'POST',
            data: JSON.stringify(purchaseData),
            contentType: 'application/json',
            success: function (response) {
                alert('Purchase added successfully');
                fetchPurchases();  // Refresh the purchases list
            },
            error: function () {
                alert('Error adding purchase.');
            }
        });
    });

    // Fetch all purchases from the database and display in table
    function fetchPurchases() {
        $.ajax({
            url: 'get_purchases.php',
            type: 'GET',
            success: function (response) {
                const purchases = JSON.parse(response);
                let rows = '';
                purchases.forEach(purchase => {
                    rows += `
                        <tr>
                            <td>${purchase.purchase_id}</td>
                            <td>${purchase.item_name}</td>
                            <td>${purchase.purchase_date}</td>
                            <td>${purchase.unit_price}</td>
                            <td>${purchase.quantity}</td>
                            <td>${purchase.vendor_name}</td>
                            <td>
                                <button onclick="deletePurchase(${purchase.purchase_id})">Delete</button>
                            </td>
                        </tr>
                    `;
                });
                $('#purchasesTable tbody').html(rows);
            },
            error: function () {
                alert('Error fetching purchases.');
            }
        });

        // Fetch the list of items for the select dropdown
        $.ajax({
            url: 'get_items.php',
            type: 'GET',
            success: function (response) {
                const items = JSON.parse(response);
                let itemOptions = '';
                items.forEach(item => {
                    itemOptions += `<option value="${item.item_id}">${item.item_name}</option>`;
                });
                $('#item_id').html(itemOptions);
            },
            error: function () {
                alert('Error fetching items.');
            }
        });

        // Fetch the list of vendors for the select dropdown
        $.ajax({
            url: 'get_vendors.php',
            type: 'GET',
            success: function (response) {
                const vendors = JSON.parse(response);
                let vendorOptions = '';
                vendors.forEach(vendor => {
                    vendorOptions += `<option value="${vendor.vendor_id}">${vendor.full_name}</option>`;
                });
                $('#vendor_id').html(vendorOptions);
            },
            error: function () {
                alert('Error fetching vendors.');
            }
        });
    }

    // Handle deleting a purchase
    window.deletePurchase = function (purchaseId) {
        if (confirm('Are you sure you want to delete this purchase?')) {
            $.ajax({
                url: 'delete_purchase.php',
                type: 'POST',
                data: JSON.stringify({ purchase_id: purchaseId }),
                contentType: 'application/json',
                success: function () {
                    alert('Purchase deleted successfully');
                    fetchPurchases();  // Refresh the purchases list
                },
                error: function () {
                    alert('Error deleting purchase.');
                }
            });
        }
    };
});
$(document).ready(function () {
    // Fetch and display existing suppliers on page load
    fetchSuppliers();

    // Handle adding a new supplier
    $('#addSupplierForm').on('submit', function (event) {
        event.preventDefault();

        const supplierData = {
            supplier_name: $('#supplier_name').val(),
            contact_info: $('#contact_info').val(),
            address: $('#address').val(),
        };

        $.ajax({
            url: 'add_supplier.php',
            type: 'POST',
            data: JSON.stringify(supplierData),
            contentType: 'application/json',
            success: function (response) {
                alert('Supplier added successfully');
                fetchSuppliers();  // Refresh the suppliers list
            },
            error: function () {
                alert('Error adding supplier.');
            }
        });
    });

    // Fetch all suppliers from the database and display in table
    function fetchSuppliers() {
        $.ajax({
            url: 'get_suppliers.php',
            type: 'GET',
            success: function (response) {
                const suppliers = JSON.parse(response);
                let rows = '';
                suppliers.forEach(supplier => {
                    rows += `
                        <tr>
                            <td>${supplier.supplier_id}</td>
                            <td>${supplier.supplier_name}</td>
                            <td>${supplier.contact_info}</td>
                            <td>${supplier.address}</td>
                            <td>${supplier.created_at}</td>
                            <td>${supplier.updated_at}</td>
                            <td>
                                <button onclick="deleteSupplier(${supplier.supplier_id})">Delete</button>
                            </td>
                        </tr>
                    `;
                });
                $('#suppliersTable tbody').html(rows);
            },
            error: function () {
                alert('Error fetching suppliers.');
            }
        });
    }

    // Handle deleting a supplier
    window.deleteSupplier = function (supplierId) {
        if (confirm('Are you sure you want to delete this supplier?')) {
            $.ajax({
                url: 'delete_supplier.php',
                type: 'POST',
                data: JSON.stringify({ supplier_id: supplierId }),
                contentType: 'application/json',
                success: function () {
                    alert('Supplier deleted successfully');
                    fetchSuppliers();  // Refresh the suppliers list
                },
                error: function () {
                    alert('Error deleting supplier.');
                }
            });
        }
    };
});
$(document).ready(function () {
    // Fetch and display existing vendors on page load
    fetchVendors();

    // Handle adding a new vendor
    $('#addVendorForm').on('submit', function (event) {
        event.preventDefault();

        const vendorData = {
            full_name: $('#full_name').val(),
            email: $('#email').val(),
            mobile: $('#mobile').val(),
            phone: $('#phone').val(),
            address: $('#address').val(),
            city: $('#city').val(),
            district: $('#district').val(),
            status: $('#status').val()
        };

        $.ajax({
            url: 'add_vendor.php',
            type: 'POST',
            data: JSON.stringify(vendorData),
            contentType: 'application/json',
            success: function (response) {
                alert('Vendor added successfully');
                fetchVendors();  // Refresh the vendors list
            },
            error: function () {
                alert('Error adding vendor.');
            }
        });
    });

    // Fetch all vendors from the database and display in table
    function fetchVendors() {
        $.ajax({
            url: 'get_vendors.php',
            type: 'GET',
            success: function (response) {
                const vendors = JSON.parse(response);
                let rows = '';
                vendors.forEach(vendor => {
                    rows += `
                        <tr>
                            <td>${vendor.vendor_id}</td>
                            <td>${vendor.full_name}</td>
                            <td>${vendor.email}</td>
                            <td>${vendor.mobile}</td>
                            <td>${vendor.phone}</td>
                            <td>${vendor.address}</td>
                            <td>${vendor.city}</td>
                            <td>${vendor.district}</td>
                            <td>${vendor.status}</td>
                            <td>${vendor.created_on}</td>
                            <td>${vendor.updated_on}</td>
                            <td>
                                <button onclick="deleteVendor(${vendor.vendor_id})">Delete</button>
                            </td>
                        </tr>
                    `;
                });
                $('#vendorsTable tbody').html(rows);
            },
            error: function () {
                alert('Error fetching vendors.');
            }
        });
    }

    // Handle deleting a vendor
    window.deleteVendor = function (vendorId) {
        if (confirm('Are you sure you want to delete this vendor?')) {
            $.ajax({
                url: 'delete_vendor.php',
                type: 'POST',
                data: JSON.stringify({ vendor_id: vendorId }),
                contentType: 'application/json',
                success: function () {
                    alert('Vendor deleted successfully');
                    fetchVendors();  // Refresh the vendors list
                },
                error: function () {
                    alert('Error deleting vendor.');
                }
            });
        }
    };
});
$(document).ready(function () {
    // Fetch vendors and populate vendor dropdown
    fetchVendors();

    // Fetch and display existing products on page load
    fetchProducts();

    // Handle adding a new product
    $('#addProductForm').on('submit', function (event) {
        event.preventDefault();

        const productData = {
            product_name: $('#product_name').val(),
            description: $('#description').val(),
            price: $('#price').val(),
            quantity: $('#quantity').val(),
            vendor_id: $('#vendor_id').val()
        };

        $.ajax({
            url: 'add_product.php',
            type: 'POST',
            data: JSON.stringify(productData),
            contentType: 'application/json',
            success: function (response) {
                alert('Product added successfully');
                fetchProducts();  // Refresh the products list
            },
            error: function () {
                alert('Error adding product.');
            }
        });
    });

    // Fetch all products from the database and display them in the table
    function fetchProducts() {
        $.ajax({
            url: 'get_products.php',
            type: 'GET',
            success: function (response) {
                const products = JSON.parse(response);
                let rows = '';
                products.forEach(product => {
                    rows += `
                        <tr>
                            <td>${product.product_id}</td>
                            <td>${product.product_name}</td>
                            <td>${product.description}</td>
                            <td>${product.price}</td>
                            <td>${product.quantity}</td>
                            <td>${product.vendor_name}</td> <!-- Vendor name should be fetched with the product -->
                            <td>${product.created_on}</td>
                            <td>${product.updated_on}</td>
                            <td>
                                <button onclick="deleteProduct(${product.product_id})">Delete</button>
                            </td>
                        </tr>
                    `;
                });
                $('#productsTable tbody').html(rows);
            },
            error: function () {
                alert('Error fetching products.');
            }
        });
    }

    // Fetch the list of vendors for the vendor dropdown
    function fetchVendors() {
        $.ajax({
            url: 'get_vendors.php',
            type: 'GET',
            success: function (response) {
                const vendors = JSON.parse(response);
                let options = '';
                vendors.forEach(vendor => {
                    options += `<option value="${vendor.vendor_id}">${vendor.full_name}</option>`;
                });
                $('#vendor_id').html(options);
            },
            error: function () {
                alert('Error fetching vendors.');
            }
        });
    }

    // Handle deleting a product
    window.deleteProduct = function (productId) {
        if (confirm('Are you sure you want to delete this product?')) {
            $.ajax({
                url: 'delete_product.php',
                type: 'POST',
                data: JSON.stringify({ product_id: productId }),
                contentType: 'application/json',
                success: function () {
                    alert('Product deleted successfully');
                    fetchProducts();  // Refresh the products list
                },
                error: function () {
                    alert('Error deleting product.');
                }
            });
        }
    };
});
