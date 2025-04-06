// Base URL of your API endpoint (replace with your actual endpoint)
const API_URL = 'http://psmedical.com/ventories/backend/api/customers.php';

// Function to fetch all customers
async function getCustomers() {
  try {
    const response = await fetch(API_URL, { method: 'GET' });
    const data = await response.json();

    if (Array.isArray(data) && data.length > 0) {
      displayCustomers(data);
    } else {
      alert("No customers found.");
    }
  } catch (error) {
    console.error('Error fetching customers:', error);
    alert('An error occurred while fetching customers.');
  }
}

// Function to display customers on the page
function displayCustomers(customers) {
  const customerList = document.getElementById('customerList');
  customerList.innerHTML = ''; // Clear previous list

  customers.forEach(customer => {
    const customerItem = document.createElement('div');
    customerItem.classList.add('customer-item');
    customerItem.innerHTML = `
      <p>ID: ${customer.customer_id}</p>
      <p>Name: ${customer.full_name}</p>
      <p>Email: ${customer.email || 'N/A'}</p>
      <p>Phone: ${customer.mobile}</p>
      <p>Address: ${customer.address}</p>
      <p>Status: ${customer.status}</p>
      <button onclick="editCustomer(${customer.customer_id})">Edit</button>
      <button onclick="deleteCustomer(${customer.customer_id})">Delete</button>
    `;
    customerList.appendChild(customerItem);
  });
}

// Function to handle form submission (create or update customer)
async function submitCustomerForm(isUpdate = false, customerId = null) {
  const customerData = getCustomerFormData();
  
  if (isUpdate) {
    await updateCustomer(customerId, customerData);
  } else {
    await createCustomer(customerData);
  }
}

// Function to get customer form data
function getCustomerFormData() {
  return {
    full_name: document.getElementById('full_name').value,
    email: document.getElementById('email').value,
    mobile: document.getElementById('mobile').value,
    phone: document.getElementById('phone').value,
    address: document.getElementById('address').value,
    city: document.getElementById('city').value,
    state: document.getElementById('state').value,
    status: document.getElementById('status').value,
  };
}

// Function to create a new customer
async function createCustomer(customerData) {
  try {
    const response = await fetch(API_URL, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(customerData),
    });

    const data = await response.json();
    if (data.message === 'New customer created successfully') {
      alert('Customer created successfully');
      getCustomers();  // Refresh the customer list
    } else {
      alert('Error creating customer: ' + data.message);
    }
  } catch (error) {
    console.error('Error creating customer:', error);
    alert('An error occurred while creating the customer.');
  }
}

// Function to fetch a single customer by ID
async function getCustomerById(customerId) {
  try {
    const response = await fetch(`${API_URL}?id=${customerId}`, { method: 'GET' });
    const data = await response.json();

    if (data) {
      populateEditForm(data);
    } else {
      alert('Customer not found.');
    }
  } catch (error) {
    console.error('Error fetching customer:', error);
    alert('An error occurred while fetching the customer.');
  }
}

// Function to populate the form for editing
function populateEditForm(customer) {
  document.getElementById('full_name').value = customer.full_name;
  document.getElementById('email').value = customer.email;
  document.getElementById('mobile').value = customer.mobile;
  document.getElementById('phone').value = customer.phone;
  document.getElementById('address').value = customer.address;
  document.getElementById('city').value = customer.city;
  document.getElementById('state').value = customer.state;
  document.getElementById('status').value = customer.status;

  const submitButton = document.getElementById('submitButton');
  submitButton.onclick = function() {
    submitCustomerForm(true, customer.customer_id);
  };
}

// Function to update an existing customer
async function updateCustomer(customerId, updatedData) {
  try {
    const response = await fetch(`${API_URL}?id=${customerId}`, {
      method: 'PUT',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(updatedData),
    });

    const data = await response.json();
    if (data.message === 'Customer updated successfully') {
      alert('Customer updated successfully');
      getCustomers();  // Refresh the customer list
    } else {
      alert('Error updating customer: ' + data.message);
    }
  } catch (error) {
    console.error('Error updating customer:', error);
    alert('An error occurred while updating the customer.');
  }
}

