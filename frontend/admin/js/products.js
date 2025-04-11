// Base URL of your API endpoint (consider setting this dynamically via env/config if needed)
const API_URL = 'api/products.php';

// Generic fetch function to handle all requests (DRY principle)
async function fetchData(url, options = {}) {
  try {
    const response = await fetch(url, options);
    const contentType = response.headers.get('content-type');

    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }

    if (contentType && contentType.includes('application/json')) {
      return await response.json();
    } else {
      throw new Error('Invalid response format');
    }
  } catch (error) {
    console.error('Fetch error:', error);
    alert(`An error occurred: ${error.message}`);
    return null;
  }
}

// Fetch and display all products
async function getProducts() {
  const data = await fetchData(API_URL, { method: 'GET' });

  const container = document.getElementById('productsContainer');
  container.innerHTML = ''; // Reset

  if (Array.isArray(data) && data.length) {
    data.forEach(displayProduct);
  } else {
    container.innerHTML = `<p class="empty-message">No products found.</p>`;
  }
}

// Display a single product
function displayProduct(product) {
  const container = document.getElementById('productsContainer');

  const productItem = document.createElement('div');
  productItem.className = 'product-item';
  productItem.innerHTML = `
    <h3>${sanitizeHTML(product.product_name)}</h3>
    <p><strong>Description:</strong> ${sanitizeHTML(product.description || 'N/A')}</p>
    <p><strong>Price:</strong> $${parseFloat(product.price).toFixed(2)}</p>
    <p><strong>Quantity:</strong> ${product.quantity}</p>
    <p><strong>Vendor ID:</strong> ${product.vendor_id}</p>
    <button class="delete-button" data-product-id="${product.product_id}">Delete</button>
  `;

  // Add delete event
  productItem.querySelector('.delete-button').addEventListener('click', () => {
    deleteProduct(product.product_id);
  });

  container.appendChild(productItem);
}

// Create a new product
async function createProduct(event) {
  event.preventDefault();

  const productData = {
    product_name: document.getElementById('product_name').value.trim(),
    description: document.getElementById('description').value.trim(),
    price: parseFloat(document.getElementById('price').value),
    quantity: parseInt(document.getElementById('quantity').value),
    vendor_id: parseInt(document.getElementById('vendor_id').value),
  };

  if (!productData.product_name || isNaN(productData.price) || isNaN(productData.quantity)) {
    alert('Please fill in all required fields correctly.');
    return;
  }

  const data = await fetchData(API_URL, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(productData),
  });

  if (data?.message === 'Product created successfully') {
    alert('Product created successfully');
    document.getElementById('productForm').reset();
    getProducts(); // Refresh list
  } else {
    alert('Error creating product: ' + (data?.message || 'Unknown error'));
  }
}

// Delete a product
async function deleteProduct(productId) {
  const confirmDelete = confirm('Are you sure you want to delete this product?');

  if (!confirmDelete) return;

  const data = await fetchData(`${API_URL}?id=${productId}`, { method: 'DELETE' });

  if (data?.message === 'Product deleted successfully') {
    alert('Product deleted successfully');
    getProducts(); // Refresh list
  } else {
    alert('Error deleting product: ' + (data?.message || 'Unknown error'));
  }
}

// Simple HTML sanitizer
function sanitizeHTML(str) {
  const temp = document.createElement('div');
  temp.textContent = str;
  return temp.innerHTML;
}

// Initialize page
window.addEventListener('DOMContentLoaded', () => {
  getProducts();
  document.getElementById('productForm').addEventListener('submit', createProduct);
});
