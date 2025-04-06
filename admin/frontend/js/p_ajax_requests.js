const API_URL = 'http://psmedical.com/admin/api/products.php';

// Fetch all products
function getProducts() {
  fetch(API_URL, {
    method: 'GET',
  })
  .then(response => response.json())
  .then(data => {
    if (Array.isArray(data) && data.length > 0) {
      displayProducts(data);
    } else {
      document.getElementById('productsContainer').innerHTML = 'No products found.';
    }
  })
  .catch(error => console.error('Error fetching products:', error));
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
      <button onclick="deleteProduct(${product.product_id})">Delete</button>
    `;
    productsContainer.appendChild(productItem);
  });
}

// Create a new product
function createProduct(event) {
  event.preventDefault();

  const productData = {
    product_name: document.getElementById('product_name').value,
    description: document.getElementById('description').value,
    price: document.getElementById('price').value,
    quantity: document.getElementById('quantity').value,
    vendor_id: document.getElementById('vendor_id').value,
  };

  fetch(API_URL, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(productData),
  })
  .then(response => response.json())
  .then(data => {
    if (data.message === 'Product created successfully') {
      alert('Product created successfully');
      getProducts();  // Refresh product list
    } else {
      alert('Error creating product: ' + data.message);
    }
  })
  .catch(error => console.error('Error creating product:', error));
}

// Delete a product
function deleteProduct(productId) {
  if (confirm('Are you sure you want to delete this product?')) {
    fetch(`${API_URL}?id=${productId}`, {
      method: 'DELETE',
    })
    .then(response => response.json())
    .then(data => {
      if (data.message === 'Product deleted successfully') {
        alert('Product deleted successfully');
        getProducts();  // Refresh product list
      } else {
        alert('Error deleting product: ' + data.message);
      }
    })
    .catch(error => console.error('Error deleting product:', error));
  }
}

// Call getProducts when the page loads
window.onload = function() {
  getProducts();
  document.getElementById('productForm').addEventListener('submit', createProduct);
};
