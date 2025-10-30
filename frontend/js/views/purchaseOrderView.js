// Frontend/js/views/purchaseView.js

export const purchaseOrderView = {
    render(purchases) {
        const tbody = document.getElementById('purchase-table-body');
        tbody.innerHTML = '';
        purchases.forEach(po => {
            const row = `<tr>
                    <td>${po.sku}</td>
                    <td>${po.supplier}</td>
                    <td>${po.quantity}</td>
                    <td>${po.price}</td>
                    <td>${new Date(po.date).toLocaleDateString()}</td>
                </tr>`;
                tbody.innerHTML += row;
        });
    },

    showMessage(msg, color = 'green') {
        const msgBox = document.getElementById('purchase-message');
        msgBox.textContent = msg;
        msgBox.style.color = color;
        setTimeout(() => msgBox.textContent = '', 3000);
    }
};
