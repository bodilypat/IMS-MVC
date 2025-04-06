// Base URL of your API endpoint (replace with your actual endpoint)
const API_URL = 'http://yourdomain.com/api/orders.php';

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