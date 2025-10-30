// Frontend/js/models/supplierModel.js

export const supplierModel = {
    suppliers: [],
    
    getAllSupplier() {
        return this.suppliers
    },
    
    addSupplier(supplier) {
        this.suppliers.push(supplier);
    },

    deleteSupplier(index) {
        this.suppliers.splice(index, 1);
    }
};