// Function to delete a customer
async function deleteCustomer(customerId) {
  if (confirm("Are you sure you want to delete this customer?")) {
    try {
      const response = await fetch(`${API_URL}?id=${customerId}`, {
        method: 'DELETE',
      });
      const data = await response.json();

      if (data.message === 'Customer deleted successfully') {
        alert('Customer deleted successfully');
        getCustomers();  // Refresh the customer list
      } else {
        alert('Error deleting customer: ' + data.message);
      }
    } catch (error) {
      console.error('Error deleting customer:', error);
      alert('An error occurred while deleting the customer.');
    }
  }
}

// Call getCustomers when the page loads to show the list of customers
window.onload = getCustomers;

// Base URL of your API endpoint (replace with your actual endpoint)
const API_URL = 'http://psmedical.com/ventories/backend/api/items.php';

// Function to fetch all items
function getItems() {
  fetch(API_URL, {
    method: 'GET',
  })
  .then(response => response.json())
  .then(data => {
    if (Array.isArray(data) && data.length > 0) {
      displayItems(data);
    } else {
      alert("No items found.");
    }
  })
  .catch(error => console.error('Error fetching items:', error));
}

// Function to display items on the page
function displayItems(items) {
  const itemList = document.getElementById('itemList');
  itemList.innerHTML = ''; // Clear previous list

  items.forEach(item => {
    const itemElement = document.createElement('div');
    itemElement.classList.add('item');
    itemElement.innerHTML = `
      <p>Item ID: ${item.item_id}</p>
      <p>Item Name: ${item.item_name}</p>
      <p>Item Number: ${item.item_number}</p>
      <p>Price: $${item.unit_price}</p>
      <p>Stock: ${item.stock}</p>
      <p>Status: ${item.status}</p>
      <p>Description: ${item.description}</p>
      <button onclick="editItem(${item.item_id})">Edit</button>
      <button onclick="deleteItem(${item.item_id})">Delete</button>
    `;
    itemList.appendChild(itemElement);
  });
}

// Function to create a new item
function createItem() {
  const itemData = {
    item_number: document.getElementById('item_number').value,
    product_id: document.getElementById('product_id').value,
    item_name: document.getElementById('item_name').value,
    discount: parseFloat(document.getElementById('discount').value),
    stock: parseInt(document.getElementById('stock').value),
    unit_price: parseFloat(document.getElementById('unit_price').value),
    image_url: document.getElementById('image_url').value || 'imageNotAvailable.jpg',
    status: document.getElementById('status').value,
    description: document.getElementById('description').value,
  };

  fetch(API_URL, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(itemData),
  })
  .then(response => response.json())
  .then(data => {
    if (data.message === 'New item created successfully') {
      alert('Item created successfully');
      getItems();  // Refresh the items list
    } else {
      alert('Error creating item: ' + data.message);
    }
  })
  .catch(error => console.error('Error creating item:', error));
}

// Function to fetch a single item by ID
function getItemById(itemId) {
  fetch(`${API_URL}?id=${itemId}`, {
    method: 'GET',
  })
  .then(response => response.json())
  .then(data => {
    if (data) {
      populateEditForm(data);
    } else {
      alert('Item not found.');
    }
  })
  .catch(error => console.error('Error fetching item:', error));
}

// Function to populate the form with the item's data for editing
function populateEditForm(item) {
  document.getElementById('item_number').value = item.item_number;
  document.getElementById('product_id').value = item.product_id;
  document.getElementById('item_name').value = item.item_name;
  document.getElementById('discount').value = item.discount;
  document.getElementById('stock').value = item.stock;
  document.getElementById('unit_price').value = item.unit_price;
  document.getElementById('image_url').value = item.image_url;
  document.getElementById('status').value = item.status;
  document.getElementById('description').value = item.description;

  document.getElementById('submitButton').onclick = function() {
    updateItem(item.item_id);
  };
}

