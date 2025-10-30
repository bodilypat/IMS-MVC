// Frontend/js/app.js 

/* Import Controller */
import { AuthController } from './controllers/authController.js';
import { DashboardController } from './controllers/dashboardController.js';
import { InventoryController } from './controllers/inventoryController.js';
import { SupplierController } from './controllers/supplierController.js';
import { StockController } from './controllers/stockController.js';
import { PurchaseController } from './controllers/purchaseController.js';

document.addEventListener('DOMContentLoaded', () => {
    /* Determine which page we are an */
    const path = window.location.pathname;

    /* Initialize controllers based on the current page  */
    if  (path.includes('login.html')) {
        AuthController.init();
    } else {
        /* Check if user is logged in */
        if (!AuthController.isLoggedIn?.()) {
            window.location.href = 'login.html';
            return;
        }

        if (path.includes('dashboard.html')) {
            DashboardController.init();
        }
        else if (path.includes('inventory.html')) {
            InventoryController.init();
        }
        else if(path.includes('suppliers.html')) {
            SupplierController.init();
        }
        else if (path.includes('stock.html')) {
            StockController.init();
        }
        else if (path.includes('purchase.html')) {
            PurchaseController.init();
        }
    }
});
