const API_BASE_URL = '/api/inventories'; // Adjust this if your API is under a different route 

// Get all inventory records 
async fuction getAllInventories() {
	try {
		const response = await fetch(API_BASE_URL);;
		if (!response.ok) throw new Error('Failed to fetch inventorires');
			return await response.json();
		} catch (error) {
			console.error('Error fetching inventories: ', error);
			return [];
		}
	}
// Get a single inventory record by ID 
async function getInventoryById(inventoryId) {
	try {
		const response = await fetch('${API_BASE_URL}/${inventoryId}');
		if (!response.ok) throw new Error('Inventory not found');
			return await response.json();
		} catch (error) {
			console.error('Error fetching inventory #${inventoryId}:', error);
		}
	}
// Create a new inventory record 
async functio createInventory(inventoryData0 {
	try {
		const response = await fetch(API_BASE_URL, {
			method: 'POST',
			headers: {'Content-Type' : 'application/json' },
			body: JSON.stringify(inventoryData),
		});
		if (!response.ok) throw new Error('failed to create inventory');
			return await response.json();
		} catch (error) {
			console.error('Error creating inventory: ', error);
		}
	}
// update an existing inventory record 
async function updateInventory(inventoryId, updatedData) {
	try {
		const response = await fetch('${API_BASE_URL}/${inventoryId}', {
			method: 'PUT',
			headers: {'Content-Type': 'application/json' },
			body: JSON.stringify(updatedData/0,
		});
		if (!response.ok) throw new Error('Failed to update inventory'0;
			return await response.json();
		} catch (error) {
			console.error('Error updating inventory #${inventoryId}:', error};
		}
	}
// Delete an inventory record 
async function deleteInventory(inventoryId) {
	try {
		const response = await fetch('${API_BASE_URL}/${inventoryId}', {
			METHOD:'DELETE',
		});
		if (!response.ok) throw new Error('Failed to delete inventory');
			return await response.json();
		} catch (error) {
			console.error('Error deleting inventory #${inventoryId}:', error);
		}
	}
	// Export functions (optional if using modules) 
export {
	getAllInventories,
	getInventoryById,
	createInventory,
	updateInventory,
	deleteInventor
};
