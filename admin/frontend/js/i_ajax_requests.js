// Base URL of your API endpoint (replace with your actual endpoint)
const API_URL = 'http://psmedical.com/admin/admin/api/items.php';

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