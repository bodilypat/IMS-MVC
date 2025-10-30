// Frontend/js/views/inventoryView.js 

export const inventoryView = {
    render(items) {
        const tbody = document.getElementById('inventory-table-body');
        tbody.innerHTML = '';
        items.forEach(item => {
            const row = `<tr>
                    <td>${item.sku}</td>
                    <td>${item.name}</td>
                    <td>${item.quantity_in_stock}</td>
                    <td>${item.price}</td>
                </tr>`;
                tbody.innerHTML += row;
        });
    },
    showMessage(msg, color = 'green') {
        const msgBox = document.getElementById('inventory-message');
        msgBox.textContent = msg;
        msgBox.style.color = color;
        setTimeout(() => msgBox.textContent = '', 3000);
    }
};
