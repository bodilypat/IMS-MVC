// Frontend/js/views/authView.js 

export const authView = {
    showMessage(msg, color = 'red') {
        const msgBox = document.getElementById('login-message');
        msgBox.textContent = msg;
        msgBox.style.color = color;
        setTimeout(() => msgBox.textContent = '', 3000);
    }
};
