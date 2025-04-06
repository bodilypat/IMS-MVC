// Base URL of your API endpoint (replace with your actual endpoint)
const API_URL = 'http://psmedical.com/admin/admin/api/customers.php';

// Function to fetch all customers
function getCustomers() {
  fetch(API_URL, {
    method: 'GET',
  })
  .then(response => response.json())
  .then(data => {
    if (Array.isArray(data) && data.length > 0) {
      displayCustomers(data);
    } else {
      alert("No customers found.");
    }
  })
  .catch(error => console.error('Error fetching customers:', error));
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

// Function to create a new customer
function createCustomer() {
  const customerData = {
    full_name: document.getElementById('full_name').value,
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
    body: JSON.stringify(customerData),
  })
  .then(response => response.json())
  .then(data => {
    if (data.message === 'New customer created successfully') {
      alert('Customer created successfully');
      getCustomers();  // Refresh the customer list
    } else {
      alert('Error creating customer: ' + data.message);
    }
  })
  .catch(error => console.error('Error creating customer:', error));
}

// Function to fetch a single customer by ID
function getCustomerById(customerId) {
  fetch(`${API_URL}?id=${customerId}`, {
    method: 'GET',
  })
  .then(response => response.json())
  .then(data => {
    if (data) {
      populateEditForm(data);
    } else {
      alert('Customer not found.');
    }
  })
  .catch(error => console.error('Error fetching customer:', error));
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

  document.getElementById('submitButton').onclick = function() {
    updateCustomer(customer.customer_id);
  };
}

// Function to update an existing customer
function updateCustomer(customerId) {
  const updatedData = {
    full_name: document.getElementById('full_name').value,
    email: document.getElementById('email').value,
    mobile: document.getElementById('mobile').value,
    phone: document.getElementById('phone').value,
    address: document.getElementById('address').value,
    city: document.getElementById('city').value,
    state: document.getElementById('state').value,
    status: document.getElementById('status').value,
  };

  fetch(`${API_URL}?id=${customerId}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(updatedData),
  })
  .then(response => response.json())
  .then(data => {
    if (data.message === 'Customer updated successfully') {
      alert('Customer updated successfully');
      getCustomers();  // Refresh the customer list
    } else {
      alert('Error updating customer: ' + data.message);
    }
  })
  .catch(error => console.error('Error updating customer:', error));
}

// Function to delete a customer
function deleteCustomer(customerId) {
  if (confirm("Are you sure you want to delete this customer?")) {
    fetch(`${API_URL}?id=${customerId}`, {
      method: 'DELETE',
    })
    .then(response => response.json())
    .then(data => {
      if (data.message === 'Customer deleted successfully') {
        alert('Customer deleted successfully');
        getCustomers();  // Refresh the customer list
      } else {
        alert('Error deleting customer: ' + data.message);
      }
    })
    .catch(error => console.error('Error deleting customer:', error));
  }
}

// Call getCustomers when the page loads to show the list of customers
window.onload = getCustomers;
