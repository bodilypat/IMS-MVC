// Base URL of your API endpoint (replace with your actual endpoint)
const API_URL = 'http://psmedical.com/admin/api/suppliers.php';

// Function to fetch all suppliers
function getSuppliers() {
  fetch(API_URL, {
    method: 'GET',
  })
  .then(response => response.json())
  .then(data => {
    if (Array.isArray(data) && data.length > 0) {
      displaySuppliers(data);
    } else {
      alert("No suppliers found.");
    }
  })
  .catch(error => console.error('Error fetching suppliers:', error));
}

// Function to display suppliers on the page
function displaySuppliers(suppliers) {
  const supplierList = document.getElementById('supplierList');
  supplierList.innerHTML = ''; // Clear previous list

  suppliers.forEach(supplier => {
    const supplierItem = document.createElement('div');
    supplierItem.classList.add('supplier-item');
    supplierItem.innerHTML = `
      <p>Supplier ID: ${supplier.supplier_id}</p>
      <p>Supplier Name: ${supplier.supplier_name}</p>
      <p>Contact Info: ${supplier.contact_info || 'N/A'}</p>
      <p>Address: ${supplier.address}</p>
      <p>Created At: ${supplier.created_at}</p>
      <p>Updated At: ${supplier.updated_at}</p>
      <button onclick="editSupplier(${supplier.supplier_id})">Edit</button>
      <button onclick="deleteSupplier(${supplier.supplier_id})">Delete</button>
    `;
    supplierList.appendChild(supplierItem);
  });
}

// Function to create a new supplier
function createSupplier() {
  const supplierData = {
    supplier_name: document.getElementById('supplier_name').value,
    contact_info: document.getElementById('contact_info').value,
    address: document.getElementById('address').value,
  };

  fetch(API_URL, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(supplierData),
  })
  .then(response => response.json())
  .then(data => {
    if (data.message === 'New supplier created successfully') {
      alert('Supplier created successfully');
      getSuppliers();  // Refresh the supplier list
    } else {
      alert('Error creating supplier: ' + data.message);
    }
  })
  .catch(error => console.error('Error creating supplier:', error));
}

// Function to fetch a single supplier by ID
function getSupplierById(supplierId) {
  fetch(`${API_URL}?id=${supplierId}`, {
    method: 'GET',
  })
  .then(response => response.json())
  .then(data => {
    if (data) {
      populateEditForm(data);
    } else {
      alert('Supplier not found.');
    }
  })
  .catch(error => console.error('Error fetching supplier:', error));
}

// Function to populate the form for editing
function populateEditForm(supplier) {
  document.getElementById('supplier_name').value = supplier.supplier_name;
  document.getElementById('contact_info').value = supplier.contact_info;
  document.getElementById('address').value = supplier.address;

  document.getElementById('submitButton').onclick = function() {
    updateSupplier(supplier.supplier_id);
  };
}

// Function to update an existing supplier
function updateSupplier(supplierId) {
  const updatedData = {
    supplier_name: document.getElementById('supplier_name').value,
    contact_info: document.getElementById('contact_info').value,
    address: document.getElementById('address').value,
  };

  fetch(`${API_URL}?id=${supplierId}`, {
    method: 'PUT',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(updatedData),
  })
  .then(response => response.json())
  .then(data => {
    if (data.message === 'Supplier updated successfully') {
      alert('Supplier updated successfully');
      getSuppliers();  // Refresh the supplier list
    } else {
      alert('Error updating supplier: ' + data.message);
    }
  })
  .catch(error => console.error('Error updating supplier:', error));
}

// Function to delete a supplier
function deleteSupplier(supplierId) {
  if (confirm("Are you sure you want to delete this supplier?")) {
    fetch(`${API_URL}?id=${supplierId}`, {
      method: 'DELETE',
    })
    .then(response => response.json())
    .then(data => {
      if (data.message === 'Supplier deleted successfully') {
        alert('Supplier deleted successfully');
        getSuppliers();  // Refresh the supplier list
      } else {
        alert('Error deleting supplier: ' + data.message);
      }
    })
    .catch(error => console.error('Error deleting supplier:', error));
  }
}

// Call getSuppliers when the page loads to show the list of suppliers
window.onload = getSuppliers;