// Function to update an existing item
function updateItem(itemId) {
  const updatedData = {
    item_number: document.getElementById('item_number').value,
    product_id: document.getElementById('product_id').value,
    item_name: document.getElementById('item_name').value,
    discount: parseFloat(document.getElementById('discount').value),
    stock: parseInt(document.getElementById('stock').value),
    unit_price: parseFloat(document.getElementById('unit_price').value),
    image_url: document.getElementById('image_url').value,
    status: document.getElementById('status').value,
    description: document.getElementById('description').value,
  };

  fetch(`${API_URL}?id=${itemId}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(updatedData),
  })
  .then(response => response.json())
  .then(data => {
    if (data.message === 'Item updated successfully') {
      alert('Item updated successfully');
      getItems();  // Refresh the items list
    } else {
      alert('Error updating item: ' + data.message);
    }
  })
  .catch(error => console.error('Error updating item:', error));
}

// Function to delete an item
function deleteItem(itemId) {
  if (confirm("Are you sure you want to delete this item?")) {
    fetch(`${API_URL}?id=${itemId}`, {
      method: 'DELETE',
    })
    .then(response => response.json())
    .then(data => {
      if (data.message === 'Item deleted successfully') {
        alert('Item deleted successfully');
        getItems();  // Refresh the items list
      } else {
        alert('Error deleting item: ' + data.message);
      }
    })
    .catch(error => console.error('Error deleting item:', error));
  }
}

// Call getItems when the page loads to show the list of items
window.onload = getItems;

// Base URL of your API endpoint (replace with your actual endpoint)
const API_URL = 'http://psmedical.com/ventories/backend/api/orders.php';

// Function to fetch all orders
function getOrders() {
  fetch(API_URL, {
    method: 'GET',
  })
  .then(response => response.json())
  .then(data => {
    if (Array.isArray(data) && data.length > 0) {
      displayOrders(data);
    } else {
      alert("No orders found.");
    }
  })
  .catch(error => console.error('Error fetching orders:', error));
}

// Function to display orders on the page
function displayOrders(orders) {
  const orderList = document.getElementById('orderList');
  orderList.innerHTML = ''; // Clear previous list

  orders.forEach(order => {
    const orderItem = document.createElement('div');
    orderItem.classList.add('order-item');
    orderItem.innerHTML = `
      <p>Order ID: ${order.order_id}</p>
      <p>Item ID: ${order.item_id}</p>
      <p>Customer ID: ${order.customer_id}</p>
      <p>Order Date: ${order.order_date}</p>
      <p>Discount: ${order.discount}</p>
      <p>Quantity: ${order.quantity}</p>
      <p>Unit Price: ${order.unit_price}</p>
      <p>Total Price: ${order.total_price}</p>
      <p>Status: ${order.status}</p>
      <button onclick="editOrder(${order.order_id})">Edit</button>
      <button onclick="deleteOrder(${order.order_id})">Delete</button>
    `;
    orderList.appendChild(orderItem);
  });
}

// Function to create a new order
function createOrder() {
  const orderData = {
    item_id: document.getElementById('item_id').value,
    customer_id: document.getElementById('customer_id').value,
    order_date: document.getElementById('order_date').value,
    discount: document.getElementById('discount').value,
    quantity: document.getElementById('quantity').value,
    unit_price: document.getElementById('unit_price').value,
    status: document.getElementById('status').value,
  };

  fetch(API_URL, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(orderData),
  })
  .then(response => response.json())
  .then(data => {
    if (data.message === 'New order created successfully') {
      alert('Order created successfully');
      getOrders();  // Refresh the order list
    } else {
      alert('Error creating order: ' + data.message);
    }
  })
  .catch(error => console.error('Error creating order:', error));
}

// Function to fetch a single order by ID
function getOrderById(orderId) {
  fetch(`${API_URL}?id=${orderId}`, {
    method: 'GET',
  })
  .then(response => response.json())
  .then(data => {
    if (data) {
      populateEditForm(data);
    } else {
      alert('Order not found.');
    }
  })
  .catch(error => console.error('Error fetching order:', error));
}

// Function to populate the form for editing
function populateEditForm(order) {
  document.getElementById('item_id').value = order.item_id;
  document.getElementById('customer_id').value = order.customer_id;
  document.getElementById('order_date').value = order.order_date;
  document.getElementById('discount').value = order.discount;
  document.getElementById('quantity').value = order.quantity;
  document.getElementById('unit_price').value = order.unit_price;
  document.getElementById('status').value = order.status;

  document.getElementById('submitButton').onclick = function() {
    updateOrder(order.order_id);
  };
}

// Function to update an existing order
function updateOrder(orderId) {
  const updatedData = {
    item_id: document.getElementById('item_id').value,
    customer_id: document.getElementById('customer_id').value,
    order_date: document.getElementById('order_date').value,
    discount: document.getElementById('discount').value,
    quantity: document.getElementById('quantity').value,
    unit_price: document.getElementById('unit_price').value,
    status: document.getElementById('status').value,
  };

  fetch(`${API_URL}?id=${orderId}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(updatedData),
  })
  .then(response => response.json())
  .then(data => {
    if (data.message === 'Order updated successfully') {
      alert('Order updated successfully');
      getOrders();  // Refresh the order list
    } else {
      alert('Error updating order: ' + data.message);
    }
  })
  .catch(error => console.error('Error updating order:', error));
}

