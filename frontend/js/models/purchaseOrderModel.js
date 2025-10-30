// Frontend/js/models/purchaseOrderModel.js 

export const PurchaseModel = {
    purchase: [],

    getAllPurchase() {
        return this.purchase;
    },

    addPurchase(purchase) {
        this.purchases.push(purchase);
    }
};

