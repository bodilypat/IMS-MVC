// Frontend/js/views/stockView.js 

export const stockView = {
    render(transactions) {
        const tbody = document.getElementById('stock-table-body');
        tbody.innerHTML = '';
        transactions.forEach(tx => {
            const row = `<tr>
                <td>${tx.sku}</td>
                <td>${tx.type}</td>
                <td>${tx.quantity}</td>
                <td>${new Date(tx.date).toLocaleDateString()}</td>
            </tr>`;
            tbody.innerHTML += row;
        });
    },
    showMessage(msg, color = 'green') {
        const msgBox = document.getElementById('stock-message');
        msgBox.textContent = msg;
        msgBox.style.color = color;
        setTimeout(() => msgBox.textContent = '', 3000);
    }
};