// Function to delete an order
function deleteOrder(orderId) {
  if (confirm("Are you sure you want to delete this order?")) {
    fetch(`${API_URL}?id=${orderId}`, {
      method: 'DELETE',
    })
    .then(response => response.json())
    .then(data => {
      if (data.message === 'Order deleted successfully') {
        alert('Order deleted successfully');
        getOrders();  // Refresh the order list
      } else {
        alert('Error deleting order: ' + data.message);
      }
    })
    .catch(error => console.error('Error deleting order:', error));
  }
}

// Call getOrders when the page loads to show the list of orders
window.onload = getOrders;

// Base URL of your API endpoint (replace with your actual endpoint)
const API_URL = 'http://psmedical.com/ventories/backend/api/vendors.php';

// Function to fetch all vendors
function getVendors() {
  fetch(API_URL, {
    method: 'GET',
  })
  .then(response => response.json())
  .then(data => {
    if (Array.isArray(data) && data.length > 0) {
      displayVendors(data);
    } else {
      alert("No vendors found.");
    }
  })
  .catch(error => console.error('Error fetching vendors:', error));
}

// Function to display vendors on the page
function displayVendors(vendors) {
  const vendorList = document.getElementById('vendorList');
  vendorList.innerHTML = ''; // Clear previous list

  vendors.forEach(vendor => {
    const vendorItem = document.createElement('div');
    vendorItem.classList.add('vendor-item');
    vendorItem.innerHTML = `
      <p>Vendor ID: ${vendor.vendor_id}</p>
      <p>Name: ${vendor.vendor_name}</p>
      <p>Email: ${vendor.email || 'N/A'}</p>
      <p>Mobile: ${vendor.mobile}</p>
      <p>Phone: ${vendor.phone || 'N/A'}</p>
      <p>Address: ${vendor.address}</p>
      <p>City: ${vendor.city || 'N/A'}</p>
      <p>State: ${vendor.state}</p>
      <p>Status: ${vendor.status}</p>
      <button onclick="editVendor(${vendor.vendor_id})">Edit</button>
      <button onclick="deleteVendor(${vendor.vendor_id})">Delete</button>
    `;
    vendorList.appendChild(vendorItem);
  });
}

// Function to create a new vendor
function createVendor() {
  const vendorData = {
    vendor_name: document.getElementById('vendor_name').value,
    email: document.getElementById('email').value,
    mobile: document.getElementById('mobile').value,
    phone: document.getElementById('phone').value,
    address: document.getElementById('address').value,
    city: document.getElementById('city').value,
    state: document.getElementById('state').value,
    status: document.getElementById('status').value,
  };

  fetch(API_URL, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(vendorData),
  })
  .then(response => response.json())
  .then(data => {
    if (data.message === 'New vendor created successfully') {
      alert('Vendor created successfully');
      getVendors();  // Refresh the vendor list
    } else {
      alert('Error creating vendor: ' + data.message);
    }
  })
  .catch(error => console.error('Error creating vendor:', error));
}

// Function to fetch a single vendor by ID
function getVendorById(vendorId) {
  fetch(`${API_URL}?id=${vendorId}`, {
    method: 'GET',
  })
  .then(response => response.json())
  .then(data => {
    if (data) {
      populateEditForm(data);
    } else {
      alert('Vendor not found.');
    }
  })
  .catch(error => console.error('Error fetching vendor:', error));
}

// Function to populate the form with the vendor's data for editing
function populateEditForm(vendor) {
  document.getElementById('vendor_name').value = vendor.vendor_name;
  document.getElementById('email').value = vendor.email;
  document.getElementById('mobile').value = vendor.mobile;
  document.getElementById('phone').value = vendor.phone;
  document.getElementById('address').value = vendor.address;
  document.getElementById('city').value = vendor.city;
  document.getElementById('state').value = vendor.state;
  document.getElementById('status').value = vendor.status;

  document.getElementById('submitButton').onclick = function() {
    updateVendor(vendor.vendor_id);
  };
}

