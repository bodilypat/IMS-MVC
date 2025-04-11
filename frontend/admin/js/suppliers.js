const API_BASE_URL = '/api/suppliers';

// Fetch all suppliers
async function fetchSuppliers() {
  try {
    const response = await fetch(API_BASE_URL);
    const data = await response.json();
    console.log('Suppliers:', data);
    return data;
  } catch (error) {
    console.error('Error fetching suppliers:', error);
  }
}

// Fetch a single supplier by ID
async function fetchSupplierById(supplierId) {
  try {
    const response = await fetch(`${API_BASE_URL}/${supplierId}`);
    const data = await response.json();
    console.log('Supplier:', data);
    return data;
  } catch (error) {
    console.error(`Error fetching supplier ${supplierId}:`, error);
  }
}

// Create a new supplier
async function createSupplier(supplierData) {
  try {
    const response = await fetch(API_BASE_URL, {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(supplierData),
    });
    const data = await response.json();
    console.log('Supplier created:', data);
    return data;
  } catch (error) {
    console.error('Error creating supplier:', error);
  }
}

// Update an existing supplier
async function updateSupplier(supplierId, updatedData) {
  try {
    const response = await fetch(`${API_BASE_URL}/${supplierId}`, {
      method: 'PUT',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(updatedData),
    });
    const data = await response.json();
    console.log('Supplier updated:', data);
    return data;
  } catch (error) {
    console.error(`Error updating supplier ${supplierId}:`, error);
  }
}

// Soft delete a supplier
async function deleteSupplier(supplierId) {
  try {
    const response = await fetch(`${API_BASE_URL}/${supplierId}`, {
      method: 'DELETE',
    });
    if (response.ok) {
      console.log(`Supplier ${supplierId} deleted`);
      return true;
    } else {
      console.error(`Failed to delete supplier ${supplierId}`);
      return false;
    }
  } catch (error) {
    console.error(`Error deleting supplier ${supplierId}:`, error);
  }
}