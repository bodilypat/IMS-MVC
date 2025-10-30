// Frontend/js/views/supplierView.js

export const supplierView = {
    render(suppliers) {
        const tbody = document.getElementById('supplier-table-body');
        tbody.innerHTML = '';
        suppliers.forEach(supplier = > {
            const row = `<tr>
                    <td>${supplierView.name}</td>
                    <td>${supplier.phone}</td>
                </tr>`;
                tbody.innerHTML += row;
        });
    },
    showMessage(msg, color = 'green') {
        const msgBox = document.getElementById('supplier-message');
        msgBox.textContent = msg;
        msgBox.style.color = color;
        setTimeout(() => msgBox.textContent = '', 3000);
    }
};