// Function to update an existing vendor
function updateVendor(vendorId) {
  const updatedData = {
    vendor_name: document.getElementById('vendor_name').value,
    email: document.getElementById('email').value,
    mobile: document.getElementById('mobile').value,
    phone: document.getElementById('phone').value,
    address: document.getElementById('address').value,
    city: document.getElementById('city').value,
    state: document.getElementById('state').value,
    status: document.getElementById('status').value,
  };

  fetch(`${API_URL}?id=${vendorId}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(updatedData),
  })
  .then(response => response.json())
  .then(data => {
    if (data.message === 'Vendor updated successfully') {
      alert('Vendor updated successfully');
      getVendors();  // Refresh the vendor list
    } else {
      alert('Error updating vendor: ' + data.message);
    }
  })
  .catch(error => console.error('Error updating vendor:', error));
}

// Function to delete a vendor
function deleteVendor(vendorId) {
  if (confirm("Are you sure you want to delete this vendor?")) {
    fetch(`${API_URL}?id=${vendorId}`, {
      method: 'DELETE',
    })
    .then(response => response.json())
    .then(data => {
      if (data.message === 'Vendor deleted successfully') {
        alert('Vendor deleted successfully');
        getVendors();  // Refresh the vendor list
      } else {
        alert('Error deleting vendor: ' + data.message);
      }
    })
    .catch(error => console.error('Error deleting vendor:', error));
  }
}

// Call getVendors when the page loads to show the list of vendors
window.onload = getVendors;

// Base URL of your API endpoint (replace with your actual endpoint)
const API_URL = 'http://psmedical.com/ventories/backend/api/products.php';

// Function to handle all fetch requests, ensuring DRY (Don't Repeat Yourself) principle
async function fetchData(url, options = {}) {
  try {
    const response = await fetch(url, options);
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }
    return await response.json();
  } catch (error) {
    console.error('Fetch error:', error);
    alert('An error occurred while processing the request.');
  }
}

// Fetch all products
async function getProducts() {
  const data = await fetchData(API_URL, { method: 'GET' });

  if (Array.isArray(data) && data.length > 0) {
    displayProducts(data);
  } else {
    document.getElementById('productsContainer').innerHTML = 'No products found.';
  }
}

// Display products on the page
function displayProducts(products) {
  const productsContainer = document.getElementById('productsContainer');
  productsContainer.innerHTML = ''; // Clear previous products

  products.forEach(product => {
    const productItem = document.createElement('div');
    productItem.classList.add('product-item');
    productItem.innerHTML = `
      <h3>${product.product_name}</h3>
      <p><strong>Description:</strong> ${product.description || 'N/A'}</p>
      <p><strong>Price:</strong> $${product.price}</p>
      <p><strong>Quantity:</strong> ${product.quantity}</p>
      <p><strong>Vendor ID:</strong> ${product.vendor_id}</p>
      <button class="delete-button" data-product-id="${product.product_id}">Delete</button>
    `;
    productsContainer.appendChild(productItem);
  });

  // Attach event listeners to delete buttons after displaying products
  document.querySelectorAll('.delete-button').forEach(button => {
    button.addEventListener('click', (e) => {
      const productId = e.target.getAttribute('data-product-id');
      deleteProduct(productId);
    });
  });
}

// Create a new product
async function createProduct(event) {
  event.preventDefault();

  const productData = {
    product_name: document.getElementById('product_name').value,
    description: document.getElementById('description').value,
    price: document.getElementById('price').value,
    quantity: document.getElementById('quantity').value,
    vendor_id: document.getElementById('vendor_id').value,
  };

  const data = await fetchData(API_URL, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(productData),
  });

  if (data.message === 'Product created successfully') {
    alert('Product created successfully');
    getProducts();  // Refresh product list
  } else {
    alert('Error creating product: ' + data.message);
  }
}

// Delete a product
async function deleteProduct(productId) {
  if (confirm('Are you sure you want to delete this product?')) {
    const data = await fetchData(`${API_URL}?id=${productId}`, { method: 'DELETE' });

    if (data.message === 'Product deleted successfully') {
      alert('Product deleted successfully');
      getProducts();  // Refresh product list
    } else {
      alert('Error deleting product: ' + data.message);
    }
  }
}

// Call getProducts when the page loads
window.onload = function() {
  getProducts();
  document.getElementById('productForm').addEventListener('submit', createProduct);
};

// Base URL of your API endpoint (replace with your actual endpoint)
const API_URL = 'http://psmedical.com/ventories/backend/api/users.php'; // Replace with actual API URL

// Function to fetch all users
function getUsers() {
  fetch(API_URL, {
    method: 'GET',
  })
  .then(response => response.json())
  .then(data => {
    if (Array.isArray(data) && data.length > 0) {
      displayUsers(data);
    } else {
      document.getElementById('usersContainer').innerHTML = 'No users found.';
    }
  })
  .catch(error => console.error('Error fetching users:', error));
}

// Function to display users on the page
function displayUsers(users) {
  const usersContainer = document.getElementById('usersContainer');
  usersContainer.innerHTML = ''; // Clear previous user list

  users.forEach(user => {
    const userItem = document.createElement('div');
    userItem.classList.add('user-item');
    userItem.innerHTML = `
      <h3>${user.fullName}</h3>
      <p><strong>Username:</strong> ${user.username}</p>
      <p><strong>Status:</strong> ${user.status}</p>
      <button class="edit" onclick="editUser(${user.user_id})">Edit</button>
      <button onclick="deleteUser(${user.user_id})">Delete</button>
    `;
    usersContainer.appendChild(userItem);
  });
}

// Function to create a new user
function createUser(event) {
  event.preventDefault();

  const userData = {
    fullName: document.getElementById('fullName').value,
    username: document.getElementById('username').value,
    password: document.getElementById('password').value,
    status: document.getElementById('status').value,
  };

  fetch(API_URL, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(userData),
  })
  .then(response => response.json())
  .then(data => {
    if (data.message === 'User created successfully') {
      alert('User created successfully');
      getUsers();  // Refresh the user list
    } else {
      alert('Error creating user: ' + data.message);
    }
  })
  .catch(error => console.error('Error creating user:', error));
}

// Function to edit a user
function editUser(userId) {
  fetch(`${API_URL}?id=${userId}`, {
    method: 'GET',
  })
  .then(response => response.json())
  .then(data => {
    if (data) {
      populateEditForm(data);
    } else {
      alert('User not found.');
    }
  })
  .catch(error => console.error('Error fetching user:', error));
}

// Function to populate the edit form
function populateEditForm(user) {
  document.getElementById('fullName').value = user.fullName;
  document.getElementById('username').value = user.username;
  document.getElementById('password').value = ''; // Password should be blanked out for security
  document.getElementById('status').value = user.status;

  const userForm = document.getElementById('userForm');
  userForm.querySelector('button').textContent = 'Update User'; // Change button text to 'Update'

  // Change form submission to update user
  userForm.onsubmit = function(event) {
    event.preventDefault();
    updateUser(user.user_id);
  };
}

// Function to update an existing user
function updateUser(userId) {
  const updatedData = {
    fullName: document.getElementById('fullName').value,
    username: document.getElementById('username').value,
    password: document.getElementById('password').value,
    status: document.getElementById('status').value,
  };

  fetch(`${API_URL}?id=${userId}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(updatedData),
  })
  .then(response => response.json())
  .then(data => {
    if (data.message === 'User updated successfully') {
      alert('User updated successfully');
      getUsers();  // Refresh the user list
      document.getElementById('userForm').querySelector('button').textContent = 'Create User'; // Reset button text
    } else {
      alert('Error updating user: ' + data.message);
    }
  })
  .catch(error => console.error('Error updating user:', error));
}

// Function to delete a user
function deleteUser(userId) {
  if (confirm("Are you sure you want to delete this user?")) {
    fetch(`${API_URL}?id=${userId}`, {
      method: 'DELETE',
    })
    .then(response => response.json())
    .then(data => {
      if (data.message === 'User deleted successfully') {
        alert('User deleted successfully');
        getUsers();  // Refresh the user list
      } else {
        alert('Error deleting user: ' + data.message);
      }
    })
    .catch(error => console.error('Error deleting user:', error));
  }
}

// Fetch users on page load
window.onload = function() {
  getUsers();
  document.getElementById('userForm').addEventListener('submit', createUser);
};

