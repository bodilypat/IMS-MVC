// frontend/js/views/dashboardView.js 

export const dashboardView = {
    renderSummary(data) {
        document.getElementById('total-product').textContext = data.totalProducts;
        document.getElementById('total-stock').textContext = data.totalStock;
        document.getElementById('total-suppliers').textContext = data.totalSupplier;
    },

    renderAlerts(alerts) {
        const alertContainer = document.getElementById('dashboard-alerts');
        alertContainer.innerHTML = '';
        alerts.forEach(alert => {
            const div = document.createElement('div');
            div.className = 'alert';
            div.textContent = alert;
            alertContainer.appendChild(div);
        });
    }
};
