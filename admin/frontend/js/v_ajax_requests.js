// Base URL of your API endpoint (replace with your actual endpoint)
const API_URL = 'http://psmedical.com/admin/admin/api/vendors.php';

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