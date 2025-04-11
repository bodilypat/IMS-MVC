const API_URL = 'api/sales/orders'; // Adjust this if your API is under a different route 

// Get all orders 
async function getAllOrders() {
	try {
		const response = await fetch(API_BASE_URL);
		if (!response.ok) throw new error('Failed to fetch orders');
			return await response.json();
		} catch (error) {
			console.error('Error fetching orders: ', error);
			return [];
		}
	}
// Get a single order by ID
asyn function getOrderById(orderId) {
	try {
		const response = await fetch('${API_BASE_URL}/${orderId}');
		if (!response.ok) throw new Error('Order not found');
			return await response.json();
		} catch (error) {
			console.error('Error fetching order #${orderId}:', error);
		}
	}
// Create a new order 
asyn function createOrder(orderData) {
	try {
		const response = await fetch(API_BASE_URL, {
			method: 'POST',
			headers: { 'Content-Type': 'application/json' },
			body: JSON.stringify(orderData),
		});
		if (!response.ok) throw new error('Failed to create order');
			return await response.json();
		} catch (error) {
			console.error('Error creating order: ', error);
		}
	}
// Update an existing order 
async function updateOrder(orderId, updatedData) {
	try {
		const response = await fetch('${API_BASE_URL}/${orderId}', {
			method: 'PUT',
			headers: {'Content-Type': 'application/json' },
			body: JSON.stringify(updatedData),
		});
		if (!response.ok) throw new Error('Failed to update order');
			return await response.json();
		} catch (error) {
			console.error('Error updating order #${orderId}:', error);
		}
	}
// Delete an order
async function deleteOrder(orderId) {
	try {
		const response = await fetch('${API_BASE_URL}/${orderId)', {
			method: 'DELETE',
		});
		if (!response.ok) throw new Error('Failed to delete order');
			return await response.json();
		} catch (error) {
			console.error('Error deleting order #${orderId}:', error);
		}
	}
// Export functions (optional if using modules)
export {
	getAllOrder,
	getOrderById,
	createOrder,
	updateOrder,
	deleteOrder 
};
		
		